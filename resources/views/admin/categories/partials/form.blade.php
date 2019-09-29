

<label for="">Наименование</label>
<input type="text" class="form-control" name="title" placeholder="Заголовок категориии" value="{{$category->title ?? ""}}" required>

<label for="">Slug</label>
<input type="text" class="form-control" name="slug" placeholder="Автоматическая генерация" value="{{$category->slug ?? ""}}" readonly="">


<br>

<input class="btn btn-primary" type="submit"  value="Сохранить">
