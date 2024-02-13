<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addtocart extends Model
{
    use HasFactory;

    protected $table ="addtocarts";

    public function products(){
        return $this->belongsTo('App\Models\Product', 'product_id')->with('product_images');
    }
}
