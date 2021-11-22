
    <form class="w-100" method="POST" action="/update/education/category">
        {{csrf_field()}}
        <input type="hidden" name="id" value="{{$data->id}}" />
        <div class="form-group">
            <label for="email" class="col-md-4 control-label">Eğitim Grubu Adı</label>

            <div class="col-md-12">
                <input id="" type="text" class="form-control" name="title" value="{{$data->title}}" required>
            </div>
        </div>
        <div class="form-group">
            <label for="açıklama" class="col-md-4 control-label">Eğitim Grubu Açıklaması</label>

            <div class="col-md-12">
                <textarea name="description" class="form-control border">{{$data->description}}</textarea>
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
