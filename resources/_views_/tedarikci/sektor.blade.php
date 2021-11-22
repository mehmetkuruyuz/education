@extends('layouts')
@section('content')
  <style>
  th {font-size:0.8em !important;}
  td {font-size:0.8em !important;}
  </style>
    <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="card-title pl-1"><strong>Sektör Tanımlama</strong> <a href='javascript:void(0)' class="btn btn-danger btn-sm float-right" data-toggle="modal" data-target="#altislem"><i class="fas fa-plus"></i>  Yeni Sektör</a></div>

                    <div class="row">
                            <div class="col-sm-12 text-right" >
                              <div class="pull-right float-right ">
                                @if (!empty($list))
                                    {{ $list->links( "pagination::bootstrap-4") }}
                                @endif
                              </div>
                            </div>
                    </div>
                    <div class="table-responsive" style="width:100%">
                      <table class="table table-hover">
                        <thead>
                            <tr>
                              <th class="d-none">Sektör Kodu</th>
                              <th>Sektör Tanımı</th>
                              <th class="text-center">İşlemler</th>
                          </tr>,
                        </thead>
                        <tbody>
                          @if (!empty($list))
                            @foreach ($list as $key => $value)
                              <tr>
                                <td class="d-none">{{$value->code}}</td>
                                <td>{{$value->title}}</td>
                                <td class="px-0" style="width:150px;">
                                  <a href='javascript:void(0)' onclick="edit({{$value->id}})"  class="text-danger mx-3"><i class="fa fa-edit"></i></a>
                                  <a href='/sektor/delete/{{$type}}/{{$value->id}}' onclick="return confirm('Silmek İstediğinize Emin misiniz?')" class="text-danger  mx-3"><i class="fa fa-times"></i></a>
                                </td>
                              </tr>
                            @endforeach
                          @endif
                        </tbody>
                      </table>
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

              <div class="modal" tabindex="-1" role="dialog" id="altislem">
                <div class="modal-dialog modal-xxl" role="document">
                  <div class="modal-content">
                    <div class="modal-header  bg-qpm-dark text-white">
                      <span class="modal-title ml-1 pl-1"> Sektör Tanımlama</span>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                      <form class="w-100 p-5" method="POST"  action="/sektor/save" id="actionX">
                        {{csrf_field()}}
                          <input type="hidden" value="{{$type}}" name="type" />
                          <div class="col-12 col-lg-4 ">
                                      <div class="form-group d-none">
                                          <label class="smallx ml-3"> Sektör Kodu</label>
                                          <div class="col-md-12">
                                                <input id="" type="text" class="form-control" name="birimKodu">
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="smallx ml-3">Sektör Açıklaması</label>
                                          <div class="col-md-12">
                                              <input id="" type="text" class="form-control" name="malzemeAciklamasi">
                                          </div>
                                      </div>

                                </div>

                      </form>
                      <div class="modal-footer text-left  justify-content-start">
                        <button type="submit" class="btn btn-danger" onclick="submitsave()">Kaydet</button>
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
        function filtrele()
        {
          window.location.href='/admin/products/list?type='+$("#typer").val();

        }

        function submitsave()
        {
          $("#actionX").submit();
        }


        function edit(id)
        {
          $.ajax({
                 url: "/sektor/edit/{{$type}}/"+id,
                 beforeSend:function(x){
                   $("#edit").children().remove();
                 },
                 success: function (response) {
                   $("#edit").append(response);

                   $("#editmodal").modal();
                 },
                 error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                 }
             });
        }

        function editsave()
        {
          $("#actionEditX").submit();
        }

    </script>
  @endsection
