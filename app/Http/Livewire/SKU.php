<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Carbon\Carbon;
use DB;
class SKU extends Component
{
    use WithPagination, WithFileUploads;
    public $name, $code, $unit_price, $image, $is_active,$current_timestamp,$sku_id;
    public $isImageUploaded = false;

    public function render()
    {
        $this->current_timestamp = Carbon::now()->toDateTimeString();
        $products = Product::orderBy('id','desc')->paginate(10);
        return view('livewire.products.index',['products' => $products]);
    }

    public function updateDetails($id){
        $skuDetails = Product::findOrFail($id);

        $this->sku_id = $id;
        $this->name = $skuDetails->name;
        $this->code = $skuDetails->code;
        $this->unit_price = $skuDetails->unit_price;
        $this->image = $skuDetails->image;
        $this->is_active = $skuDetails->is_active;
        $this->emit('updateDetails');
    }

    public function mount()
    {
        $this->fill([
            'image' => $this->image,
            'name' => $this->name,
            'code' => $this->code,
            'unit_price' => $this->unit_price,
            'is_active' => $this->is_active,
        ]);
    }


    public function store(){
        DB::beginTransaction();
        
        $validated = $this->validate([
            'image' => 'nullable',//'image|max:1024', 
            'name' => 'required|unique:skus',
            'unit_price' => 'required',
        ],
        [
            'image.required' => 'The product image field is required.',
            'name.required' => 'The name field is required.',
            'name.unique' => 'The name must be unique.',
            'unit_price.required' => 'The unit price field is required.',
        ]);
        
        $path = '';
        if($validated['image']){
            $path = $validated['image']->store('img', 'public');
        }

        try{
         
            $users = Product::create([
                'image' => str_replace('img/','',$path),
                'name' => $validated['name'],
                'code' => generateSKU($validated['name']),
                'unit_price' => $validated['unit_price'],
                'date_created' => $this->current_timestamp,
                'created_by' => 'Admin', //auth
                'timestamp' => $this->current_timestamp,
                'user_id' => 1
            ]);

            $this->resetInputFields();
            flashMessage('SKU created successfully.');

        DB::commit();
        } catch (\Exception $e){
            DB::rollBack();
            flashMessage($e->getMessage(),false);
        }
        
    }

    public function update(){
        DB::beginTransaction();
       
        $validated = $this->validate([
            'image' => 'nullable',//'image|max:1024', 
            'name' => 'required|unique:skus,name,'.$this->sku_id.',id',
            'unit_price' => 'required',
        ],
        [
            'image.required' => 'The product image field is required.',
            'name.required' => 'The name field is required.',
            'name.unique' => 'The name must be unique.',
            'unit_price.required' => 'The unit price field is required.',
        ]);
        
        $path = '';
        if($validated['image']){
            $path = $validated['image']->store('img', 'public');
        }

        try{
          
            $users = Product::find($this->sku_id)->update([
                'image' => str_replace('img/','',$path),
                'name' => $validated['name'],
                'code' => generateSKU($validated['name']),
                'unit_price' => $validated['unit_price'],
                'timestamp' => $this->current_timestamp,
                'user_id' => 1
            ]);

            $this->resetInputFields();
            flashMessage('Customer updated successfully.');

        DB::commit();
        } catch (\Exception $e){
            DB::rollBack();
            flashMessage($e->getMessage(),false);
        }
        
    }


    public function resetInputFields(){
        $this->image = '';
        $this->name = '';
        $this->product_category_id = '';
        $this->description = '';
    }

}
