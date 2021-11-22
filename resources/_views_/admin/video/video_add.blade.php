@extends('user::admin.layout')
@section('content')

  <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Video Oluştur</h4>
              <form class="w-100" method="POST" action="/admin/video/save" enctype="multipart/form-data">
                  {{csrf_field()}}
                  <div class="form-group">
                      <label for="email" class="col-md-4 control-label">Video İsmi</label>

                      <div class="col-md-12">
                          <input id="" type="text" class="form-control" name="title" value="{{ old('title') }}" required>
                      </div>
                  </div>

                  <div class="form-group">
                      <label for="description" class="col-md-4 control-label">Video Açıklaması</label>

                      <div class="col-md-12">
                          <input id="" type="text" class="form-control" name="description" value="{{ old('description') }}" required>
                      </div>
                  </div>

                  <div class="form-group">
                      <label for="category" class="col-md-4 control-label">Video Kategorisi</label>

                      <div class="col-md-12">
                            <select name="categoryId" class="form-control">
                                <option value="0">Kategori Seçiniz</option>
                                @if (!empty($category))
                                  @foreach ($category as $key => $value)
                                    <option value="{{$value->id}}">{{$value->title}}</option>
                                  @endforeach
                                @endif
                            </select>
                        </div>
                  </div>

                  <div class="form-group p-2">
                    <label for="category" class="col-md-4 control-label">Video Dosyası</label>
                  <div class="custom-file">
                      <input type="file" class="custom-file-input" id="customFile" name="video">
                      <label class="custom-file-label" for="customFile">Video Dosyası</label>
                  </div>
                    </div>
                <div class="form-group p-2">
                  <label for="category" class="col-md-4 control-label">Video Resmi</label>
                  <div class="custom-file">
                      <input type="file" class="custom-file-input" id="customFile" name="thumb">
                      <label class="custom-file-label" for="customFile">Video Resmi</label>
                  </div>
                </div>
                  <div class="form-group">
                      <label for="description" class="col-md-4 control-label">Başarılı Sayılması İçin Gerekli Süre</label>

                      <div class="col-md-12">
                          <input id="" type="text" class="form-control" name="successTime" value="{{ old('description') }}" required>
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="description" class="col-md-4 control-label">Maximum Deneme Sayısı</label>

                      <div class="col-md-12">
                          <input id="" type="text" class="form-control" name="maximumtry" value="{{ old('maximumTry') }}" required>
                      </div>
                  </div>
                  <div class="form-group">
                      <div class="col-md-6 col-md-offset-4">
                          <button type="submit" class="btn btn-primary">
                              Kaydet
                          </button>
                      </div>
                  </div>
            </form>
          </div>
        </div>
    </div>

@endsection
@section("altscripts")
  <script>
      // Add the following code if you want the name of the file appear on select
      $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
      });
  </script>
@endsection
