<div class="modal-header  bg-qpm-dark text-white">
  <span class="modal-title ml-1 pl-1"> Yetkili Düzenleme</span>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="modal-body">
  <form class="w-100 row" method="POST"  action="/tedarikci/yetkili/update" id="actionEditX">

    {{csrf_field()}}
          <input id="" type="hidden" class="form-control" name="id" value="{{$data->id}}">
          <div class="modal-body">
            <form class="w-100 row" method="POST"  action="/tedarikci/yetkili/update" id="actionX">
              {{csrf_field()}}
              <div class="col-lg-4">
                  <input type="hidden" name="id" value="{{$data->id}}" />
                  <input type="hidden" name="firmaid" value="{{$data->firmaid}}" />


                      <div class="form-group my-0">
                        <label class="smallx ml-3">Adı Soyadı</label>
                        <div class="col-md-12">
                            <input id="" type="text" class="form-control" name="adisoyadi" value="{{$data->adisoyadi}}">
                        </div>
                      </div>

                      <div class="form-group my-0">
                        <label class="smallx ml-3">Ünvan</label>
                        <div class="col-md-12">
                          @if (!empty($allunvan))
                            <select name="unvan" class="form-control">
                              @foreach ($allunvan as $key => $value)
                                    <option value="{{$value->id}}" @if($data->kullanicikodu==$value->id) selected @endif>{{$value->title}}</option>
                              @endforeach
                            </select>
                          @endif
                        </div>
                      </div>

                      <div class="form-group my-0">
                        <label class="smallx ml-3">Telefon Numarası</label>
                        <div class="col-md-12">
                            <input id="" type="text" class="form-control" name="telefon"  value="{{$data->telefon}}">
                        </div>
                      </div>

                      <div class="form-group my-0">
                        <label class="smallx ml-3">Email Adresi</label>
                        <div class="col-md-12">
                            <input id="" type="text" class="form-control" name="email"  value="{{$data->email}}">
                        </div>
                      </div>
                      <div class="form-group my-0">
                        <label class="smallx ml-3"> Kullanıcı Kodu</label>
                        <div class="col-md-12">
                            <input id="" type="text" class="form-control" name="kullanicikodu" value="{{$data->kullanicikodu}}">
                        </div>
                      </div>


                  </div>
                  <div class="col-12">
                    <div class="form-group m-3">
                        <button class="btn btn-danger" type="submit" onclick="submitedit()">Kaydet</button>
                    </div>
                  </div>

              </form>
          </div>
  </form>
</div>
