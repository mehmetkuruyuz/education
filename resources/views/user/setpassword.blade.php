@extends('admin.layouts.app')
@section('content')
  <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Kullanıcı Şifresi Ayarlama</h4>
                  <p class="card-description">
                    Kullanıcı Şifreleri geri döndürülemez bir şekilde oluşturulur. Şifreyi yedeklemeyi unutmayınız.
                  </p>
                  <form action="/admin/setpassword/set" method="post">
                                       {{csrf_field()}}
                    <div class="form-group">
                        {{$user->name}} adlı kullanıcıya gönderilecek şifreyi yazınız. Otomatik Şifre oluşturulmuştur.
                    </div>
                    <input type="hidden" value="{{$user->id}}" name="id" />
                    <input type="hidden" value="{{$user->email}}" name="email" />
                    <input type="hidden" value="{{$user->name}}" name="name" />
                    <div class="form-group">
                      <label for="">Şifreyi Giriniz</label>
                      <input type="text" class="form-control" name="newpassword" value="{{$newpassword}}" />
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-danger">Şifre Oluştur ve Mail Yolla</button>
                    </div>
                  </form>
                </div>
              </div>
  </div>

@endsection
