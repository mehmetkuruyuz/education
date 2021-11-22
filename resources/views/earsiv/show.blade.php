<div class="modal-header  bg-qpm-dark text-white">
  <span class="modal-title ml-1 pl-1">Earsiv Görüntüleme</span>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="modal-body">

  <div class="responsive">
    <table class="table">
        <tr>
          <td>
              <label class="smallx ml-3">Protokol No</label>
          </td>
          <td>
              {{$data->protokol_no}}
          </td>
        </tr>
        <tr>
          <td>
                <label class="smallx ml-3">TC Kimlik No</label>
          </td>
          <td>
              {{$data->tc_kimlik}}
          </td>
        </tr>
        <tr>
          <td>
                <label class="smallx ml-3">Raf No</label>
          </td>
          <td>
                  {{$data->raf}}
          </td>
        </tr>
        <tr>
          <td>
              <label class="smallx ml-3">Sıra No</label>
          </td>
          <td>
                  {{$data->sira}}
          </td>
        </tr>
        <tr>
          <td>
                <label class="smallx ml-3">Dosya No</label>
          </td>
          <td>
                  {{$data->dosya}}
          </td>
        </tr>
        <tr>
          <td>
                <label class="smallx ml-3">Dosya No</label>
          </td>
          <td>
                  {{$data->dosya}}
          </td>
        </tr>
        @if (!empty($data->dosyalama))
          <tr>
            <td>
              <label class="smallx ml-3">Eklenen Dosyalar</label>
            </td>
            <td>
              <div class="col-md-12">
                @foreach ($data->dosyalama as $key => $value)
                      <a href='/uploads/{{$value->mediaurl}}' target="_blank">{{$value->name}}</a><br />
                @endforeach
            </div>
          </td>
        </tr>
        @endif
    </table>

  </div>
  <div class="row">
    <div class="col-12 col-lg-8">
      <div class="form-group ">

          <div class="col-md-12">

          </div>
      </div>
      <div class="form-group ">

          <div class="col-md-8">

          </div>
      </div>
      <div class="form-group ">

          <div class="col-md-12">

          </div>
      </div>
      <div class="form-group ">

          <div class="col-md-12">

          </div>
      </div>
      <div class="form-group ">

          <div class="col-md-12">

          </div>
      </div>

    </div>
  </div>
</div>
