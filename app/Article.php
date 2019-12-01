<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    // makes sure only certain fields can be externally set from a form.
    protected $fillable = ['title', 'excerpt', 'body'];

    /*
    *   Alternatively, could return "slug" if you want to retrieve articles by "slug".
    *   There would have to be a slug attribute.
    */
    public function getRouteKeyName() {
        return parent::getRouteKeyName();
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
