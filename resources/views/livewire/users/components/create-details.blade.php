<!-- Modal -->
<div class="modal fade" id="addUserDetails" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Customer</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
     
      <form wire:submit.prevent="store">
        
        <div class="modal-body">
              <div class="mb-3">
                  <label for="first_name" class="form-label">First Name</label>
                  <input wire:model.defer="first_name" type="text" class="form-control" id="first_name" placeholder="">
                  @error('first_name') <span class="text-danger">{{ $message }}</span>@enderror
              </div>
              <div class="mb-3">
                  <label for="last_name" class="form-label">Last Name</label>
                  <input wire:model.defer="last_name" type="text" class="form-control" id="last_name" placeholder="">
                  @error('last_name') <span class="text-danger">{{ $message }}</span>@enderror
              </div>
              <div class="mb-3">
                  <label for="exampleFormControlInput1" class="form-label">Mobile Number</label>
                  <input wire:model.defer="mobile_number" type="number" class="form-control" id="exampleFormControlInput1" placeholder="">
                  @error('mobile_number') <span class="text-danger">{{ $message }}</span>@enderror
              </div>
              <div class="mb-3">
                  <label for="city" class="form-label">City</label>
                  <input wire:model.defer="city" type="text" class="form-control" id="city" />
                  @error('city') <span class="text-danger">{{ $message }}</span>@enderror
              </div>
              
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button class="btn btn-primary" data-bs-dismiss="modal">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>