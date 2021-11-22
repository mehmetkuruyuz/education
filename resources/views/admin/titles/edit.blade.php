{{--
@extends('layouts')
@section('content')

<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Ünvan Düzenle</h4>
      <p class="card-description">Ünvan Düzenlemek için formu doldurunuz</p>
      <form class="w-100" method="POST" action="/admin/parametreler/satinalma/titles/update">

      --}}
          {{csrf_field()}}
          <input type='hidden' name="id" value="{{$data->id}}" />
          <div class="form-group">
              <label for="email" class="col-md-4 control-label">Firma</label>
              <div class="col-md-12">
                  <select class="form-control" name="companyId">
                    @if(!empty($list))
                      @foreach ($list as $key => $value)
                          <option value="{{$value->id}}" @if($value->id==$data->companyId) selected @endif>{{$value->title}}</option>
                      @endforeach
                    @endif
                  </select>
              </div>
          </div>
          <div class="form-group">
              <label for="email" class="col-md-4 control-label">Ünvan</label>
              <div class="col-md-12">
                  <input id="" type="text" class="form-control" name="title" value="{{$data->title}}" required>
              </div>
          </div>
          <div class="form-group">
              <label for="açıklama" class="col-md-4 control-label">Ünvan Açıklaması</label>

              <div class="col-md-12">
                  <textarea name="description" class="form-control border">{{$data->description}}</textarea>
              </div>
          </div>
{{--
          <div class="form-group">
              <div class="col-md-6">
                  <button type="submit" class="btn btn-primary">
                      Güncelle
                  </button>
              </div>
          </div>
        </form>
    </div>
  </div>
</div>



@endsection
--}}
