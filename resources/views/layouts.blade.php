<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="/assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    {{env("APP_NAME")}}
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="/assets/css/theme.css" crossorigin="anonymous">
  <link href="/fontawesome/css/all.css" rel="stylesheet">

  <link href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.css" rel="stylesheet">

  <!--load all styles -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
  <style>
  body, html {
    height: 100%;
  }
  </style>
  @yield("topscripts")
</head>

<body>
  @php
    \Helper::loginWithUserCode();
  @endphp

@if(\Auth::check())
    @if (\Auth::user()->id==1 || \Auth::user()->id==5)
      <div class="container-fluid">
        <div class="row" style="">
          <div class="col-6 col-lg-2">
            <a href="/" style="color:#FFFFFF;"><img src='/img/logo.png' class="img-fluid" /></a>
          </div>
          <div class="col-6 col-lg-10 text-right pt-3" id="notification-div">
            <div class="dropdown w-25">
              <a id="a" role="button" data-toggle="dropdown" data-target="#" href="/a.html" style="color:#0d0035;margin-top:10px">
                <strong>{{\Auth::user()->name}}</strong>
              </a>
              <ul class="dropdown-menu dropdown-menu-right" style='width:150px !important' role="menu" aria-labelledby="a">
                <li class="pr-3 pt-3">

                  <a class="content" href="#">
                    <div class=" text-right  text-danger">
                      <p class="item-info">Şifre Değiştir</p>
                    </div>
                  </a>
                  <a class="content" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <div class="text-right text-danger">
                      <form id="logout-form" action="/logout" method="POST" style="display: none;"> {{ csrf_field() }} </form>
                      <p class="item-info">Çıkış</p>
                    </div>
                  </a>

                </li>
              </ul>
            </div>
            <div class="dropdown">
              <a id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="/page.html" style="color:#0d0035;">
                <i class="fa fa-bell"></i>
              </a>
              <ul class="dropdown-menu dropdown-menu-right notifications" role="menu" aria-labelledby="dLabel">

                <li class="divider"></li>
                <div class="notification-heading">
                  <h4 class="menu-title">Notifications</h4>
                  <h4 class="menu-title pull-right">View all<i class="glyphicon glyphicon-circle-arrow-right"></i></h4>
                </div>
                <li class="divider"></li>
                <div class="notifications-wrapper">
                  <a class="content" href="#">

                    <div class="notification-item">
                      <h4 class="item-title">Evaluation Deadline 1 · day ago</h4>
                      <p class="item-info">Marketing 101, Video Assignment</p>
                    </div>

                  </a>

                </div>
                <li class="divider"></li>
                <div class="notification-footer">
                  <h4 class="menu-title">View all<i class="glyphicon glyphicon-circle-arrow-right"></i></h4>
                </div>
              </ul>
            </div>
          </div>
        </div>
      </div>


      <div class="navbar navbar-expand-md navbar-white bg-qpm-dark" role="navigation">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link text-white" href="/">Anasayfa <span class="sr-only">(current)</span></a>
            </li>

            <li class="nav-item dropdown order-2">
              <a class="nav-link  text-white dropdown-toggle" id="admin" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Entegre Tanımlamalar</a>
              <ul class="dropdown-menu" aria-labelledby="dropdown1">
                <li class="dropdown-item dropdown-submenu">
                  <a class="dropdown-item dropdown-toggle nav-link font-size-16 text-qpm-dark" href="#">Kullanıcı Tanımlamaları</a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item nav-link font-size-16 text-qpm-dark" href="/admin/user/list">Kullanıcı Tanımlama</a></li>
                    <li><a class="dropdown-item nav-link font-size-16 text-qpm-dark" href="/admin/user/masrafyeriatama">Kullanıcı Masraf Yeri Atama</a></li>
                    <li><a class="dropdown-item nav-link font-size-16 text-qpm-dark" href="/admin/parametreler/satinalma/titles">Kullanıcı Görev Tanımlama</a></li>
                    <li><a class="dropdown-item nav-link font-size-16 text-qpm-dark" href="/admin/parametreler/satinalma/group">Kullanıcı Grup Tanımlama</a></li>
                  </ul>
                </li>

                <li class="dropdown-item dropdown-submenu">
                  <a class="dropdown-item dropdown-toggle nav-link font-size-16 text-qpm-dark" href="#">Stok Tanımlamaları</a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item nav-link font-size-16 text-qpm-dark" href="/products/list">Stok Tanımlama</a></li>
                    <li><a class="dropdown-item nav-link font-size-16 text-qpm-dark" href="/stok/list/birim">Stok Birim Tanımlama</a></li>
                    <li><a class="dropdown-item nav-link font-size-16 text-qpm-dark" href="/stok/list/tip">Stok Tipi Tanımlama</a></li>
                    <li><a class="dropdown-item nav-link font-size-16 text-qpm-dark" href="/stok/list/sinif">Stok Sınıfı Tanımlama</a></li>
                    <li><a class="dropdown-item nav-link font-size-16 text-qpm-dark" href="/stok/list/turu">Stok Türü Tanımlama</a></li>
                  </ul>
                </li>
                <li class="dropdown-item dropdown-submenu">
                  <a class="dropdown-item dropdown-toggle nav-link font-size-16 text-qpm-dark" href="#">Müşteri - Tedarikçi Tanımlamaları</a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item nav-link font-size-16 text-qpm-dark" href="/tedarikci/list">Müşteri - Tedarikçi Tanımlama</a></li>
                    <li><a class="dropdown-item nav-link font-size-16 text-qpm-dark" href="/sektor/list">Sektör Tanımlama</a></li>
                    <li><a class="dropdown-item nav-link font-size-16 text-qpm-dark" href="/unvan/list">Yetkili Ünvan Tanımlama</a></li>
                  </ul>
                </li>
                <li class="dropdown-item dropdown-submenu">
                  <a class="dropdown-item dropdown-toggle nav-link font-size-16 text-qpm-dark" href="#">Sınav Tanımlamaları</a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item nav-link font-size-16 text-qpm-dark" href="/admin/sinav/list">Sınav Listesi</a></li>
                  </ul>
                </li>
                <li class="dropdown-item dropdown-submenu">
                  <a class="dropdown-item dropdown-toggle nav-link font-size-16 text-qpm-dark" href="#">İş Akış Tanımlamaları</a>
                  <ul class="dropdown-menu">
                    <li class="dropdown-item"><a href="/satinalma/surec/akis" class="nav-link font-size-16 text-qpm-dark">Satın Alma Talep</a></li>
                  </ul>
                </li>

                <li class="dropdown-item"><a href="/tanimlama/masrafyeri" class="nav-link font-size-16 text-qpm-dark">Masraf Yeri Tanımlama</a></li>



              </ul>
            </li>
            <li class="nav-item dropdown order-6">
              <a class="nav-link  text-white dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Elektronik İş Akış Yönetim Sistemi</a>
              <ul class="dropdown-menu" aria-labelledby="dropdown1">
                <li class="dropdown-item dropdown-submenu">
                  <a class="dropdown-item dropdown-toggle nav-link font-size-16 text-qpm-dark" href="#">Satınalma Talepleri</a>
                  <ul class="dropdown-menu">
                    <li class="dropdown-item"><a href="/satinalma" class="nav-link  font-size-16 text-qpm-dark">Satın Alma Taleplerim</a></li>
                    <li class="dropdown-item"><a href="/satinalma-onay" class="nav-link  font-size-16 text-qpm-dark">Onayda Bekleyenler</a></li>
                  <!--  <li class="dropdown-item"><a href="/satinalma-islem" class="nav-link  font-size-16 text-qpm-dark">Onaylanan / Reddedilen</a></li> -->
                  </ul>
                </li>

                <li class="dropdown-item dropdown-submenu">
                  <a class="dropdown-item dropdown-toggle nav-link font-size-16 text-qpm-dark" href="#">Sipariş İşlemleri</a>
                  <ul class="dropdown-menu">
                    <li class="dropdown-item"><a href="/teklif/index" class="nav-link  font-size-16 text-qpm-dark">Sipariş Edilecek Talepler </a></li>
                    <li class="dropdown-item"><a href="/teklif/siparis" class="nav-link  font-size-16 text-qpm-dark">Sipariş Edilen Talepler </a></li>
                    <li class="dropdown-item"><a href="/teklif/tamamlanmis" class="nav-link  font-size-16 text-qpm-dark">Tedarik Edilen Talepler </a></li>
                  </ul>
                </li>

              </ul>
            </li>
            <li class="nav-item dropdown order-7">
              <a class="nav-link  text-white dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Online Eğitim</a>
              <ul class="dropdown-menu" aria-labelledby="dropdown1">
                <li class="dropdown-item"><a href="/education/category" class="nav-link font-size-16 text-qpm-dark">Eğitim Grubu Tanımlama</a></li>
                <li class="dropdown-item dropdown-submenu">
                  <a class="dropdown-item dropdown-toggle nav-link font-size-16 text-qpm-dark" href="#">Eğitimlerim</a>
                  <ul class="dropdown-menu">
                    <li class="dropdown-item"><a href="/user/education" class="nav-link  font-size-16 text-qpm-dark">Güncel Eğitimlerim</a></li>
                    <li class="dropdown-item"><a href="/user/education/timer" class="nav-link  font-size-16 text-qpm-dark">Geciken Eğitimlerim</a></li>
                    <li class="dropdown-item"><a href="/user/education/done" class="nav-link  font-size-16 text-qpm-dark">Tamamlanan Eğitimlerim</a></li>
                  </ul>
                </li>
                <li class="dropdown-item dropdown-submenu">
                  <a class="dropdown-item dropdown-toggle nav-link font-size-16 text-qpm-dark" href="#">Tüm Eğitimler</a>
                  <ul class="dropdown-menu">
                    <li class="dropdown-item"><a href="/education/continue/list" class="nav-link  font-size-16 text-qpm-dark">Güncel Eğitimler</a></li>
                    <li class="dropdown-item"><a href="/education/done/list" class="nav-link  font-size-16 text-qpm-dark">Tamamlanan Eğitimler</a></li>
                  </ul>
                </li>
              </ul>
            </li>
            <li class="nav-item dropdown order-8">

              <a class="nav-link  text-white dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Anket</a>
              <ul class="dropdown-menu" aria-labelledby="dropdown1">
                <li class="dropdown-item"><a href="/poll/inside" class="nav-link font-size-16 text-qpm-dark">İç Anket Oluşturma</a></li>
                      <li class="dropdown-item"><a href="/poll/outside" class="nav-link font-size-16 text-qpm-dark">Dış Anket Oluşturma</a></li>
                <li class="dropdown-item dropdown-submenu">
                  <a class="dropdown-item dropdown-toggle nav-link font-size-16 text-qpm-dark" href="#">Anketlerim</a>
                  <ul class="dropdown-menu">
                    <li class="dropdown-item"><a href="/user/poll" class="nav-link  font-size-16 text-qpm-dark">Güncel Anketler</a></li>
                    <li class="dropdown-item"><a href="/user/poll/timer" class="nav-link  font-size-16 text-qpm-dark">Geciken Anketler</a></li>
                    <li class="dropdown-item"><a href="/user/poll/done" class="nav-link  font-size-16 text-qpm-dark">Tamamlanan Anketler</a></li>
                  </ul>
                </li>

                <li class="dropdown-item dropdown-submenu">
                  <a class="dropdown-item dropdown-toggle nav-link font-size-16 text-qpm-dark" href="#">Tüm Anketler</a>
                  <ul class="dropdown-menu">
                    <li class="dropdown-item"><a href="/poll/continue/list" class="nav-link  font-size-16 text-qpm-dark">Güncel Anketler</a></li>
                    <li class="dropdown-item"><a href="/poll/done/list" class="nav-link  font-size-16 text-qpm-dark">Tamamlanan Anketler</a></li>
                  </ul>
                </li>
                <li class="dropdown-item dropdown-submenu">
                  <a class="dropdown-item dropdown-toggle nav-link font-size-16 text-qpm-dark" href="#">Anket Tanımlamaları</a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item nav-link font-size-16 text-qpm-dark" href="/parametreler/anket/soru">Soru Grubu Tanımlama</a></li>

                  </ul>
                </li>
              </ul>
            </li>
            <li class="nav-item dropdown order-8">

              <a class="nav-link  text-white dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sınav</a>
              <ul class="dropdown-menu" aria-labelledby="dropdown1">
                <li class="dropdown-item"><a href="/sinav/inside" class="nav-link font-size-16 text-qpm-dark">Sınav Oluşturma</a></li>
                <li class="dropdown-item dropdown-submenu">
                  <a class="dropdown-item dropdown-toggle nav-link font-size-16 text-qpm-dark" href="#">Sınavlarım</a>
                  <ul class="dropdown-menu">
                    <li class="dropdown-item"><a href="/user/sinav" class="nav-link  font-size-16 text-qpm-dark">Aktif Sınavlarım</a></li>
                    <li class="dropdown-item"><a href="/user/sinav/late" class="nav-link  font-size-16 text-qpm-dark">Gecikmiş Sınavlarım</a></li>
                    <li class="dropdown-item"><a href="/user/sinav/done" class="nav-link  font-size-16 text-qpm-dark">Tamamlanan Sınavlarım</a></li>
                  </ul>
                </li>

                <li class="dropdown-item dropdown-submenu">
                  <a class="dropdown-item dropdown-toggle nav-link font-size-16 text-qpm-dark" href="#">Sınavlar</a>
                  <ul class="dropdown-menu">
                    <li class="dropdown-item"><a href="/sinav/continue/list" class="nav-link  font-size-16 text-qpm-dark">Güncel Sınavlar</a></li>
                    <li class="dropdown-item"><a href="/sinav/done/list" class="nav-link  font-size-16 text-qpm-dark">Tamamlanan Sınavlar</a></li>
                  </ul>
                </li>
                <li class="dropdown-item dropdown-submenu">
                  <a class="dropdown-item dropdown-toggle nav-link font-size-16 text-qpm-dark" href="#">Sınav Tanımlamaları</a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item nav-link font-size-16 text-qpm-dark" href="/parametreler/sinav/soru">Soru Grubu Tanımlama</a></li>

                  </ul>
                </li>
              </ul>
            </li>
            <li class="nav-item dropdown order-9">
                  <a class="nav-link  text-white dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">E-Arşiv</a>
                  <ul class="dropdown-menu" aria-labelledby="dropdown1">
                    <li class="dropdown-item"><a href="/earsiv/list" class="nav-link font-size-16 text-qpm-dark">Kayıt ve Görüntüleme</a></li>
                    <li class="dropdown-item"><a href="/earsiv/queue" class="nav-link font-size-16 text-qpm-dark">Adresleme</a></li>
                  </ul>
            </li>
          </ul>

        </div>
      </div>
    @endif
@endif
<div class="container-fluid " style="min-height:100%">

    @yield('content')

</div>

@if(\Auth::check())
  @if (\Auth::user()->id==1)

    <div class="footer-copyright-area">
      <div class="container-fluid">
        <div class="row bg-qpm-dark">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="footer-copy-right text-white pt-3">
              <p>Copyright © {{\Carbon\Carbon::parse("Y")->format("Y")}}. BSY Bilgi Sistemleri Yönetim Danışmanlık Hizmetleri San. ve Tic. A.Ş. </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  @endif
@endif
  <div class="shiny-notification">
    Bekleyiniz Yükleniyor ...
  </div>

  <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.js" ></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.js"></script>
  <script src="/assets/js/theme.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>

  <script>
      $(function () {
        $('[data-toggle="tooltip"]').tooltip()
      })
  </script>
  @yield("altscripts")

</body>

</html>
