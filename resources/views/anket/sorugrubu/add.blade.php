{{--
@extends('layouts')
@section('content')

<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Ünvan Ekle</h4>
      <p class="card-description">Yeni Ünvan Eklemek için formu doldurunuz</p>

      <form class="w-100" method="POST" action="/admin/parametreler/satinalma/titles/save">
      --}}
          {{csrf_field()}}
          <div class="form-group">
              <label class="smallx ml-3">Firma</label>
              <div class="col-md-12">
                  <select class="form-control" name="companyId">
                    @if(!empty($list))
                      @foreach ($list as $key => $value)
                          <option value="{{$value->id}}">{{$value->title}}</option>
                      @endforeach
                    @endif
                  </select>
              </div>
          </div>
          {{csrf_field()}}

            <div class="col-12 col-lg-4">
                        <div class="form-group">
                            <label class="smallx ml-3"> Soru Grubu Kodu</label>
                            <div class="col-md-12">
                                  <input id="" type="text" class="form-control" name="birimKodu">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="smallx ml-3"> Soru Grubu Açıklaması</label>
                            <div class="col-md-12">
                                <input id="" type="text" class="form-control" name="malzemeAciklamasi">
                            </div>
                        </div>

                  </div>
    {{--
          <div class="form-group">
              <div class="col-md-6">
                  <button type="submit" class="btn btn-primary">
                      Kaydet
                  </button>
              </div>
          </div>
        </form>


    </div>
  </div>
</div>


@endsection
--}}
