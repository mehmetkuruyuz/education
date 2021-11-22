@extends('layouts')
@section('content')
<style>
  th {
    font-size: 0.8em !important;
  }

  td {
    font-size: 0.8em !important;
  }
</style>
<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <div class="card-title pl-1"><strong>Yetkili Tanımlama</strong> <a href='/tedarikci/list' class="btn btn-success btn-sm float-right mx-3">Listeye Geri Dön</a>  <a href='javascript:void(0)' class="btn btn-danger btn-sm float-right" data-toggle="modal" data-target="#tedarikci"><i class="fas fa-plus"></i> Yeni Kayıt</a></div>
      <div class="row">

            <div class="col-12 col-lg-3 mt-3">
              <div class="form-group my-0">
                <label class="smallx ml-3">Firma Kodu</label>
                <div class="col-md-12">
                    {{$data->firmakodu}}
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-3 mt-3">
              <div class="form-group my-0">
                <label class="smallx ml-3">Firma Türü</label>
                <div class="col-md-12">
                  {{$data->firmaturu}}
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-3 mt-3">
              <div class="form-group my-0">
                <label class="smallx ml-3">Firma Adı</label>
                <div class="col-md-12">
                  {{$data->firmaadi}}
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-3 mt-3">
              <div class="form-group my-0">
                <label class="smallx ml-3">Firma Ticari Unvanı</label>
                <div class="col-md-12">
                  {{$data->firmaticariunvani}}
                </div>
              </div>
            </div>

          <div class="col-12 col-lg-3 mt-3">
            <div class="form-group my-0">
              <label class="smallx ml-3">Adres</label>
              <div class="col-md-12">
                  {{$data->adres}}
              </div>
            </div>
          </div>



          <div class="col-12 col-lg-3 mt-3">
            <div class="form-group my-0">
              <label class="smallx ml-3">İl</label>
              <div class="col-md-12">
                  {{Helper::SehirBul($data->sehir)}}
              </div>
          </div>
        </div>
        <div class="col-12 col-lg-3 mt-3">
            <div class="form-group my-0">
              <label class="smallx ml-3">İlçe</label>
              <div class="col-md-12">
                {{Helper::IlceBul($data->ilce)}}
              </div>
          </div>
        </div>
        <div class="col-12 col-lg-3 mt-3">
            <div class="form-group my-0">
              <label class="smallx ml-3">Telefon Numarası</label>
              <div class="col-md-12">
                  {{$data->telefon}}
              </div>
          </div>
        </div>
        <div class="col-12 col-lg-3 mt-3">
            <div class="form-group my-0">
              <label class="smallx ml-3">Fax Numarası</label>
              <div class="col-md-12">
                  {{$data->fax}}
              </div>
          </div>
        </div>
        <div class="col-12 col-lg-3 mt-3">
            <div class="form-group my-0">
              <label class="smallx ml-3">Mail Adresi</label>
              <div class="col-md-12">
                  {{$data->email}}
              </div>
          </div>
        </div>
        <div class="col-12 col-lg-3 mt-3">
            <div class="form-group my-0">
              <label class="smallx ml-3">Web Adresi</label>
              <div class="col-md-12">
                  {{$data->webadresi}}
              </div>
          </div>
        </div>
        <div class="col-12 col-lg-3 mt-3">
            <div class="form-group my-0">
              <label class="smallx ml-3">Sektör </label>
              <div class="col-md-12">
                  {{Helper::findSektor($data->sektor)}}
              </div>
          </div>
        </div>

    </div>
            <div class="col-md-12 mt-5">

              <div class="table-responsive" style="width:100%">
              <table class="table table-hover">
                <thead>
              <tr>
                      <th>Kullanıcı Kodu</th>
                      <th>Adı Soyadı</th>
                      <th>Unvan</th>
                      <th>Telefon Numarası</th>
                      <th>Mail Adresi</th>
                      <th class="text-center">İşlemler</th>
                  </tr>
                </thead>
              @if (!empty($allylist))
                <tbody>
                  @foreach ($allylist as $key => $value)
                  <tr>




                    <td>{{$value->kullanicikodu}}</td>
                    <td>{{$value->adisoyadi}}</td>
                    <td>{{Helper::findUnvan($value->unvan)}}</td>
                    <td>{{$value->telefon}}</td>
                      <td>{{$value->email}}</td>

                    <td class="px-0" style="width:150px;">
                      <a href='javascript:void(0)' onclick="edit({{$value->id}})"  class="text-danger mx-3"><i class="fa fa-edit"></i></a>
                      <a href='/tedarikci/yetkili/delete/{{$value->id}}' onclick="return confirm('Silmek İstediğinize Emin misiniz?')" class="text-danger  mx-3"><i class="fa fa-times"></i></a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
              @endif
            </table>
            </div>
            </div>
            <div class="col-sm-12 text-right" >
              <div class="pull-right float-right ">
                @if (!empty($list))
                    {{ $list->links( "pagination::bootstrap-4") }}
                @endif
              </div>
            </div>

      </div>
    </div>
  </div>
</div>


</div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="tedarikci">
  <div class="modal-dialog modal-xxl" role="document">
    <div class="modal-content">
      <div class="modal-header  bg-qpm-dark text-white">
        <span class="modal-title ml-1 pl-1"> Yetkili Tanımlamaları</span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="w-100" method="POST"  action="/tedarikci/yetkili/save" id="actionX">
          {{csrf_field()}}
          <div class="col-lg-4">
              <input type="hidden" name="firmaid" value="{{$data->id}}" />

                  <div class="form-group my-0">
                    <label class="smallx ml-3">Adı Soyadı</label>
                    <div class="col-md-12">
                        <input id="" type="text" class="form-control" name="adisoyadi">
                    </div>
                  </div>

                  <div class="form-group my-0">
                    <label class="smallx ml-3">Ünvan</label>
                    <div class="col-md-12">
                      @if (!empty($allunvan))
                        <select name="unvan" class="form-control">
                          @foreach ($allunvan as $key => $value)
                                <option value="{{$value->id}}">{{$value->title}}</option>
                          @endforeach
                        </select>
                      @endif
                    </div>
                  </div>

                  <div class="form-group my-0">
                    <label class="smallx ml-3">Telefon Numarası</label>
                    <div class="col-md-12">
                        <input id="" type="text" class="form-control" name="telefon">
                    </div>
                  </div>

                  <div class="form-group my-0">
                    <label class="smallx ml-3">Email Adresi</label>
                    <div class="col-md-12">
                        <input id="" type="text" class="form-control" name="email">
                    </div>
                  </div>
                  <div class="form-group my-0">
                    <label class="smallx ml-3"> Kullanıcı Kodu</label>
                    <div class="col-md-12">
                        <input id="" type="text" class="form-control" name="kullanicikodu">
                    </div>
                  </div>



              </div>
              <div class="form-group m-3">
                  <button class="btn btn-danger" type="submit" onclick="submitedit()">Kaydet</button>
              </div>
          </form>
      </div>
    </div>
  </div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="editmodal" >
  <div class="modal-dialog modal-xxl" role="document">
    <div class="modal-content" id="edit">

    </div>
  </div>
</div>

@endsection
@section("altscripts")
<script>

    function edit(id)
    {
      $.ajax({
             url: "/tedarikci/yetkili/edit/"+id,
             beforeSend:function(x){
                $("#edit").children().remove();
             },
             success: function (response) {
               $("#edit").children().remove();
               $("#edit").append(response);
               $("#editmodal").modal();
             },
             error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
             }
         });
    }
    function submitedit()
    {
      $("#actionEditX").submit();
    }
</script>
@endsection
