@extends('main.layouts.app')

@section('content')
    <!-- Page Content -->
  <div class="container">

    <div class="row">

      <div class="col-lg-3">

        <h1 class="my-4">Shop Name</h1>
        <div class="list-group">
            @foreach ($categories as $category)
                <a href="{{ route('showCategory',$category->id) }}" class="list-group-item">{{ $category->name_en }}</a>
            @endforeach
        </div>

        <hr>

        <div class="list-group">
            <h5>Get Your Payment Status</h5>
            <form method="POST" action="{{ route('status') }}" autocomplete="off">
                @csrf
                <div  class="input-group">
                    <input class="form-control" name="invoiceId" type="text" placeholder="Your Invoice ID" required>
                </div>
                <div class="mt-2">
                    <button class="w-100 btn btn-primary btn-lg" type="submit">Get Payment Status</button>
                </div>
            </form>
        </div>

      </div>
      <!-- /.col-lg-3 -->
      <div class="col-lg-9">
        @if (session()->has('success'))
            <div class="alert alert-success">{{ session()->get('success') }}</div>
        @endif
        <div class="row">
            @foreach ($products as $product)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                  <a href="#"><img class="card-img-top" src="{{ asset('/images').'/'.$product->image }}" width="100px" height="200px" alt=""></a>
                  <div class="card-body">
                    <h4 class="card-title">
                      <a href="#">{{ $product->name_en }}</a>
                    </h4>
                    <h5>${{ $product->price }}</h5>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p>
                    <p class="btn-holder"><a href="{{ route('add-to-cart', $product->id) }}" class="btn btn-warning btn-block text-center" role="button">Add to cart</a> </p>
                  </div>
                  <div class="card-footer">
                    <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                  </div>
                </div>
              </div>
            @endforeach



        </div>
        <!-- /.row -->

      </div>
      <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->
@endsection
