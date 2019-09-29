@extends('admin.layouts.app_admin')

@section('content')

  <div class="container">

    @component('admin.components.breadcrumb')
      @slot('title')Редактирование категориии меню@endslot
        {{-- @slot('parent')Главная@endslot --}}
          @slot('active')Меню@endslot
          @endcomponent

          <form class="form-horizontal" action="{{route('admin.menu.update', $menu)}}" method="post"  enctype="multipart/form-data">
            @method('PUT')
            @csrf
            @include('admin.menus.partials.form')
          </form>
        </div>
      @endsection
