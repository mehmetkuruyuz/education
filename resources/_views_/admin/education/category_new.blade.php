@extends('user::admin.layout')
@section('content')

  <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Video Kategorisi Oluştur</h4>
              <form class="w-100" method="POST" action="/admin/kategori/save">
                  {{csrf_field()}}
                  <div class="form-group">
                      <label for="email" class="col-md-4 control-label">Kategori İsmi</label>

                      <div class="col-md-12">
                          <input id="" type="text" class="form-control" name="title" value="{{ old('title') }}" required>
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="açıklama" class="col-md-4 control-label">Kategori Açıklaması</label>

                      <div class="col-md-12">
                          <textarea name="description" class="form-control border"></textarea>
                      </div>
                  </div>

                  <div class="form-group">
                      <div class="col-md-6 col-md-offset-4">
                          <button type="submit" class="btn btn-primary">
                              Kayıt Ol
                          </button>
                      </div>
                  </div>
                </form>
          </div>
        </div>
  </div>

@endsection
