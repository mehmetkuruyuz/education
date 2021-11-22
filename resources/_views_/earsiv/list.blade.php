@extends('layouts')
@section('content')

  <style>
  th {font-size:0.9em !important;}
  td {font-size:0.8em !important;}
  </style>
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="card-title pl-1"><strong>E-Arşiv Listesi</strong> <a href='javascript:void(0)' class="btn btn-danger btn-sm float-right" data-toggle="modal" data-target="#altislem"><i class="fas fa-plus"></i>  Yeni Arşiv Dökümanı</a></div>

        <div class="col-md-12">
          <div class="box  my-3">
              <form action="/earsiv/list" method="post" >
                {{csrf_field()}}

                <div class="form-group row">
                  <div class="col-sm-4">
                    <label for="staticEmail" class="col-auto col-form-label smallx  ml-0 pl-1">Firma Kodu</label>
                    <input type="text" class="form-control" id="" value="{{Helper::findCompanyName(1)}} "  readonly />
                  </div>
                  <div class="col-sm-2">
                    <label for="staticEmail" class="col-auto col-form-label smallx  ml-0 pl-1">Protokol No</label>
                    <input type="text" class="form-control" id=""  name="protokol_no" @if (!empty($protokol_no)) value="{{$protokol_no}}" @endif/>
                  </div>
                  <div class="col-sm-2">
                    <label for="staticEmail" class="col-auto col-form-label smallx ml-0 pl-1">TC Kimlik</label>
                    <input type="text" class="form-control" id="staticEmail"  name="tc_kimlik" @if (!empty($tc_kimlik)) value="{{$tc_kimlik}}" @endif />
                  </div>
                  <div class="col-sm-1" style="padding-top:33px;">
                  <button type="submit" class="btn btn-info btn-sm"><i class="fas fa-search"></i> Ara</button>
                </div>
              </div>
              </form>
          </div>
        </div>
        <div class="row">
          <div class="table-responsive col-12" style="width:100%">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Eklenme Tarihi</th>
                  <th>Protokol No</th>
                  <th>TC Kimlik No</th>
                  <th>Adresleme Tarihi</th>
                  <th>Raf</th>
                  <th>Sıra</th>
                  <th>Dosya</th>
                  <th>İşlemler</th>
                </tr>
              </thead>
              @if (!empty($list))
                @foreach ($list as $z => $ze)
                    <tr>
                      <td>{{$ze->created_at}}</td>
                      <td>{{$ze->protokol_no}}</td>
                      <td>{{$ze->tc_kimlik}}</td>
                      <td>{{$ze->adresleme_tarihi}}</td>
                      <td>{{$ze->raf}}</td>
                      <td>{{$ze->sira}}</td>
                      <td>{{$ze->dosya}}</td>
                      <td>
                          <a href='javascript::void()' class="text-danger mr-3" onclick="show({{$ze->id}})"><i class="fas fa-eye" style="margin-top:5px"></i></a>
                          <a href='javascript::void()' class="text-danger mr-3"><i class="fas fa-edit" style="margin-top:5px"></i></a>
                      </td>
                    </tr>
                  @endforeach
              @endif
            </table>
          </div>
        </div>
      </div>
    </div>

  </div>
  <div class="modal" tabindex="-1" role="dialog" id="altislem">
    <div class="modal-dialog modal-xxl" role="document">
      <div class="modal-content">
        <div class="modal-header  bg-qpm-dark text-white">
          <span class="modal-title ml-1 pl-1">E-Arşiv Ekleme</span>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
          <form class="w-100 p-5" method="POST"  action="/earsiv/save" id="actionX" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="col-12 col-lg-8">
              <div class="form-group ">
                  <label class="smallx ml-3">Protokol No</label>
                  <div class="col-md-12">
                        <input id="" type="text" class="form-control" name="protokol_no">
                  </div>
              </div>
            </div>
            <div class="col-12 col-lg-8">
              <div class="form-group ">
                  <label class="smallx ml-3">Tc Kimlik No</label>
                  <div class="col-md-12">
                        <input id="" type="text" class="form-control" name="tckimlik_no">
                  </div>
              </div>
            </div>
            <div class="col-12 col-lg-8">
              <div class="form-group col-md-12">
                <label for="inputEmail4" class="smallx">Ek Dosyalar</label>
                <div class="custom-file">

                  <input type="file" class="custom-file-input" name="file[]" id="customFile" multiple>
                  <label class="custom-file-label" for="customFile">Dosya Seç</label>
                </div>
              </div>
              <div id="secililistesi" class="ml-3" style="font-size:11px;">
                Seçili Listesi
              </div>
            </div>

          <div class="modal-footer text-left  justify-content-start">
            <button type="submit" class="btn btn-danger" onclick="submitsave()">Kaydet</button>
          </div>
        </form>
      </div>
    </div>
  </div>


        <div class="modal" tabindex="-1" role="dialog" id="editmodal" >
          <div class="modal-dialog modal-xxl" role="document">
            <div class="modal-content" id="editbody">


            </div>
          </div>
        </div>

@endsection

  @section("altscripts")
  <script>
      $("#customFile").change(function (e) {
              var files = [];
              for (var i = 0; i < $(this)[0].files.length; i++) {
                  files.push($(this)[0].files[i].name);
              }
              $("#secililistesi").html(files.join(',<br /> '));
          });


          function show(id)
          {

                $("#editbody").children().remove();

                $.ajax({
                  url: "/earsiv/show/" + id,
                  type: "get",
                  success: function(response) {
                    $("#editbody").append(response);
                    $("#editmodal").modal();
                  },
                  error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                  }
                });

          }
  </script>
@endsection
