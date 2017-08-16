<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['order_id', 'item_name', 'quantity'];
    
    /**
     * Get the order that owns the item.
     */
    public function order()
    {
        return $this->belongsTo('App\Order');
    }
}
