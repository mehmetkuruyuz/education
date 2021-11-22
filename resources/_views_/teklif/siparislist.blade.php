@extends('layouts')
@section('content')

  <style>
  th {font-size:11px !important;}
  td {font-size:11px !important;}
  .smallxd {font-weight: bold;}
  </style>
<div class="container-fluid my-3">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <div class="card-title pl-1"><strong>Sipariş Edilen Talepler</strong> </div>
          <form action="/teklif/siparis" method="post" >
            {{csrf_field()}}

            <div class="form-group row">
              <div class="col-sm-3">
                <label for="staticEmail" class="col-auto col-form-label smallx  ml-0 pl-1">Firma Kodu</label>
                <input type="text" class="form-control" id="" value="{{Helper::findCompanyName(1)}} "  readonly />
              </div>
              <div class="col-sm-3">
                <label for="s" class="col-auto col-form-label smallx  ml-0 pl-1">Stok Kodu</label>
                <input type="text" class="form-control" id=""  name="stokkodu" @if (!empty($stokkodu)) value="{{$stokkodu}}" @endif  />
              </div>

              <div class="col-sm-1" style="padding-top:33px;">
              <button type="submit" class="btn btn-info btn-sm"><i class="fas fa-search"></i> Ara</button>
            </div>
          </div>
          </form>
          <form action="/teklif/tedarikedildi" method="post" name="x">
            {{csrf_field()}}
              @if(!empty($list))
                        <table class="table">
                          <thead>
                            <tr>

                              <th class="smallxd">Sipariş Kodu</th>
                              <th class="smallxd">Sipariş Tarihi</th>
                              <th class="smallxd">Toplam</th>
                              <th class="smallxd">Stok Birimi </th>
                              <th class="smallxd">Stok Kodu</th>
                              <th class="smallxd">Stok Tanımı</th>
                              <th class="smallxd">Stok Türü </th>
                              <th class="smallxd">Stok Sınıfı </th>

                              <th class="smallxd">Stok Açıklaması </th>
                              <th class="smallxd">Önerilen Tedarikçi</th>
                              <th class="smallxd">Birim Fiyatı</th>

                              <th class="smallxd">
                                İşlemler
                              </th>
                            </tr>
                          </thead>
                            @foreach ($list as $klo => $vlo)
                              <tr>
                                <td>{{$vlo->satinAlmaKodu}}</td>
                                <td>{{\Carbon\Carbon::parse($vlo->siparistarihi)->format("d-m-Y H:i")}}</td>
                                <td>{{$vlo->total_debit}}</td>
                                <td>{{$vlo->stokbirimi}}</td>
                                <td>{{$vlo->stokkodu}}</td>
                                <td>{{$vlo->urunadi}}</td>
                                <td>{{$vlo->stokturu}}</td>
                                <td>{{$vlo->stoksinifi}}</td>

                                <td>{{$vlo->stokaciklamasi}}</td>
                                <td>{{$vlo->onerilentedarikci}}</td>
                                <td>{{$vlo->birimfiyati}}</td>

                                <td>

                                @if ($vlo->status=="siparisedildi")
                                  <a href='javascript::void()' class="text-danger collapsable"  data-toggle="collapse" onclick="checkforme({{$vlo->id}})" data-target="#collapseme_{{$vlo->id}}"><i class="fas fa-eye" style="margin-top:5px"></i></a>
                                  <div class="custom-control custom-checkbox float-left d-none"  id="parenter_{{$vlo->id}}">
                                    <input type="checkbox" class="custom-control-input "   id="customCheckParent_{{$vlo->id}}"  value="{{$vlo->id}}" onclick="checksub({{$vlo->id}})">
                                    <label class="custom-control-label" for="customCheckParent_{{$vlo->id}}"> </label>
                                  </div>
                                @else
                                  Tedarik Edildi
                                @endif
                                </td>
                                <td></td>
                              </tr>
                              @if(!empty($vlo->teklifsiparis))
                                <tr id="collapseme_{{$vlo->id}}" class="collapse out">
                                  <td colspan="10">
                                        <table class="table">
                                          <thead>
                                            <th>

                                            </th>
                                            <th>Talep No</th>
                                            <th>Masraf Yeri Adı</th>
                                            <th>Talep Yapan</th>
                                            <th>İstenen Adet</th>
                                            <th>İşlemler</th>
                                          </thead>
                                            @foreach ($vlo->teklifsiparis as $top => $deger)
                                              <tr>
                                                <td>

                                                </td>
                                                <td>{{$deger->talepNo}} </td>
                                                <td>{{Helper::findMasrafYeriAdi($deger->teklifdurum->masrafYeriId)}} </td>

                                                <td>{{Helper::findUserNameWithCode($deger->teklifdurum->createdUser)}} </td>
                                                <td>{{$deger->stokadet}} </td>
                                                <td>
                                                  @if ($deger->status=="siparisedildi")
                                                    <div class="custom-control custom-checkbox float-left">
                                                      <input type="checkbox" class="custom-control-input fullcheck_{{$vlo->id}}"  id="customCheck_{{$deger->id}}"  name="alttalepno[]" value="{{$deger->id}}" onclick="opensavebutton()">
                                                      <label class="custom-control-label" for="customCheck_{{$deger->id}}"> </label>
                                                    </div>
                                                  @else
                                                    Tedarik Edilmiş.
                                                @endif
                                                </td>
                                              </tr>
                                            @endforeach
                                        </table>
                                  </td>
                                </tr>
                              @endif
                            @endforeach
                        </table>
                    @endif


            <div class="col-12">
              <button class="btn btn-danger d-none" id="opensave">Tedarik Edildi</button>
            </div>
          </form>
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
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
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

    ustparent = parent.parent().parent().parent().parent();

    ustparent.find(".stokkodu").val(malzemeKodu);
    ustparent.find(".stokturu").val(malzemeTuru);
    ustparent.find(".stoktipi").val(malzemeTipi);
    ustparent.find(".stoksinif").val(malzemeSinifi);
    ustparent.find(".stokbirimi").val(malzemeBirimi);
    ustparent.find(".birimfiyati").val(birimFiyat);

  }

  function checksub(id)
  {
  $(".fullcheck_"+id).prop("checked",true);
    $("#opensave").removeClass("d-none");
  }

  function opensavebutton()
  {
    $("#opensave").removeClass("d-none");
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


function checkforme(id)
{

  $("#parenter_"+id).removeClass("d-none");
}


</script>
@endsection
