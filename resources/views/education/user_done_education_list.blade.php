@extends('layouts')
@section('content')
  <style>
  th {font-size:0.9em !important;}
  td {font-size:0.8em !important;}
  </style>
  <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="card-title pl-1"><strong>Tamamlanmış Eğitimlerim</strong> </div>
                  <div class="col-12">
                    <form action="/user/education/done" method="post" >
                      {{csrf_field()}}

                      <div class="form-group row">
                        {{--
                        <div class="col-sm-2">
                          <label for="staticEmail" class="col-auto col-form-label smallx  ml-0 pl-1">Firma Kodu</label>
                          <input type="text" class="form-control" id="" value="{{Helper::findCompanyName(1)}} "  readonly />
                        </div>
                        --}}
                        <div class="col-sm-2">
                          <label for="staticEmail" class="col-auto col-form-label smallx  ml-0 pl-1">Eğitim Kodu</label>
                          <input type="text" class="form-control" id=""  name="egitimCode" value="@if(!empty($egitimCode)) {{$egitimCode}} @endif" />
                        </div>
                        <div class="col-sm-2">
                          <label for="staticEmail" class="col-auto col-form-label smallx ml-0 pl-1">Eğitim Adı</label>
                          <input type="text" class="form-control" id=""  name="egitimTitle"  value="@if(!empty($egitimtitle)) {{$egitimtitle}} @endif" />
                        </div>
                        <div class="col-sm-2">
                          <label for="staticEmail" class="col-auto col-form-label smallx ml-0 pl-1">Eğitimci Adı Soyadı</label>
                          <input type="text" class="form-control" id=""  name="teacherName"  value="@if(!empty($teacherName)) {{$teacherName}} @endif" />
                        </div>
                        <div class="col-sm-1" style="padding-top:33px;">
                        <button type="submit" class="btn btn-info btn-sm"><i class="fas fa-search"></i> Ara</button>
                      </div>
                    </div>
                    </form>
                  </div>

                  <div class="row">
                    <div class="table-responsive col-12" style="width:100%">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>Eğitim Kodu</th>
                            <th>Eğitim Adı</th>
                            <th>Eğitim  Açıklama</th>
                            <th>Eğitim Grubu</th>
                            <th>Eğitimci Adı Soyadı</th>
                            <th>Eğitim Veren Firma</th>
                            <th>Oluşturulma Tarihi</th>
                            <th>Eğitim Tamamlanma Tarihi</th>
                            <th>
                                Durumu
                            </th>
                            </tr>
                        </thead>
                        <tbody>
                          @if(!empty($list))

                            @foreach ($list as $key => $value)
          
                              @if (!empty($value->education))
                                <tr>
                                  <td>{{$value->education->egitimCode}}</td>
                                  <td>{{$value->education->title}}</td>
                                  <td>{{$value->education->description}}</td>
                                  <td>@if (!empty($value->education->category->title)) {{$value->education->category->title}} @endif</td>
                                  <td>{{$value->education->teacherName}}</td>
                                  <td>{{$value->education->egitimKurumu}}</td>
                                  <td>{{$value->education->created_at}}</td>
                                  <td>{{$value->education->tamamlanmaTarihi}}</td>
                                  <td>
                                    @php
                                      $inf=Helper::egitimDurumBilgisiGetir($value->education->id,\Auth::user()->id)
                                    @endphp
                                    @if (!empty($inf))
                                        @if ($inf->isSuccess=="yes")
                                          Tamamlandı - {{$inf->updated_at}}
                                        @else
                                          Yarım Bırakılmış - İzlenme Süresi {{$inf->educationTime}}
                                        @endif
                                    @endif
                                  </td>
                                </tr>
                              @endif
                            @endforeach
                          @endif
                        </tbody>
                      </table>
                    </div>
                </div>
              </div>
          </div>
    </div>


    <div class="modal" tabindex="-1" role="dialog" id="egitimizle">
      <div class="modal-dialog  modal-xxl" role="document">
        <div class="modal-content">
          <div class="modal-header bg-qpm-dark text-white">
            <span class="modal-title ml-1 pl-1">Eğitim Grubu Güncelleme </span>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" class="text-white">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body " id="egitimduzenlebody">

          </div>

        </div>

      </div>

    </div>
@endsection

@section("altscripts")

    <script>
          function openEducation(id) {

                $("#egitimduzenlebody").children().remove();

                $.ajax({
                  url: "/education/watch/" + id,
                  type: "get",
                  success: function(response) {
                    $("#egitimduzenlebody").append(response);

                    $("#egitimizle").modal();
                  },
                  error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                  }
                });


              }
      </script>
@endsection
