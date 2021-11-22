<div class="modal-header  bg-qpm-dark text-white">
  <span class="modal-title ml-1 pl-1"> Sektor Düzenleme</span>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
  <form class="w-100 p-5" method="POST"  action="/unvan/update" id="actioneditX">
    {{csrf_field()}}
      <input id="" type="hidden" class="form-control" name="id" value="{{$data->id}}">
      <div class="col-12 col-lg-4">
                  <div class="form-group d-none">
                      <label class="smallx ml-3"> Yetkili Ünvan Kodu</label>
                      <div class="col-md-12">
                            <input id="" type="text" class="form-control" name="birimKodu" value="{{$data->code}}">
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="smallx ml-3"> Yetkili Ünvan Açıklaması</label>
                      <div class="col-md-12">
                          <input id="" type="text" class="form-control" name="malzemeAciklamasi" value="{{$data->title}}">
                      </div>
                  </div>

            </div>

  </form>
  <div class="modal-footer text-left  justify-content-start">
    <button type="submit" class="btn btn-danger" onclick="editsave()">Kaydet</button>
  </div>
