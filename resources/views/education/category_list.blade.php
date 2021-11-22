@extends('layouts')
@section('content')
  <style>
  th {font-size:0.9em !important;}
  td {font-size:0.8em !important;}
  </style>
  <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="card-title pl-1"><strong>Eğitim Grubu Tanımlama</strong> <a href='javascript:void(0)' class="btn btn-danger btn-sm float-right" data-toggle="modal" data-target="#yeniegitimolusturma"><i class="fas fa-plus"></i> Yeni Eğitim Grubu</a></div>
                  <form action="/education/category" method="post" >
                    {{csrf_field()}}

                    <div class="form-group row">
                      {{--
                      <div class="col-sm-4">
                        <label for="staticEmail" class="col-auto col-form-label smallx  ml-0 pl-1">Firma Kodu</label>
                        <input type="text" class="form-control" id="" value="{{Helper::findCompanyName(1)}} "  readonly />
                      </div>
                      --}}
                      <div class="col-sm-3">
                        <label for="s" class="col-auto col-form-label smallx  ml-0 pl-1">Eğitim Adı</label>
                        <input type="text" class="form-control" id=""  name="categoryname"  @if (!empty($categoryname)) value="{{$categoryname}}"   @endif />
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
                            <th>Eğitim Grubu Adı</th>
                            <th>Eğitim Grubu Açıklama</th>
                            <th>Oluşturma Tarihi</th>
                            <th>İşlemler</th>
                          </tr>
                        </thead>
                        <tbody>
                          @if (!empty($list))
                            @foreach ($list as $key => $value)
                              <tr>
                                <td>{{$value->title}}</td>
                                <td>{{$value->description}}</td>
                                <td>{{$value->created_at}}</td>
                                <td class="px-0" style="width:120px;">
                                    <a href='javascript:void(0)' onclick="openInformation('{{$value->id}}')"  title="Kategori Düzenle"><i class="fa fa-edit text-danger mx-2"></i></a>
                                    <a href='/education/lessons/{{$value->id}}'   title="Dersleri Düzenle"><i class="fas fa-photo-video text-danger  mx-2"></i></a>
                                    <a href='/delete/education/category/{{$value->id}}'   title="Kategori Sil" onclick="return confirm('Silmek İstediğinize Emin misiniz?')"><i class="fas fa-times text-danger  mx-2"></i></a>
                                </td>
                              </tr>
                            @endforeach
                          @endif
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
    </div>



    <div class="modal" tabindex="-1" role="dialog" id="yeniegitimolusturma">
      <div class="modal-dialog  modal-xxl" role="document">
        <div class="modal-content">
          <div class="modal-header bg-qpm-dark text-white">
              <span class="modal-title ml-1 pl-1">Eğitim Grubu Tanımlama</span>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" class="text-white">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body ">
            <form class="w-100" method="POST" action="/save/education/category" enctype="multipart/form-data" id='dataFrm'>
              {{csrf_field()}}
              <div class="form-group">
                  <label for="email" class="col-md-4 control-label">Eğitim Grubu Adı</label>

                  <div class="col-md-12">
                      <input id="" type="text" class="form-control" name="title" value="{{ old('title') }}" required>
                  </div>
              </div>
              <div class="form-group">
                  <label for="açıklama" class="col-md-4 control-label">Eğitim Grubu Açıklaması</label>

                  <div class="col-md-12">
                      <textarea name="description" class="form-control border"></textarea>
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
          </div>
        </div>
      </div>
    </div>


    <div class="modal" tabindex="-1" role="dialog" id="egitimduzenle">
      <div class="modal-dialog  modal-xxl" role="document">
        <div class="modal-content">
          <div class="modal-header bg-qpm-dark text-white">
            <span class="modal-title ml-1 pl-1">Eğitim Grubu Güncelleme </span>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" class="text-white">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body " id="egitimduzenlebody">

          </div>

        </div>

      </div>

    </div>


@endsection

@section('altscripts')


  <script>

  function openInformation(id) {

        $("#egitimduzenlebody").children().remove();

        $.ajax({
          url: "/egitim/category/find/" + id,
          type: "get",
          success: function(response) {
            $("#egitimduzenlebody").append(response);
            $("#egitimduzenle").modal();

          },
          error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
          }
        });


      }

  </script>
@endsection
