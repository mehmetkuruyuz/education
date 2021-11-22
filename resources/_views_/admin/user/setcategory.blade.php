@extends('user::admin.layout')
@section('content')
    <div class="row">
      <div class="col-sm-12 my-1">

      </div>
      <div class="col-sm-12 my-1">
        <div class="row">
          <div class="col-12 bg-white">
              <form action='/admin/user/savecategory' method="post">
                {{ csrf_field() }}
                <div class="form-group">
                  <div class="alert alert-danger">
                      Kullanıcı Bilgisi <strong> {{$userInf->name}} </strong> Kullanıcısına ilgili kategoriyi atama yapmak için lütfen kategoriyi seçiniz ve kaydı tamamlayınız.
                      <br />
                      Daha önce atama yapılmış ve video seyredilmiş ise tüm bilgiler silinecektir. Lütfen Dikkatli kullanınız.
                  </div>
                  <input type="hidden" name="userid"  value="{{$userInf->id}}" />
                  <label for="selecttypeer">Kategori</label>
                  <select name='kategoriid' class="form-control">
                    @foreach ($categoryList as $key => $value)
                      <option value="{{$value->id}}">{{$value->title}}</option>
                    @endforeach
                  </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
        </div>
      </div>
    </div>
@endsection
