<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        // return view('dashboard', compact('stats'));

        return Inertia::render('Dashboard', [
            'stats' => [
                'total_customers' => Customer::count(),
                'total_orders' => Order::count(),
                'revenue' => Order::where('status', 'completed')->sum('total_amount'),
            ]
        ]);
    }
}
