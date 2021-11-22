@extends('layouts')
@section('content')
  <style>
  th {font-size:0.9em !important;}
  td {font-size:0.8em !important;}
  </style>
  <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="card-title pl-1"><strong>{{$title}} >> Eğitim Oluşturma</strong>  <a href='javascript:void(0)' class="btn btn-danger btn-sm float-right" data-toggle="modal" data-target="#yeniegitimolusturma"><i class="fas fa-plus"></i> Yeni Eğitim</a></div>

                  <div class="row">
                    <div class="col-12">
                      <form action="/education/lessons/{{$egitimid}}" method="post" >
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
                    <div class="table-responsive col-12" style="width:100%">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>Eğitim Kodu</th>
                            <th>Eğitim Adı</th>
                            <th>Eğitim  Açıklama</th>
                            <th>Eğitimci Adı Soyadı</th>
                            <th>Eğitim Veren Firma</th>
                            <th>Eğitim Grubu</th>
                            <th>Başlangıç Tarihi</th>
                            <th>Tamamlanma Tarihi</th>
                            <th>İşlemler</th>
                          </tr>
                        </thead>
                        <tbody>
                          @if (!empty($list))
                            @foreach ($list as $key => $value)
                              <tr>
                                <td>{{$value->egitimCode}}</td>
                                <td>{{$value->title}}</td>
                                <td>{{$value->description}}</td>
                                <td>{{$value->teacherName}}</td>
                                <td>{{$value->egitimKurumu}}</td>
                                <td>{{$title}}</td>
                                  <td>{{\Carbon\Carbon::parse($value->created_at)->format("d-m-Y")}}</td>
                                  <td>{{\Carbon\Carbon::parse($value->tamamlanmaTarihi)->format("d-m-Y")}}</td>
                                <td class="px-0" style="width:140px;">
                                    <a href='javascript:void(0)' onclick="openInformation('{{$value->id}}')"><i class="fa fa-edit text-danger mx-2"></i></a>
                                    <a href='javascript:void(0)' onclick="openUsersInformation('{{$value->id}}')"><i class="fas fa-users text-danger mx-2"></i></a>
                                    <a href='/delete/education/{{$value->id}}' onclick="return confirm('Silmek İstediğinize Emin misiniz?')"><i class="fas fa-times text-danger  mx-2"></i></a>
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

        <div class="modal" tabindex="-1" role="dialog" id="yeniegitimolusturma">
          <div class="modal-dialog  modal-xxl" role="document">
            <div class="modal-content">
              <div class="modal-header bg-qpm-dark text-white">
                  <span class="modal-title ml-1 pl-1">Eğitim Oluştur</span>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close" class="text-white">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body ">

                <form class="w-100" method="POST" action="/education/save" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="hidden" name="category" id="categoryid" value="{{$categoryid}}" />
                    <div class="form-group">
                        <label for="egitimCode" class="col-md-4 control-label">Eğitim Kodu</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="egitimCode"  value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-md-4 control-label">Eğitim İsmi</label>

                        <div class="col-md-12">
                            <input id="" type="text" class="form-control" name="title" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description" class="col-md-4 control-label">Eğitim Açıklaması</label>

                        <div class="col-md-12">
                            <textarea class="form-control" name="description" required></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="teacherName" class="col-md-4 control-label">Eğitimci Adı Soyadı</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="teacherName"  value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="egitimKurumu" class="col-md-4 control-label">Eğitim Veren Firma</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="egitimKurumu"  value="">
                        </div>
                    </div>
                    <div class="form-group d-none">
                        <label for="egitimKurumu" class="col-md-4 control-label">Eğitim Grup Adı</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="grupname"  value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-md-4 control-label">Eğitim Süresi</label>

                        <div class="col-md-12">
                            <input id="" type="text" class="form-control time" name="videoTime" required >
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="col-md-4 control-label">Zorunlu Seyredilme Süresi</label>

                        <div class="col-md-12">
                            <input id="" type="text" class="form-control time" name="successTime" required >
                        </div>
                    </div>
                    <div class="form-group p-2">
                        <label for="category" class="col-md-4 control-label">Eğitim Dosyası</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile" name="video">
                            <label class="custom-file-label" for="customFile">Eğitim Dosyası</label>
                        </div>
                    </div>

                  <div class="form-group p-2 d-none">
                    <label for="category" class="col-md-4 control-label">Eğitim Resmi</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="customFile" name="thumb">
                        <label class="custom-file-label" for="customFile">Eğitim Resmi</label>
                    </div>
                  </div>
                    <div class="form-group">
                        <label for="description" class="col-md-4 control-label">Eğitim Tamamlanma Tarihi</label>

                        <div class="col-md-12">
                            <input id="" type="text" class="form-control daterange" name="bitissuresi" value="" >
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


            <div class="modal" tabindex="-1" role="dialog" id="egitimduzenle">
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
  <script>
  $(document).ready(function (){
      $('.time').mask('00:00:00');
  });

    $('.daterange').daterangepicker({
        "singleDatePicker": true,
        "drops": "up"
    }, function(start, end, label) {
      console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
    });


    function openInformation(id) {

          $("#egitimduzenlebody").children().remove();

          $.ajax({
            url: "/education/find/" + id,
            type: "get",
            success: function(response) {
              $("#egitimduzenlebody").append(response);

              $('.daterange').daterangepicker({
                  "singleDatePicker": true,
                  "drops": "up"
              }, function(start, end, label) {
                console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
              });

              $("#egitimduzenle").modal();
                          $('.time').mask('00:00:00');
            },
            error: function(jqXHR, textStatus, errorThrown) {
              console.log(textStatus, errorThrown);
            }
          });


        }


        function openUsersInformation(id) {

              $("#egitimduzenlebody").children().remove();

              $.ajax({
                url: "/education/users/" + id,
                type: "get",
                success: function(response) {
                  $("#egitimduzenlebody").append(response);

                  $("#egitimduzenle").modal();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                  console.log(textStatus, errorThrown);
                }
              });


            }


      function userAdd(id)
      {
        var element=$('a[data-id="'+id+'"]');
        var subelement="<div class='col-8 my-1 ml-5 p-2'>"+element.data("name")+"<input type='hidden' name='user[]'  value='"+element.data("id")+"' />   <a href='javascript:void(0)' class='float-right' onclick='deleteSil(this)' > <i class='fas fa-minus text-danger'></i></a></div>";

        $("#egitimalanlar").append(subelement);
        console.log(element.data("masrafyeri"));
      }


      function masrafYeriAdd(id)
      {
        var element=$('a[data-masrafyeri="'+id+'"]');
          element.each(function (index){
          var subelement="<div class='col-8 my-1 ml-5 p-2'>"+$(this).data("name")+"<input type='hidden' name='user[]'  value='"+$(this).data("id")+"' />   <a href='javascript:void(0)' class='float-right' onclick='deleteSil(this)' > <i class='fas fa-minus text-danger'></i></a></div>";
          $("#egitimalanlar").append(subelement);
        });

      //  var subelement="<div class='col-8 my-1 ml-5 p-2'>"+element.data("name")+"<input type='hidden' name='user[]'  value='"+element.data("id")+"' />   <a href='javascript:void(0)' onclick='deleteSil(this)' > <i class='fas fa-minus text-danger'></i></a></div>";

      //  $("#egitimalanlar").append(subelement);
      }


      function deleteSil(t)
      {
        $(t).parent().remove();
      }
  </script>
@endsection
