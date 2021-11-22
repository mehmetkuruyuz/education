<div class="modal-header  bg-qpm-dark text-white">
  <span class="modal-title ml-1 pl-1"> Stok Tanımlama</span>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
  <form class="w-100 p-5" method="POST"  action="/products/update" id="actionEditX">
    {{csrf_field()}}
    <input type="hidden" name="id" value="{{$data->id}}" />
    <nav>
      <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Genel Bilgiler</a>
        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Depo Durum</a>
        <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Cari ve Ticari Bilgiler</a>
      </div>
    </nav>
    <div class="tab-content p-3" id="nav-tabContent">
      <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
      <div class="col-12 col-lg-4">
                  <div class="form-group my-0">
                      <label class="smallx ml-3">Stok Kodu</label>
                      <div class="col-md-12">
                            <input id="" type="text" class="form-control" name="malzemeKodu" value="{{$data->malzemeKodu}}">
                      </div>
                  </div>
                  <div class="form-group my-0">
                      <label class="smallx ml-3">Stok Açıklaması</label>
                      <div class="col-md-12">
                          <input id="" type="text" class="form-control" name="malzemeAciklamasi" value="{{$data->malzemeAciklamasi}}">
                      </div>
                  </div>
                  <div class="form-group my-0">
                      <label class="smallx ml-3">Stok Tipi</label>
                      <div class="col-md-12">
                        <select class="form-control" name="malzemeTipi">
                          @if(!empty($MalzemeTipiList))
                            @foreach ($MalzemeTipiList as $key => $value)
                                <option value="{{$value->id}}" @if ($data->malzemeTipi==$value->id) selected @endif>{{$value->title}}</option>
                            @endforeach
                          @endif
                        </select>
                      </div>
                  </div>
                  <div class="form-group my-0">
                      <label class="smallx ml-3">Stok Sınıfı</label>
                      <div class="col-md-12">
                        <select class="form-control" name="malzemeSinifi">
                          @if(!empty($MalzemeSinifiList))
                            @foreach ($MalzemeSinifiList as $key => $value)
                                <option value="{{$value->id}}" @if ($data->malzemeSinifi==$value->id) selected @endif>{{$value->title}}</option>
                            @endforeach
                          @endif
                        </select>
                      </div>
                  </div>
                  <div class="form-group my-0">
                      <label class="smallx ml-3">Stok Birimi</label>
                      <div class="col-md-12">
                        <select class="form-control" name="malzemeBirimi">
                          @if(!empty($MalzemeBirimiList))
                            @foreach ($MalzemeBirimiList as $key => $value)
                                <option value="{{$value->id}}" @if ($data->malzemeBirimi==$value->id) selected @endif>{{$value->title}}</option>
                            @endforeach
                          @endif
                        </select>
                      </div>
                  </div>
                  <hr  />
                  <label class="font-bold ml-3">Stok Boyutları</label>
                  <div class="row">
                    <div class="col-4">
                      <div class="form-group my-0">
                          <label class="smallx ml-3">Uzunluk</label>
                          <div class="col-md-12">
                              <input id="" type="text" class="form-control" name="x" value="{{$data->x}}">
                          </div>
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-group my-0">
                          <label class="smallx ml-3">Genişlik</label>
                          <div class="col-md-12">
                              <input id="" type="text" class="form-control" name="y" value="{{$data->y}}">
                          </div>
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-group my-0">
                          <label class="smallx ml-3">Derinlik</label>
                          <div class="col-md-12">
                              <input id="" type="text" class="form-control" name="z" value="{{$data->z}}">
                          </div>
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-group my-0">
                          <label class="smallx ml-3">Hacim</label>
                          <div class="col-md-12">
                              <input id="" type="text" class="form-control" name="hacim" value="{{$data->hacim}}">
                          </div>
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-group my-0">
                          <label class="smallx ml-3">Brüt Ağırlık</label>
                          <div class="col-md-12">
                              <input id="" type="text" class="form-control" name="agirlik" value="{{$data->agirlik}}">
                          </div>
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-group my-0">
                          <label class="smallx ml-3">Net Ağırlık</label>
                          <div class="col-md-12">
                              <input id="" type="text" class="form-control" name="netagirlik"  value="{{$data->netagirlik}}">
                          </div>
                      </div>
                    </div>
                  </div>
                  <label class="font-bold ml-3">Özel Kodlar</label>
                  <div class="row">
                    <div class="col-12">
                      <div class="form-group my-0">
                          <label class="smallx ml-3">Özel Kod 1</label>
                          <div class="col-md-12">
                              <input id="" type="text" class="form-control" name="ozelurun1" value="{{$data->ozelurun1}}">
                          </div>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="form-group my-0">
                          <label class="smallx ml-3">Özel Kod 2</label>
                          <div class="col-md-12">
                              <input id="" type="text" class="form-control" name="ozelurun2" value="{{$data->ozelurun2}}">
                          </div>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="form-group my-0">
                          <label class="smallx ml-3">Özel Kod 3</label>
                          <div class="col-md-12">
                              <input id="" type="text" class="form-control" name="ozelurun3" value="{{$data->ozelurun3}}">
                          </div>
                      </div>
                    </div>
                  </div>
            </div>
      </div>
      <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
        <div class="col-12 col-lg-4">
          <div class="form-group my-0">
              <label class="smallx ml-3">Depolama Tipi</label>
              <div class="col-md-12">
                <select class="form-control" name="depolamaTipi">
                  @if(!empty($DepoTipiList))
                    @foreach ($DepoTipiList as $key => $value)
                        <option value="{{$value->id}}" @if($data->depolamaTipi==$value->id) selected @endif>{{$value->title}}</option>
                    @endforeach
                  @endif
                </select>
              </div>
          </div>
        <div class="form-group my-0">
            <label class="smallx ml-3">Depo Numarası</label>
            <div class="col-md-12">
                <input id="" type="text" class="form-control" name="depoNumarasi" value="{{$data->depoNumarasi}}">
            </div>
        </div>
        <div class="form-group my-0">
            <label class="smallx ml-3">Emniyet Stoğu</label>
            <div class="col-md-12">
                <input id="" type="text" class="form-control" name="malzemeEmliyetStogu" value="{{$data->malzemeEmliyetStogu}}">
            </div>
        </div>
        <div class="form-group my-0">
            <label class="smallx ml-3">Min. Değeri</label>
            <div class="col-md-12">
                  <input id="" type="text" class="form-control" name="minDeger" value="{{$data->minDeger}}">
            </div>
        </div>
        <div class="form-group my-0">
            <label class="smallx ml-3">Max. Değeri</label>
            <div class="col-md-12">
                <input id="" type="text" class="form-control" name="maxDeger" value="{{$data->maxDeger}}">
            </div>
        </div>
        <div class="form-group my-0">
            <label class="smallx ml-3">Yeniden Sipariş Seviyesi</label>
            <div class="col-md-12">
                <input id="" type="text" class="form-control" name="yenidenSiparis" value="{{$data->yenidenSiparis}}">
            </div>
        </div>
        <div class="form-group d-none">
            <label class="smallx ml-3">Ambar Kodu</label>
            <div class="col-md-12">
                <input id="" type="text" class="form-control" name="ambarKodu" value="{{$data->ambarKodu}}">
            </div>
        </div>
        <div class="form-group my-0">
            <label class="smallx ml-3">Birim Fiyat</label>
            <div class="col-md-12">
                <input id="" type="text" class="form-control" name="birimFiyat" value="{{$data->birimFiyat}}">
            </div>
        </div>
        <div class="form-group my-0">
            <label class="smallx ml-3">Kullanım Süresi</label>
            <div class="col-md-12">
                <input id="" type="text" class="form-control" name="kullanimSuresi" value="{{$data->kullanimSuresi}}">
            </div>
        </div>
        </div>

      </div>
      <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
        <div class="col-12 col-lg-4">
          <div class="form-group my-0">
              <label class="smallx ml-3">Tedarikçi Kodu</label>
              <div class="col-md-12">
                  <input id="" type="text" class="form-control" name="tedarikciKodu" value="{{$data->tedarikciKodu}}">
              </div>
          </div>

          <div class="form-group my-0">
              <label class="smallx ml-3">Müşteri kodu</label>
              <div class="col-md-12">
                  <input id="" type="text" class="form-control" name="musteriKodu" value="{{$data->musteriKodu}}">
              </div>
          </div>
          <div class="form-group my-0">
              <label class="smallx ml-3">Muhasebe Hesap Kodu</label>
              <div class="col-md-12">
                  <input id="" type="text" class="form-control" name="muhasebeKodu" value="{{$data->muhasebeKodu}}">
              </div>
          </div>
          <div class="form-group my-0">
              <label class="smallx ml-3">KDV Oranı</label>
              <div class="col-md-12">
                  <input id="" type="text" class="form-control" name="kdvOrani" value="{{$data->kdvOrani}}">
              </div>
          </div>
          <div class="form-group my-0">
              <label class="smallx ml-3">Marka</label>
              <div class="col-md-12">
                  <input id="" type="text" class="form-control" name="marka" value="{{$data->marka}}">
              </div>
          </div>
          <div class="form-group my-0">
              <label class="smallx ml-3">GTIP No</label>
              <div class="col-md-12">
                  <input id="" type="text" class="form-control" name="gtip" value="{{$data->gtip}}">
              </div>
          </div>
        </div>
      </div>
    </div>
  </form>
  <div class="modal-footer text-left  justify-content-start">
    <button type="submit" class="btn btn-danger" onclick="editsave()">Kaydet</button>
  </div>
