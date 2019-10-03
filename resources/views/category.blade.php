@extends('layouts.my_app')

@section('content')
  <div class="container">
    <nav class="navbar navbar-expand-lg navbar-inverse navbar-menu">
<button type="button" class="btn navbar-toggler button-basket btn-secondary" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
  <span><i class="fas fa-bars"></i></span>
</button>
<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
  <ul class="navbar-nav mr-auto">
  @foreach ($categories as $category_list)
    @if ($category_list == $category)
      <li class="nav-item active"><a class="mine nav-link"  href="{{route('category', $category_list->slug)}}">{{$category->title}}</a></li>
    @else
      <li class="nav-item"><a class="mine nav-link" href="{{route('category', $category_list->slug)}}">{{$category_list->title}}</a></li>
    @endif
  @endforeach
</ul>
</div>
<button type="button" class="btn button-basket btn-secondary float-right" data-toggle="modal" data-target="#exampleModalCenter">
<i class="fas fa-shopping-basket"></i></button>
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Корзина</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <basket-component></basket-component>
      </div>
    </div>
  </div>
</div>
  </nav>

      <br>
      <div class="row">
        @foreach ($menus as $menu)
          <div class="col-lg-3 col-md-4 col-sm-6 ">
            <div class="card card h-100 centered" style="width: 15rem;">
              <img class="card-img-top"  src="{{asset('/storage/' . $menu->image)}}"  alt="Card image cap">
              <div class="main card-body">
                <h5 class="card-title">{{$menu->title}}</h5>
                <div class="row">
                  <div class="col-sm-6">
                    <h4 class="card-text text-left">{{$menu->price}}р</h4>
                  </div>
                  @if ($menu->weight && $menu->quantity)
                    <div class="col-sm-6">
                      <p class="card-text text-right">{{$menu->weight}}г | {{$menu->quantity}}шт</p>
                    </div>
                  @elseif ($menu->weight)
                    <div class="col-sm-6">
                      <p class="card-text text-right">{{$menu->weight}}г</p>
                    </div>
                  @elseif ($menu->quantity)
                    <div class="col-sm-6">
                      <p class="card-text text-right">{{$menu->quantity}}шт</p>
                    </div>
                  @endif
                  <p class="card-text text-left">{{$menu->ingredients}}</p>

                </div>
              </div>
              <div class="card-footer">
                <form class="form-horizontal" action="{{route('basket.store')}}" method="post">
                  @csrf
                  <input type="hidden" name="category" value="{{$category->slug}}">
                  <input type="hidden" name="slug" value="{{$menu->slug}}">
                   <input class="btn btn-block btn-secondary button-basket" type="submit"  value="В корзину">

                </form>

</div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  @endsection
