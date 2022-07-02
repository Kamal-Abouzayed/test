@extends('main.layouts.app')

@section('content')
    <!-- Page Content -->
  <div class="container">

    <div class="row">
        @if ($category->id)
        @foreach ($product as $item)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
              <a href="#"><img class="card-img-top" src="{{ asset('/images').'/'.$item->image }}" width="100px" height="200px" alt=""></a>
              <div class="card-body">
                <h4 class="card-title">
                  <a href="#">{{ $item->name_en }}</a>
                </h4>
                <h5>{{ $item->price }}</h5>
                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p>
                <p class="btn-holder"><a href="{{ route('add-to-cart', $item->id) }}" class="btn btn-warning btn-block text-center" role="button">Add to cart</a> </p>
              </div>
              <div class="card-footer">
                <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
              </div>
            </div>
          </div>
        @endforeach

        @endif


    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->
@endsection
