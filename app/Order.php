<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    /**
     * Get the items for the order
     */
    public function items()
    {
        return $this->hasMany('App\Item');
    }
}
