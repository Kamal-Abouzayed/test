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

                        <a href="{{ route('product.create') }}" class="btn btn-primary">Create</a>

                    </div>
                </div>
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">id</th>
                        <th scope="col">Name_en</th>
                        <th scope="col">Name_ar</th>
                        <th scope="col">Category</th>
                        <th scope="col">buy</th>
                        <th scope="col">views</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)    
                            <tr>
                                <th scope="row">{{ $product->id }}</th>
                                <td>{{ $product->name_en }}</td>
                                <td>{{ $product->name_ar }}</td>
                                <td>{{ $product->category->name_en }}</td>
                                <td>{{ $product->buy }}</td>
                                <td>{{ $product->views }}</td>
                                <td>
                                    <a role="button" class="btn btn-info" href="/admin/product/edit/{{ $product->id }}">Edit</a>
                                </td>
                                <td>
                                    {!! Form::open([
                                        'action' => ['App\Http\Controllers\Users\Admin\ProductController@destroy', $product->id], 
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