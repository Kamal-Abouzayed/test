@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('admin.update', $admin->id )}}">
    @csrf
    @method('PATCH')

    <div class="form-group row">
      <div class="col-sm-6 mb-3 mb-sm-0">
        <input type="text" id="name" class="form-control form-control-user @error('name') is-invalid @enderror" name="name" placeholder="Name" value="{{ $admin->name }}" required autocomplete="name">

        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      </div>
    </div>

    <div class="form-group row">
      <div class="col-sm-6 mb-3 mb-sm-0">
        <input type="email" id="email" class="form-control form-control-user @error('email') is-invalid @enderror" placeholder="Email Address" name="email" value="{{ $admin->email }}" required autocomplete="email">

          @error('email')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
      </div>
    </div>

    <div class="form-group row">
      <div class="col-sm-6 mb-3 mb-sm-0">
        <input type="password" id="password" class="form-control form-control-user  @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="new-password">

        @error('password')
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
