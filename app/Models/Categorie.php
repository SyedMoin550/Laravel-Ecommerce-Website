<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;
    protected $table = "Categories";
    protected $primaryKey = "id";

    public function parentCategory(){
        return $this->hasOne('App\Models\Categorie','id','parent_id');
    }


    public function subCategories(){
        return $this->hasMany('App\Models\Categorie','parent_id');
    }

    public function products(){
        return $this->hasMany('App\Models\Product','category_id');
    }



}
