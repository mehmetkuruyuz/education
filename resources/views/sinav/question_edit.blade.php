<form class="w-100" method="POST" action="/sinav/edit/answer/{{$id}}" enctype="multipart/form-data" id='dataFrm'>
  <input type="hidden" name="id" value="{{$bilgi->id}}" />
  {{csrf_field()}}
  <div class="form-group">
      <label class="smallx ml-3">Soru</label>
      <div class="col-md-12">
          <textarea name="title" class="form-control border">{{$bilgi->question}}</textarea>
      </div>
  </div>
  <div class="form-group my-0">
      <label class="smallx ml-3">Soru Grubu</label>
      <div class="col-md-12">
            <select name="kategori" class="selectmulti form-control" style="width:100%" id="siparisfirma">
                @if (!empty($kategoritype))
                    @foreach ($kategoritype as $key => $value)
                        <option @if ($value->id==$bilgi->kategoriname->id) selected="selected"  @endif value="{{$value->id}}">{{$value->code}} - {{$value->title}}</option>
                    @endforeach
                @endif
            </select>
      </div>
  </div>

  <div class="form-group">
    <label class="smallx ml-3">Soru Sırası</label>
      <div class="col-md-12">
          <input type="text" name="ordernum" value="{{$bilgi->ordernum}}" class="form-control" maxlength="3"  />
      </div>
  </div>
  <hr  id="afterburner" />
  <div class="form-group">
    <label class="smallx ml-3">Soru Cevapları</span>
  </div>
  <div class="form-group text-right" >
      <a href="javascript:void(0)" class="text-danger" onclick="addAnswersek()"><i class="fa fa-plus"></i></a>
  </div>
  <div id="form-cevaplarek" class="mb-5">
    @if (!empty($bilgi->answers))
        @foreach ($bilgi->answers as $xl => $vle)
          <div class='row'>
            <div class='col-3'>
              <label for="email" class="col-md-4 control-label">Cevap</label>
              <div class="col-md-12"><input id="" type="text" class="form-control" name="cevap[]" value="{{$vle->answer}}" required></div>
            </div>
            <div class='col-2'>
              <label for="puan" class="col-md-4 control-label">Puan</label>
              <div class="col-md-12"><input id="" type="text" class="form-control" name="puan[]" value="{{$vle->puan}}" required></div>
            </div>
            <div class='col-3'>
                <label for="cevap" class="col-md-4 control-label">Cevap Tipi</label>
                <div class="col-md-12">
                  <select name="isCorrect[]" class="form-control">
                    <option value="no" @if($vle->iscorrect=="no") selected @endif>Yanlış Cevap</option>
                    <option value="yes" @if($vle->iscorrect=="yes") selected @endif>Doğru Cevap</option>
                  </select>
                </div>
            </div>
          <div class="col-2 text-right"><a href="javascript::void(0)" class="text-danger" onclick="return silEleman(this)"><i class="fa fa-minus"></i></a></div>
        </div>
        @endforeach
    @endif
  </div>
    <div class="form-group">
      <div class="col-md-6 col-md-offset-4">
          <button type="submit" class="btn btn-danger">
              Kaydet
          </button>
      </div>
  </div>
</form>
