@extends('layouts')
@section('content')

  <style>
  th {font-size:0.8em !important;}
  td {font-size:0.8em !important;}
  .smallx {font-size:0.8em !important;font-weight: bold;}
  </style>
    <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="card-title pl-1"><strong> Kullanıcı Grubu Tanımlama </strong> <a href='javascript:void(0)' class="btn btn-danger btn-sm float-right"  onclick="add()"><i class="fas fa-plus"></i>  Yeni Grup Tanımı</a></div>
                    <p class="card-description  d-none">
                        Sistemde Kayıtlı Kullanıcı Grup Tanımlama
                    </p>

                    <div class="row">
                      <div class="col-12 text-right">
                        <!--  <a href='/admin/user/new' class="btn btn-danger">  -->

                      </div>


                            <div class="col-sm-12 text-right" >
                              <div class="pull-right float-right ">
                                @if (!empty($list))
                                    {{ $list->links( "pagination::bootstrap-4") }}
                                @endif
                              </div>
                            </div>
                            <div class="table-responsive" style="width:100%">
                              @if(!empty($list))
                              <table class="table">
                                <thead>
                                  <th>Id</th>
                                  <th>Başlık</th>
                                  <th>Açıklama</th>
                                  <th>İşlemler</th>
                                </thead>
                                <tbody>
                                @foreach ($list as $key => $value)
                                    <tr>
                                      <td>{{$key+1}}</td>
                                      <td>{{$value->title}}</td>
                                      <td>{{$value->description}}</td>
                                      <td style="width:150px">
                                        <a class="text-danger mx-3" href='javascript::void(0)' onclick="openedit({{$value->id}})"><i class="fa fa-edit"></i></a>
                                        <a class="text-danger mx-3" href='/admin/parametreler/satinalma/group/delete/{{$value->id}}' onclick="return confirm('Silmek İstediğinize Emin misiniz?')"><i class="fa fa-times"></i></a>
                                      </td>
                                    </tr>
                                @endforeach
                              </tbody>

                              </table>
                              @endif
                            </div>

                    </div>
              </div>
              </div>
            </div>



            <div class="modal" tabindex="-1" role="dialog" id="yenititle">
              <div class="modal-dialog modal-xxl" role="document">
                <div class="modal-content">
                  <div class="modal-header  bg-qpm-dark text-white">
                    <span class="modal-title ml-1 pl-1"> Kullanıcı Grup Tanımlama</span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                    <form class="w-100" method="POST"  action="/admin/parametreler/satinalma/group/save" id="actionX">

                    </form>
                    <div class="modal-footer text-left  justify-content-start">
                      <button type="submit" class="btn btn-danger" onclick="submitsave()">Kaydet</button>
                    </div>

                </div>
              </div>
            </div>
            </div>

            <div class="modal" tabindex="-1" role="dialog" id="edittitle">
              <div class="modal-dialog modal-xxl" role="document">
                <div class="modal-content">
                  <div class="modal-header  bg-qpm-dark text-white">
                    <span class="modal-title ml-1 pl-1"> Kullanıcı Grup Tanımı Düzenleme</span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                    <form class="w-100" method="POST"  action="/admin/parametreler/satinalma/group/update" id="actionXE">

                    </form>
                    <div class="modal-footer text-left  justify-content-start">
                      <button type="submit" class="btn btn-danger" onclick="submitedit()">Kaydet</button>
                    </div>

                </div>
              </div>
            </div>
            </div>

@endsection
@section('altscripts')
  <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
  <script>

      function submitsave()
      {
        $("#actionX").submit();
      }

      function submitedit()
      {
          $("#actionXE").submit();
      }
function openedit(id)
{
  $.ajax({
         url: "/admin/parametreler/satinalma/group/edit/"+id,
         beforeSend:function(x){
           $("#actionXE").children().remove();
         },
         success: function (response) {
           $("#actionXE").append(response);
           $("#edittitle").modal();
         },
         error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
         }
     });
}

      function add()
      {
        $.ajax({
               url: "/admin/parametreler/satinalma/group/add",
               beforeSend:function(x){
                 $("#actionX").children().remove();
               },
               success: function (response) {
                 $("#actionX").append(response);
                 $("#yenititle").modal();
               },
               error: function(jqXHR, textStatus, errorThrown) {
                  console.log(textStatus, errorThrown);
               }
           });
      }
  </script>
@endsection
