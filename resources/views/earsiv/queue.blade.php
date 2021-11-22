@extends('layouts')
@section('content')

  <style>
  th {font-size:0.9em !important;}
  td {font-size:0.8em !important;}
  </style>
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="card-title pl-1"><strong>E-Arşiv Listesi</strong></div>
        <form action="/earsiv/queue" method="post" >
          {{csrf_field()}}
        <div class="form-group row">
              @include('company.select')
          <div class="col-sm-2">
            <label for="" class="col-auto col-form-label smallx  ml-0 pl-1">Protokol No</label>
            <input type="text" class="form-control" id=""  name="protokol_no" @if (!empty($protokol_no)) value="{{$protokol_no}}" @endif/>
          </div>
          <div class="col-sm-2">
            <label for="" class="col-auto col-form-label smallx ml-0 pl-1">TC Kimlik</label>
            <input type="text" class="form-control" id=""  name="tc_kimlik" @if (!empty($tc_kimlik)) value="{{$tc_kimlik}}" @endif />
          </div>


          <div class="col-sm-1">
            <label for="" class="col-auto col-form-label smallx ml-0 pl-1">Raf</label>
            <input type="text" class="form-control" id=""  name="raf" @if (!empty($raf)) value="{{$raf}}" @endif />
          </div>
          <div class="col-sm-1">
            <label for="" class="col-auto col-form-label smallx ml-0 pl-1">Sıra</label>
            <input type="text" class="form-control" id=""  name="sira" @if (!empty($sira)) value="{{$sira}}" @endif />
          </div>
          <div class="col-sm-1">
            <label for="" class="col-auto col-form-label smallx ml-0 pl-1">Dosya</label>
            <input type="text" class="form-control" id=""  name="dosya" @if (!empty($dosya)) value="{{$dosya}}" @endif />
          </div>
          <div class="col-sm-1" style="padding-top:33px;">
          <button type="submit" class="btn btn-info btn-sm"><i class="fas fa-search"></i> Ara</button>
        </div>
      </div>
      </form>
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
                          <a href='javascript::void()' class="text-danger mr-3" onclick="findfilelist({{$ze->id}})"><i class="fas fa-eye" style="margin-top:5px"></i></a>
                          <a href='javascript::void()' class="text-danger mr-3" onclick="makestamp({{$ze->id}})"><i class="fas fa-stamp" style="margin-top:5px"></i></a>
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
          <span class="modal-title ml-1 pl-1">E-Arşiv Raf Belirleme</span>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
          <form class="w-100 p-5" method="POST"  action="/earsiv/update" id="actionX" enctype="multipart/form-data">
            {{csrf_field()}}
            <input type="hidden" name="id" id="iddate" value="" />
            <div class="col-12 col-lg-8">
              <div class="form-group ">
                  <label class="smallx ml-3">Raf No</label>
                  <div class="col-md-12">
                        <input id="" type="text" class="form-control" name="raf">
                  </div>
              </div>
            </div>
            <div class="col-12 col-lg-8">
              <div class="form-group ">
                  <label class="smallx ml-3">Sıra No</label>
                  <div class="col-md-12">
                        <input id="" type="text" class="form-control" name="sira">
                  </div>
              </div>
            </div>
            <div class="col-12 col-lg-8">
              <div class="form-group ">
                  <label class="smallx ml-3">Dosya No</label>
                  <div class="col-md-12">
                        <input id="" type="text" class="form-control" name="dosya">
                  </div>
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
            <div class="modal-content" id="edit">
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

          function makestamp(id)
          {
              $("#iddate").val(id);
              $("#altislem").modal();
          }
  </script>
@endsection
