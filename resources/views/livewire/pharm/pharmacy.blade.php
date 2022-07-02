<div>
    <div>
        @if ($updateMode)
            @include('livewire.pharm.update')
        @else
            @include('livewire.pharm.create')
        @endif
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif


    <div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Employee</th>
                <th scope="col">Work Date From</th>
                <th scope="col">Work Date To</th>
                <th scope="col">Day</th>
                <th scope="col">Pharmacy Name</th>
                <th scope="col">Start Time</th>
                <th scope="col">End Time</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($pharmacy as $item)
                    <tr>
                        <th scope="row">{{ $item->id }}</th>
                        <td>{{ $item->employee }}</td>
                        <td>{{ $item->date_from }}</td>
                        <td>{{ $item->date_to }}</td>
                        <td>{{ $item->day }}</td>
                        <td>{{ $item->pharmacy_name }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->start_time)->format('h:i A') }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->end_time)->format('h:i A') }}</td>
                        <td>
                        <button wire:click="edit({{$item->id}})"
                                class="btn btn-sm btn-outline-info py-0">
                                Edit
                        </button>
                        |
                        <button wire:click="destroy({{$item->id}})"
                                class="btn btn-sm btn-outline-danger py-0">
                                Delete
                        </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    </div>

</div>


