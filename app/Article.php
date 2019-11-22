<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /*
    *   Alternatively, could return "slug" if you want to retrieve articles by "slug".
    *   There would have to be a slug attribute.
    */
    public function getRouteKeyName() {
        return parent::getRouteKeyName();
    }
}
