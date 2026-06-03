<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;

class OrderItemController extends Controller
{
    public function index()
    {
        $orderItems = OrderItem::with('order', 'product')->get();
        return view('admin.order_items.index', compact('orderItems'));
    }
}