@extends('layouts')
@section('content')
  <style>
  th {font-size:0.8em !important;}
  td {font-size:0.8em !important;}
  </style>
    <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="card-title pl-1"><strong>Stok Tanımlama</strong> <a href='javascript:void(0)' class="btn btn-danger btn-sm float-right" data-toggle="modal" data-target="#yenistok"><i class="fas fa-plus"></i>  Yeni Stok</a></div>
                    <div class="row">
                      <div class="col-12 text-right">
                      </div>
                        <div class="col-md-12">
                        </div>
                            <div class="col-sm-12 text-right" >
                              <div class="pull-right float-right ">
                                @if (!empty($list))
                                    {{ $list->links( "pagination::bootstrap-4") }}
                                @endif
                              </div>
                            </div>
                    </div>
                    <form action="/products/list" method="post" >
                      {{csrf_field()}}

                      <div class="form-group row">
                        <div class="col-sm-2">
                          <label for="staticEmail" class="col-auto col-form-label smallx  ml-0 pl-1">Stok Kodu</label>
                          <input type="text" class="form-control" id="" value=""  name="stokkodu"  />
                        </div>
                        <div class="col-sm-2">
                          <label for="staticEmail" class="col-auto col-form-label smallx  ml-0 pl-1">Stok Tanımı</label>
                          <input type="text" class="form-control" id="" value=""  name="stoktanimi"  />
                        </div>
                        <div class="col-sm-2">
                          <label for="staticEmail" class="col-auto col-form-label smallx  ml-0 pl-1">Stok Turu</label>
                          <select class="form-control" name="stokTurusearch">
                            <option value="">Seçiniz</option>
                            @if(!empty($StokTuruList))
                              @foreach ($StokTuruList as $key => $value)
                                  <option value="{{$value->id}}">{{$value->title}}</option>
                              @endforeach
                            @endif
                          </select>
                        </div>
                        <div class="col-sm-2">
                          <label for="staticEmail" class="col-auto col-form-label smallx  ml-0 pl-1">Stok Tipi</label>
                          <select class="form-control" name="malzemeTipisearch">
                              <option value="">Seçiniz</option>
                            @if(!empty($MalzemeTipiList))
                                @foreach ($MalzemeTipiList as $key => $value)
                                    <option value="{{$value->id}}">{{$value->title}}</option>
                                  @endforeach
                                @endif
                          </select>
                        </div>
                        <div class="col-sm-2">
                          <label for="staticEmail" class="col-auto col-form-label smallx  ml-0 pl-1">Stok Sınıfı</label>

                          <select class="form-control" name="malzemeSinifisearch">
                            <option value="">Seçiniz</option>
                              @if(!empty($MalzemeSinifiList))
                                @foreach ($MalzemeSinifiList as $key => $value)
                                  <option value="{{$value->id}}">{{$value->title}}</option>
                                @endforeach
                              @endif
                          </select>
                        </div>
                        <div class="col-sm-1" style="padding-top:33px;">
                        <button type="submit" class="btn btn-info btn-sm"><i class="fas fa-search"></i> Ara</button>
                      </div>
                    </div>
                    </form>
                    <div class="table-responsive" style="width:100%">
                      <table class="table table-hover">
                        <thead>
                            <tr>
                              <th>Kodu</th>
                              <th>Tanımı</th>
                              <th>Tipi</th>
                              <th>Sınıfı</th>
                              <th>Birim</th>
                              <th>Türü</th>
                              <th>Uzunluk</th>
                              <th>Genişlik</th>
                              <th>Derinlik</th>
                              <th>Hacim</th>
                              <th>Ağırlık</th>
                              <th class="text-center">İşlemler</th>
                          </tr>
                        </thead>



                        <tbody>
                          @if (!empty($list))
                            @foreach ($list as $key => $value)
                              <tr>
                                <td>{{$value->malzemeKodu}}</td>
                                <td>{{$value->malzemeAciklamasi}}</td>
                                <td>{{Helper::findUrunTipi($value->malzemeTipi)}}</td>
                                <td>{{Helper::findUrunSinifi($value->malzemeSinifi)}}</td>
                                <td>{{Helper::findUrunBirimi($value->malzemeBirimi)}}</td>
                                <td>{{Helper::findStokTuru($value->stokTuru)}}</td>

                                <td>{{$value->x}}</td>
                                <td>{{$value->y}}</td>
                                <td>{{$value->z}}</td>
                                <td>{{$value->hacim}}</td>
                                <td>{{$value->agirlik}}</td>
                                <td class="px-0" style="width:150px;">
                                  <a href='javascript:void(0)' onclick="edit({{$value->id}})"  class="text-danger mx-3"><i class="fa fa-edit"></i></a>
                                  <a href='/products/delete/{{$value->id}}' onclick="return confirm('Silmek İstediğinize Emin misiniz?')" class="text-danger  mx-3"><i class="fa fa-times"></i></a>
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

              <div class="modal" tabindex="-1" role="dialog" id="yenistok">
                <div class="modal-dialog modal-xxl" role="document">
                  <div class="modal-content">
                    <div class="modal-header  bg-qpm-dark text-white">
                      <span class="modal-title ml-1 pl-1"> Stok Tanımlama</span>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                      <form class="w-100 p-5" method="POST"  action="/products/save" id="actionX">
                        {{csrf_field()}}
                        <nav>
                          <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Genel Bilgiler</a>
                            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Depo Durum</a>
                            <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Cari ve Ticari Bilgiler</a>
                          </div>
                        </nav>
                        <div class="tab-content p-3" id="nav-tabContent">
                          <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                          <div class="col-12 col-lg-4">
                                      <div class="form-group my-0">
                                          <label class="smallx ml-3">Stok Kodu</label>
                                          <div class="col-md-12">
                                                <input id="" type="text" class="form-control" name="malzemeKodu">
                                          </div>
                                      </div>
                                      <div class="form-group my-0">
                                          <label class="smallx ml-3">Stok Açıklaması</label>
                                          <div class="col-md-12">
                                              <input id="" type="text" class="form-control" name="malzemeAciklamasi">
                                          </div>
                                      </div>
                                      <div class="form-group my-0">
                                          <label class="smallx ml-3">Stok Türü</label>
                                          <div class="col-md-12">
                                            <select class="form-control" name="stokTuru">
                                              @if(!empty($StokTuruList))
                                                @foreach ($StokTuruList as $key => $value)
                                                    <option value="{{$value->id}}">{{$value->title}}</option>
                                                @endforeach
                                              @endif
                                            </select>
                                          </div>
                                      </div>
                                      <div class="form-group my-0">
                                          <label class="smallx ml-3">Stok Tipi</label>
                                          <div class="col-md-12">
                                            <select class="form-control" name="malzemeTipi">
                                              @if(!empty($MalzemeTipiList))
                                                @foreach ($MalzemeTipiList as $key => $value)
                                                    <option value="{{$value->id}}">{{$value->title}}</option>
                                                @endforeach
                                              @endif
                                            </select>
                                          </div>
                                      </div>
                                      <div class="form-group my-0">
                                          <label class="smallx ml-3">Stok Sınıfı</label>
                                          <div class="col-md-12">
                                            <select class="form-control" name="malzemeSinifi">
                                              @if(!empty($MalzemeSinifiList))
                                                @foreach ($MalzemeSinifiList as $key => $value)
                                                    <option value="{{$value->id}}">{{$value->title}}</option>
                                                @endforeach
                                              @endif
                                            </select>
                                          </div>
                                      </div>
                                      <div class="form-group my-0">
                                          <label class="smallx ml-3">Stok Birimi</label>
                                          <div class="col-md-12">
                                            <select class="form-control" name="malzemeBirimi">
                                              @if(!empty($MalzemeBirimiList))
                                                @foreach ($MalzemeBirimiList as $key => $value)
                                                    <option value="{{$value->id}}">{{$value->title}}</option>
                                                @endforeach
                                              @endif
                                            </select>
                                          </div>
                                      </div>

                                      <label class="font-bold mt-3 ml-3">Stok Boyutları</label>
                                      <div class="row">
                                        <div class="col-4">
                                          <div class="form-group my-0">
                                              <label class="smallx ml-3">Uzunluk</label>
                                              <div class="col-md-12">
                                                  <input id="" type="text" class="form-control" name="x">
                                              </div>
                                          </div>
                                        </div>
                                        <div class="col-4">
                                          <div class="form-group my-0">
                                              <label class="smallx ml-3">Genişlik</label>
                                              <div class="col-md-12">
                                                  <input id="" type="text" class="form-control" name="y">
                                              </div>
                                          </div>
                                        </div>
                                        <div class="col-4">
                                          <div class="form-group my-0">
                                              <label class="smallx ml-3">Derinlik</label>
                                              <div class="col-md-12">
                                                  <input id="" type="text" class="form-control" name="z">
                                              </div>
                                          </div>
                                        </div>
                                        <div class="col-4">
                                          <div class="form-group my-0">
                                              <label class="smallx ml-3">Hacim</label>
                                              <div class="col-md-12">
                                                  <input id="" type="text" class="form-control" name="hacim">
                                              </div>
                                          </div>
                                        </div>
                                        <div class="col-4">
                                          <div class="form-group my-0">
                                              <label class="smallx ml-3">Brüt Ağırlık</label>
                                              <div class="col-md-12">
                                                  <input id="" type="text" class="form-control" name="agirlik">
                                              </div>
                                          </div>
                                        </div>
                                        <div class="col-4">
                                          <div class="form-group my-0">
                                              <label class="smallx ml-3">Net Ağırlık</label>
                                              <div class="col-md-12">
                                                  <input id="" type="text" class="form-control" name="netagirlik">
                                              </div>
                                          </div>
                                        </div>
                                      </div>
                                      <label class="font-bold ml-3  mt-3">Özel Kodlar</label>
                                      <div class="row">
                                        <div class="col-12">
                                          <div class="form-group my-0">
                                              <label class="smallx ml-3">Özel Kod 1</label>
                                              <div class="col-md-12">
                                                  <input id="" type="text" class="form-control" name="ozelurun1">
                                              </div>
                                          </div>
                                        </div>
                                        <div class="col-12">
                                          <div class="form-group my-0">
                                              <label class="smallx ml-3">Özel Kod 2</label>
                                              <div class="col-md-12">
                                                  <input id="" type="text" class="form-control" name="ozelurun2">
                                              </div>
                                          </div>
                                        </div>
                                        <div class="col-12">
                                          <div class="form-group my-0">
                                              <label class="smallx ml-3">Özel Kod 3</label>
                                              <div class="col-md-12">
                                                  <input id="" type="text" class="form-control" name="ozelurun3">
                                              </div>
                                          </div>
                                        </div>
                                      </div>
                                </div>
                          </div>
                          <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <div class="col-12 col-lg-4">
                            <div class="form-group my-0">
                                  <label class="smallx ml-3">Depolama Tipi</label>
                                  <div class="col-md-12">
                                    <select class="form-control" name="depolamaTipi">
                                      @if(!empty($DepoTipiList))
                                        @foreach ($DepoTipiList as $key => $value)
                                            <option value="{{$value->id}}">{{$value->title}}</option>
                                        @endforeach
                                      @endif
                                    </select>
                                  </div>
                            </div>
                            <div class="form-group my-0">
                                <label class="smallx ml-3">Depo Numarası</label>
                                <div class="col-md-12">
                                    <input id="" type="text" class="form-control" name="depoNumarasi">
                                </div>
                            </div>
                            <div class="form-group my-0">
                                <label class="smallx ml-3">Emniyet Stoğu</label>
                                <div class="col-md-12">
                                    <input id="" type="text" class="form-control" name="malzemeEmliyetStogu">
                                </div>
                            </div>
                            <div class="form-group my-0">
                                <label class="smallx ml-3">Min. Değeri</label>
                                <div class="col-md-12">
                                      <input id="" type="text" class="form-control" name="minDeger">
                                </div>
                            </div>
                            <div class="form-group my-0">
                                <label class="smallx ml-3">Max. Değeri</label>
                                <div class="col-md-12">
                                    <input id="" type="text" class="form-control" name="maxDeger">
                                </div>
                            </div>
                            <div class="form-group my-0">
                                <label class="smallx ml-3">Yeniden Sipariş Seviyesi</label>
                                <div class="col-md-12">
                                    <input id="" type="text" class="form-control" name="yenidenSiparis">
                                </div>
                            </div>
                            <div class="form-group d-none">
                                <label class="smallx ml-3">Ambar Kodu</label>
                                <div class="col-md-12">
                                    <input id="" type="text" class="form-control" name="ambarKodu">
                                </div>
                            </div>
                              <div class="form-group my-0">
                                  <label class="smallx ml-3">Birim Fiyat</label>
                                  <div class="col-md-12">
                                      <input id="" type="text" class="form-control" name="birimFiyat">
                                  </div>
                              </div>
                              <div class="form-group my-0">
                                  <label class="smallx ml-3">Kullanım Süresi</label>
                                  <div class="col-md-12">
                                      <input id="" type="text" class="form-control" name="kullanimSuresi">
                                  </div>
                              </div>
                            </div>

                          </div>
                          <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                            <div class="col-12 col-lg-4">
                              <div class="form-group my-0">
                                  <label class="smallx ml-3">Tedarikçi Kodu</label>
                                  <div class="col-md-12">
                                      <input id="" type="text" class="form-control" name="tedarikciKodu">
                                  </div>
                              </div>

                              <div class="form-group my-0">
                                  <label class="smallx ml-3">Müşteri kodu</label>
                                  <div class="col-md-12">
                                      <input id="" type="text" class="form-control" name="musteriKodu">
                                  </div>
                              </div>
                              <div class="form-group my-0">
                                  <label class="smallx ml-3">Muhasebe Hesap Kodu</label>
                                  <div class="col-md-12">
                                      <input id="" type="text" class="form-control" name="muhasebeKodu">
                                  </div>
                              </div>
                              <div class="form-group my-0">
                                  <label class="smallx ml-3">KDV Oranı</label>
                                  <div class="col-md-12">
                                      <input id="" type="text" class="form-control" name="kdvOrani">
                                  </div>
                              </div>
                              <div class="form-group my-0">
                                  <label class="smallx ml-3">Marka</label>
                                  <div class="col-md-12">
                                      <input id="" type="text" class="form-control" name="marka">
                                  </div>
                              </div>
                              <div class="form-group my-0">
                                  <label class="smallx ml-3">GTIP No</label>
                                  <div class="col-md-12">
                                      <input id="" type="text" class="form-control" name="gtip">
                                  </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </form>
                      <div class="modal-footer  text-left  pl-5 justify-content-start">
                        <button type="submit" class="btn btn-danger ml-5" onclick="submitsave()">Kaydet</button>
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
                 url: "/products/edit/"+id,
                 beforeSend:function(x){
                   $("#actionX").children().remove();
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
