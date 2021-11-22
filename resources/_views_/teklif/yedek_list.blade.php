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
          <div class="card-title pl-1"><strong>İşlem Yapılan Talepler</strong>

          </div>
          <form action="/teklif/onayla" method="post" name="x">
            {{csrf_field()}}
            <table class="table">
              <thead>
                <th>Talep Tarihi </th>
                <th>Talep No</th>
                <th>Teklif No</th>
                <th>Masraf Yeri</th>
                <th>Talep Eden</th>
                <th>Talep Durumu</th>
                <th>İşlemler</th>
              </thead>
              @if(!empty($list))
              @foreach ($list as $key => $value)
              <tr>
                <td>{{$value->created_at}}</td>
                <td>{{$value->talepNo}}</td>
                <td>{{$value->id}}</td>
                <td>{{Helper::findMasrafYeriAdi($value->masrafYeriId)}}</td>
                <td>{{Helper::findUserName($value->createdUser)}}</td>
                <td>{{Helper::lookStatus($value->status)}}</td>
                <td><a href='javascript::void()' class="text-danger"  data-toggle="collapse" data-target="#collapseme_{{$value->id}}"><i class="fas fa-eye"></i></a></td>
              </tr>
              @if(!empty($value->altelemaninbekleme))
                <tr id="collapseme_{{$value->id}}" class="collapse out">
                    <td colspan="7">
                        <table class="table">
                          <thead>
                            <tr>
                              <th class="smallxd">Talep No</th>
                              <th class="smallxd">Stok Kodu</th>
                              <th class="smallxd">Stok Tanımı</th>
                              <th class="smallxd">Stok Türü </th>
                              <th class="smallxd">Stok Sınıfı </th>
                              <th class="smallxd">Stok Birimi </th>
                              <th class="smallxd">Stok Adet </th>
                              <th class="smallxd">Stok Açıklaması </th>
                              <th class="smallxd">Önerilen Tedarikçi</th>
                              <th class="smallxd">Birim Fiyatı </th>
                              <th class="smallxd">
                                Satın Alındı
                              </th>
                            </tr>
                          </thead>
                            @foreach ($value->altelemaninbekleme as $klo => $vlo)
                              <tr>
                                <td>{{$vlo->talepNo}}</td>
                                <td>{{$vlo->stokkodu}}</td>
                                <td>{{$vlo->urunadi}}</td>
                                <td>{{$vlo->stokturu}}</td>
                                <td>{{$vlo->stoksinifi}}</td>
                                <td>{{$vlo->stokbirimi}}</td>
                                <td>{{$vlo->stokadet}}</td>
                                <td>{{$vlo->stokaciklamasi}}</td>
                                <td>{{$vlo->onerilentedarikci}}</td>
                                <td>{{$vlo->birimfiyati}}</td>
                                <td>
                                  @if ($vlo->status=="bekleme")
                                  <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="alttalepno[]" id="customCheck_{{$vlo->id}}"  value="{{$vlo->id}}" onclick="opensavebutton()">
                                    <label class="custom-control-label" for="customCheck_{{$vlo->id}}"> </label>
                                  </div>
                                @else
                                    Tedarik Edildi
                                @endif
                                </td>
                              </tr>
                            @endforeach
                        </table>
                    </td>
                </tr>
              @endif
              @endforeach
              @endif
            </table>

            <div class="col-12">
              <button class="btn btn-danger d-none" id="opensave">Kaydet</button>
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



</script>
@endsection
