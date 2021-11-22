@extends('layouts')
@section('content')
  <style>
  th {font-size:0.9em !important;}
  td {font-size:0.8em !important;}
  </style>
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="card-title pl-1"><strong>Devam Eden Sınav Listesi</strong></div>
        <form action="/sinav/continue/list" method="post" >
          {{csrf_field()}}

          <div class="form-group row">
              @include('company.select')
            {{--
            <div class="col-sm-4">
              <label for="staticEmail" class="col-auto col-form-label smallx  ml-0 pl-1">Firma Kodu</label>
              <input type="text" class="form-control" id="" value="{{Helper::findCompanyName(1)}} "  readonly />
            </div>
            --}}

            <div class="col-sm-3">
              <label for="s" class="col-auto col-form-label smallx  ml-0 pl-1">Sınav Adı</label>
              <input type="text" class="form-control" id=""  name="categoryname"  @if (!empty($categoryname)) value="{{$categoryname}}"   @endif />
            </div>

            <div class="col-sm-1" style="padding-top:33px;">
            <button type="submit" class="btn btn-info btn-sm"><i class="fas fa-search"></i> Ara</button>
          </div>
        </div>
        </form>

        <div class="row">
          <div class="table-responsive col-12" style="width:100%">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>
                    Sınavı Oluşturan
                  </th>
                  <th>Sınav Kodu</th>
                  <th>Sınav Adı</th>
                  <th>Sınav Açıklama</th>
                  <th>Bitiş Tarihi</th>

                  <th>Oluşturulma Tarihi</th>
                  <th>İşlemler</th>
                </tr>
              </thead>
              @if (!empty($list))
                @foreach ($list as $z => $ze)
                    <tr>
                      <td>@if (!empty($ze->MakerId)) {{Helper::findUserNameWithCode($ze->MakerId)}} @endif</td>
                      <td>{{$ze->anketCode}}</td>
                      <td>{{$ze->title}}</td>
                      <td>{{$ze->description}}</td>
                      <td>{{$ze->enddate}}</td>

                      <td>{{$ze->created_at}}</td>
                      <td><a href='/sinav/show/allanswers/{{$ze->id}}' class="text-danger"><i class="fas fa-hourglass-start"></i></a></td>
                    </tr>
                  @endforeach
              @endif
            </table>
          </div>
        </div>
      </div>
    </div>

  </div>
@endsection
