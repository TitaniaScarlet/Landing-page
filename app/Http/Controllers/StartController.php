<?php

namespace App\Http\Controllers;

use App\Category;
use App\Menu;
use Illuminate\Http\Request;

class StartController extends Controller
{
  function start () {
    $categories = Category::get();
     $category = Category::first();
    // $menus = Menu::get();
    $menus = Menu::where('category_id', $category->id)->get();

      return view('category', [
        'categories' => $categories,
        'category' => $category,
        'menus' => $menus,
      ]);
}
}
