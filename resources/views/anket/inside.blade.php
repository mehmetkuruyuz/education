<div class="row mb-5">
    <div class="col-6">
      <ul class="nav nav-tabs">
          <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#users">Kullanıcılar</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#masrafyeri">Masraf Yeri</a>
          </li>
      </ul>
        <!-- Tab panes -->
        <div class="tab-content py-5 px-1"  style="height:500px;overflow-y:auto;">
            <div class="tab-pane container active" id="users">
                @if (!empty($userlist))
                    @foreach ($userlist as $key => $value)
                      <div class="row p-2 my-2" id="user_{{$value->id}}">
                        <div class="col-6" >
                          {{$value->name}}
                        </div>
                        <div class="col-1">
                            <a href='javascript:void(0)' onclick="userAdd({{$value->id}})" data-masrafyeri="{{$value->masrafYeri}}" data-name="{{$value->name}}" data-id="{{$value->id}}">
                              <i class="fas fa-plus text-danger"></i>
                            </a>
                        </div>
                      </div>
                    @endforeach
                @endif
            </div>
            <div class="tab-pane container fade" id="masrafyeri">
              @if (!empty($masrafyerilist))
                  @foreach ($masrafyerilist as $key => $value)
                      <div class="row p-2 my-2" id="masrafyeri_{{$value->id}}">
                        <div class="col-6">
                          {{$value->title}}
                        </div>
                        <div class="col-1">
                            <a href='javascript:void(0)' onclick="masrafYeriAdd({{$value->id}})" > <i class="fas fa-plus text-danger"></i> </a>
                        </div>
                      </div>
                  @endforeach
              @endif
            </div>
        </div>
    </div>
    <div class="col-6"   style="height:500px;overflow-y:auto;">
      <form class="w-100" method="POST" action="/poll/assing/user" enctype="multipart/form-data" id='dataFrm'>
        <input type="hidden" name="id" value="{{$polldata->id}}" />
        <input type="hidden" name="type" value="{{$type}}" />
        {{csrf_field()}}
        <span class="">Ankete Atanan Kullanıcılar</span>
          <div class="row pt-4" id="egitimalanlar">
              @if(!empty($useratananlist))
                @foreach ($useratananlist as $key => $value)
                    <div class='col-8 my-1 ml-5 p-2'>{{$value->user->name}} {{Helper::findMasrafYeriAdi($value->user->masrafYeri)}}
                      <input type='hidden' name='user[]'  value='{{$value->user->id}}' />   <a href='javascript:void(0)' class='float-right' onclick='deleteSil(this)' > <i class='fas fa-minus text-danger'></i></a></div>
                @endforeach
              @endif
          </div>
          <button class="btn btn-danger float-right">Kaydet</button>
      </form>
    </div>
</div>
{{--}}


    {{csrf_field()}}

    <div class="row">
    <div class="col-12 col-lg-4">
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
            <select name="username" class="form-control select2">
                @if (!empty($userlist))
                  @foreach ($userlist as $key => $value)
                      <option value="{{$value->id}}">{{$value->name}}</option>
                  @endforeach
                @endif
            </select>
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
  <div class="col-12 col-lg-8">
    <div class="form-group">
      <div class="col-md-12">
        <label class="smallx">Atanan Kullanıcılar</label>
        <div class="row my-3">
          <div class="col-2">E-Posta</div>
          <div class="col-2">Kullanıcı Adı</div>
          <div class="col-2">Firma Adı</div>
          <div class="col-2">Görevi</div>
          <div class="col-1">Bölümü</div>
          <div class="col-2">Açıklama</div>

        </div>
        @if (!empty($useratananlist))
            @foreach ($useratananlist as $key => $value)
              <div class="row my-3">
                  <div class="col-2">{{$value->email}}</div>
                  <div class="col-2">{{$value->username}}</div>
                  <div class="col-2">{{$value->FirmaAdi}}</div>
                  <div class="col-2">{{$value->Gorevi}}</div>
                  <div class="col-1">{{$value->Bolumu}}</div>
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
--}}
