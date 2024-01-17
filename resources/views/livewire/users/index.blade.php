<div>
    <!-- Button trigger modal -->
    <div class="card-tools">
        <div class="row">
            <div class="col-md-3">
                <h2>Users</h2>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserDetails">
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
                <th>FullName</th>
                <th>Mobile Number</th>
                <th>City</th>
                <th>isActive</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $key => $user)
                <tr>
                    <td>{{ $key + $users->firstItem() }}</td>
                    <td>{{ $user->full_name }}</td>
                    <td>{{ $user->mobile_number }}</td>
                    <td>{{ $user->city }}</td>
                    <td>{{ config('constants.status.users')[$user->is_active] }}</td>
                    <td><button wire:click="updateDetails('{{$user->id}}')" type="button" class="btn btn-outline-primary">Edit</button></td>
                </tr>
            @empty
            @endforelse
        </tbody>
    </table>
    <div class="card-footer">
        {{ $users->links() }}
    </div>
    @include('livewire.users.components.create-details')
    @include('livewire.users.components.update-details')
</div>
@push('scripts')
   <script>
    window.livewire.on('store', () => {
        $('#addUserDetails').modal('show');
    });
    window.livewire.on('updateDetails', () => {
        $('#updateUserDetails').modal('show');
    });      
    </script>
@endpush