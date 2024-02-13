<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $primaryKey = 'order_id';

    public static function boot()
    {
        parent::boot();

        // Format the updated_at timestamp without seconds
        static::saving(function ($model) {
            $model->updated_at = Carbon::now()->format('Y-m-d');
        });

    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function order_items(){
        return $this->hasMany('App\Models\OrderItem','order_id','order_id')->with('products');
    }
}
