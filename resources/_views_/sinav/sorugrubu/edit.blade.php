
          {{csrf_field()}}
          <input type='hidden' name="id" value="{{$data->id}}" />
          @include('company.select')
          <div class="col-12 col-lg-4">
                      <div class="form-group d-none">
                          <label class="smallx ml-3 "> Tanımlama Grubu Kodu</label>
                          <div class="col-md-12">
                                <input id="" type="text" class="form-control" name="birimKodu" value="{{$data->code}}">
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="smallx ml-3"> Tanımlama Grubu Açıklaması</label>
                          <div class="col-md-12">
                              <input id="" type="text" class="form-control" name="malzemeAciklamasi" value="{{$data->title}}">
                          </div>
                      </div>

                </div>
