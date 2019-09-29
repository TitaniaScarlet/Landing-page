<div class="row">
  <div class="col-sm-6">
    <label for="">Наименование</label>
    <input type="text" class="form-control" name="title" placeholder="Заголовок меню" value="{{$menu->title ?? ""}}" required>
  </div>
<div class="col-sm-4">
  <label for="">Категория</label>
  <select class="form-control" name="category_id">
    @foreach ($categories as $category)
      <option value="{{$category->id ?? ""}}"
            @isset($menu->category_id)
              @if ($menu->category_id == $category->id)
          selected=""
              @endif
        @endisset
        >{{$category->title ?? ""}}</option>
    @endforeach
      </select>
</div>
<div class="col-sm-2">
    <label for="">Slug</label>
    <input type="text" class="form-control" name="slug" placeholder="Автоматическая генерация" value="{{$menu->slug ?? ""}}" readonly="">
</div>
</div>

<div class="row">
  <div class="col-sm-4">
    <label for="">Вес, г</label>
    <input type="text" class="form-control" name="weight" placeholder="Вес" value="{{$menu->weight ?? ""}}">
  </div>
  <div class="col-sm-4">
    <label for="">Количество, шт</label>
    <input type="text" class="form-control" name="quantity" placeholder="Количество" value="{{$menu->quantity ?? ""}}">
  </div>
  <div class="col-sm-4">
    <label for="">Цена, р</label>
    <input type="text" class="form-control" name="price" placeholder="Цена" value="{{$menu->price ?? ""}}" required>
  </div>
</div>

<div class="row">
  <div class="col-sm-10">
    <label for="">Ингредиенты</label>
    <textarea class="form-control"  name="ingredients" rows="3" cols="20">{{$menu->ingredients ?? ""}}</textarea>
  </div>
  <div class="col-sm-2">
    <label for="" class="text-center">Фотография</label>
    <input type="file"  name="image" class="form-control-file">
  </div>
</div>

<br>

<input class="btn btn-primary" type="submit"  value="Сохранить">
