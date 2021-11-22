@extends('user::admin.layout')
@section('content')
  <style>
  th {font-size:0.9em !important;}
  td {font-size:0.8em !important;}
  </style>
  <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Video Kategorileri</h4>
                  <p class="card-description">
                      Sistemde Video Kategorileri
                  </p>
                  <div class="row">
                    <div class="table-responsive col-12" style="width:100%">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>Adı</th>

                            <th>Resim</th>
                            <th>Kategori</th>
                            <th>Eğitim Sıralaması</th>
                            <th>Kayıt Tarihi</th>
                            <th>Düzenle</th>
                          </tr>
                        </thead>
                        <tbody>
                          @if (!empty($list))
                            @foreach ($list as $key => $value)
                              <tr>
                                <td>{{$value->title}}</td>
                                <td>{{$value->thumb}}</td>
                                <td>{{$value->category->title}}</td>
                                <td>{{$value->educationOrder}}</td>
                                <td>{{$value->created_at}}</td>
                                <td class="px-0" style="width:20px;"><a href='/admin/video/edit/{{$value->id}}'><i class="fa fa-edit"></i></a></td>
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
@endsection
