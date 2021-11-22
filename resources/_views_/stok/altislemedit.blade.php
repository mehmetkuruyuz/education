<div class="modal-header  bg-qpm-dark text-white">
  <span class="modal-title ml-1 pl-1"> {{$title}} Tanımlama</span>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
  <form class="w-100 p-5" method="POST"  action="/stok/update" id="actionEditX">
    {{csrf_field()}}
      <input type="hidden" value="{{$type}}" name="type" />
        <input type="hidden" value="{{$data->id}}" name="id" />
      <div class="col-12 col-lg-4">
                  <div class="form-group">
                      <label class="smallx ml-3"> Stok {{$title}} Kodu</label>
                      <div class="col-md-12">
                            <input id="" type="text" class="form-control" name="birimKodu" value="{{$data->code}}">
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="smallx ml-3">Stok {{$title}} Açıklaması</label>
                      <div class="col-md-12">
                          <input id="" type="text" class="form-control" name="malzemeAciklamasi" value="{{$data->title}}">
                      </div>
                  </div>

            </div>

  </form>
  <div class="modal-footer text-left  justify-content-start">
    <button type="submit" class="btn btn-danger" onclick="editsave()">Kaydet</button>
  </div>
