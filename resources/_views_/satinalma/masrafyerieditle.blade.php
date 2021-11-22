
{{csrf_field()}}
<input type="hidden" value="{{$data->id}}" name="id" />
<div class="row">
    <div class="col-12 col-lg-4">
      <div class="form-group my-0">
          <label class="smallx ml-3">Firma Bilgisi</label>
          <div class="col-md-12">
              <select name="firmCode"  class="selectmulti form-control" id="firmCode" required style="width:100% !important" onchange="loadCompanyData()">
                <option value="-1"> Lütfen Firma Kodu Seçiniz </option>
                @if (!empty($companyList))
                  @foreach ($companyList as $key => $value)
                      <option value="{{$value->id}}" @if ($data->companyId==$value->id) selected @endif>{{$value->companyCode}}  - {{$value->title}} </option>
                  @endforeach
                @endif
              </select>
          </div>
      </div>
      <div class="form-group" id="">
        <label class="smallx ml-3">Masraf Yeri Grup Kodu</label>
          <div class="col-md-12" id="parentXId" data-selected="{{$data->parentId}}" >

          </div>
      </div>
      <div class="form-group my-0">
        <label class="smallx ml-3">Masraf Yeri <small>(Kodu)</small></label>
          <div class="col-md-12">
              <input type="text" class="form-control" name="code"  value="{{$data->code}}"  required id="mastercode">
          </div>
      </div>
      <div class="form-group my-0">
        <label class="smallx ml-3">Masraf Yeri Adı</label>
          <div class="col-md-12">
              <input  type="text" class="form-control" name="title"  value="{{$data->title}}"  required>
          </div>
      </div>
      <div class="form-group my-0">
        <label class="smallx ml-3">Masraf Yeri Onaylayıcısı</label>
          <div class="col-md-12">
            <select name="masterUserId"  id="masterUserId" class="selectmulti form-control" required style="width:100% !important">
                @if (!empty($userList))
                  @foreach ($userList as $key => $value)
                        <option value="{{$value->id}}"  @if ($data->masterUserId==$value->id) selected @endif >{{$value->usercode}}  - {{$value->name}} </option>
                  @endforeach
                @endif
            </select>
          </div>
      </div>
      <div class="form-group d-none">
        <label class="smallx ml-3">Masraf Yeri Tanımlaması</label>
          <div class="col-md-12">
              <input  type="text" class="form-control" name="description">
          </div>
      </div>
      <div class="form-group d-none"  id="onaylayiciekrani">
        <div class="col-md-12 text-right">
             <button type="button" class="btn btn-success btn-sm" id="" onclick="yeniOnaylayiciEkle()">Masraf Yeri Ekle</button>
          </div>
      </div>
      <div class="form-check d-none my-2 ml-3">
        <input type="checkbox" class="form-check-input" id="exampleCheck1"  name="powerUp"  value="yes" @if($data->powerUp=="yes") checked @endif>
        <label class="form-check-label smallx" for="exampleCheck1">Bir Üst Onaylayıcıya Gönder</label>
      </div>
      <div class="form-group" id='onaylayicilar'>

      </div>
        <hr  />
    </div>
</div>

{{---}}

<div class="modal-footer justify-content-start">
<button type="submit" class="btn btn-danger">Kaydet</button>
</div>


@extends('layouts')
@section('content')

  <form class="w-100" method="POST" action="/tanimlama/masrafyeri/save" enctype="multipart/form-data">
      <div class="modal-body">
            {{csrf_field()}}
            <div class="row">
                <div class="col-12 col-lg-12">
                  <div class="form-group my-0">
                      <label for="" class="col-md-12 control-label font-semibold">Firma Bilgisi</label>
                      <div class="col-md-12">
                          <select name="firmCode"  class="selectmulti form-control" id="firmCode" required style="width:100% !important" onchange="loadCompanyData()">
                            <option value="-1"> Lütfen Firma Kodu Seçiniz </option>
                            @if (!empty($companyList))
                              @foreach ($companyList as $key => $value)
                                  <option value="{{$value->id}}" @if ($data->companyId==$value->id) selected @endif>{{$value->companyCode}}  - {{$value->title}} </option>
                              @endforeach
                            @endif
                          </select>
                      </div>
                  </div>
                  <div class="form-group" id="masterAllOfAction">
                      <label for="" class="col-md-12 control-label font-semibold">Masraf Yeri Grup Kodu</label>
                      <div class="col-md-12">
                        <select name="parentId"  id="parentId" class="selectmulti form-control" required style="width:100% !important" onchange="setMasterCode(this)">

                        </select>
                      </div>
                  </div>
                  <div class="form-group my-0">
                      <label for="" class="col-md-12 control-label font-semibold">Masraf Yeri <small>(Kodu)</small></label>
                      <div class="col-md-12">
                          <input type="text" class="form-control" name="code"  required id="mastercode">
                      </div>
                  </div>
                  <div class="form-group my-0">
                      <label for="" class="col-md-12 control-label font-semibold">Masraf Yeri Adı</label>
                      <div class="col-md-12">
                          <input  type="text" class="form-control" name="title"  required>
                      </div>
                  </div>

                  <div class="form-group d-none">
                      <label for="" class="col-md-12 control-label font-semibold">Masraf Yeri Tanımlaması</label>
                      <div class="col-md-12">
                          <input  type="text" class="form-control" name="description">
                      </div>
                  </div>
                  <div class="form-group d-none"  id="onaylayiciekrani">
                    <div class="col-md-12 text-right">
                         <button type="button" class="btn btn-success btn-sm" id="" onclick="yeniOnaylayiciEkle()">Masraf Yeri Ekle</button>
                      </div>
                  </div>
                  <div class="form-group" id='onaylayicilar'>

                  </div>
                    <hr  />
                </div>
            </div>

        <button type="submit" class="btn btn-danger">Kaydet</button>
    </form>

  @endsection

@section('altscripts')
  <script>
  $(document).ready(function(){
    var id={{$data->id}}
    loadCompanyData();

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
                  $("#parentId").append("<option value='0'>Ana Masraf Yeri</option>");
                  $("#parentId").append(response);

                  var dataid={{$data->parentId}}
                  $("#parentId").val(dataid).trigger('change');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                   console.log(textStatus, errorThrown);
                }
            });
    }

  </script>
@endsection
--}}
