<form class="w-100" method="POST" action="/poll/assing/user" enctype="multipart/form-data" id='dataFrm'>

    {{csrf_field()}}
    <input type="hidden" name="id" value="{{$polldata->id}}" />
    <input type="hidden" name="type" value="{{$type}}" />
<div class="row">
  <div class="col-12 col-lg-6">
    <div class="form-group">
      <div class="col-md-6 col-md-offset-4">
          {{$polldata->title}}
      </div>
    </div>
    <div class="form-group">
      <div class="col-md-6 col-md-offset-4">
        <label class="smallx">Kullanıcı Atama</label>
      </div>
    </div>
    <div class="form-group">
      <label class="smallx ml-3">Kullanıcı Adı</label>
        <div class="col-md-12">
            <input type="text" name="name" value="" class="form-control" />
        </div>
    </div>
    <div class="form-group">
      <label class="smallx ml-3">Kullanıcı Email</label>
        <div class="col-md-12">
            <input type="text" name="email" value="" class="form-control" />
        </div>
    </div>
    <div class="form-group">
      <label class="smallx ml-3">Kullanıcı Firma Adı</label>
        <div class="col-md-12">
            <input type="text" name="FirmaAdi" value="" class="form-control" />
        </div>
    </div>
    <div class="form-group">
      <label class="smallx ml-3">Kullanıcı Gorevi</label>
        <div class="col-md-12">
            <input type="text" name="Gorevi" value="" class="form-control" />
        </div>
    </div>
    <div class="form-group">
      <label class="smallx ml-3">Kullanıcı Bolumu</label>
        <div class="col-md-12">
            <input type="text" name="Bolumu" value="" class="form-control" />
        </div>
    </div>
    <div class="form-group">
      <label class="smallx ml-3">Açıklama</label>
        <div class="col-md-12">
            <input type="text" name="aciklama" value="" class="form-control" />
        </div>
    </div>
    <div class="form-group">
      <div class="col-md-6 col-md-offset-4">
          <button type="submit" class="btn btn-danger">
              Kaydet
          </button>
      </div>
    </div>
  </div>
  <div class="col-12 col-lg-6">
    <div class="form-group">
      <div class="col-md-12">
        <label class="smallx">Atanan Kullanıcılar</label>
        <div class="row my-3">
            <div class="col-2">E-posta</div>
            <div class="col-2">Kullanıcı Adı</div>

              <div class="col-2">Firma Adı</div>
              <div class="col-2">Görevi</div>
              <div class="col-1">Bölümü</div>


            <div class="col-2">Açıklama</div>
        
        </div>
        @if (!empty($userlist))
            @foreach ($userlist as $key => $value)
              <div class="row my-3">
                  <div class="col-2">{{$value->email}}</div>
                  <div class="col-2">{{$value->username}}</div>
                  @if ($value->userid==0)
                    <div class="col-2">{{$value->FirmaAdi}}</div>
                    <div class="col-2">{{$value->Gorevi}}</div>
                    <div class="col-1">{{$value->Bolumu}}</div>
                  @endif

                  <div class="col-2">{{$value->aciklama}}</div>
                  <div class="col-1"><a href='/poll/delete/user/{{$polldata->id}}/{{$value->id}}' class="text-danger" onclick="return confirm('Silmek İstediğinize Emin misiniz?')">
                    <i class="fa fa-times"></i>
                  </a></div>
              </div>

            @endforeach
        @endif
      </div>
    </div>
  </div>
</div>

</form>
