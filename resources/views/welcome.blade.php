@extends('layouts')
@section("content")
  <div class="container-fluid my-3">
  <div class="row">

    <div class="col-12 col-lg-12 my-2">
        <strong>Bekleyen İşlemlerim</strong>
    </div>
    {{--
    <div class="col-12 col-lg-3 my-2 d-none">

      <div class="card shadow ">
        <div class="card-body">
          <div class="card-text"><span class="badge float-left mr-2"><i class="fas fa-file-invoice fa-2x"></i></span>
            <a href='/satinalma-onay' class="text-dark">Bekleyen Satın Alma Talepleri <span class="badge badge-danger font-size-16 float-right">{{Helper::countForWelcomeBekleyenTalepler()}}</span></a></div>
        </div>
      </div>
    </div>
    --}}

    <div class="col-12 col-lg-3 my-2">

      <div class="card shadow ">
        <div class="card-body">
          <div class="card-text"><span class="badge float-left mr-2"><i class="fas fa-graduation-cap fa-2x"></i></span>
            <a href='/user/education' class="text-dark">Bekleyen Eğitimlerim <span class="badge badge-danger font-size-16 float-right">{{Helper::EgitimAtanmaControl()}}</span></a></div>
        </div>
      </div>
    </div>

    <div class="col-12 col-lg-3 my-2">

      <div class="card shadow ">
        <div class="card-body">
          <div class="card-text"><span class="badge float-left mr-2"><i class="fas fa-poll-h fa-2x"></i></span>
            <a href='/user/poll' class="text-dark">Bekleyen Anketlerim <span class="badge badge-danger font-size-16 float-right">{{Helper::AnketAtanmaKontrol()}}</span></a></div>
        </div>
      </div>
    </div>

        <div class="col-12 col-lg-3 my-2">

          <div class="card shadow ">
            <div class="card-body">
              <div class="card-text"><span class="badge float-left mr-2"><i class="fas fa-stream fa-2x"></i></span>
                <a href='/exam/atanmis' class="text-dark">Bekleyen Sınavlarım <span class="badge badge-danger font-size-16 float-right">0</span></a></div>
            </div>
          </div>
        </div>
  </div>
</div>

@endsection
