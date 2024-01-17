<!-- Modal -->
<div wire:ignore.self class="modal fade" id="updateItemDetails" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Items</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        @if($item_details)
        <form wire:submit.prevent="updateQtyItem">
            <div class="modal-body">
                    <div class="mb-3" >
                        <label for="item_details_sku" class="form-label">SKU</label>
                        <select required wire:model.defer="item_details.sku" class="form-control">
                                <option value="{{ $item_details['id'] }}">{{ $item_details['name'] }} - {{ number_format($item_details['original_price'],2) }}
                        </select>
                    </div>
                    <div class="mb-3" >
                        <label for="item_details_quantity" class="form-label">Quantity</label>
                        <input required wire:model.defer="item_details.quantity" type="text" class="form-control" id="item_details_quantity" placeholder="">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary">Submit</button>
            </div>
        </form>
    @endif
    </div>
  </div>
</div>