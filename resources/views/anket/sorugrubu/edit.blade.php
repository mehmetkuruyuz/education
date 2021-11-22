
          {{csrf_field()}}
          <input type='hidden' name="id" value="{{$data->id}}" />
          <div class="form-group">
              <label for="email" class="col-md-4 control-label">Firma</label>
              <div class="col-md-12">
                  <select class="form-control" name="companyId">
                    @if(!empty($list))
                      @foreach ($list as $key => $value)
                          <option value="{{$value->id}}" @if($value->id==$data->companyId) selected @endif>{{$value->title}}</option>
                      @endforeach
                    @endif
                  </select>
              </div>
          </div>
          <div class="col-12 col-lg-4">
                      <div class="form-group d-none">
                          <label class="smallx ml-3 "> Sektor Kodu</label>
                          <div class="col-md-12">
                                <input id="" type="text" class="form-control" name="birimKodu" value="{{$data->code}}">
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="smallx ml-3"> Sektor Açıklaması</label>
                          <div class="col-md-12">
                              <input id="" type="text" class="form-control" name="malzemeAciklamasi" value="{{$data->title}}">
                          </div>
                      </div>

                </div>
