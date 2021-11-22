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
            <div class="card-title pl-1"><strong>Masraf Yeri Atama</strong> </div>
                  <p class="card-description d-none">
                   Masraf yerine atama yapmak istediğiniz kullanıcı bilgisini yazınız.
                  </p>

                  <div class="row">
                    <div class="col-12 text-right">
                      <!--  <a href='/admin/user/new' class="btn btn-danger">  -->

                    </div>
                      <div class="col-md-12">

                      </div>
                  </div>
                  <div class="col-md-12">
                      <form action="/admin/user/list" method="post" >
                        {{csrf_field()}}

                        <div class="form-group row">
                          <div class="col-sm-4">
                            <label for="staticEmail" class="col-auto col-form-label smallx  ml-0 pl-1">Firma Kodu</label>
                            <input type="text" class="form-control" id="" value="{{Helper::findCompanyName(1)}} "  readonly />
                          </div>
                          <div class="col-sm-2">
                            <label for="staticEmail" class="col-auto col-form-label smallx  ml-0 pl-1">Kullanıcı Kodu</label>
                            <input type="text" class="form-control" id="" value="" name="usercode" />
                          </div>
                          <div class="col-sm-2">
                            <label for="staticEmail" class="col-auto col-form-label smallx ml-0 pl-1">Kullanıcı Adı Soyadı</label>
                            <input type="text" class="form-control" id="staticEmail" value="" name="isim" />
                          </div>
                        <div class="col-sm-1" style="padding-top:33px;">
                          <button type="submit" class="btn btn-info btn-sm"><i class="fas fa-search"></i> Ara</button>
                        </div>
                      </div>
                      </form>
                  </div>
                  <div class="table-responsive" style="width:100%">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Kullanıcı Kodu</th>
                          <th>Kullanıcı Adı Soyadı</th>
                          <th>Kullanıcı Grubu</th>
                          <th>Kullanıcı Görev Tanımı</th>
                          <th>Masraf Yeri Tanımı</th>
                          <th>Üst Amir</th>
                          <th class="d-none">E-posta</th>
                          <th class="text-center">
                            Atama
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        @if (!empty($user))
                          @foreach ($user as $key => $value)
                            <tr>

                              <td>{{$value->usercode}}</td>
                              <td>{{$value->name}}</td>
                              <td>{{Helper::findGroup($value->groupId)}}</td>
                              <td>{{Helper::findTitle($value->gorevtanimi)}}</td>
                              <td>{{Helper::findMasrafYeriAdi($value->masrafYeri)}}</td>
                              <td>{{Helper::ustMasrafYeriBul($value->masrafYeri)}}</td>
                              <td>{{$value->email}}</td>
                              <td class="text-center"><a href='javascript:void()' class="text-danger" onclick="atamaYap({{$value->id}})"><i class="fas fa-book-reader font-size-14px"></i></a></td>
                            </tr>
                          @endforeach
                        @endif
                      </tbody>
                    </table>
                  </div>

                  <div class="modal" tabindex="-1" role="dialog" id="editmodal">
                    <div class="modal-dialog modal-xxl" role="document">
                      <div class="modal-content">
                        <div class="modal-header  bg-qpm-dark text-white">
                          <span class="modal-title ml-1 pl-1">Masraf Yeri Atama</span>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                          <div class="row">
                            <div class="col-12">
                              <form class="w-100" method="POST" action="/admin/user/masrafyeriatama/save" id="actionX">

                              </form>
                            </div>
                          </div>

                          <div class="modal-footer text-left  justify-content-start">
                            <button type="submit" class="btn btn-danger" onclick="submitedit()">Kaydet</button>
                          </div>

                      </div>
                    </div>
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
    $(function() {
        $('.selectmulti').select2({});
      });


    function atamaYap(id)
    {

        if (id>0)
        {
          $.ajax({
                 url: "/admin/user/edit/"+id,
                 //type: "post",
                 //data: {"firmcode":firm, "_token": "{{ csrf_token() }}"} ,
                 beforeSend:function(x){
                   $("#actionX").children().remove();
                 },
                 success: function (response) {
                   $("#actionX").append(response);

                    $('input, select').prop('disabled', 'disabled');
                    $("#masrafyeri").prop('disabled', false);
                    $("#actionX").append("<input type='hidden' value='"+id+"' name='userid' />");
                    $("input[name=_token]").prop('disabled', false);
                    $("#editmodal").modal();
                    loadCompanyData();
                 },
                 error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                 }
             });

        }



    }

    function submitedit()
    {
      $("#actionX").submit();
    }



    function loadCompanyData()
    {

          var firm=$("#firmCode").val();
          if (firm==0) { alert("Lütfen Firma Kodu Seçiniz");}
         $.ajax({
                url: "/satinalma/tummasrafyerleri",
                type: "post",
                data: {"firmcode":firm, "_token": "{{ csrf_token() }}"} ,
                beforeSend:function(x){
                  $("#parentId").children().remove();
                },
                success: function (response) {
                  $("#parentId").append(response);
                  var selectedid=$("#parentId").data("selected");

                  var $radios = $('input:radio[name=parentId]');
                      if($radios.is(':checked') === false) {
                          $radios.filter('[value='+selectedid+']').prop('checked', true);
                          var lasthero=$radios.filter('[value='+selectedid+']');

                        //  $("#parentId").children(".ulstyle").addClass("d-none");
                        //  $("#sub_"+selectedid).children(".ulstyle").addClass("d-none");
                          $("#sub_"+selectedid).removeClass("d-none");
                          $("#sub_"+selectedid).parents().removeClass("d-none");
                      }
                      if (selectedid==0) {$(".ulstyle").addClass("d-none")}
                },
                error: function(jqXHR, textStatus, errorThrown) {
                   console.log(textStatus, errorThrown);
                }
            });
    }
    </script>
@endsection
