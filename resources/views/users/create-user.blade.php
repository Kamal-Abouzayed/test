@extends('layouts.app')

@section('content')
<form id="user" class="user" method="POST" action="{{ route('user.save') }}" enctype="multipart/form-data">
    @csrf

    <div class="form-group row">
      <div class="col-sm-6 mb-3 mb-sm-0">
        <input type="text" id="name" class="form-control form-control-user @error('name') is-invalid @enderror" name="name" placeholder="Name" value="{{ old('name') }}" required autocomplete="name">

        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      </div>
    </div>

    <div class="form-group row">
      <div class="col-sm-6 mb-3 mb-sm-0">
        <input type="email" id="email" class="form-control form-control-user @error('email') is-invalid @enderror" placeholder="Email Address" name="email" value="{{ old('email') }}" required autocomplete="email">

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

    <div class="input-group hdtuto control-group lst increment" >
      <input type="file" id="image" name="images[]" class="myfrm form-control">
      <div class="input-group-btn"> 
        <button class="btn btn-success add" type="button"><i class="fldemo glyphicon glyphicon-plus"></i>Add</button>
      </div>
    </div>
    <div class="clone hide">
      <div class="hdtuto control-group lst input-group" style="margin-top:10px">
        <input type="file" id="image" name="images[]" class="myfrm form-control">
        <div class="input-group-btn"> 
          <button class="btn btn-danger remove" type="button"><i class="fldemo glyphicon glyphicon-remove"></i> Remove</button>
        </div>
      </div>
    </div>

    <button type="submit" class="btn btn-primary">
        {{ __('create') }}
    </button>
  </form>
@endsection

@push('js')
  <script type="text/javascript">
  $(document).ready(function()
    $('#user').on('submit', function(event) {
      event.preventDefault();

      $.ajax({
        url: "{{ route('user.save') }}",
        type: "POST",
        data: $('#user').serialize(),
        success:function(response){
            console.log(response);
          },
      });
    });
  });

  </script>

  <script type="text/javascript">
    $(document).ready(function() {
      $(".btn-success").click(function(){ 
          var lsthmtl = $(".clone").html();
          $(".increment").after(lsthmtl);
      });
      $("body").on("click",".btn-danger",function(){ 
          $(this).parents(".hdtuto").remove();
      });
    });
  </script>
@endpush