<!-- Modal -->
<div wire:ignore class="modal fade" id="addProductDetails" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add SKU</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form wire:submit.prevent="store">
        <div class="modal-body">
                <div class="mb-3" >
                    <label for="name" class="form-label">Name</label>
                    <input wire:model.defer="name" type="text" class="form-control" id="name" placeholder="">
                    @error('name') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="mb-3" >
                    <label for="unit_price" class="form-label">Unit Price</label>
                    <input wire:model.defer="unit_price" type="text" class="form-control" id="unit_price" placeholder="">
                    @error('unit_price') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="mb-3">
                    <label for="uploadImage" class="form-label">Image</label>
                    <input wire:model="image" type="file" class="form-control" id="uploadImage" />
                    @error('image') <span class="text-danger">{{ $message }}</span>@enderror
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