@extends('admin.layout')
@section('content')
  <style>
  th {font-size:0.99em !important;}
  td {font-size:0.9em !important;}
  </style>
  <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Sınav Düzenle</h4>
                  <p class="card-description">
                      Sınav oluşturmak ve soru eklemek için
                  </p>
                  <div class="row">
                    <form class="w-100" method="POST" action="/admin/sinav/update" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input type='hidden' value="{{$data->id}}" name="id" />
                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Sınav İsmi</label>

                            <div class="col-md-12">
                                <input id="" type="text" class="form-control" name="title" value="{{$data->title}}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description" class="col-md-4 control-label">Sınav Açıklaması</label>

                            <div class="col-md-12">
                                <input id="" type="text" class="form-control" name="description" value="{{$data->description}}" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="category" class="col-md-4 control-label">Video Kategorisi</label>

                            <div class="col-md-12">
                                  <select name="categoryId" class="form-control">
                                      <option value="0">Kategori Seçiniz</option>
                                      @if (!empty($category))
                                        @foreach ($category as $key => $value)
                                          <option value="{{$value->id}}" @if ($data->educationCategory==$value->id) selected @endif>{{$value->title}}</option>
                                        @endforeach
                                      @endif
                                  </select>
                              </div>
                        </div>
                        <div class="form-group">
                            <label for="category" class="col-md-4 control-label">Eğiitim Sırası</label>

                            <div class="col-md-12">
                                  <select name="sira" class="form-control">
                                      <option value="son" @if($data->sira=="son") selected @endif>Eğitim Sonu</option>
                                      <option value="bas" @if($data->sira=="bas") selected @endif>Eğitim Başı</option>
                                  </select>
                              </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class="col-md-4 control-label">Maksimum Zamanlama</label>

                            <div class="col-md-12">
                                <input id="" type="text" class="form-control" name="maximumTime" value="{{$data->maximumTime}}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class="col-md-4 control-label">Maksimum Deneme</label>

                            <div class="col-md-12">
                                <input id="" type="text" class="form-control" name="maxTry" value="3" value="{{$data->maxTry}}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class="col-md-4 control-label">Başarılı Olma Yüzdesi</label>

                            <div class="col-md-12">
                                <input id="" type="text" class="form-control" name="successRate" value="{{$data->successRate}}" required>
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
    </div>
@endsection
