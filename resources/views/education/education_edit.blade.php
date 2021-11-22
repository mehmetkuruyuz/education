
                <form class="w-100" method="POST" action="/education/update" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="hidden" name="id" id="id" value="{{$data->id}}" />
                    <input type="hidden" name="category" id="categoryid" value="{{$data->categoryId}}" />
                    <div class="form-group">
                        <label for="egitimCode" class="col-md-4 control-label">Eğitim Kodu</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="egitimCode"  value="{{$data->egitimCode}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-md-4 control-label">Eğitim İsmi</label>

                        <div class="col-md-12">
                            <input id="" type="text" class="form-control" name="title" required value="{{$data->title}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description" class="col-md-4 control-label">Eğitim Açıklaması</label>

                        <div class="col-md-12">
                            <textarea class="form-control" name="description" required>{{$data->description}}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="teacherName" class="col-md-4 control-label">Eğitimci Adı Soyadı</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="teacherName"  value="{{$data->teacherName}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="egitimKurumu" class="col-md-4 control-label">Eğitim Veren Kurum</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="egitimKurumu"  value="{{$data->egitimKurumu}}">
                        </div>
                    </div>
                    <div class="form-group d-none">
                        <label for="egitimKurumu" class="col-md-4 control-label">Eğitim Grup Adı</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="grupname"  value="{{$data->grupname}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-md-4 control-label">Eğitim Süresi</label>

                        <div class="col-md-12">
                            <input id="" type="text" class="form-control time" name="videoTime" required value="{{$data->videoTime}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="col-md-4 control-label">Zorunlu Seyredilme Süresi</label>

                        <div class="col-md-12">
                            <input id="" type="text" class="form-control time" name="successTime" required value="{{$data->successTime}}">
                        </div>
                    </div>
                    <div class="form-group p-2">
                        <label for="category" class="col-md-4 control-label">Eğitim Dosyası</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile" name="video">
                            <label class="custom-file-label" for="customFile">Eğitim Dosyası</label>
                        </div>
                    </div>

                  <div class="form-group p-2 d-none">
                    <label for="category" class="col-md-4 control-label">Eğitim Resmi</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="customFile" name="thumb">
                        <label class="custom-file-label" for="customFile">Eğitim Resmi</label>
                    </div>
                  </div>
                    <div class="form-group">
                        <label for="description" class="col-md-4 control-label">Eğitim Tamamlanma Tarihi</label>

                        <div class="col-md-12">
                            <input id="" type="text" class="form-control daterange" name="bitissuresi" value="{{\Carbon\Carbon::parse($data->tamamlanmaTarihi)->format("m/d/Y")}}" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-md-4 control-label">Eğitim Başlama Tarihi</label>

                        <div class="col-md-12">
                            <input id="" type="text" class="form-control daterange" name="baslangictarihi" value="{{\Carbon\Carbon::parse($data->baslangictarihi)->format("m/d/Y")}}" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="egitimZorunlu" class="col-md-4 control-label">Eğitim Öncesi Zorunlu Sınav</label>
                        <div class="col-md-12">
                            <select name="educationsfrontexam" class="form-control">
                                <option value="0">Yok</option>
                                @if (!empty($sinavList))
                                  @foreach ($sinavList as $key => $value)
                                      <option value="{{$value->id}}">{{$value->title}}</option>
                                  @endforeach
                                @endif

                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="egitimZorunlu" class="col-md-4 control-label">Eğitim Sonrası Zorunlu Sınav</label>
                        <div class="col-md-12">
                            <select name="educationsendexam" class="form-control">
                                <option value="0">Yok</option>
                                @if (!empty($sinavList))
                                  @foreach ($sinavList as $key => $value)
                                    <option value="{{$value->id}}">{{$value->title}}</option>
                                  @endforeach
                                @endif
                            </select>
                            <small class="text-muted">Eğitim Öncesi sınav ve Eğitim Sonrası sınav farklı seçilmelidir.</small>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="egitimZorunlu" class="col-md-4 control-label">Eğitim Öncesi Zorunlu Anket</label>
                        <div class="col-md-12">
                            <select name="educationsforntanket" class="form-control">
                                <option value="0">Yok</option>
                                @if (!empty($pollsList))
                                  @foreach ($pollsList as $key => $value)
                                    <option value="{{$value->id}}">{{$value->title}}</option>
                                  @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="egitimZorunlu" class="col-md-4 control-label">Eğitim Sonrası Zorunlu Anket</label>
                        <div class="col-md-12">
                            <select name="educationsendanket" class="form-control">
                                <option value="0">Yok</option>
                                @if (!empty($pollsList))
                                  @foreach ($pollsList as $key => $value)
                                      <option value="{{$value->id}}">{{$value->title}}</option>
                                  @endforeach
                                @endif
                            </select>
                              <small class="text-muted">Eğitim Öncesi sınav ve Eğitim Sonrası sınav farklı seçilmelidir.</small>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-danger">
                                Kaydet
                            </button>
                        </div>
                    </div>
              </form>
