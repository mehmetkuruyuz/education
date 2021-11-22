@extends('layouts')
@section('content')
  <style>
  th {font-size:0.8em !important;}
  td {font-size:0.8em !important;}
  .smallx {font-size:0.8em !important;font-weight: bold;}
  </style>
    <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="card-title pl-1"><strong>Stok Tanımlama</strong> <a href='javascript:void(0)' class="btn btn-danger btn-sm float-right" data-toggle="modal" data-target="#yenistok"><i class="fas fa-plus"></i>  Yeni Stok</a></div>
                    <p class="card-description  d-none">
                        Stok Kayıtlı Kullanıcılar
                    </p>

                    <div class="row">
                      <div class="col-12 text-right">
                      </div>
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
                            <th>Kodu</th>
                            <th>Adı</th>
                            <th>Marka</th>
                            <th>Tip</th>
                            <th class="text-center">İşlemler</th>
                          </tr>
                        </thead>
                        <tbody>
                          @if (!empty($list))
                            @foreach ($list as $key => $value)
                              <tr>
                                <td>{{$value->urunkodu}}</td>
                                <td>{{$value->uruntitle}}</td>
                                <td>{{$value->urunmarka}}</td>
                                <td>{{$value->typeofproduct}}</td>
                                <td class="px-0" style="width:150px;">
                                  <a href='javascript:void(0)' onclick="edit({{$value->id}})"  class="text-danger mx-3"><i class="fa fa-edit"></i></a>
                                  <a href='/admin/products/delete/{{$value->id}}' class="text-danger  mx-3"><i class="fa fa-times"></i></a>

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


                    @endsection

  @section("altscripts")
    <script>
        function filtrele()
        {
          window.location.href='/admin/products/list?type='+$("#typer").val();

        }
    </script>
  @endsection
{{--}}
<style>
th {font-size:0.8em !important;}
td {font-size:0.8em !important;}
</style>
  <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Ürün Listesi</h4>
                  <p class="card-description">
                      Sistemde Kayıtlı Ürünler ve Hizmetler Listesi
                  </p>

                  <div class="row">
                    <div class="col-12 text-right py-3" >
                        <a href='/admin/products/add' class="btn btn-danger">Yeni Ürün</a>
                    </div>
                      <div class="col-md-2">
                        <label class="font-semibold">Filtreleme </label>
                          <select name='filtrele' class="form-control" id='typer'>
                              <option value="Malzeme" @if ($type=="Malzeme") selected @endif>Malzeme</option>
                              <option value="Hizmet" @if ($type=="Hizmet") selected @endif>Hizmet</option>
                          </select>
                      </div>
                      <div class="col-md-1 pt-4">
                         <button class="btn btn-success btn-sm my-2" onclick="filtrele()">Filtrele</button>
                      </div>

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
                          <th>Kodu</th>
                          <th>Adı</th>
                          <th>Marka</th>
                          <th>Tip</th>
                          <th>Sil</th>
                        </tr>
                      </thead>
                      <tbody>
                        @if (!empty($list))
                          @foreach ($list as $key => $value)
                            <tr>
                              <td>{{$value->urunkodu}}</td>
                              <td>{{$value->uruntitle}}</td>
                              <td>{{$value->urunmarka}}</td>
                              <td>{{$value->typeofproduct}}</td>
                              <td class="px-0" style="width:20px;"><a href='/admin/products/delete/{{$value->id}}'><i class="fa fa-times"></i></a></td>
                            </tr>
                          @endforeach
                        @endif
                      </tbody>
                    </table>
                  </div>
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
  </script>
@endsection
--}}
