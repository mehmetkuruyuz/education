@extends('admin.layout')
@section('content')
  <style>
  th {font-size:0.99em !important;}
  td {font-size:0.9em !important;}
  </style>
  <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">

                  <div class="card-title pl-1"><strong>SınavTanımlama</strong> <a href='admin/sinav/new' class="btn btn-danger btn-sm float-right"><i class="fas fa-plus"></i>  Yeni Kullanıcı</a></div>
                  <div class="row">
                    <div class="table-responsive col-12" style="width:100%">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>Sınav Adı</th>
                            <th>Açıklama</th>
                            <th>Bağlı Eğitim</th>
                            <th>Kayıt Tarihi</th>
                            <th>Toplam Soru Sayısı</th>
                            <th>
                              Cevaplanma İstatistikleri
                            </th>
                            <th>Soruları Düzenle</th>

                            <th>Düzenle</th>
                          </tr>
                        </thead>
                        <tbody>
                          @if (!empty($list))
                            @foreach ($list as $key => $value)
                              <tr>
                                <td>{{$value->title}}</td>
                                <td>{{$value->description}}</td>
                                <td>{{$value->exam->title}}</td>
                                <td>{{$value->created_at}}</td>
                                <td>{{$value->questions_count}}</td>
                                <td class="px-0" style="width:20px;"><a href='/exam/statics/{{$value->id}}'><i class="far fa-question-circle"></i></a></td>
                                <td class="px-0" style="width:20px;"><a href='/admin/sinav/questions/list/{{$value->id}}'><i class="far fa-question-circle"></i></a></td>
                                <td class="px-0" style="width:20px;"><a href='/admin/sinav/edit/{{$value->id}}'><i class="fa fa-edit"></i></a></td>
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
