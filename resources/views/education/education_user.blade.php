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
      <form action='/education/user/save' method="post" name="a">
        <input type="hidden" name="egitimid" value="{{$egitimid}}"  />
        {{csrf_field()}}
        <span class="">Eğitime Atanan Kullanıcılar</span>
          <div class="row pt-4" id="egitimalanlar">
              @if(!empty($userInEducationList))
                @foreach ($userInEducationList as $key => $value)
                    <div class='col-8 my-1 ml-5 p-2'>{{$value->user->name}} {{Helper::findMasrafYeriAdi($value->user->masrafYeri)}}
                      <input type='hidden' name='user[]'  value='{{$value->user->id}}' />   <a href='javascript:void(0)' class='float-right' onclick='deleteSil(this)' > <i class='fas fa-minus text-danger'></i></a></div>
                @endforeach
              @endif
          </div>
          <button class="btn btn-danger float-right">Kaydet</button>
      </form>
    </div>
</div>
