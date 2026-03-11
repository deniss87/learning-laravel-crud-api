<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Http\Resources\OrderResource;
use App\Http\Requests\OrderRequest;

class OrderController extends Controller
{
    public function store(OrderRequest $request)
    {
        $order = Order::create($request->validated());

        return (new OrderResource($order->load('customer')))
            ->response()
            ->setStatusCode(201);
    }
}
