@extends('layouts')
@section('content')
  <style>
  th {font-size:0.9em !important;}
  td {font-size:0.8em !important;}
  </style>
  <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="card-title pl-1"><strong>@if ($polltype=="inside")  @else Dış @endif Sınav Listesi </strong> <a href='javascript:void(0)' class="btn btn-danger btn-sm float-right" data-toggle="modal" data-target="#yenianketolusturma"><i class="fas fa-plus"></i> Yeni Sınav</a></div>
                  <form action="/sinav/{{$polltype}}" method="post" >
                    {{csrf_field()}}

                    <div class="form-group row">
                      @include('company.select')
                      <div class="col-sm-3">
                        <label for="s" class="col-auto col-form-label smallx  ml-0 pl-1">Sınav Adı</label>
                        <input type="text" class="form-control" id=""  name="categoryname"  @if (!empty($categoryname)) value="{{$categoryname}}"   @endif />
                      </div>
                        <input type="hidden" class="form-control" name="type" value="{{$polltype}}"  readonly />
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
                            <th>Sınavı Oluşturan</th>
                            <th>Sınav Kodu</th>
                            <th>Sınav Adı</th>
                            <th>Sınav Açıklama</th>
                            <th>Başlama Tarihi</th>
                            <th>Bitiş Tarihi</th>

                            <th>Oluşturulma Tarihi</th>
                            <th>İşlemler</th>
                          </tr>
                        </thead>
                        <tbody>
                          @if (!empty($list))
                            @foreach ($list as $key => $value)
                              <tr>
                                <td>{{Helper::findUserNameWithCode($value->MakerId)}}</td>
                                <td>{{$value->anketCode}}</td>
                                <td>{{$value->title}}</td>
                                <td>{{$value->description}}</td>
                                <td>{{$value->startdate}}</td>
                                <td>{{$value->enddate}}</td>

                                <td>{{$value->created_at}}</td>
                                <td class="px-0" style="width:180px;">
                                    <a href='javascript:void(0)' onclick="openInformation('{{$value->id}}')"><i class="fa fa-edit text-danger mx-2"></i></a>
                                    <a href='javascript:void(0)' onclick="openUsersInformation('{{$value->id}}')"><i class="fas fa-users text-danger mx-2"></i></a>
                                    <a href='/sinav/question/{{$value->id}}'><i class="far  fa-question-circle text-danger  mx-2"></i></a>
                                    <a href='/delete/sinav/{{$value->id}}' onclick="return confirm('Silmek İstediğinize Emin misiniz?')"><i class="fas fa-times text-danger  mx-2"></i></a>
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



    <div class="modal" tabindex="-1" role="dialog" id="yenianketolusturma">
      <div class="modal-dialog  modal-xxl" role="document">
        <div class="modal-content">
          <div class="modal-header bg-qpm-dark text-white">
              <span class="modal-title ml-1 pl-1">Yeni Sınav</span>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" class="text-white">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body ">
            <form class="w-100" method="POST" action="/save/sinav" enctype="multipart/form-data" id='dataFrm'>
              {{csrf_field()}}
              <div class="form-group">
                  <label for="anketCode" class="col-md-4 control-label">Sınav Kodu</label>

                  <div class="col-md-12">
                      <input id="anketCode" type="text" class="form-control" name="anketCode" value="" >
                  </div>
              </div>
              <div class="form-group">
                  <label for="email" class="col-md-4 control-label">Sınav Adı</label>

                  <div class="col-md-12">
                      <input id="" type="text" class="form-control" name="title" value="{{ old('title') }}" required>
                  </div>
              </div>
              <div class="form-group">
                  <label for="açıklama" class="col-md-4 control-label">Sınav Açıklamsı</label>

                  <div class="col-md-12">
                      <textarea name="description" class="form-control border"></textarea>
                  </div>
              </div>
                <input id="" type="hidden" class="form-control" name="type" value="{{$polltype}}" required>
              <div class="form-group">
                  <label for="baslangicsuresi" class="col-md-4 control-label">Sınav Başlangıç Tarihi</label>

                  <div class="col-md-12">
                      <input id="baslangicsuresi" type="text" class="form-control daterange" name="baslangicsuresi" value="" >
                  </div>
              </div>
              <div class="form-group">
                  <label for="bitissuresi" class="col-md-4 control-label">Sınav Tamamlanma Tarihi</label>

                  <div class="col-md-12">
                      <input id="bitissuresi" type="text" class="form-control daterange" name="bitissuresi" value="" >
                  </div>
              </div>
              <div class="form-group">
                  <div class="col-md-6 col-md-offset-4">
                      <button type="submit" class="btn btn-danger">
                          Kaydet
                      </button>
                  </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>


    <div class="modal" tabindex="-1" role="dialog" id="anketduzenle">
      <div class="modal-dialog  modal-xxl" role="document">
        <div class="modal-content">
          <div class="modal-header bg-qpm-dark text-white">
            <span class="modal-title ml-1 pl-1">Sınav Güncelleme </span>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" class="text-white">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body " id="anketduzenlebody">

          </div>

        </div>

      </div>

    </div>

    <div class="modal" tabindex="-1" role="dialog" id="kullaniciAta">
      <div class="modal-dialog  modal-xxl" role="document">
        <div class="modal-content">
          <div class="modal-header bg-qpm-dark text-white">
            <span class="modal-title ml-1 pl-1">Kullanıcı Atama</span>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" class="text-white">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body " id="kullaniciduzenlebody">

          </div>

        </div>

      </div>

    </div>

@endsection

@section('altscripts')
  <script>
  $('.daterange').daterangepicker({
      "singleDatePicker": true,
      "drops": "up"
  }, function(start, end, label) {
    console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
  });

  function openInformation(id) {

        $("#anketduzenlebody").children().remove();

        $.ajax({
          url: "/sinav/edit/" + id,
          type: "get",
          success: function(response) {
            $("#anketduzenlebody").append(response);
            $("#anketduzenle").modal();
          },
          error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
          }
        });


      }


      function openUsersInformation(id)
      {
          $("#kullaniciduzenlebody").html("");
          $.ajax({
            url: "/sinav/user/assign/" + id,
            type: "get",
            success: function(response) {
              $("#kullaniciduzenlebody").append(response);
              $("#kullaniciAta").modal();
                  $('.select2').select2({
                        placeholder: ""
                  });

            },
            error: function(jqXHR, textStatus, errorThrown) {
              console.log(textStatus, errorThrown);
            }
          });

      }

  </script>
@endsection
