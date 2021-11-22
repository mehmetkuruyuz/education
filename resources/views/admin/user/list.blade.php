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
                  <div class="card-title pl-1"><strong>Kullanıcı Tanımlama</strong> <a href='javascript:void(0)' class="btn btn-danger btn-sm float-right" data-toggle="modal" data-target="#yenikullanici"><i class="fas fa-plus"></i>  Yeni Kullanıcı</a></div>
                  <p class="card-description  d-none">
                      Sistemde Kayıtlı Kullanıcılar
                  </p>

                  <div class="row">
                    <div class="col-12 text-right">
                      <!--  <a href='/admin/user/new' class="btn btn-danger">  -->

                    </div>
                      <div class="col-md-12">
                          <form action="/admin/user/list" method="post" >
                            {{csrf_field()}}

                            <div class="form-group row">
                                    @include('company.select')
                              <div class="col-sm-2">
                                <label for="staticEmail" class="col-auto col-form-label smallx  ml-0 pl-1">Kullanıcı Kodu</label>
                                <input type="text" class="form-control" id="" value="{{$usercode}}" name="usercode" />
                              </div>
                              <div class="col-sm-2">
                                <label for="staticEmail" class="col-auto col-form-label smallx ml-0 pl-1">Kullanıcı Adı Soyadı</label>
                                <input type="text" class="form-control" id="staticEmail" value="{{$isim}}" name="isim" />
                              </div>
                            <div class="col-sm-2">
                              <label for="email" class="col-auto col-form-label smallx ml-0 pl-1">E-Posta</label>
                              <input type="text" class="form-control" id="email" value="{{$email}}" name="email" />
                            </div>

                          <div class="col-sm-1" style="padding-top:33px;">
                              <button type="submit" class="btn btn-info btn-sm"><i class="fas fa-search"></i> Ara</button>
                            </div>
                          </div>
                          </form>
                      </div>

                          <div class="col-sm-12 text-right" >
                            <div class="pull-right float-right ">
                              @if (!empty($user))
                                  {{ $user->links( "pagination::bootstrap-4") }}
                              @endif
                            </div>
                          </div>
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
                          <th>Üst Onaylayıcı</th>
                          <th>E-posta</th>
                          <th style="width:100px !important">İşlemler</th>
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

                              <td>{{Helper::REVIZEustMasrafYeriBul($value->masrafYeri,$value->id)}}</td>
                              <td>{{$value->email}}</td>

                              <td class="px-0">
                                <a href='javascript:void(0)' onclick="edit({{$value->id}})"  class="text-danger mx-3"><i class="fa fa-edit"></i></a>
                                <a href='/admin/user/delete/{{$value->id}}' onclick="return confirm('Kullanıcıyı Silmek İstediğinize Eminmisiniz?')" class="text-danger  mx-3"><i class="fa fa-times"></i></a>
                              </td>
                            </tr>
                          @endforeach
                        @endif
                      </tbody>
                    </table>
                  </div>
                  <div class="col-sm-12 text-right" >
                    <div class="pull-right float-right ">
                      @if (!empty($user))
                          {{ $user->links( "pagination::bootstrap-4") }}
                      @endif
                    </div>
                  </div>
            </div>
          </div>
        </div>


        <div class="modal" tabindex="-1" role="dialog" id="yenikullanici">
          <div class="modal-dialog modal-xxl" role="document">
            <div class="modal-content">
              <div class="modal-header  bg-qpm-dark text-white">
                <span class="modal-title ml-1 pl-1">Yeni Kullanıcı Tanımlama</span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <form class="w-100" method="POST" action="/admin/user/save">
              <div class="modal-body">

                <div class="col-md-12">
                    <div class="card card-default">
                        <div class="card-body">
                          <div class="row">
                              <div class="col-12 col-lg-4">
                                <div class="form-group">
                                    <label class="smallx ml-3">Firma Kodu</label>
                                    <div class="col-md-12">
                                        <select name="companyCode"  class="selectmulti form-control form-control-sm" id="firmCode" required style="width:100% !important">
                                          <option value="-1"> Lütfen Firma Kodu Seçiniz </option>
                                          @if (!empty($companyList))
                                            @foreach ($companyList as $key => $value)
                                                <option  value="{{$value->id}}" data-name="{{$value->title}}" selected>{{$value->companyCode}}  - {{$value->title}} </option>
                                            @endforeach
                                          @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group my-0 d-none">
                                  <div class="col-md-12 ">
                                    <label class="smallx">Firma Tanımı</label>
                                    <input type="text" value="" id="firmatanim" value="" class="form-control form-control-sm" readonly />
                                  </div>
                                </div>

                              </div>
                          </div>
                          <div class="row">
                              <div class="col-12 col-lg-4 my-0 ">
                                <div class="form-group  my-0">
                                      <label class=" smallx  ml-3">Kullanıcı Kodu</label>

                                    <div class="col-md-12">
                                        <input id="slug" type="text" class="form-control form-control-sm" name="slug" value="" required>
                                    </div>
                                </div>
                                <div class="form-group my-0">
                                        <label class=" smallx  ml-3">Kullanıcı Adı - Soyadı</label>
                                    <div class="col-md-12  my-0">
                                        <input id="" type="text" class="form-control form-control-sm" name="name" value="{{ old('name') }}" required>
                                    </div>
                                </div>
                                <div class="form-group  my-0">
                                      <label class=" smallx  ml-3">Kullanıcı Görev Tanımı</label>
                                    <div class="col-md-12">
                                        <select class="form-control" name="gorevtanimi">
                                            @if (!empty($alltitle))
                                                @foreach ($alltitle as $key => $value)
                                                  <option value="{{$value->id}}">{{$value->title}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        {{--  }}<input  type="text" class="form-control form-control-sm" name="unvan" value="{{ old('unvan') }}" > --}}
                                    </div>
                                </div>
                                <div class="form-group  my-0">
                                      <label class=" smallx  ml-3">Şifre</label>
                                    <div class="col-md-12">
                                        <input id="password" type="password" class="form-control form-control-sm" name="password" required>
                                    </div>
                                </div>
                                <div class="form-group my-0">
                                      <label class=" smallx  ml-3">E-Posta Adresi</label>

                                    <div class="col-md-12 my-0">
                                        <input id="email" type="email" class="form-control form-control-sm" name="email" value="{{ old('email') }}" required>
                                    </div>
                                </div>

                                <div class="form-group  my-0">
                                      <label class=" smallx  ml-3">Kullanıcı Grup Tanımı</label>
                                    <div class="col-md-12">
                                        <select class="form-control" name="groupid">
                                            @if (!empty($allGroups))
                                                @foreach ($allGroups as $key => $value)
                                                  <option value="{{$value->id}}">{{$value->title}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                              <div class="form-group my-0">
                                        <label class=" smallx  ml-3">Telefon No</label>
                                  <div class="col-md-12">
                                      <input  type="text" class="form-control form-control-sm" name="telefon" value="{{ old('telefon') }}" >
                                  </div>
                              </div>
                              </div>
                          </div>
                          <div class="col-8 d-none">
                            {{ csrf_field() }}
                          <div class="col-12 bg-qpm-dark text-white p-2 ">Masraf Yeri Bilgileri</div>
                        </div>
                    </div>
                </div>
              </div>
              <div class="modal-footer text-left  justify-content-start">
                <button type="submit" class="btn btn-danger">Kaydet</button>
              </div>
            </form>

            </div>
          </div>
        </div>
      </div>

<!----------------------EDIT MODAL---------------------->

  <div class="modal" tabindex="-1" role="dialog" id="edituser">
    <div class="modal-dialog modal-xxl" role="document">
      <div class="modal-content">
        <div class="modal-header  bg-qpm-dark text-white">
          <span class="modal-title ml-1 pl-1">Kullanıcı Düzenleme</span>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
          <form class="w-100" method="POST" action="/admin/user/update" id="actionX">

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
    $(function() {
        $('.selectmulti').select2({});
      });

      function submitedit()
      {
        $('#actionX').submit();
        //alert("test");
      }

      function getAllMasrafYeri()
      {

        $.ajax({
               url: "/satinalma/tummasrafyerleri",
               type: "post",
               data: {"firmcode":firm, "_token": "{{ csrf_token() }}"} ,
               beforeSend:function(x){
                 $("#parentId").children().remove();
               },
               success: function (response) {
                 $("#parentId").append(response);
               },
               error: function(jqXHR, textStatus, errorThrown) {
                  console.log(textStatus, errorThrown);
               }
           });
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


    function edit(id)
    {
      if (id>0)
      {
        $.ajax({
               url: "/admin/user/edit/"+id,
               beforeSend:function(x){
                 $("#actionX").children().remove();
               },
               success: function (response) {
                 $("#actionX").append(response);
                 loadCompanyData();
                 $("#edituser").modal();
               },
               error: function(jqXHR, textStatus, errorThrown) {
                  console.log(textStatus, errorThrown);
               }
           });

      }
    }

/*
    function loadCompanyData()
    {

        var firm=$("#firmCode").val();
        var namer =  $("#firmCode").find(':selected').data('name');
        $("#firmatanim").val(namer);

        if (firm==0) { alert("Lütfen Firma Kodu Seçiniz");}
         $.ajax({
                url: "/satinalma/loadInformation",
                type: "post",
                data: {"firmcode":firm, "_token": "{{ csrf_token() }}"} ,
                beforeSend:function(x){
                  $("#parentId").children().remove();
                },
                success: function (response) {
                  $("#parentId").append(response);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                   console.log(textStatus, errorThrown);
                }
            });
    }
*/
    </script>
@endsection
