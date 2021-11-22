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
          <div class="card-title pl-1"><strong>Satın Alma Talep Süreç Tanımlama</strong>  <a href='/tanimlama/masraf/sablon' class="btn btn-danger btn-sm float-right"><i class="fas fa-plus"></i> Tüm Masraf Yerleri Şablon Tanımlama</a></div>
          <div class="col-md-12">
            <div class="box  my-3">
                <form action="/satinalma/surec/akis" method="post" >
                  {{csrf_field()}}

                  <div class="form-group row">
                    <div class="col-sm-4">
                      <label for="staticEmail" class="col-auto col-form-label smallx  ml-0 pl-1">Masraf Yeri</label>
                      <input type="text" class="form-control" id="" value="{{$arama}}"  name="masrafyeri"  />
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
                  <th>Süreç İlgili Sayısı</th>
                  <th class="text-center" >İşlemler</th>
                </thead>
                @if(!empty($list))
                  <tbody>
                    @foreach ($list as $key => $value)
                      <tr>
                          <td>{{$value->code}}</td>
                          <td>{{$value->title}}</td>
                          @php  $hiperx=Helper::masrafyerlerilistesi($value->id) @endphp
                          <td>
                            {{count($hiperx)}}
                          </td>
                          <td class="text-center" style="width:150px;">

                            <div class="btn-group dropleft">
                              <a href='#' class="text-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="fas fa-eye"></i>
                              </a>
                              <div class="dropdown-menu p-5 py-2" style="min-width:40rem;">
                                <div class="container-fluid my-3">
                                    <div class="row justify-content-center">
                                        <div class="col-md-12 mx-auto">
                                          <div class="box text-right my-3" id="timeline">
                                            <ol class="list-unstyled" id="hospital">
                                              @if (!empty($hiperx))
                                                <li id="">
                                                  <span>Talep Yapan : {{$value->title}}</span>
                                                </li>
                                                @foreach ($hiperx as $muko => $zuko)
                                                  @if ($zuko!="Bağlanmamış")
                                                    <li id="">
                                                      <span>{{$zuko}}</span>
                                                    </li>
                                                  @endif
                                                @endforeach
                                              @endif
                                            </ol>
                                        </div>
                                      </div>
                                      </div>
                                      </div>
                              </div>
                            </div>
                              <!-- <a href='/masrafsurec/goster/{{$value->id}}' class="text-danger mx-2"></a> -->
                              <a href='/masrafsurec/duzenle/{{$value->id}}'  class="text-danger mx-2"><i class="fas fa-edit"></i></a>
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
  </script>
@endsection
--}}
