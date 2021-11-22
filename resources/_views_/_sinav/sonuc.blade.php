@extends('layouts')
@section("content")
  <div class="container-fluid" style="margin-top:90px">
      <div class="row justify-content-center">
          <div class="col-md-12">
              <div class="card" id="allstartbody">
                  @php
                    $successRate=round($sonuc["correct"]/($sonuc["totalanswers"]+$sonuc["empty"])*100);
                  @endphp
                  <div class="card-header" id="startoverTitle">
                      Sayın <strong>{{\Auth::user()->name}} </strong>  Sınav Sonucunuz </div>
                      <div class="alert @if ($successRate>$info->successRate) alert-success @else alert-danger @endif ">
                        <strong> Bu sınavdan başarılı olabilmeniz için gerekli doğru cevap yüzdesi % {{$info->successRate}} dir. Sınava ait toplam doğru yüzdeniz %{{$successRate}} dir.</strong>
                      </div>
                    <div class="card-body">
                      <div class="row">
                          <div class="col-6 p-5">Toplam Soru Sayısı</div>
                          <div class="col-6 p-5">{{$sonuc["totalanswers"]+$sonuc["empty"]}}</div>
                      </div>
                        <div class="row">
                            <div class="col-6 p-5">Toplam Cevaplanan Soru Sayısı</div>
                            <div class="col-6 p-5">{{$sonuc["totalanswers"]}}</div>
                        </div>
                        <div class="row">
                            <div class="col-6 p-5">Toplam Doğru Sayısı</div>
                            <div class="col-6 p-5">{{$sonuc["correct"]}}</div>
                        </div>
                        <div class="row">
                            <div class="col-6 p-5">Toplam Yanlış Sayısı</div>
                            <div class="col-6 p-5">{{$sonuc["incorrect"]}}</div>
                        </div>
                        <div class="row">
                            <div class="col-6 p-5">Toplam Puan</div>
                            <div class="col-6 p-5">{{$sonuc["puan"]}}</div>
                        </div>
                        <div class="row">
                            <div class="col-6 p-5">Toplam Boş Sayısı</div>
                            <div class="col-6 p-5">{{$sonuc["empty"]}}</div>
                        </div>
                          @if ($successRate>$info->successRate) <a href='/return0'>Katılım Belgesini Adrese Yolla</a> @endif
                    </div>
              </div>
          </div>
      </div>
  </div>
@endsection
