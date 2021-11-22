@extends('layouts')
@section('content')

  <style>
  th {font-size:0.8em !important;}
  td {font-size:0.8em !important;}
  .smallx {font-size:0.8em !important;font-weight: bold;}
  </style>
<div class="container-fluid my-3">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <div class="card-title pl-1"><strong>Satın Alma Taleplerim</strong>
            <a href='javascript:void(0)' class="btn btn-danger btn-sm float-right" data-toggle="modal" data-target="#yenitalep"><i class="fas fa-plus"></i> Yeni Satın Alma Talep</a>
          </div>

          <form action="/satinalma" method="post" >
            {{csrf_field()}}


            <div class="form-group row">
    @include('company.select')
              <div class="col-sm-3">
                <label for="s" class="col-auto col-form-label smallx  ml-0 pl-1">Talep No</label>
                <input type="text" class="form-control" id=""  name="talepno" @if (!empty($talepno)) value="{{$talepno}}" @endif  />
              </div>
              <div class="col-sm-1" style="padding-top:33px;">
              <button type="submit" class="btn btn-info btn-sm"><i class="fas fa-search"></i> Ara</button>
            </div>
          </div>
          </form>
            <table class="table">
              <thead>
                <th>Talep Tarihi </th>
                <th>Talep No</th>
                <th>Masraf Yeri</th>
                <th>Talep Eden</th>
                <th>Talep Durumu</th>
                <th>Onaylayıcı</th>
                <th>İşlemler</th>
              </thead>
              @if(!empty($list))
              @foreach ($list as $key => $value)
              <tr>
                <td>{{$value->created_at}}</td>
                <td>{{$value->talepNo}}</td>
                <td>{{Helper::findMasrafYeriAdi($value->masrafYeri)}}</td>
                <td>{{Helper::findUserName($value->createdUser)}}</td>
                <td>
                  {{Helper::lookStatus($value->status)}}
                </td>
                <td>
                  @if (!empty($value->durumbeklemebul))
                    @switch($value->durumbeklemebul->masrafYeriTipi)
                        @case ("departman")
                        @case ("ustdepartman")
                              {{Helper::findMasrafYeriAdiWithUser($value->durumbeklemebul->masrafYeriId)}}
                        @break
                        @case ("birey")
                            {{Helper::findUserName($value->durumbeklemebul->masrafYeriId)}}
                        @break
                        @case ("unvan")
                            {{Helper::findUnvanWithCode($value->durumbeklemebul->masrafYeriId)}}
                        @break
                    @endswitch
                  @endif
                </td>
                <td><a href='javascript::void()' class="text-danger" onclick="openInformation({{$value->id}})"><i class="fas fa-eye"></i></a></td>
              </tr>
              @endforeach
              @endif
            </table>
          </div>

        </div>
      </div>
    </div>
  </div>

  <div class="modal" tabindex="-1" role="dialog" id="yenitalep">
    <div class="modal-dialog  modal-xxl" role="document">
      <div class="modal-content">
        <div class="modal-header bg-qpm-dark text-white">
            <span class="modal-title ml-1 pl-1">Satın Alma Talep Formu </span>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" class="text-white">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body ">
          <form class="w-100" method="POST" action="/save/satinalmaform" enctype="multipart/form-data" id='dataFrm'>
            {{csrf_field()}}
            @php
            $firmaName=\Helper::getCompanyCode();
            @endphp

            <div class="row">
              <div class="col-12 col-lg-12">
                <div class="form-group my-0">
                  <div class="row">
                    <div class="col-12">
                      <table class="table borderless">
                          <tr>
                             <td> <strong>Firma Kodu:</strong><br />
                               {{$firmaName->companyCode}} {{$firmaName->title}}
                             </td>
                             <td>
                                 <strong>Talep Kullanıcısı : </strong> <br />
                                 {{\Helper::shout(\Auth::user()->usercode)}}  {{\Auth::user()->name}}
                             </td>

                             <td>
                               <strong>Talep Form No : </strong><br />
                               <span  id="talepNumberText"></span>
                                <input id="talepNumberValue" type="hidden" class="form-control" name="talepno" readonly value="" >
                             </td>
                             <td>
                                 <strong>Talep Masraf Yeri </strong> <br />
                                 {{\Helper::findMasrafYeriAdi(\Auth::user()->masrafYeri)}}
                             </td>
                          </tr>
                      </table>

                      <div class="col-md-12">
                        <input id="" type="hidden" class="form-control" name="userId" readonly value="{{\Auth::user()->id}}">
                      </div>

                    </div>
                  </div>

                </div>


                <div class="form-group my-0">
                  <table class="table">
                    <thead>
                      <tr>
                        <th class="smallx text-center">Stok Kodu</th>
                        <th class="smallx text-center">Stok Tanımı</th>
                        <th class="smallx text-center">Stok Türü </th>
                        <th class="smallx text-center">Stok Sınıfı </th>
                        <th class="smallx text-center">Stok Birimi </th>
                        <th class="smallx text-center">Stok Adet </th>
                        <th class="smallx text-center">Stok Açıklaması </th>
                        <th class="smallx text-center">Önerilen Tedarikçi</th>
                        <th class="smallx text-center">Birim Fiyatı </th>
                        <th class="smallx text-center"><a class="text-danger" onclick="addItem()"><i class="fas fa-plus"></i></a></th>
                      </tr>
                    </thead>
                    <tbody id="satinalma">
                    </tbody>
                    <tfooter>
                        <tr>
                          <td class="smallx">Genel Açıklama</td>
                          <td colspan="3"><textarea type="text" name="genelaciklama" class="form-control"></textarea></td>
                          <td class="smallx">Ekli Dosya <br /> <small>Birden fazla seçebilirsiniz</small></td>
                          <td colspan="2">
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" name="file[]" id="customFile" multiple>
                              <label class="custom-file-label" for="customFile">Dosya Seç</label>
                              <div id="secililistesi">
                                Seçili Listesi
                              </div>
                            </div>
                          </td>
                          <td colspan="3">

                          </td>
                        </tr>
                    </tfooter>
                  </table>
                </div>
              </div>
          </form>
        </div>

        <div class="modal-footer  justify-content-start">
          <button class="btn btn-danger" onclick="submitForm()">Kaydet</button>
        </div>

      </div>
    </div>
  </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="talepinceleme">
  <div class="modal-dialog  modal-xxl" role="document">
    <div class="modal-content">
      <div class="modal-header bg-qpm-dark text-white">
        <span class="modal-title ml-1 pl-1">Satın Alma Talep İnceleme </span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" class="text-white">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body " id="talepincelemebody">

      </div>

    </div>

  </div>

</div>

@endsection

@section('altscripts')
  <script>
$("#customFile").change(function (e) {
        var files = [];
        for (var i = 0; i < $(this)[0].files.length; i++) {
            files.push($(this)[0].files[i].name);
        }
        $("#secililistesi").html(files.join(',<br /> '));
    });



$('#yenitalep').on('show.bs.modal', function (e) {
    $.ajax({
      url: "/satinalma/findlastnumber/",
      type: "get",
      success: function(response) {
        $("#talepNumberText").text(response);
        $("#talepNumberValue").val(response);
      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.log(textStatus, errorThrown);
      }
    });
})


  function submitForm() {
    $("#dataFrm").submit();
  }
  $(function() {
    $('.selectmulti').select2({
      //  placeholder: "Lütfen Kullanıcı Seçiniz"
    });
  });

  function removeAllItem(t) {
    $(t).parent().parent().remove();
  }

  function changeType(t) {
    var parent = $(t).find(':selected');




    var malzemeKodu = parent.attr('data-malzemeKodu');
    var malzemeTipi = parent.attr('data-malzemeTipi');
    var malzemeTuru = parent.attr('data-malzemeTuru');
    var malzemeSinifi = parent.attr('data-malzemeSinifi');
    var malzemeBirimi = parent.attr('data-malzemeBirimi');
    var birimFiyat = parent.attr('data-birimFiyat');

    ustparent = parent.parent().parent().parent();

    ustparent.find(".stokkodu").val(malzemeKodu);
    ustparent.find(".stokturu").val(malzemeTuru);
    ustparent.find(".stoktipi").val(malzemeTipi);
    ustparent.find(".stoksinif").val(malzemeSinifi);
    ustparent.find(".stokbirimi").val(malzemeBirimi);
    ustparent.find(".birimfiyati").val(birimFiyat);

  }


  function openInformation(id) {

    $("#talepincelemebody").children().remove();

    $.ajax({
      url: "/satinalma/showtalep/" + id,
      type: "get",
      success: function(response) {
        $("#talepincelemebody").append(response);
        $("#talepinceleme").modal();
      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.log(textStatus, errorThrown);
      }
    });


  }


  function addItem() {
    $.ajax({
      url: "/satinalma/yeniurun",
      type: "get",
      /*data: {"_token": "{{ csrf_token() }}"} ,*/
      success: function(response) {
        $("#satinalma").append(response);
        $('.selectmulti').select2({});
        $(".selectmultiwithtags").select2({
          tags: true
        });
      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.log(textStatus, errorThrown);
      }
    });

  }



</script>
@endsection
