<form class="w-100" method="POST" action="/update/poll" enctype="multipart/form-data" id='dataFrm'>
  {{csrf_field()}}
  <div class="form-group">
      <label for="anketCode" class="col-md-4 control-label">Anket Kodu</label>

      <div class="col-md-12">
          <input id="anketCode" type="text" class="form-control" name="anketCode" value="{{$data->anketCode}}" >
      </div>
  </div>
  <div class="form-group">
      <label for="email" class="col-md-4 control-label">Anket Adı</label>
      <input id="" type="hidden" class="form-control" name="id" value="{{$data->id}}" required>
      <div class="col-md-12">
          <input id="" type="text" class="form-control" name="title" value="{{$data->title}}" required>
      </div>
  </div>
  <div class="form-group">
      <label for="açıklama" class="col-md-4 control-label">Anket Açıklamsı</label>

      <div class="col-md-12">
          <textarea name="description" class="form-control border">{{$data->description}}</textarea>
      </div>
  </div>

        <input id="" type="hidden" class="form-control" name="type" value="{{$data->polltype}}" required>

  <div class="form-group">
      <label for="baslangicsuresi" class="col-md-4 control-label">Anket Başlangıç Tarihi</label>

      <div class="col-md-12">
          <input id="baslangicsuresi" type="text" class="form-control daterange" name="baslangicsuresi" value="{{\Carbon\Carbon::parse($data->startdate)->format("m/d/Y")}}" >
      </div>
  </div>
  <div class="form-group">
      <label for="bitissuresi" class="col-md-4 control-label">Anket Tamamlanma Tarihi</label>

      <div class="col-md-12">
          <input id="bitissuresi" type="text" class="form-control daterange" name="bitissuresi" value="{{\Carbon\Carbon::parse($data->enddate)->format("m/d/Y")}}" >
      </div>
  </div>
  <div class="form-group">
      <div class="col-md-6 col-md-offset-4">
          <button type="submit" class="btn btn-danger">
              Kaydet
          </button>
      </div>
  </div>
</form>
