@extends('admin.layout')
@section('content')

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Soru Oluştur</h4>
      </div>
      <div class="row">

        <form class="w-100 col-12 p-5" method="POST" action="/admin/question/add" enctype="multipart/form-data">
            {{csrf_field()}}
            <input type='hidden' value="{{$id}}" name="soruCategoryId" />
            <div class="form-group">
                <label for="email" class="col-md-4 control-label">Soru Başlığı</label>
                <div class="col-md-12">
                    <input id="" type="text" class="form-control" name="title" value="" required>
                </div>
            </div>

            <div class="form-group">
                <label for="description" class="col-md-4 control-label">Soru</label>

                <div class="col-md-12">
                    <input id="" type="text" class="form-control" name="description" value="" required>
                </div>
            </div>
            <div>

                Soru Kategorisi  <strong>{{$category->category->title}}</strong>
                <br  />
                Sınav Başlığı   <strong>{{$category->title}}</strong>
            </div>
            <hr />
            <div>
              Cevaplar
            </div>
            <div class="form-group">
              <button type="button" class="btn btn-success" onclick="newAnswerAdd()">Yeni Cevap Ekle</button>
              <table class="table">
                <thead>
                    <th>Cevap</th>
                    <th>Puan</th>
                    <th>Doğru Cevap mı?</th>
                    <th>Sil</th>
                </thead>
                <tbody id="newanswer">
                    <tr>
                      <td>
                        <input type="text" name="answer[]" value="" class="form-control" />
                      </td>
                      <td>
                        <input type="text" name="puan[]" value="" class="form-control" />
                      </td>
                      <td>
                          <select name="isCorrect[]" class="form-control">
                              <option value="no">Hayır</option>
                              <option value="yes">Evet</option>
                          </select>
                      </td>
                      <td>
                          <button type="button" class="btn btn-danger" onclick="deleteThis(this)">Sil</button>
                      </td>
                    </tr>
                </tbody>
              </table>
            </div>

              <div class="form-group">
                  <div class="col-md-6 col-md-offset-4">
                      <button type="submit" class="btn btn-primary">
                          Kaydet
                      </button>
                  </div>
              </div>

        </div>
    </div>
</div>
@endsection
@section("altscripts")
  <script>
      // Add the following code if you want the name of the file appear on select
      function newAnswerAdd()
      {
        $("#newanswer").append('<tr><td><input type="text" name="answer[]" value="" class="form-control" /></td><td><input type="text" name="puan[]" value="" class="form-control" /></td><td><select name="isCorrect[]" class="form-control"><option value="no">Hayır</option><option value="yes">Evet</option></select></td><td><button type="button" class="btn btn-danger" onclick="deleteThis(this)">Sil</button></td></tr>');
      }
      function deleteThis(t)
      {
        $(t).parent().parent().remove();
      }
  </script>
@endsection
