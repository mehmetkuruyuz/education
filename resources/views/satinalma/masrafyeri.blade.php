@extends('layouts')
@section('content')
  <style>
  th {font-size:0.8em !important;}
  td {font-size:0.8em !important;}
  .smallx {font-size:0.8em !important;font-weight: bold;}
  </style>
  <div class="container-fluid my-3">

        <div class="card">
          <div class="card-body">
            <div class="card-title pl-1"><strong>Masraf Yeri Tanımlama</strong> <a href='javascript:void(0)' class="btn btn-danger btn-sm float-right" data-toggle="modal" data-target="#masrafyeriekle"><i class="fas fa-plus"></i> Yeni Masraf Yeri</a></div>
            <p class="card-description d-none">
                Sistemde Kayıtlı Masraf Yerleri
            </p>

          <div class="col-md-12">
            <div class="box  my-3">
                <form action="/admin/user/list" method="post" >
                  {{csrf_field()}}

                  <div class="form-group row">
                      @include('company.select')
                    <div class="col-sm-2">
                      <label for="staticEmail" class="col-auto col-form-label smallx  ml-0 pl-1">Masraf Yeri Kodu</label>
                      <input type="text" class="form-control" id=""  name="masrafyeri" />
                    </div>
                    <div class="col-sm-2">
                      <label for="staticEmail" class="col-auto col-form-label smallx ml-0 pl-1">Masraf Yeri Adı</label>
                      <input type="text" class="form-control" id="staticEmail"  name="isim" />
                    </div>
                    <div class="col-sm-1" style="padding-top:33px;">
                    <button type="submit" class="btn btn-info btn-sm"><i class="fas fa-search"></i> Ara</button>
                  </div>
                </div>
                </form>
            </div>
          </div>
            <table class="table table-striped">
                <thead>
                  <th>Masraf Yeri Kodu</th>
                  <th>Masraf Yeri Adı</th>
                  <th>Masraf Yeri Onaylayıcı Kodu</th>
                  <th>Masraf Yeri Onaylayıcı</th>
                  <th>Onaylayıcı Masraf Yeri Kodu</th>
                  <th>Üst Onaylayıcı</th>
                  <th>İşlemler</th>
                </thead>
                @if(!empty($list))
                  <tbody>
                    @foreach ($list as $key => $value)
                      <tr>
                          <td>{{$value->code}}</td>
                          <td>{{$value->title}}</td>
                          <td>{{Helper::findUserCode($value->masterUserId)}}</td>
                          <td>{{Helper::findUserName($value->masterUserId)}}</td>
                          <td>@if (!empty($value->altdata)) {{$value->altdata->code}} @else  @endif</td>
                          <td> {{Helper::ustMasrafYeriBul($value->id)}} </td>
                        <!--  <td>@if (!empty($value->altdata)) {{$value->altdata->title}} @else  @endif</td> -->
                          <td style="width:150px">
                            <a class="text-danger mx-3" href='javascript::void(0)' onclick="edit({{$value->id}})"><i class="fa fa-edit"></i></a>
                            <a class="text-danger mx-3" onclick="return confirm('Silmek İstediğinize Emin misiniz?')" href='/satinalma/masrafyeri/delete/{{$value->id}}'><i class="fa fa-times"></i></a>
                          </td>
                      </tr>
                    @endforeach
                  </tbody>
                @endif
            </table>
            {{ $list->links( "pagination::bootstrap-4") }}
          </div>
      </div>
  </div>
  </div>
  <div class="modal" tabindex="-1" role="dialog" id="masrafyeriekle">
    <div class="modal-dialog modal-xxl" role="document">
      <div class="modal-content">
        <div class="modal-header  bg-qpm-dark text-white">
          <span class="modal-title ml-1 pl-1">Masraf Yeri Tanımlama</span>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

    <form class="w-100" method="POST" action="/tanimlama/masrafyeri/save" enctype="multipart/form-data">
        <div class="modal-body">
              {{csrf_field()}}
              <div class="row">
                  <div class="col-12 col-lg-4">
                    <div class="form-group my-0">
                        <label class="smallx ml-3">Firma Bilgisi</label>
                        <div class="col-md-12">
                            <select name="firmCode"  class="selectmulti form-control" id="firmCode" required style="width:100% !important" onchange="loadCompanyData()">
                              <option value="-1"> Lütfen Firma Kodu Seçiniz </option>
                              @if (!empty($companyList))
                                @foreach ($companyList as $key => $value)
                                    <option value="{{$value->id}}" >{{$value->companyCode}}  - {{$value->title}} </option>
                                @endforeach
                              @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group" id="masterAllOfAction">
                      <label class="smallx ml-3">Masraf Yeri Grup Kodu</label>
                        <div class="col-md-12" id="parentId">
                          {{--
                          <select name="parentId"  id="parentId" class="selectmulti form-control" required style="width:100% !important" onchange="setMasterCode(this)">

                          </select>
                          --}}
                        </div>
                    </div>
                    <div class="form-group my-0">
                      <label class="smallx ml-3">Masraf Yeri <small>(Kodu)</small></label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="code"  required id="mastercode">
                        </div>
                    </div>
                    <div class="form-group my-0">
                      <label class="smallx ml-3">Masraf Yeri Adı</label>
                        <div class="col-md-12">
                            <input  type="text" class="form-control" name="title"  required>
                        </div>
                    </div>
                    <div class="form-group my-0">
                      <label class="smallx ml-3">Masraf Yeri Onaylayıcısı</label>
                        <div class="col-md-12">
                          <select name="masterUserId"  id="masterUserId" class="selectmulti form-control" required style="width:100% !important">
                              @if (!empty($userList))
                                @foreach ($userList as $key => $value)
                                      <option value="{{$value->id}}">{{$value->usercode}}  - {{$value->name}} </option>
                                @endforeach
                              @endif
                          </select>
                        </div>
                    </div>
                    <div class="form-group d-none">
                      <label class="smallx ml-3">Masraf Yeri Tanımlaması</label>
                        <div class="col-md-12">
                            <input  type="text" class="form-control" name="description">
                        </div>
                    </div>
                    <div class="form-group d-none"  id="onaylayiciekrani">
                      <div class="col-md-12 text-right">
                           <button type="button" class="btn btn-success btn-sm" id="" onclick="yeniOnaylayiciEkle()">Masraf Yeri Ekle</button>
                        </div>
                    </div>
                    <div class="form-check  my-2 ml-3 d-none">
                      <input type="checkbox" class="form-check-input" id="exampleCheck1"  name="powerUp"  value="yes">
                      <label class="form-check-label smallx" for="exampleCheck1">Bir Üst Onaylayıcıya Gönder</label>
                    </div>
                    <div class="form-group" id='onaylayicilar'>

                    </div>
                      <hr  />
                  </div>
              </div>


        <div class="modal-footer justify-content-start">
          <button type="submit" class="btn btn-danger">Kaydet</button>
        </div>
      </form>
      </div>
    </div>
  </div>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="editmodal">
      <div class="modal-dialog modal-xxl" role="document">
        <div class="modal-content">
          <div class="modal-header  bg-qpm-dark text-white">
            <span class="modal-title ml-1 pl-1">Masraf Yeri Düzenleme</span>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
            <form class="w-100" method="POST" action="/tanimlama/masrafyeri/update" enctype="multipart/form-data"  id="actionX">

            </form>
            <div class="modal-footer text-left  justify-content-start">
              <button type="submit" class="btn btn-danger" onclick="submitedit()">Kaydet</button>
            </div>

        </div>
      </div>
    </div>

@endsection

@section('altscripts')

  <script>


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
              },
              error: function(jqXHR, textStatus, errorThrown) {
                 console.log(textStatus, errorThrown);
              }
          });
  }

  var lastone=0;

  function yeniOnaylayiciEkle()
  {


    lastone+=1;
    $.ajax({
           url: "/satinalma/yenionaylayici",
           type: "post",
           data: {"sira":lastone, "_token": "{{ csrf_token() }}"} ,
           beforeSend:function(x){

           },
           success: function (response) {
              $("#onaylayicilar").append(response);
              $("#onaylayiciekrani").hide();
           },
           error: function(jqXHR, textStatus, errorThrown) {
              console.log(textStatus, errorThrown);
           }
       });
  }

  $(function() {
      $('.selectmulti').select2({
            placeholder: "Lütfen Kullanıcı Seçiniz"
      });
    });

    function setMasterCode(t)
    {
      $("#mastercode").val($(t).find(':selected').data('code'));
    }


    function onayYeriGetir(t,id)
    {
      var kl=$(t).val();
      if (kl==0) {return false;}
      $("#place"+id).children().remove();
      var firm=$("#firmCode").val();
      switch (kl)
      {
              case "departman":

                  $.ajax({
                         url: "/satinalma/loadInformation",
                         type: "post",
                         data: {"firmcode":firm, "_token": "{{ csrf_token() }}"} ,
                         success: function (response) {
                              $("#place"+id).append(response);

                              $('.external').select2();
                         },
                         error: function(jqXHR, textStatus, errorThrown) {
                            console.log(textStatus, errorThrown);
                         }
                     });
              break;
            case "birey":
            $.ajax({
                   url: "/satinalma/userlist",
                   type: "post",
                   data: {"firmcode":firm, "_token": "{{ csrf_token() }}"} ,
                   success: function (response) {
                        $("#place"+id).append(response);

                        $('.external').select2({});
                   },
                   error: function(jqXHR, textStatus, errorThrown) {
                      console.log(textStatus, errorThrown);
                   }
               });
            break;
            case "unvan":
            $.ajax({
                   url: "/satinalma/unvanlist",
                   type: "post",
                   data: {"firmcode":firm, "_token": "{{ csrf_token() }}"} ,
                   success: function (response) {
                        $("#place"+id).append(response);

                        $('.external').select2({});
                   },
                   error: function(jqXHR, textStatus, errorThrown) {
                      console.log(textStatus, errorThrown);
                   }
               });

            break;
      }

    }



      function loadCompanyForEditData()
      {

            var firm=$("#firmCode").val();
            if (firm==0) { alert("Lütfen Firma Kodu Seçiniz");}
           $.ajax({
                  url: "/satinalma/tummasrafyerleri",
                  type: "post",
                  data: {"firmcode":firm, "_token": "{{ csrf_token() }}"} ,
                  beforeSend:function(x){
                    $("#parentXId").children().remove();
                  },
                  success: function (response) {
                    $("#parentXId").append(response);
                    var selectedid=$("#parentXId").data("selected");

                    var $radios = $('input:radio[name=parentId]');
                        if($radios.is(':checked') === false) {
                            $radios.filter('[value='+selectedid+']').prop('checked', true);
                            var lasthero=$radios.filter('[value='+selectedid+']');
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

      $.ajax({
             url: "/satinalma/masrafyeri/edit/"+id,
             beforeSend:function(x){
               $("#actionX").children().remove();
             },
             success: function (response) {
               $("#actionX").append(response);
               loadCompanyForEditData();
               $("#editmodal").modal();
             },
             error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
             }
         });


    }

  </script>
  <link href="/assets/css/select2totree.css" rel="stylesheet">
  <script src="/assets/js/select2totree.js"></script>
  <script>
    $("#sel_2").select2ToTree();
  </script>
@endsection
