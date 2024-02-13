<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class card extends Component
{
    /**
     * Create a new component instance.
     */

     public $title;
     public $price;
     public $img;
     public $originalPrice;
    public $discount;
     public function __construct($title,$price,$img,$originalPrice,$discount)
     {
         $this->title= $title;
         $this->price= $price;
         $this->img= $img;
         $this->originalPrice= $originalPrice;
         $this->discount= $discount;

        //  $this->original_price = $original_price;
        //  $this->discount = $discount;
     }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.card');
    }
}
