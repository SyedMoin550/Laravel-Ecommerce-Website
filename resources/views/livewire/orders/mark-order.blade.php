{{-- <h5>
    Mark Order <span class="badge bg-success float-end">{{$order->status}}</span>
    <Select class="form-select mt-3" wire:change="markOrder()">
        <option value="In Progress" {{$order->status == "In Progress" ? 'selected': ''}}>In Progress</option>
        <option value="Shipped" {{$order->status == "Shipped" ? 'selected': ''}}>Shipped</option>
        <option value="Delivered" {{$order->status == "Delivered" ? 'selected': ''}}>Delivered</option>
        <option value="Cancelled" {{$order->status == "Cancelled" ? 'selected': ''}}>Cancelled</option>
    </Select>
</h5> --}}
<h5>
    Mark Order <span class="badge bg-success float-end"></span>
    <select class="form-select mt-3" wire:model="selectedStatus">
        <option value="In Progress">In Progress</option>
        <option value="Shipped">Shipped</option>
        <option value="Delivered">Delivered</option>
        <option value="Cancelled">Cancelled</option>
    </select>
</h5>
