@extends('layouts')
@section('content')
  <style>
  th {font-size:0.8em !important;}
  td {font-size:0.8em !important;}
  </style>
<div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="card-title pl-1"><strong>Müşteri - Tedarikçi Tanımlama</strong> <a href='javascript:void(0)' class="btn btn-danger btn-sm float-right" data-toggle="modal" data-target="#tedarikci"><i class="fas fa-plus"></i>  Yeni Kayıt</a></div>
            <div class="row">

                <div class="col-md-12">
                  <form action="/tedarikci/list" method="post" >
                    {{csrf_field()}}

                    <div class="form-group row">
                      <div class="col-sm-2">
                        <label for="staticEmail" class="col-auto col-form-label smallx  ml-0 pl-1">Firma Kodu</label>
                        <input type="text" class="form-control" id="" value=""  name="firmakodu"  />
                      </div>
                      <div class="col-sm-3">
                        <label for="s" class="col-auto col-form-label smallx  ml-0 pl-1">Firma Adı</label>
                        <input type="text" class="form-control" id="" value=""  name="firmaadi"  />
                      </div>
                      <div class="col-sm-2">
                        <label for="s" class="col-auto col-form-label smallx  ml-0 pl-1">İl</label>
                        <select name="sehir" class="form-control" id="searchil" onchange="selectSubSk()">
                          <option value="-1">
                            Seçiniz
                          </option>
                            @if(!empty($sehir))
                              @foreach ($sehir as $key => $value)
                                <option value="{{$value->sehir_key}}">
                                    {{$value->sehir_title}}
                                </option>
                              @endforeach
                            @endif
                        </select>
                      </div>
                      <div class="col-sm-2">
                        <label for="s" class="col-auto col-form-label smallx  ml-0 pl-1">İlçe</label>
                        <select name="searchilce" class="form-control" id="searchilce">
                            <option value="-1">Lütfen Şehri Seçiniz</option>
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
                          <th>Firma Kodu</th>
                          <th>Firma Türü</th>
                          <th>Firma Adı</th>
                          <th>Firma Ticari Ünvanı</th>
                          <th>İl</th>
                          <th>İlçe</th>
                          <th class="text-center">İşlemler</th>
                      </tr>
                    </thead>
                  @if (!empty($list))
                    <tbody>
                      @foreach ($list as $key => $value)
                      <tr>
                        <td>{{$value->firmakodu}}</td>
                        <td>{{$value->firmaturu}}</td>
                        <td>{{$value->firmaadi}}</td>
                        <td>{{$value->firmaticariunvani}}</td>
                        <td>{{Helper::SehirBul($value->sehir)}}</td>
                        <td>{{Helper::IlceBul($value->ilce)}}</td>
                        <td class="px-0" style="width:150px;">
                          <a href='/tedarikci/yetkili/{{$value->id}}' class="text-danger mx-3"><i class="fa fa-plus" style="font-size:0.7em"></i><i class="fa fa-user"></i></a>
                          <a href='javascript:void(0)' onclick="edit({{$value->id}})"  class="text-danger mx-3"><i class="fa fa-edit"></i></a>
                          <a href='/tedarikci/delete/{{$value->id}}' onclick="return confirm('Silmek İstediğinize Emin misiniz?')" class="text-danger  mx-3"><i class="fa fa-times"></i></a>
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
<div class="modal" tabindex="-1" role="dialog" id="tedarikci">
  <div class="modal-dialog modal-xxl" role="document">
    <div class="modal-content">
      <div class="modal-header  bg-qpm-dark text-white">
        <span class="modal-title ml-1 pl-1"> Müşteri - Tedarikçi Tanımlamaları</span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="w-100 row" method="POST"  action="/tedarikci/save" id="actionX">

          {{csrf_field()}}
                <div class="col-12 col-lg-4">
                          <div class="form-group my-0">
                            <label class="smallx ml-3">Firma Kodu</label>
                            <div class="col-md-12">
                                <input id="" type="text" class="form-control" name="firmakodu">
                            </div>
                        </div>
                          <div class="form-group my-0">
                            <label class="smallx ml-3">Firma Türü</label>
                            <div class="col-md-12">
                                <select name="firmaturu" class="form-control">
                                  <option value="Müşteri">Müşteri</option>
                                  <option value="Tedarikçi">Tedarikçi</option>
                                  <option value="Müşteri ve Tedarikçi">Müşteri ve Tedarikçi</option>
                                </select>
                            </div>
                        </div>
                          <div class="form-group my-0">
                            <label class="smallx ml-3">Firma Adı</label>
                            <div class="col-md-12">
                                <input id="" type="text" class="form-control" name="firmaadi">
                            </div>
                        </div>
                          <div class="form-group my-0">
                            <label class="smallx ml-3">Firma Ticari Unvanı</label>
                            <div class="col-md-12">
                                <input id="" type="text" class="form-control" name="firmaticariunvani">
                            </div>
                        </div>
                          <div class="form-group my-0">
                            <label class="smallx ml-3">Adres</label>
                            <div class="col-md-12">
                                <input id="" type="text" class="form-control" name="adres">
                            </div>
                        </div>
                          <div class="form-group my-0">
                            <label class="smallx ml-3">İl</label>
                            <div class="col-md-12">
                                <select name="sehir" class="form-control" id="sehir" onchange="selectSub()">
                                  <option value="-1">
                                    Seçiniz
                                  </option>
                                    @if(!empty($sehir))
                                      @foreach ($sehir as $key => $value)
                                        <option value="{{$value->sehir_key}}">
                                            {{$value->sehir_title}}
                                        </option>
                                      @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                          <div class="form-group my-0">
                            <label class="smallx ml-3">İlçe</label>
                            <div class="col-md-12">
                                <select name="ilce" class="form-control" id="ilce">
                                    <option value="-1">Lütfen Şehri Seçiniz</option>
                                </select>
                            </div>
                        </div>
                  </div>
                    <div class="col-12 col-lg-4">

                          <div class="form-group my-0">
                            <label class="smallx ml-3">Telefon Numarası</label>
                            <div class="col-md-12">
                                <input id="" type="text" class="form-control" name="telefon">
                            </div>
                        </div>
                          <div class="form-group my-0">
                            <label class="smallx ml-3">Fax Numarası</label>
                            <div class="col-md-12">
                                <input id="" type="text" class="form-control" name="fax">
                            </div>
                        </div>
                          <div class="form-group my-0">
                            <label class="smallx ml-3">Mail Adresi</label>
                            <div class="col-md-12">
                                <input id="" type="text" class="form-control" name="email">
                            </div>
                        </div>
                          <div class="form-group my-0">
                            <label class="smallx ml-3">Web Adresi</label>
                            <div class="col-md-12">
                                <input id="" type="text" class="form-control" name="webadresi">
                            </div>
                        </div>
                          <div class="form-group my-0">
                            <label class="smallx ml-3">Sektör </label>
                            <div class="col-md-12">
                                <select name="sektor" class="form-control">
                                  @if (!empty($sektor))
                                    @foreach ($sektor as $key => $value)
                                        <option value="{{$value->id}}">{{$value->title}}</option>
                                    @endforeach
                                  @endif
                                </select>
                            </div>
                        </div>
                          <div class="form-group my-0">
                            <label class="smallx ml-3">Vergi Dairesi</label>
                            <div class="col-md-12">
                                <input id="" type="text" class="form-control" name="vergidairesi">
                            </div>
                        </div>
                          <div class="form-group my-0">
                            <label class="smallx ml-3">Vergi No</label>
                            <div class="col-md-12">
                                <input id="" type="text" class="form-control" name="vergino">
                            </div>
                        </div>

                        </div>
                  </div>
                  <div class="form-group m-3">
                      <button class="btn btn-danger ml-3" type="submit">Kaydet</button>
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

<div class="modal" tabindex="-1" role="dialog" id="yetkili" >
  <div class="modal-dialog modal-xxl" role="document">
    <div class="modal-content" id="yetkilidata">

    </div>
  </div>
</div>

@endsection
@section("altscripts")
<script>

  function selectSub()
  {
    var id=$("#sehir").val();
    $.ajax({
           url: "/sehir/"+id,
           beforeSend:function(x){
             $("#ilce").children().remove();
           },
           success: function (response) {
             $("#ilce").append(response);
           },
           error: function(jqXHR, textStatus, errorThrown) {
              console.log(textStatus, errorThrown);
           }
       });

  }
  function selectSSub()
  {
    var id=$("#sehirs").val();
    $.ajax({
           url: "/sehir/"+id,
           beforeSend:function(x){
             $("#ilces").children().remove();
           },
           success: function (response) {

             $("#ilces").append(response);
             if ($("#ilces").data("selected")!=-1)
             {
               $("#ilces").val($("#ilces").data("selected"));
               $("#ilces").data("selected",-1);
             }
           },
           error: function(jqXHR, textStatus, errorThrown) {
              console.log(textStatus, errorThrown);
           }
       });

  }




  function selectSubSk()
  {
    var id=$("#searchil").val();
    $.ajax({
           url: "/sehir/"+id,
           beforeSend:function(x){
             $("#searchilce").children().remove();
           },
           success: function (response) {

             $("#searchilce").append(response);

           },
           error: function(jqXHR, textStatus, errorThrown) {
              console.log(textStatus, errorThrown);
           }
       });

  }

  function edit(id)
  {
    $.ajax({
           url: "/tedarikci/edit/"+id,
           beforeSend:function(x){
              $("#edit").children().remove();
           },
           success: function (response) {
             $("#edit").append(response);
              selectSSub();
             $("#editmodal").modal();
           },
           error: function(jqXHR, textStatus, errorThrown) {
              console.log(textStatus, errorThrown);
           }
       });
  }
  function yetkili(id)
  {


    $.ajax({
           url: "/tedarikci/yetkili/"+id,
           beforeSend:function(x){
              $("#yetkilidata").children().remove();
           },
           success: function (response) {
             $("#yetkilidata").append(response);
             $("#yetkili").modal();
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
