    {{ csrf_field() }}
    <input type="hidden" value="{{$user->id}}" name="id" />
    <div class="modal-body">
      <div class="col-md-12">
          <div class="card card-default">
              <div class="card-body">
                <div class="row">
                    <div class="col-12 col-lg-4">
                      <div class="form-group">
                          <label class="smallx ml-3">Firma Kodu</label>
                          <div class="col-md-12">
                              <select name="companyCode"  class="selectmulti form-control form-control-sm" id="firmCode" required style="width:100% !important" onchange="loadCompanyData()" readonly>
                                <option value="-1"> Lütfen Firma Kodu Seçiniz </option>
                                @if (!empty($companyList))
                                  @foreach ($companyList as $key => $value)
                                      <option value="{{$value->id}}" @if ($user->companyId==$value->id) selected @endif>{{$value->companyCode}}  - {{$value->title}} </option>
                                  @endforeach
                                @endif
                              </select>
                          </div>
                      </div>
                      <div class="form-group my-0 d-none">
                        <div class="col-md-12 ">
                          <label class="smallx">Firma Tanımı</label>
                          <input type="text" value="" id="firmatanim" value="" class="form-control form-control-sm" readonly />
                        </div>
                      </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-4 my-0 ">
                      <div class="form-group  my-0">
                            <label class=" smallx  ml-3">Kullanıcı Kodu</label>

                          <div class="col-md-12">
                                <input id="slug" type="text" class="form-control form-control-sm" name="slug" value="{{ $user->usercode }}" required>
                          </div>
                      </div>
                      <div class="form-group my-0">
                              <label class=" smallx  ml-3">Kullanıcı Adı - Soyadı</label>
                          <div class="col-md-12  my-0">
                              <input id="" type="text" class="form-control form-control-sm" name="name" value="{{ $user->name }}" required>
                          </div>
                      </div>
                      <div class="form-group  my-0">
                            <label class=" smallx  ml-3">Kullanıcı Görev Tanımı</label>
                          <div class="col-md-12">
                              <select class="form-control" name="gorevtanimi">
                                  @if (!empty($alltitle))
                                      @foreach ($alltitle as $key => $value)
                                        <option value="{{$value->id}}" @if ( $user->gorevtanimi==$value->id) selected @endif>{{$value->title}}</option>
                                      @endforeach
                                  @endif
                              </select>
                            {{--  <input  type="text" class="form-control form-control-sm" name="unvan" value="{{}}" > --}}
                          </div>
                      </div>
                      <div class="form-group my-0">
                            <label class=" smallx  ml-3">E-Posta Adresi</label>

                          <div class="col-md-12 my-0">
                              <input id="email" type="email" class="form-control form-control-sm" name="email" value="{{ $user->email }}" required>
                          </div>
                      </div>
                      <div class="form-group  my-0">
                            <label class=" smallx  ml-3">Kullanıcı Grup Tanımı</label>
                          <div class="col-md-12">
                              <select class="form-control" name="groupid">
                                  @if (!empty($allGroups))
                                      @foreach ($allGroups as $key => $value)
                                        <option value="{{$value->id}}" @if ( $user->groupId==$value->id) selected @endif>{{$value->title}}</option>
                                      @endforeach
                                  @endif
                              </select>
                          </div>
                      </div>

                    <div class="form-group my-0">
                              <label class=" smallx  ml-3">Telefon No</label>
                        <div class="col-md-12">
                            <input  type="text" class="form-control form-control-sm" name="telefon" value="{{ $user->telefon }}" >
                        </div>
                    </div>

                    <div class="form-group my-0">
                        <label class="smallx ml-3">Masraf Yeri</label>
                        <div class="col-md-12" id="parentId" data-selected="{{$user->masrafYeri}}">



                        {{--
                          <select name="masrafyeri"  id="masrafyeri" class="selectmulti form-control" required style="width:100% !important">
                            <option value="-1">Seçiniz</option>
                            @if (!empty($masrafyerlerilistesi))
                              @foreach ($masrafyerlerilistesi as $key => $value)

                                  @if (!empty($value->altmanydata))
                                      <optgroup label="{{$value->code}} {{$value->title}} Alt Masraf Yerleri">
                                        <option value="{{$value->id}}" @if ($value->id==$masterId) selected @endif>{{$value->code}} - {{$value->title}}</option>
                                        @foreach ($value->altmanydata as $keyx => $xalue)
                                          <option value="{{$xalue->id}}"  @if ($xalue->id==$masterId) selected @endif>{{$xalue->code}} - {{$xalue->title}}</option>
                                        @endforeach
                                      </optgroup>
                                  @else
                                      <option value="{{$value->id}}"  @if ($value->id==$masterId) selected @endif data-code="{{$value->code}}">{{$value->code}} - {{$value->title}}</option>
                                  @endif
                              @endforeach
                            @endif
                          </select>
                          --}}
                        </div>
                    </div>
                    </div>
                </div>

                  {{ csrf_field() }}
          </div>
      </div>


    </div>
