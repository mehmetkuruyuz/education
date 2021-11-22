@extends('admin.layout')

@section("altscripts")
  @if (!empty($redirect))
    <script>
      $(document).ready(function(){
        setTimeout(function(){window.location.href="{{$redirect}}"} , 1500);
      })

    </script>

  @endif
@endsection
@section('content')

  <div class="my-5 row">
      <div class="col-12">
          <div class="alert alert-primary">
              {{$message}}   @if (!empty($redirect)) Yönlendiriliyorsunuz... @endif
          </div>
      </div>
  </div>
@endsection
