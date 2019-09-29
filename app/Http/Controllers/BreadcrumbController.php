<?php

namespace App\Http\Controllers;

use App\Category;
use App\Menu;
use Illuminate\Http\Request;

class BreadcrumbController extends Controller
{
    public function category($slug) {
      $categories = Category::get();
      $category = Category::where('slug', $slug)->first();
      // $menus = Menu::get();
      $menus = Menu::where('category_id', $category->id)->get();

      return view('category', [
        'category' => $category,
        'menus' => $menus,
        'categories' => $categories
      ]);
    }
}
