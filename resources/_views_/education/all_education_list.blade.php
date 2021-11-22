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
                    @if ($typer=="continue")
                      <strong>Güncel Eğitimler</strong>
                    @else
                      <strong>Tamamlanmış Eğitimler</strong>
                    @endif
                  </div>

                  <div class="col-12">
                    <form action="/user/education" method="post" >
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
                            <th>Eğitim Adı</th>
                            <th>Eğitim  Açıklama</th>
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
                                  <td>{{\Carbon\Carbon::parse($value->created_at)->format("d-m-Y")}}</td>
                                  <td>{{\Carbon\Carbon::parse($value->tamamlanmaTarihi)->format("d-m-Y")}}</td>
                                  <td class="px-0" style="width:140px;">
                                      <a href='javascript:void(0)' onclick="openUsersInformation('{{$value->id}}')"><i class="fa fa-eye text-danger mx-2"></i></a>
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



            <div class="modal" tabindex="-1" role="dialog" id="egitimduzenle">
              <div class="modal-dialog  modal-xxl" role="document">
                <div class="modal-content">
                  <div class="modal-header bg-qpm-dark text-white">
                    <span class="modal-title ml-1 pl-1">Eğitim Durumu </span>
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
            },
            error: function(jqXHR, textStatus, errorThrown) {
              console.log(textStatus, errorThrown);
            }
          });


        }


        function openUsersInformation(id) {

              $("#egitimduzenlebody").children().remove();

              $.ajax({
                url: "/education/status/" + id,
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
