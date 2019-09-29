@extends('admin.layouts.app_admin')

@section('content')

  <div class="container">

    @component('admin.components.breadcrumb')
      @slot('title')Создание категориии меню@endslot
          @slot('active')Меню@endslot
          @endcomponent

          <form class="form-horizontal" action="{{route('admin.menu.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            @include('admin.menus.partials.form')
          </form>

        </div>

      @endsection
