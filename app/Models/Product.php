<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table ="products";

    protected $fillable = [
        'category_id',
        'product_name',
        'slug',
        'brand',
        'desc',
        'details',
        'original_price',
        'salling_price',
        'quantity',
        'date'
    ];

    public function category(){
        return $this->belongsTo('App\Models\Categorie','category_id')->with('parentCategory'); //dusry Table ki foreign key jis ki base pr data fetch krna hy
    }

    public function getParentParentCategory(){
        return $this->belongsTo('App\Models\Categorie','category_id')->with(['parentCategory' => function($query){
            $query->with('parentCategory');
        }]); //dusry Table ki foreign key
    }


    public function product_images(){
        return $this->hasMany('App\Models\ProductImage','product_id','id'); //usi Table ki foreign key
    }

    // public function addtocart(){
    //     return $this->hasMany('App\Models\Addtocart','id');
    // }
}
