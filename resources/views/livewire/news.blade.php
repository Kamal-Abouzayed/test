<div>
    @if ($updateMode)
        @include('livewire.update')
    @else
        @include('livewire.create')
    @endif

    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

<div>
    <table class="table">
        <thead>
        <tr>
        <th scope="col">ID</th>
            <th scope="col">title</th>
            <th scope="col">Body</th>
            <th scope="col">Image</th>
            <th scope="col">Edit</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($news as $item)
                <tr>
                    <th scope="row">{{ $item->id }}</th>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->body }}</td>
                    <td><img src="{{ asset('/storage').'/'.$item->image }}" height="50px" width="50px" alt=""></td>
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
