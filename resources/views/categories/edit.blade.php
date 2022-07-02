@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('category.update', $category->id) }}">
    @csrf
    @method('PATCH')

    <div class="form-group row">
      <div class="col-sm-6 mb-3 mb-sm-0">
        <input type="text" id="name" class="form-control form-control-user @error('name_en') is-invalid @enderror" name="name_en" placeholder="Name in English" value="{{ $category->name_en }}" required>

        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-6 mb-3 mb-sm-0">
          <input type="text" id="name" class="form-control form-control-user @error('name_ar') is-invalid @enderror" name="name_ar" placeholder="Name in Arabic" value="{{ $category->name_ar }}" required>
  
          @error('name')
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