@extends('user::admin.layout')
@section('content')
  <style>
  th {font-size:0.9em !important;}
  td {font-size:0.8em !important;}
  </style>
  <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Durumlar</h4>
                  <p class="card-description">

                  </p>
                  <div class="row">
                    <div class="table-responsive col-12" style="width:100%">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th colspan="2">Kullanıcı Adı</th>
                            <th>Video Kategorisi</th>
                            <th>Video İzlenme Durumları</th>
                            <th>Sınav Durumları</th>

                            <th colspan="4">Mail Gönderin</th>
                          </tr>
                        </thead>
                        <tbody>
                          @if (!empty($list))
                            @foreach ($list as $key => $value)
                              <tr>
                                <td>{{$value["isim"]}}</td>
                                <td>{{$value["email"]}}</td>
                                <td>{{$value["atanmiskategori"]}}</td>
                                <td>{{$value["videoseyretme"]}}</td>


                                <td>{{$value["sinav"]}}</td>
                                <td>  @if ($value["durum"]==true) <a href='/admin/send/email/sinavbelgesi/{{$value["id"]}}'>Sınav Başarı Bilgisi Yolla</a> @else İşlemleri Tamamlamamış @endif </td>
                                <td><a href='/admin/send/email/yenivideo/{{$value["id"]}}'>Yeni Video Bilgisi Yolla</a></td>
                                <td><a href='/admin/send/email/sinavagir/{{$value["id"]}}'>Sınava Girme Bilgisi Yolla</a></td>
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
