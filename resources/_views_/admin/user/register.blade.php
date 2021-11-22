@extends('layouts')

@section('content')

    <div class="row">
      <div class="col-sm-12 my-1">
            &nbsp;
      </div>
        <form class="w-100" method="POST" action="/admin/user/save">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header bg-qpm-dark text-white "><h5 style="">Yeni Kullanıcı Kayıt Formu</h5></div>
                <div class="card-body">
                  <div class="row">
                      <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label for="" class="col-md-12 control-label font-semibold  strong">Firma Kodu</label>
                            <div class="col-md-12">
                                <select name="companyCode"  class="selectmulti form-control form-control-sm" id="firmCode" required style="width:100% !important" onchange="loadCompanyData()">
                                  <option value="-1"> Lütfen Firma Kodu Seçiniz </option>
                                  @if (!empty($companyList))
                                    @foreach ($companyList as $key => $value)
                                        <option value="{{$value->id}}">{{$value->companyCode}}  - {{$value->title}} </option>
                                    @endforeach
                                  @endif
                                </select>
                            </div>
                        </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-12 col-lg-8 ">
                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label font-semibold ">Kullanıcı Kodu</label>

                            <div class="col-md-12">
                                <input id="slug" type="text" class="form-control form-control-sm" name="slug" value="" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label font-semibold ">Kullanıcı Adı - Soyadı</label>
                            <div class="col-md-12">
                                <input id="" type="text" class="form-control form-control-sm" name="name" value="{{ old('name') }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label font-semibold ">Şifre</label>
                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control form-control-sm" name="password" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="telefon" class="col-md-4 control-label font-semibold ">Görev Tanımı</label>
                            <div class="col-md-12">
                                <input  type="text" class="form-control form-control-sm" name="unvan" value="{{ old('unvan') }}" >
                            </div>
                        </div>
                      </div>
                      <div class="col-lg-8  col-12">
                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label font-semibold ">E-Posta Adresi</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control form-control-sm" name="email" value="{{ old('email') }}" required>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="telefon" class="col-md-4 control-label font-semibold ">Kullanıcı Grubu</label>
                            <div class="col-md-12">
                                <input  type="text" class="form-control form-control-sm" name="groupId" value="" >
                            </div>
                        </div>
                      <div class="form-group">
                          <label for="telefon" class="col-md-4 control-label font-semibold ">Telefon No</label>
                          <div class="col-md-12">
                              <input  type="text" class="form-control form-control-sm" name="telefon" value="{{ old('telefon') }}" >
                          </div>
                      </div>
                      </div>
                  </div>
                  <div class="col-6 d-none">
                    {{ csrf_field() }}
                  <div class="col-12 bg-qpm-dark text-white p-2 ">Masraf Yeri Bilgileri</div>
                  <hr  />
                  <div class="form-group">
                      <label for="" class="col-md-12 control-label font-semibold ">Masraf Yeri</label>
                      <div class="col-md-12">
                        <select name="groupId"  id="parentId" class="select2 form-control" required style="width:100% !important">

                        </select>
                      </div>
                  </div>

                </div>
                <div class="col-12 col-lg-6">

                </div>

            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-primary">
                    Kullanıcı Kaydını Oluştur
                </button>
            </div>
        </div>
      </form>
    </div>
    </div>
@endsection


@section("style")
  	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection

@section('altscripts')
  <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script>

    $(function() {
        $('.select2').select2({
              placeholder: "LÜTFEN DEPARTMAN SEÇİNİZ"
        });
      });
    function loadCompanyData()
    {

          var firm=$("#firmCode").val();
          if (firm==0) { alert("Lütfen Firma Kodu Seçiniz");}
         $.ajax({
                url: "/satinalma/loadInformation",
                type: "post",
                data: {"firmcode":firm, "_token": "{{ csrf_token() }}"} ,
                beforeSend:function(x){
                  $("#parentId").children().remove();
                },
                success: function (response) {
                  $("#parentId").append(response);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                   console.log(textStatus, errorThrown);
                }
            });
    }



</script>
@endsection
