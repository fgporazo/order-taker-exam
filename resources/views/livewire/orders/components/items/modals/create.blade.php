<!-- Modal -->
<div wire:ignore.self class="modal fade" id="addItemDetails" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Items</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form wire:submit.prevent="addItem">
        <div class="modal-body">
                <div class="mb-3" >
                    <label for="sku" class="form-label">SKU</label>
                    <select required wire:model.defer="items.sku" class="form-control">
                        <option value="">-- Select SKU --</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }} - {{ number_format($product->unit_price,2) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3" >
                    <label for="quantity" class="form-label">Quantity</label>
                    <input required wire:model.defer="items.quantity" type="text" class="form-control" id="quantity" placeholder="">
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button class="btn btn-primary">Submit</button>
        </div>
    </form>
    </div>
  </div>
</div>