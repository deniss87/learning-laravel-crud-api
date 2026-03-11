<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'customers_count' => Customer::count(),
            'orders_count'    => Order::count(),
            'total_revenue'   => Order::where('status', 'completed')->sum('total_amount'),
        ];

        return view('dashboard', compact('stats'));
    }
}
