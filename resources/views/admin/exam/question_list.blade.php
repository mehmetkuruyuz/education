@extends('admin.layout')
@section('content')
  <style>
  th {font-size:0.99em !important;}
  td {font-size:0.9em !important;}
  </style>
  <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Sistemde Kayıtlı Sorular ve Cevapları</h4>
                  <p class="card-description">
                      Sınava Bağlı Soru Listeleri
                  </p>
                  <div class="row">
                    <a href='/admin/question/{{$id}}/new' class="btn btn-danger">Yeni Soru Ekle</a>
                    <div class="table-responsive col-12" style="width:100%">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>Soru Başlık</th>
                            <th>Açıklama</th>
                            <th>Cevaplar</th>
                            <th>Düzenle</th>
                          </tr>
                        </thead>
                        <tbody>
                          @if (!empty($list))
                            @foreach ($list as $key => $value)
                              <tr>
                                <td>{{$value->question}}</td>
                                <td>{{$value->description}}</td>
                                <td>@if (!empty($value->questions))
                                  @foreach ($value->questions as $zkey => $zvalue)
                                    {{$zvalue->answer}}<br  />
                                  @endforeach
                                   @endif</td>
                                <td class="px-0" style="width:20px;"><a  title="Düzenle" href='/admin/question/edit/{{$value->id}}'><i class="fa fa-edit"></i></a></td>
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
