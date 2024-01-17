<?php

namespace App\Http\Livewire;
use Illuminate\Support\Facades\Hash;
use App\Models\PurchaseOrder;
use Livewire\Component;
use Carbon\Carbon;
use DB;

class Order extends Component
{

    public $customer, $date_of_delivery, $status, $amount_due, $date_created, $timestamp, $created_by, $user_id, $current_timestamp, $order_id;
    public function render()
    {
        $this->current_timestamp = Carbon::now()->toDateTimeString();
        $orders = PurchaseOrder::with('customer')->orderBy('timestamp','desc')->paginate(10);
        return view('livewire.orders.index',['orders' => $orders]);
    }

    public function updateDetails($id){
        $userDetails = PurchaseOrder::findOrFail($id);
        $this->order_id = $id;
        
        $this->date_of_delivery = $userDetails->date_of_delivery;
        $this->status = $userDetails->status;
        $this->amount_due = $userDetails->amount_due;
        $this->date_created = $userDetails->date_created;
        $this->timestamp = $userDetails->timestamp;
        $this->created_by = $userDetails->created_by;
        $this->user_id = $userDetails->user_id;
        $this->emit('updateDetails');
    }

    public function resetInputFields(){
        $orders = PurchaseOrder::orderBy('timestamp','asc')->paginate(10);
    }

   
   
}
