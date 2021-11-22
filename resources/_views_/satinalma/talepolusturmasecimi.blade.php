@extends('layouts')
@section("topscripts")


@endsection
@section("content")
          <div class="card  card-tasks mt-4">
            <div class="card-body">
              <div class="row text-center  justify-content-between">
                <div class="col-12 p-5 my-3">
                  <strong>Talep Son Onaydan Geçmiştir.</strong>
                </div>
                <div class="col-5 text-center border shadow mx-3 p-5">
                    Satınalma Talep Ekranlarına Geri Dönmek için <a href='/satinalma-onay' class="text-danger">Tıklayınız</a>
                </div>
                <div class="col-5 text-center border shadow mx-3 p-5">
                    Teklif Durum Ekranlarına Geçiş Yapmak İçin <a href='/teklif/index' class="text-danger">Tıklayınız</a>
                </div>
              </div>
            </div>
          </div>
@endsection
