<?php

namespace App\Http\Livewire;
use Illuminate\Support\Facades\Hash;
use App\Models\Customer;
use Livewire\Component;
use Carbon\Carbon;
use DB;

class User extends Component
{

    public $first_name, $last_name, $full_name, $mobile_number, $city, $date_created, $timestamp, $created_by, $user_id, $current_timestamp, $customer_id;
    public function render()
    {
        $this->current_timestamp = Carbon::now()->toDateTimeString();
        $users = Customer::orderBy('timestamp','desc')->paginate(10);
        return view('livewire.users.index',['users' => $users]);
    }

    public function updateDetails($id){
        $userDetails = Customer::findOrFail($id);
        $this->customer_id = $id;
        $this->first_name = $userDetails->first_name;
        $this->last_name = $userDetails->last_name;
        $this->full_name = $userDetails->full_name;
        $this->mobile_number = $userDetails->mobile_number;
        $this->city = $userDetails->city;
        $this->date_created = $userDetails->date_created;
        $this->timestamp = $userDetails->timestamp;
        $this->created_by = $userDetails->created_by;
        $this->user_id = $userDetails->user_id;
        $this->emit('updateDetails');
    }

    public function resetInputFields(){
        $users = Customer::orderBy('timestamp','asc')->paginate(10);
    }

    public function store(){
        DB::beginTransaction();
       
        $validated = $this->validate([
            'first_name' => ['required', 'string', 'max:255','min:2','alpha_spaces'],
            'last_name'  => ['required', 'string', 'max:255','min:2','alpha_spaces'],
            'mobile_number' => ['required', 'unique:customers', 'string', 'max:15'],
            'city' => ['required', 'string', 'max:255'],
        ],
        [
            'first_name.required' => 'The first name field is required.',
            'last_name.required' => 'The last name field is required.',
            'first_name.alpha_spaces' => 'The first name field is invalid.',
            'last_name.alpha_spaces' => 'The last name field is invalid.',
            'mobile_number.required' => 'The mobile number field is required.',
            'mobile_number.unique' => 'The mobile number already exist!',
            'city.required' => 'The city field is required.',
            
        ]);
       
        try{
            $fullName = ucwords($validated['first_name']) .' '. ucwords($validated['last_name']);
            $isFullnameExists = Customer::where('full_name',$fullName)->first();
            if($isFullnameExists){
                return flashMessage('Full Name (first name and last name) already exist!',false);
            }
            $users = Customer::create([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'full_name' => $fullName,
                'mobile_number' => $validated['mobile_number'],
                'city' => $validated['city'],
                'date_created' => $this->current_timestamp,
                'created_by' => "Admin", //auth
                'timestamp' => $this->current_timestamp,
                'user_id' => 1 //auth
            ]);

            $this->resetInputFields();
            flashMessage('Customer created successfully.');

        DB::commit();
        } catch (\Exception $e){
            DB::rollBack();
            flashMessage($e->getMessage(),false);
        }
        
    }

    public function update(){
        DB::beginTransaction();
       
        $validated = $this->validate([
            'first_name' => ['required', 'string', 'max:255','min:2','alpha_spaces'],
            'last_name'  => ['required', 'string', 'max:255','min:2','alpha_spaces'],
            'mobile_number' => 'required|unique:customers,mobile_number,'.$this->customer_id.',id',
            'city' => ['required', 'string', 'max:255'],
        ],
        [
            'first_name.required' => 'The first name field is required.',
            'last_name.required' => 'The last name field is required.',
            'first_name.alpha_spaces' => 'The first name field is invalid.',
            'last_name.alpha_spaces' => 'The last name field is invalid.',
            'mobile_number.required' => 'The mobile number field is required.',
            'city.required' => 'The city field is required.',
            
        ]);
       
        try{
          
            $users = Customer::find($this->customer_id)->update([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'full_name' => $validated['first_name'] .' '. $validated['last_name'],
                'mobile_number' => $validated['mobile_number'],
                'city' => $validated['city'],
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
}
