<div>
    <br>
    <x-commons.alert></x-commons.alert>
    <div class="card-tools">
        <div class="row">
            <div class="col-md-3">
                <h2>Order Taking</h2>
            </div>
        </div>
    </div><br>
    <form wire:submit.prevent="store">
        <div class="container">
            <div class="col-md-6 mb-2 row">
                <label for="selectCustomer" class="col-sm-4 col-form-label">Customer</label>
                <div class="col-sm-8"> 
                <select id="selectCustomer" wire:model.defer="customer_id" class="form-control"> 
                    <option value="">-- Select Customer --</option>
                    @foreach($customers as $list)
                        <option value="{{ $list->id }}">{{ $list->full_name }}</option>
                    @endforeach
                </select>
                </div>
            </div>
            <div class="col-md-6 mb-2 row">
                <label for="inputDelDate" class="col-sm-4 col-form-label">Delivery Date</label>
                <div class="col-sm-8">
                    <input wire:model.defer="date_of_delivery" id="datepicker" type="text" class="form-control" id="inputDelDate">
                </div>
            </div>
            <div class="col-md-6 mb-2 row">
                <label for="selectStatus" class="col-sm-4 col-form-label">Status</label>
                <div class="col-sm-8">
                <select id="selectStatus" wire:model.defer="status" class="form-control"> 
                    <option value="">-- Select Status --</option>
                    <option value="New">New </option>
                    <option value="Completed">Completed </option>
                    <option value="Cancelled">Cancelled </option>
                </select>
                </div>
            </div>
        </div>
        @include('livewire.orders.components.items.buttons.create')
        <hr>
        <div class="container">
            <h3>Items<h3>
            <table id="example" class="table table-striped table-bordered table-sm" >
                <thead>
                    <tr>
                        <th>SKU</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($itemRows as $key => $order)
                        <tr>
                            <td>{{ $order['sku'] ?? ''}}</td>
                            <td>{{ $order['quantity'] ?? ''}}</td>
                            <td>{{ $order['price'] ?? ''}}</td>
                            <td>
                                @include('livewire.orders.components.items.buttons.update')
                            </td>
                        </tr>
                    @empty
                    @endforelse
                    <tr>
                    <td colspan="3">Total Amount</td>
                    <td>{{ number_format($amount_due,2) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="container">
            <button class="btn btn-primary">Save</button>
        </div>
    </form>
    @include('livewire.orders.components.items.modals.create')
    @include('livewire.orders.components.items.modals.update')
</div>

@push('scripts')
    <script>
        window.livewire.on('updateDetails', () => {
            $('#updateItemDetails').modal('show');
        });   
      
        $(function () {
            var date = new Date();
            date.setDate(date.getDate()+1);
            $("#datepicker").datepicker({ 
                autoclose: true, 
                todayHighlight: true,
                startDate: date
            });

            $("#datepicker").on("change",function(){
                @this.date_of_delivery = $("#datepicker").val();
            });
        });

    </script>
@endpush