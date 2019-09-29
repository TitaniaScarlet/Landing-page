<?php

namespace App\Http\Controllers\Admin;

use App\Menu;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.menus.index', [
          'menus' => Menu::paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.menus.create', [
          'menu' => [],
          'categories' => Category::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      if ($request->file('image')) {
        $image = $request->file('image')->store('menus', 'public');
      $menu = Menu::create([
  'title' => $request->title,
  'image' => $image,
  'category_id' => $request->category_id,
  'slug' => $request->slug,
  'weight' => $request->weight,
  'quantity' => $request->quantity,
  'price' => $request->price,
  'ingredients' => $request->ingredients
        ]);
      }
  else {
    $menu = Menu::create($request->all());
  }
  return redirect()->route('admin.menu.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        return view('admin.menus.edit', [
          'menu' => $menu,
          'categories' => Category::get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
      if ($request->file('image')) {
        Storage::disk('public')->delete($menu->image);
        $image = $request->file('image')->store('menus', 'public');
       $menu->image = $image;
       }
       $menu->title = $request->title;
       $menu->category_id = $request->category_id;
       $menu->weight = $request->weight;
       $menu->quantity = $request->quantity;
       $menu->price = $request->price;
       $menu->ingredients = $request->ingredients;
       $menu->save();



      // $menu->update($request->except('slug'));
      return redirect()->route('admin.menu.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
      Storage::disk('public')->delete($menu->image);
        $menu->delete();
        return redirect()->route('admin.menu.index');

    }
}
