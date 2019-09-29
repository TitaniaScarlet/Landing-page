<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Menu extends Model
{
  protected $guarded = [];

  public function setSlugAttribute($value) {
  $this->attributes['slug'] = Str::slug(mb_substr($this->title, 0, 40) . "-" . \Carbon\Carbon::now()->format('dmyHi'), '-');
  }

  public function category()
 {
   return $this->belongsTo('App\Category');
 }
 public function baskets()
 {
   return $this->hasMany('App\Basket');
 }
}
