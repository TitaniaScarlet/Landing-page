<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    protected $guarded = [];

    public function menu()
   {
     return $this->belongsTo('App\Menu');
   }
}
