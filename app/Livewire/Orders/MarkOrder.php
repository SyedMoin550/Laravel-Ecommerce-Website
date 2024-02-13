<?php

namespace App\Livewire\Orders;

use Livewire\Component;

class MarkOrder extends Component
{

    public $order;
    public $selectedStatus;

    public function markOrder()
    {
        // You can access the selected status via $this->selectedStatus
        dd($this->selectedStatus);
    }


    public function render()
    {
        return view('livewire.orders.mark-order');
    }
}
