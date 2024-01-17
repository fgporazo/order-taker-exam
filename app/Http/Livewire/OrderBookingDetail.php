<?php

namespace App\Http\Livewire;
use Illuminate\Support\Facades\Hash;
use App\Models\PurchaseOrder;
use App\Models\PurchaseItem;
use App\Models\Customer;
use App\Models\Product;
use Livewire\Component;
use Carbon\Carbon;
use DB;

class OrderBookingDetail extends Component
{

    public $customer_id, $date_of_delivery, $status, $amount_due, $date_created, $timestamp, $created_by, $user_id, $current_timestamp, $order_id;
    public $itemRows = [];
    public $items = [];
    public $item_details = [];

    public function render()
    {
        $this->current_timestamp = Carbon::now()->toDateTimeString();
        $customers = Customer::all();
        $products = Product::orderBy('id','asc')->get();
        $orders = PurchaseOrder::where('id',request()->order_id)
                                ->with('items','customer')
                                ->first();
        
        return view('livewire.orders.update',[
            'orders' => $orders,
            'customers' => $customers, 
            'products' => $products
        ]); 
    }


    public function mount()
    {
        $orders = PurchaseOrder::where('id',request()->order_id)
                                ->with('items','customer')
                                ->first();
        $this->fill([
            'order_id' => $orders->id,
            'customer_id' => $orders->customer->id,
            'date_of_delivery' => $orders->date_of_delivery,
            'status' => $orders->status
        ]);

        // $this->order_id = $orders->id;

        foreach($orders->items as $item){ // set all current items of current order id
            $product = Product::find($item->SKU_ID);
            $this->itemRows[$item->SKU_ID] = [
                "id" => $item->SKU_ID,
                "name" => $product->name,
                "sku" => $product->code,
                "original_price" => $product->unit_price,
                "price" => $item->price,
                "quantity" => $item->quantity  
            ];
        
            $this->amount_due += $item->price; // set total amount due
        }
    }

  
    public function addItem(){
        $item = $this->items;
        $itemID = (int)$item["sku"];
        $itemDetails = Product::find($itemID);
        $item['id'] = $itemDetails->id;
        $item['name'] = $itemDetails->name;
        $item['sku'] = $itemDetails->code;
        $item['original_price'] = (float)$itemDetails['unit_price'];
        $item['price'] = (int)$item['quantity'] * (float)$itemDetails['unit_price'];
        $item['quantity'] = (int)$item['quantity'];
        $this->amount_due += $item['price']; 
        // dd($this->itemRows, $itemDetails, in_array($this->itemRows[$itemDetails->id] ?? '',$this->itemRows));
        if(in_array($this->itemRows[$itemDetails->id] ?? '',$this->itemRows)){
            // compute qty and price if existing
            $this->itemRows[$itemDetails->id]['quantity'] += $item['quantity']; 
            $this->itemRows[$itemDetails->id]['price'] += $item['price']; 
        }else{
            // add new sku if not existing
            $this->itemRows[$itemDetails->id] = $item;
        }
    }

    public function updateItemDetails($id){ 
        $this->item_details = [
            'id' => $this->itemRows[$id]['id'],
            'name' => $this->itemRows[$id]['name'],
            'sku' => $this->itemRows[$id]['sku'],
            'quantity' => $this->itemRows[$id]['quantity'],
            'original_price' => $this->itemRows[$id]['original_price'],
            'price' => $this->itemRows[$id]['price'],
            
        ];
        $this->emit('updateDetails');
    }

    public function updateQtyItem(){
        $item = $this->item_details;
        // update new total qty and associated total price
        $this->itemRows[$item['id']]['quantity'] = $item['quantity']; 
        $this->itemRows[$item['id']]['price'] = $item['quantity'] * $item['original_price']; 
        // compute new total price

    }

    public function resetInputFields(){
        $orders = PurchaseOrder::orderBy('timestamp','asc')->paginate(10);
    }

    public function update(){

        DB::beginTransaction();
   
        $validated = $this->validate([
            'customer_id' => 'required',
            'date_of_delivery' => 'required',
            'status'  => 'required'
        ],
        [
            'customer_id.required' => 'The customer field is required.',
            'date_of_delivery.required' => 'The date of delivery field is required.',
            'status.required' => 'The status field is required.',
        ]);
       
        try{
            
            if(!$this->itemRows){
                return flashMessage('Error...Please add items.',false);
            }
            
            // add purchase order - form
            $order = PurchaseOrder::where('id',$this->order_id)->update([
                'customer_id' => $validated['customer_id'],
                'date_of_delivery' => $validated['date_of_delivery'],
                'status' => $validated['status'],
                'amount_due' => $this->amount_due,
                'timestamp' => $this->current_timestamp,
                'user_id' => 1 //auth
            ]);
            // add purchase items - table
            if($order){
              
                $oldPurchaseItems = PurchaseItem::where('purchase_order_id',$this->order_id)->delete();
      
                if($oldPurchaseItems){
                    foreach($this->itemRows as $row){
                        $items = PurchaseItem::create([
                            'purchase_order_id' => $this->order_id,
                            'SKU_ID' => $row['id'],
                            'quantity' => $row['quantity'],
                            'price' => $row['price'],
                            'timestamp' => $this->current_timestamp,
                            'user_id' => 1 //auth
                        ]);
                    }
                }
            }

            $this->resetInputFields();
            flashMessage('Order updated successfully.');

        DB::commit();
        } catch (\Exception $e){
            DB::rollBack();
            flashMessage($e->getMessage(),false);
        }

    }
}
