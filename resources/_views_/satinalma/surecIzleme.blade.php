@extends('layouts')
@section('content')

  <div class="container-fluid my-3">
      <div class="row justify-content-center">
          <div class="col-md-6 mx-auto">
            <div class="box text-right my-3" id="timeline">
              <ol class="list-unstyled">
                <li>
                  <h5>{{$data->title}}</h5>
                  <p>Satın Alma Süreci için Talep Formu Doldurur</p>
                </li>
                @if (!empty($masrafyerlerilistesi))
                  @foreach ($masrafyerlerilistesi as $key => $value)
                    <li>
                      <h5>{{$value->upmasraf->title}}</h5>
                      <p>Onaylar - Reddeder</p>
                    </li>
                  @endforeach
                @endif

            </div>
          </div>
      </div>
  </div>
@endsection
