
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
          <div class="form-group">
              <label for="email" class="col-md-4 control-label">Grup</label>
              <div class="col-md-12">
                  <input id="" type="text" class="form-control" name="title" value="{{$data->title}}" required>
              </div>
          </div>
          <div class="form-group">
              <label for="açıklama" class="col-md-4 control-label">Grup Açıklaması</label>

              <div class="col-md-12">
                  <textarea name="description" class="form-control border">{{$data->description}}</textarea>
              </div>
          </div>
