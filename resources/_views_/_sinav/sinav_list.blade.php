@extends('layouts')
@section('content')
  <style>
  th {font-size:0.9em !important;}
  td {font-size:0.8em !important;}
  </style>
  <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="card-title pl-1">
                      Sınav Listesi
                  </div>
                  {{--
                  <div class="col-12">
                    <form action="/exam/atanmis" method="post" >
                      {{csrf_field()}}

                      <div class="form-group row">
                        <div class="col-sm-2">
                          <label for="staticEmail" class="col-auto col-form-label smallx  ml-0 pl-1">Firma Kodu</label>
                          <input type="text" class="form-control" id="" value="{{Helper::findCompanyName(1)}} "  readonly />
                        </div>
                        <div class="col-sm-1" style="padding-top:33px;">

                      </div>
                    </div>
                    </form>
                  </div>
                  --}}

                  <div class="row">
                    <div class="table-responsive col-12" style="width:100%">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>Sınav Adı</th>
                            <th>Sınav Açıklaması</th>
                            <th>Bağlı Eğitim</th>
                            <th>Oluşuturulma Tarihi</th>
                            <th>Tamamlanma Tarihi</th>
                            <th>İşlemler</th>
                          </tr>
                        </thead>
                        <tbody>
                          @if (!empty($list))
                            @foreach ($list as $key => $value)
                              <tr>
                                <td>{{$value->title}}</td>
                                <td>{{$value->description}}</td>
                                <td>
                                  @if (!empty($value->exam))
                                    {{$value->exam->title}}
                                  @endif
                                </td>
                                  <td>{{\Carbon\Carbon::parse($value->created_at)->format("d-m-Y")}}</td>
                                  <td>{{\Carbon\Carbon::parse($value->tamamlanmaTarihi)->format("d-m-Y")}}</td>
                                  <td class="px-0" style="width:140px;">
                                      <a href='/exam/start/{{$value->id}}'><i class="fa fa-eye text-danger mx-2"></i></a>
                                  </td>
                              </tr>
                            @endforeach
                          @endif
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
        </div>



@endsection

@section("altscripts")

@endsection
