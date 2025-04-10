<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = ['order_id', 'food_id', 'soluong', 'tongtien'];

    public function food()
    {
        return $this->belongsTo(Food::class);
    }
    //
}
