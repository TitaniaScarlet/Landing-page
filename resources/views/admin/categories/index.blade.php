@extends('admin.layouts.app_admin')

@section('content')
  <div class="container">
    @component('admin.components.breadcrumb')
      @slot('title') Список категорий @endslot
          @slot('active') Категории @endslot
          @endcomponent

          <hr>

          <a href="{{route('admin.category.create')}}" class="btn btn-primary float-right" role="button"><i class="far fa-plus-square"> Создать категорию</i></a>
          <br><br><br>
          <table class="table table-striped">
            <thead>
              <th>Наименование</th>
              <th class="text-right">Действие</th>
            </thead>
            <tbody>
              @forelse ($categories as $category)
                <tr>
                <td>{{$category->title}}</td>
                <td class="text-right">
                  <form onsubmit="if(confirm('Удалить?')) {return true} else {return false}" action="{{route('admin.category.destroy', $category)}}" method="post">
                     <input type="hidden" name="_method" value="delete">
                     @csrf

                     <a href="{{route('admin.category.edit', $category)}}"><i class="far fa-edit"></i></a>

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
                <td colspan="2">
                  <ul class="pagination float-right">
                    {{$categories->links()}}
                  </ul>
                </td>
              </tr>
            </tfoot>
          </table>
        </div>
      @endsection
