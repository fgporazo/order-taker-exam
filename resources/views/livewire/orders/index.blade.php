<div>
   <!-- Button trigger modal -->
   <div class="card-tools">
        <div class="row">
            <div class="col-md-3">
                <h2>Orders</h2>
                <a href="{{ route('order.create') }}" target="_blank" class="btn btn-primary"> Create New</a>
            </div>
        </div>
    </div>
    <br>
    <x-commons.alert></x-commons.alert>
    <table id="example" class="table table-striped table-bordered" style="width:100%" >
        <thead>
            <tr>
                <th>#</th>
                <th>Customer</th>
                <th>Delivery Date</th>
                <th>Status</th>
                <th>Amount Due</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $key => $order)
                <tr>
                    <td>{{ $key + $orders->firstItem() }}</td>
                    <td>{{ $order->customer->full_name }}</td>
                    <td>{{ $order->date_of_delivery }}</td>
                    <td>{{ $order->status }}</td>
                    <td>{{ number_format($order->amount_due,2) }}</td>
                    <td><a href="{{ route('order.update',$order->id) }}" class="btn btn-outline-primary">Edit</a></td>
                </tr>
            @empty
            @endforelse
        </tbody>
    </table>
    <div class="card-footer">
        {{ $orders->links() }}
    </div>
    
</div>

@push('scripts')
    <script>
        window.livewire.on('viewDetails', () => {
            $('#updateOrderDetails').modal('show');
        });   
    </script>
@endpush