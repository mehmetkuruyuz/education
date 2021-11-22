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
          <div class="card-title pl-1"><strong>Onayda Bekleyenler</strong>
            <form action="/satinalma-onay" method="post" >
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
          </div>
            <table class="table">
              <thead>
                <th>Talep Tarihi </th>
                <th>Talep No</th>
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
                <td>{{Helper::findMasrafYeriAdi($value->masrafYeri)}}</td>
                <td>{{Helper::findUserName($value->createdUser)}}</td>
                <td>{{Helper::lookStatus($value->status)}}</td>
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


  function openInformation(id) {

    $("#talepincelemebody").children().remove();

    $.ajax({
      url: "/satinalma/findtalep/" + id,
      type: "get",
      /*data: {"_token": "{{ csrf_token() }}"} ,*/
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


  function setStatusAndSend(islem)
  {
     $("#xxtypexx").val(islem);
     $("#talepformilerlet").submit();
  }

  function birimRed(id,t)
  {
    var k=confirm("Ürün Reddilecek ve Satınalma alanında işlem yapılamayacaktır. Emin misiniz?");
    if (k==true)
    {
      $.ajax({
        url: "/satinalma/talep/red/birim/"+id,
        type: "get",
        success: function(response) {
            if (response=="ok") {
              $(t).parent().parent().addClass("strikeout");
              $(t).parent().children().remove();
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.log(textStatus, errorThrown);
        }
      });
    }
  }
</script>
@endsection
