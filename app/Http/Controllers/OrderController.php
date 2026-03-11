<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\Customer;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sort = $request->input('sort', 'created_at');
        $direction = $request->input('direction') === 'asc' ? 'asc' : 'desc';
        $search = $request->input('search');
        $selectedStatuses = $request->input('statuses', []);
        $dateFrom = $request->input('date_from');
        $dateTo = $request->input('date_to');

        $query = Order::query()->with('customer');

        // 1. Live search (by order number or client name)
        if ($search) {
            $searchTerm = '%' . mb_strtolower($search, 'UTF-8') . '%';
            $query->where(function ($q) use ($searchTerm) {
                $q->whereRaw('LOWER(order_number) LIKE ?', [$searchTerm])
                  ->orWhereHas('customer', function ($q) use ($searchTerm) {
                      $q->whereRaw('LOWER(first_name) LIKE ?', [$searchTerm])
                        ->orWhereRaw('LOWER(last_name) LIKE ?', [$searchTerm]);
                  });
            });
        }

        // 2. Filter by status
        $query->when($selectedStatuses, function ($q) use ($selectedStatuses) {
            $q->whereIn('status', $selectedStatuses);
        });

        // 3. Filter by dates
        $query->when($dateFrom, fn($q) => $q->whereDate('created_at', '>=', $dateFrom));
        $query->when($dateTo, fn($q) => $q->whereDate('created_at', '<=', $dateTo));

        // 4. Sorting
        if ($sort === 'customer') {
            $query->join('customers', 'orders.customer_id', '=', 'customers.id')
                  ->orderBy('customers.last_name', $direction)
                  ->select('orders.*');
        } else {
            $query->orderBy($sort, $direction);
        }

        $orders = $orders = $query->paginate(10)->withQueryString();

        $data = compact('orders', 'sort', 'direction', 'search', 'selectedStatuses', 'dateFrom', 'dateTo');

        if ($request->header('HX-Request')) {
            return view('orders._table', $data);
        }

        return view('orders.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::orderBy('last_name')->get();

        return view('orders.create', compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderRequest $request)
    {
        Order::create(array_merge($request->validated(), [
            'user_id' => Auth::id()
        ]));

        return redirect()
            ->route('orders.index')
            ->with('success', 'Order created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $this->authorize('update', $order);
        $customers = Customer::orderBy('last_name')->get();

        return view('orders.edit', compact('order', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OrderRequest $request, Order $order)
    {
        $this->authorize('update', $order);
        $order->update($request->validated());

        return redirect()->route('orders.index')->with('success', 'Order updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $this->authorize('delete', $order);

        $orderNumber = $order->order_number;
        $order->delete();

        return redirect()
            ->route('orders.index')
            ->with('success', "Order #{$orderNumber} deleted successfully!");
    }
}
