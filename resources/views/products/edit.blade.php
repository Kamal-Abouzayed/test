@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('product.update', $product->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PATCH')

    <div class="form-group row">
      <div class="col-sm-6 mb-3 mb-sm-0">
        <input type="text" id="name" class="form-control form-control-user @error('name_en') is-invalid @enderror" name="name_en" placeholder="Name in English" value="{{ $product->name_en }}" required>

        @error('name_en')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-6 mb-3 mb-sm-0">
          <input type="text" id="name" class="form-control form-control-user @error('name_ar') is-invalid @enderror" name="name_ar" placeholder="Name in Arabic" value="{{ $product->name_ar }}" required>
  
          @error('name_ar')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
        </div>
      </div>

      <div class="form-group row">
        <div class="col-sm-6 mb-3 mb-sm-0">
            <select name="category" class="form-select" aria-label="Default select example">
                <option value="{{ $product->category_id }}">{{ $product->category->name_en }}</option>
              </select>
  
          @error('category')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
        </div>
      </div>

      <div class="form-group row">
        <div class="col-sm-6 mb-3 mb-sm-0">
            <input type="file" name="image" class="form-control">
            
            <img src="{{ asset('/images').'/'.$product->image }}" width="100px" height="100px" alt="">

          @error('image')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
        </div>
        
      </div>

    <button type="submit" class="btn btn-primary">
        {{ __('Edit') }}
    </button>
  </form>
@endsection