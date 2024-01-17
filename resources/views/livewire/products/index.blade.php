<div>
    <!-- Button trigger modal -->
    <div class="card-tools">
        <div class="row">
            <div class="col-md-3">
                <h2>Products</h2>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductDetails">
                Create New
                </button>
            </div>
        </div>
    </div>
    <br>
    <x-commons.alert></x-commons.alert>
    <table id="example" class="table table-striped table-bordered" style="width:100%" >
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Code</th>
                <th>UnitPrice</th>
                <th>isActive</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $key => $product)
                <tr>
                    <td>{{ $key + $products->firstItem() }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->code }}</td>
                    <td>{{ number_format($product->unit_price,2) }}</td>
                    <td>{{ config('constants.status.sku')[$product->is_active] }}</td>
                    <td>
                        @if($product->image)
                        <img src="{{asset('storage/img/'.$product->image)}}" width="50">
                        @endif
                    </td>
                    <td><button wire:click="updateDetails('{{$product->id}}')" type="button" class="btn btn-outline-primary">Edit</button></td>
                </tr>
            @empty
            @endforelse
        </tbody>
    </table>
    <div class="card-footer">
        {{ $products->links() }}
    </div>
    @include('livewire.products.components.create-details')
    @include('livewire.products.components.update-details')
</div>

@push('scripts')
    <script>
        window.livewire.on('updateDetails', () => {
            $('#updateProductDetails').modal('show');
        });   
    </script>
@endpush