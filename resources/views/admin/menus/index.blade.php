@extends('admin.layouts.app_admin')

@section('content')
  <div class="container">
    @component('admin.components.breadcrumb')
      @slot('title') Список категорий @endslot
          @slot('active') Категории @endslot
          @endcomponent

          <hr>

          <a href="{{route('admin.menu.create')}}" class="btn btn-primary float-right" role="button"><i class="far fa-plus-square"> Создать категорию</i></a>
          <br><br><br>
          <table class="table table-striped">
            <thead>
              <th>Категория</th>
              <th>Наименование</th>
              <th>Ингредиенты</th>
              <th>Масса, г</th>
              <th>Количество, шт</th>
              <th>Цена, р</th>
              <th class="text-right">Действие</th>
            </thead>
            <tbody>
              @forelse ($menus as $menu)
                <tr>
                  <td>{{$menu->category->title}}</td>
                <td>{{$menu->title}}</td>
                <td>{{$menu->ingredients}}</td>
                <td>{{$menu->weight}}</td>
                <td>{{$menu->quantity}}</td>
                <td>{{$menu->price}}</td>
                <td class="text-right">
                  <form onsubmit="if(confirm('Удалить?')) {return true} else {return false}" action="{{route('admin.menu.destroy', $menu)}}" method="post">
                     <input type="hidden" name="_method" value="delete">
                     @csrf

                     <a href="{{route('admin.menu.edit', $menu)}}"><i class="far fa-edit"></i></a>

                     <button type="submit" class="btn"><i class="far fa-trash-alt"></i></button>
                  </form>

                </td>

                </tr>

              @empty
                <tr>
                  <td colspan="2" class="text-center"><h4>Данные отсутствуют</h4></td>
                </tr>
              @endforelse
            </tbody>
            <tfoot>
              <tr>
                <td colspan="7">
                  <ul class="pagination float-right">
                    {{$menus->links()}}
                  </ul>
                </td>
              </tr>
            </tfoot>
          </table>
        </div>
      @endsection
