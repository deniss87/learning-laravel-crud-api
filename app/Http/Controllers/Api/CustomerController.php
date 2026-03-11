<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Http\Resources\CustomerResource;
use App\Http\Resources\OrderResource;

class CustomerController extends Controller
{
    public function index()
    {
        // return all customers
        $customers = Customer::orderBy('last_name')->get();
        return CustomerResource::collection($customers);
    }

    public function orders(Customer $customer)
    {
        // return orders for a specific customer
        $orders = $customer->orders()
            ->with('customer')
            ->latest()
            ->get();
        return OrderResource::collection($orders);
    }
}
