@extends('layouts.app')

@section('content')
    {!! Form::open([
      'action' => ['App\Http\Controllers\Users\Admin\UserController@update', $user->id],
      'method' => 'PATCH',
      'id' => 'user'
    ])
    !!}
    @csrf

    <div class="form-group row">
      <div class="col-sm-6 mb-3 mb-sm-0">
        <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" name="name" placeholder="Name" value="{{ $user->name }}" autocomplete="name">

        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      </div>
    </div>

    <div class="form-group row">
      <div class="col-sm-6 mb-3 mb-sm-0">
        <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" placeholder="Email Address" name="email" value="{{ $user->email }}" autocomplete="email">

          @error('email')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
      </div>
    </div>
    <div class="form-group row">
      <div class="col-sm-6 mb-3 mb-sm-0">
        <input type="password" class="form-control form-control-user  @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="new-password">
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      </div>
    </div>

    <div class="col-6">
      <div class="card card-primary">
          <div class="card-header">
             Edit Photo
          </div>

          <table class="table table-bordered table-hover">

              <div class="card-body">
                  @foreach($images as $image)
                      <img src="{{ asset('/images/'. $image->images) }}"
                           style="width: 100px; height: 100px; margin-bottom: 5px"
                      >
                      <input {{ $user->image()->where('id',$image->user_id)->count() == 1 ? 'checked': '' }}  type="checkbox" name="images[]" value="{{$image->id}}">
                  @endforeach
              </div>
          </table>

      </div>
      <!-- /.row -->
  </div>

    <button type="submit" class="btn btn-primary">
        {{ __('Edit') }}
    </button>
    {!! Form::close() !!}
@endsection

@push('js')
  <script type="text/javascript">
  $(document).ready(function()
    $('#user').on('submit', function(event) {
      event.preventDefault();

      $.ajax({
        url: "{{ route('user.update', $user->id) }}",
        type: "POST",
        data: $('#user').serialize(),
        success:function(response){
            console.log(response);
          },
      });
    });
  });
  </script>
@endpush
