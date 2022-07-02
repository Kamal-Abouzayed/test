@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Admin Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('messages.welcome').' '.Auth::user()->name   }}

                        <hr>

                        <a href="{{ route('admin.create') }}" class="btn btn-primary">Create</a>
                    </div>
                </div>
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>

                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($admins as $admin)
                            <tr>
                                <th scope="row">{{ $admin->id }}</th>
                                <td>{{ $admin->name }}</td>
                                <td>{{ $admin->email }}</td>
                                <td>
                                    <a role="button" class="btn btn-info" href="/en/admin/edit/{{ $admin->id }}">Edit</a>
                                </td>
                                <td>
                                    {!! Form::open([
                                        'action' => ['App\Http\Controllers\Users\Admin\AdminController@destroy', $admin->id],
                                        'method' => 'DELETE',
                                    ]) !!}
                                    @csrf
                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                  </table>
            </div>

        </div>
    </div>
@endsection
