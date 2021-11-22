@extends('layouts')
@section('content')
  <style>
  th {font-size:0.8em !important;}
  td {font-size:0.8em !important;}
  .smallx {font-size:0.8em !important;font-weight: bold;}
  </style>
  <div class="container-fluid my-3">
<form action="/genelsurec/kaydet" method="post">
      {{csrf_field()}}
        <div class="card">
          <div class="card-body">
          <div class="card-title pl-1"><strong>Satın Alma Talep Genel Süreç Tanımlama</strong> </div>
            <div class="pl-3" style="width:100%">
              <div class="row">
                <div class="col-9 ml-1 d-none">
                  <strong>Satın Alma İş Akışı ve Onaylayıcılar </strong>
                </div>
                  <div class="col-12 text-right" >
                    <a href='javascript:void(0)' class="btn btn-danger btn-sm" onclick="yeniOnaylayiciEkle()"><i class="fas fa-plus"></i>  Yeni Onaylayıcı Ekle</a>
                  </div>
                  <div class="form-group col-6 my-3" id="onaylayicilar">

                  </div>
                  <div class="form-group col-6 my-3" id="gorselonaylayicilar">
                      <div class="container-fluid my-3">
                          <div class="row justify-content-center">
                              <div class="col-md-6 mx-auto">
                                <div class="box text-right my-3" id="timeline">
                                  <ol class="list-unstyled" id="hospital">
                                    <li id="patient_00">
                                      <h5>Talep Eden</h5>
                                      <p>Satın Alma Süreci için Talep Formu Doldurur</p>
                                    </li>
                                    @if(!empty($list))
                                      @foreach ($list as $key => $value)
                                        <li id="patient_{{$key}}">
                                          <h5>
                                            @switch($value->type)
                                              @case("departman")
                                                {{Helper::findMasrafYeriAdi($value->unit_id)}}
                                              @break
                                              @case("birey")
                                                {{Helper::findUserNameWithCode($value->unit_id)}}
                                              @break
                                              @case("ustdepartman")
                                                  Bir Üst Onaylayıcı
                                              @break
                                              @case("unvan")
                                                {{Helper::findUnvan($value->unit_id)}}
                                              @break
                                            @endswitch
                                            </h5>
                                          <p>Onay Sürecinde Onaylar yada Reddeder</p>
                                        </li>
                                      @endforeach
                                    @endif
                                </div>
                              </div>
                          </div>
                      </div>
                  </div>
                      </div>
                  </div>
              </div>
          </div>
<button class="btn btn-sm btn-danger">Kaydet</button>
</form>
  </div>


@endsection


{{--
@extends('layouts')
@section('content')


  <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="card-title pl-1"><strong>Satın Alma Talep Süreç Tanımlama</strong> </div>
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

                            <div class="form-group row d-none">
                              <div class="col-sm-4">
                                <label for="staticEmail" class="col-auto col-form-label smallx  ml-0 pl-1">Firma Kodu</label>
                                <input type="text" class="form-control" id="" value="{{Helper::findCompanyName(1)}} "  readonly />
                              </div>
                            </div>
                          </form>
                      </div>
                      <div class="pl-3" style="width:100%">
                        <div class="row">
                          <div class="col-9 ml-1 d-none">
                            <strong>Satın Alma İş Akışı ve Onaylayıcılar </strong>
                          </div>
                            <div class="col-12 text-right" >
                              <a href='javascript:void(0)' class="btn btn-danger btn-sm" onclick="yeniOnaylayiciEkle()"><i class="fas fa-plus"></i>  Yeni Onaylayıcı Ekle</a>
                            </div>
                        </div>

                        <div class="form-group my-3" id="masterAllOfAction">
                            <label for="" class="col-auto col-form-label smallx  ml-0 pl-1">1. Talep Yapan</label>
                            <div class="col-md-12 ml-0 pl-0" id="parentId">

                            </div>
                        </div>
                        <div class="form-group my-3" id="onaylayicilar">

                        </div>
                      </div>
                </div>
          </div>
        </div>
      </div>

@endsection
--}}
@section('altscripts')
  <script>






$(document).ready(function (){
    loadCompanyData();
});

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
           },
           error: function(jqXHR, textStatus, errorThrown) {
              console.log(textStatus, errorThrown);
           }
       });
  }

  $(function() {
      $('.selectmulti').select2({
            placeholder: ""
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

        $("#place"+id).parent().removeClass("d-none");
      switch (kl)
      {
              case "departman":

                  $.ajax({
                         url: "/satinalma/forselectalldepartments",
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
            case "ustdepartman":
            $("#place"+id).parent().addClass("d-none");
            $("#place"+id).append("<option value='0' selected>selected</option>");
            if ($('#patient_'+id).text().length>0)
            {
                var textinstert="";
                textinstert+='<h5>Bir Üst Onaylayıcı</h5>';
                textinstert+='<p>Onay Sürecinde Onaylar yada Reddeder</p>';
                $('#patient_'+id).html(textinstert);
            }else {
              var textinstert="";
              textinstert+='<li id="patient_'+id+'">';
              textinstert+='<h5>Bir Üst Onaylayıcı</h5>';
              textinstert+='<p>Onay Sürecinde Onaylar yada Reddeder</p>';
              textinstert+='</li>';
              $("#hospital").append(textinstert);
            }


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

    function addItemToScreen(id)
    {

      var maintext=$("#place"+id+" option:selected").html();
      var idx= $("#place"+id).val();

      var textinstert="";
      if ($('#patient_'+id).text().length>0)
      {
            textinstert+='<h5>'+maintext+'</h5>';
            textinstert+='<p>Onay Sürecinde Onaylar yada Reddeder</p>';

            $('#patient_'+id).html(textinstert);
      }else {
          textinstert+='<li id="patient_'+id+'">';
          textinstert+='<h5>'+maintext+'</h5>';
          textinstert+='<p>Onay Sürecinde Onaylar yada Reddeder</p>';
          textinstert+='</li>';
          $('#patient_'+id).remove();
          $("#hospital").append(textinstert);
      }


    }


    function removeItemToScreen(id)
    {
      $('#patient_'+id).remove();
      $("#place"+id).children().remove();
      $('#master'+id).remove();

    }
  </script>
@endsection
