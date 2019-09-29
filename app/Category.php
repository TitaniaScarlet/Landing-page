<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
  protected $guarded = [];

  public function setSlugAttribute($value) {
  $this->attributes['slug'] = Str::slug(mb_substr($this->title, 0, 40) . "-" . \Carbon\Carbon::now()->format('dmyHi'), '-');
  }

  public function menus()
  {
    return $this->hasMany('App\Menu');
  }
}
