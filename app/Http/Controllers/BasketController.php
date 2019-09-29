<?php

namespace App\Http\Controllers;

use App\Basket;
use App\Menu;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('baskets.index', [
          'baskets' => Basket::get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      if ($request->session()->exists('slug')) {
        $slugs = $request->session()->get('slug');
        $orders = [];
foreach ($slugs as $slug) {
  $menu = Menu::where('slug', $slug)->first();
   array_push( $orders, array(
     "title" => $menu->title,
     "price" => $menu->price,
     "quantity" => 1,
     "sum" =>  $menu->price
   )
 );
}
         return [
          'orders' => $orders,
        ];
      }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $request->session()->push('slug', $request->slug);
        return redirect()->route('category', $request->category);
    }

    public function order(Request $request) {
      $orders = $request->orders;
      array_push( $orders, array($request->name, $request->code, $request->tel));

      define('TELEGRAM_TOKEN', '971962607:AAEsp7uiOAsLqXNtKnKIB779C0AhEU5F2TA');
      define('TELEGRAM_CHATID', '603349067');
      $ch = curl_init();
       curl_setopt_array(
           $ch,
           array(
               CURLOPT_URL => 'https://api.telegram.org/bot' . TELEGRAM_TOKEN . '/sendMessage',
               CURLOPT_POST => TRUE,
               CURLOPT_RETURNTRANSFER => TRUE,
               CURLOPT_TIMEOUT => 10,
               CURLOPT_POSTFIELDS => array(
                   'chat_id' => TELEGRAM_CHATID,
                   'text' => json_encode($orders,  JSON_UNESCAPED_UNICODE)
               ),
           )
       );
       curl_exec($ch);
$request->session()->forget('slug');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Basket  $basket
     * @return \Illuminate\Http\Response
     */
    public function show(Basket $basket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Basket  $basket
     * @return \Illuminate\Http\Response
     */
    public function edit(Basket $basket)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Basket  $basket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Basket $basket)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Basket  $basket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Basket $basket)
    {
        //
    }
}
