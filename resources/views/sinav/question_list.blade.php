@extends('layouts')
@section('content')
  <style>
  th {font-size:0.9em !important;}
  td {font-size:0.8em !important;}
  </style>
  <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="card-title pl-1"> <strong>{{$bilgi->title}} Soru Listesi</strong> <a href='javascript:void(0)' class="btn btn-danger btn-sm float-right" data-toggle="modal" data-target="#yenianketolusturma"><i class="fas fa-plus"></i> Yeni Soru</a></div>

                  <div class="row">
                    <div class="table-responsive col-12" style="width:100%">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>Soru Sırası</th>
                            <th>Soru Grubu</th>
                            <th>Soru</th>
                            <th>Cevaplar</th>
                            <th>Oluşturulma Tarihi</th>
                            <th>İşlemler</th>
                          </tr>
                        </thead>
                        <tbody>
                          @if (!empty($list))
                            @foreach ($list as $key => $value)
                              <tr>
                                <td>{{$value->ordernum}}</td>
                                <td>@if (!empty($value->kategoriname)) {{$value->kategoriname->title}} @endif</td>
                                <td>{{$value->question}}</td>
                                <td>
                                  @if (!empty($value->answers))
                                      @foreach ($value->answers as $xl => $vle)
                                          <div>{{$vle->answer}}</div>
                                      @endforeach
                                  @endif
                                </td>
                                <td>{{$value->created_at}}</td>
                                <td class="px-0" style="width:180px;">
                                    <a href='javascript:void(0)' onclick="openInformation('{{$value->id}}')"  title="Soru Düzenle"><i class="fa fa-edit text-danger mx-2"></i></a>
                                    <a href='/delete/sinav/question/{{$value->id}}' onclick="return confirm('Silmek İstediğinize Emin misiniz?')"  title="Soru Sil"><i class="fas fa-times text-danger  mx-2"></i></a>
                                </td>
                              </tr>
                            @endforeach
                          @endif
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
    </div>



    <div class="modal" tabindex="-1" role="dialog" id="yenianketolusturma">
      <div class="modal-dialog  modal-xxl" role="document">
        <div class="modal-content">
          <div class="modal-header bg-qpm-dark text-white">
              <span class="modal-title ml-1 pl-1">Yeni Soru Ekle</span>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" class="text-white">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body ">
            <form class="w-100" method="POST" action="/sinav/save/answer/{{$id}}" enctype="multipart/form-data" id='dataFrm'>
              {{csrf_field()}}
              <div class="form-group">
                  <label class="smallx ml-3">Soru</label>
                  <div class="col-md-12">
                      <textarea name="title" class="form-control border"></textarea>
                  </div>
              </div>
              <div class="form-group my-0">
                  <label class="smallx ml-3">Soru Grubu</label>
                  <div class="col-md-12">
                        <select name="kategori" class="selectmulti form-control" style="width:100%" id="siparisfirma">
                            @if (!empty($kategoritype))
                                @foreach ($kategoritype as $key => $value)
                                    <option value="{{$value->id}}">{{$value->code}} - {{$value->title}}</option>
                                @endforeach
                            @endif
                        </select>
                  </div>
              </div>

              <div class="form-group">
                <label class="smallx ml-3">Soru Sırası</label>
                  <div class="col-md-12">
                      <input type="text" name="ordernum" value="" class="form-control" maxlength="3"  />
                  </div>
              </div>
              <hr  id="afterburner" />
              <div class="form-group">
                <label class="smallx ml-3">Anket Cevapları</span>
              </div>
              <div class="form-group text-right" >
                  <a href="javascript:void(0)" class="text-danger" onclick="addAnswers()"><i class="fa fa-plus"></i></a>
              </div>
              <div id="form-cevaplar" class="mb-5">

              </div>
                <div class="form-group">
                  <div class="col-md-6 col-md-offset-4">
                      <button type="submit" class="btn btn-danger">
                          Kaydet
                      </button>
                  </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>


        <div class="modal" tabindex="-1" role="dialog" id="anketduzenle">
          <div class="modal-dialog  modal-xxl" role="document">
            <div class="modal-content">
              <div class="modal-header bg-qpm-dark text-white">
                <span class="modal-title ml-1 pl-1">Soru Güncelleme </span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" class="text-white">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body " id="anketduzenlebody">

              </div>

            </div>

          </div>

        </div>

@endsection

@section('altscripts')
  <script>
    $('.daterange').daterangepicker({
        "singleDatePicker": true,
        "drops": "up"
    }, function(start, end, label) {
      console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
    });

  function openInformation(id) {

        $("#anketduzenlebody").children().remove();

        $.ajax({
          url: "/sinav/question/edit/" + id,
          type: "get",
          success: function(response) {
            $("#anketduzenlebody").append(response);
            $("#anketduzenle").modal();
          },
          error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
          }
        });


      }


      function addAnswers()
      {
        var elementfor="";
        elementfor+="<div class='row'>";
        elementfor+="<div class='col-3'>";
        elementfor+='<label for="email" class="col-md-4 control-label">Cevap</label><div class="col-md-12"><input id="" type="text" class="form-control" name="cevap[]" value="" required></div>';
        elementfor+="</div>";
        elementfor+="<div class='col-2'>";
        elementfor+='<label for="puan" class="col-md-2 control-label">Puan</label><div class="col-md-12"><input id="" type="text" class="form-control" name="puan[]" value="" required></div>';
        elementfor+="</div>";
        elementfor+="<div class='col-3'>";
        elementfor+='<label for="cevap" class="col-md-4 control-label">Cevap Tipi</label><div class="col-md-12"><select name="isCorrect[]" class="form-control"><option value="no">Yanlış Cevap</option><option value="yes">Doğru Cevap</option></select></div>';
        elementfor+="</div>";

        elementfor+='<div class="col-2 text-right"><a href="javascript::void(0)" class="text-danger" onclick="return silEleman(this)"><i class="fa fa-minus"></i></a></div>';
        elementfor+="</div>";
        $("#form-cevaplar").append(elementfor);
      }


      function addAnswersek()
      {
        var elementfor="";
        elementfor+="<div class='row'>";
        elementfor+="<div class='col-3'>";
        elementfor+='<label for="email" class="col-md-4 control-label">Cevap</label><div class="col-md-12"><input id="" type="text" class="form-control" name="cevap[]" value="" required></div>';
        elementfor+="</div>";
        elementfor+="<div class='col-2'>";
        elementfor+='<label for="puan" class="col-md-2 control-label">Puan</label><div class="col-md-12"><input id="" type="text" class="form-control" name="puan[]" value="" required></div>';
        elementfor+="</div>";
        elementfor+="<div class='col-3'>";
        elementfor+='<label for="cevap" class="col-md-4 control-label">Cevap Tipi</label><div class="col-md-12"><select name="isCorrect[]" class="form-control"><option value="no">Yanlış Cevap</option><option value="yes">Doğru Cevap</option></select></div>';
        elementfor+="</div>";

        elementfor+='<div class="col-2 text-right"><a href="javascript::void(0)" class="text-danger" onclick="return silEleman(this)"><i class="fa fa-minus"></i></a></div>';
        elementfor+="</div>";
        $("#form-cevaplarek").append(elementfor);
      }

      function silEleman(t)
      {
        $(t).parent().parent().remove();
      }

  </script>
@endsection
