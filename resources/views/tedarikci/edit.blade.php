<div class="modal-header  bg-qpm-dark text-white">
  <span class="modal-title ml-1 pl-1"> Müşteri - Tedarikçi Tanımlamaları</span>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="modal-body">
  <form class="w-100 row" method="POST"  action="/tedarikci/update" id="actionEditX">

    {{csrf_field()}}
          <input id="" type="hidden" class="form-control" name="id" value="{{$data->id}}">
          <div class="col-12 col-lg-4">
                    <div class="form-group my-0">
                      <label class="smallx ml-3">Firma Kodu</label>
                      <div class="col-md-12">
                          <input id="" type="text" class="form-control" name="firmakodu" value="{{$data->firmakodu}}">
                      </div>
                  </div>
                    <div class="form-group my-0">
                      <label class="smallx ml-3">Firma Türü</label>
                      <div class="col-md-12">
                          <select name="firmaturu" class="form-control">
                            <option value="Müşteri" @if ($data->firmaturu=="Müşteri") selected @endif>Müşteri</option>
                            <option value="Tedarikçi" @if ($data->firmaturu=="Tedarikçi") selected @endif>Tedarikçi</option>
                            <option value="Müşteri ve Tedarikçi" @if ($data->firmaturu=="Müşteri ve Tedarikçi") selected @endif>Müşteri ve Tedarikçi</option>
                          </select>
                      </div>
                  </div>
                    <div class="form-group my-0">
                      <label class="smallx ml-3">Firma Adı</label>
                      <div class="col-md-12">
                          <input id="" type="text" class="form-control" name="firmaadi"  value="{{$data->firmaadi}}">
                      </div>
                  </div>
                    <div class="form-group my-0">
                      <label class="smallx ml-3">Firma Ticari Unvanı</label>
                      <div class="col-md-12">
                          <input id="" type="text" class="form-control" name="firmaticariunvani"  value="{{$data->firmaticariunvani}}">
                      </div>
                  </div>
                    <div class="form-group my-0">
                      <label class="smallx ml-3">Adres</label>
                      <div class="col-md-12">
                          <input id="" type="text" class="form-control" name="adres"  value="{{$data->adres}}">
                      </div>
                  </div>
                    <div class="form-group my-0">
                      <label class="smallx ml-3">İl</label>
                      <div class="col-md-12">
                          <select name="sehir" class="form-control" id="sehirs" onchange="selectSSub()">
                            <option value="-1">
                              Seçiniz
                            </option>
                              @if(!empty($sehir))
                                @foreach ($sehir as $key => $value)
                                  <option value="{{$value->sehir_key}}" @if ($value->sehir_key==$data->sehir) selected @endif >
                                      {{$value->sehir_title}}
                                  </option>
                                @endforeach
                              @endif
                          </select>
                      </div>
                  </div>
                    <div class="form-group my-0">
                      <label class="smallx ml-3">İlçe</label>
                      <div class="col-md-12">
                          <select name="ilce" class="form-control" id="ilces" data-selected="{{$data->ilce}}">
                              <option value="-1">Lütfen Şehri Seçiniz</option>
                          </select>
                      </div>
                  </div>
            </div>
              <div class="col-12 col-lg-4">

                    <div class="form-group my-0">
                      <label class="smallx ml-3">Telefon Numarası</label>
                      <div class="col-md-12">
                          <input id="" type="text" class="form-control" name="telefon"  value="{{$data->telefon}}">
                      </div>
                  </div>
                    <div class="form-group my-0">
                      <label class="smallx ml-3">Fax Numarası</label>
                      <div class="col-md-12">
                          <input id="" type="text" class="form-control" name="fax"  value="{{$data->fax}}">
                      </div>
                  </div>
                    <div class="form-group my-0">
                      <label class="smallx ml-3">Mail Adresi</label>
                      <div class="col-md-12">
                          <input id="" type="text" class="form-control" name="email"  value="{{$data->email}}">
                      </div>
                  </div>
                    <div class="form-group my-0">
                      <label class="smallx ml-3">Web Adresi</label>
                      <div class="col-md-12">
                          <input id="" type="text" class="form-control" name="webadresi"  value="{{$data->webadresi}}">
                      </div>
                  </div>
                    <div class="form-group my-0">
                      <label class="smallx ml-3">Sektör </label>
                      <div class="col-md-12">
                          <select name="sektor" class="form-control">
                            @if (!empty($sektor))
                              @foreach ($sektor as $key => $value)
                                  <option value="{{$value->id}}" @if ($value->id==$data->sektor) selected @endif>{{$value->title}}</option>
                              @endforeach
                            @endif
                          </select>
                      </div>
                  </div>
                    <div class="form-group my-0">
                      <label class="smallx ml-3">Vergi Dairesi</label>
                      <div class="col-md-12">
                          <input id="" type="text" class="form-control" name="vergidairesi"  value="{{$data->vergidairesi}}">
                      </div>
                  </div>
                    <div class="form-group my-0">
                      <label class="smallx ml-3">Vergi No</label>
                      <div class="col-md-12">
                          <input id="" type="text" class="form-control" name="vergino"  value="{{$data->vergino}}">
                      </div>
                  </div>

                  </div>
            <div class="col-lg-12">
              <div class="form-group m-3">
                  <button class="btn btn-danger" type="submit" onclick="submitedit()">Kaydet</button>
              </div>
            </div>

  </form>
</div>
