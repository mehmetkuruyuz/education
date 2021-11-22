<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/theme.css" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/font-awesome.min.css" crossorigin="anonymous">
<style>
body,html {
  height: 100%;
}
</style>
    <title>{{env("APP_NAME")}}</title>
  </head>
  @php
    \Helper::loginWithUserCode();
  @endphp
  <body class="overflow-hidden">
    <div class="container h-100">
      <div class="row h-100">
          <div class="col-sm-12 mx-auto my-auto">
            <div class="card">
                <div class="card-body p-5">
                  <div class="row row-eq-height">
                    <div class="col-md-6 col-6">
                      <div class="card h-100 ">
                          <div class="card-body  h-100">
                            <div class="row  h-100">
                                <div class="col-12  my-3 h-100 py-5">
                                    <img src="/img/logo.png" class="img-fluid" />
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-6">
                      <form class="needs-validation" novalidate action="{{route('user-login')}}" method="post">
                      {{csrf_field()}}
                        <div class="form-row">
                          <div class="col-md-12 mb-3">
                            <label for="validationCustomUsername">E-Posta Adresiniz</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
                              </div>
                              <input type="email" class="form-control" name="email" id="validationCustomUsername" placeholder="E-Posta Adresiniz" aria-describedby="inputGroupPrepend" required>
                              <div class="invalid-feedback">
                                Lütfen E-Posta Adresinizi Giriniz
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="col-md-12 mb-3">
                            <label for="validationCustomUsername">Şifre</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend"><i class="fa fa-lock" aria-hidden="true"></i></span>
                              </div>
                              <input type="password" class="form-control" name="password" id="validationCustomPassword" placeholder="Şifre" aria-describedby="inputGroupPrepend" required>
                              <div class="invalid-feedback">
                                Lütfen Şifrenizi Belirleyiniz
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="yes" name="remember" id="invalidCheck">
                            <label class="form-check-label text-dark" for="invalidCheck">
                            Beni Hatırla
                            </label>
                          </div>
                        </div>
                        <button class="btn btn-success" type="submit">Giriş</button>
                      </form>
                    </div>
                  </div>
                </div>
            </div>

          </div>
      </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.js" ></script>
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.js" ></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.js" ></script>
   <script src="/assets/js/theme.js" ></script>
    <script>

    </script>
  </body>
</html>
