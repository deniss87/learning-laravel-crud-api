<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use App\Http\Requests\CustomerRequest;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sort = $request->input('sort', 'created_at');
        $direction = $request->input('direction') === 'asc' ? 'asc' : 'desc';
        $search = $request->input('search');

        $customers = Customer::query()
          ->when($search, function ($query, $search) {

              $searchTerm = '%' . mb_strtolower($search, 'UTF-8') . '%';

              $query->where(function ($q) use ($searchTerm) {
                  $q->whereRaw('LOWER(first_name) LIKE ?', [$searchTerm])
                    ->orWhereRaw('LOWER(last_name) LIKE ?', [$searchTerm])
                    ->orWhereRaw('LOWER(email) LIKE ?', [$searchTerm])
                    ->orWhereRaw('phone LIKE ?', [$searchTerm]);
              });
          })
          ->orderBy($sort, $direction)
          ->paginate(10)
          ->withQueryString();

        if ($request->header('HX-Request')) {
            return view('customers._table', compact('customers', 'sort', 'direction', 'search'));
        }

        return view('customers.index', compact('customers', 'direction', 'sort', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerRequest $request)
    {
        Customer::create(array_merge($request->validated(), [
            'user_id' => Auth::id()
        ]));
        return redirect()->route('customers.index')->with('success', 'Customer created successfully!');
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
    public function edit(Customer $customer)
    {
        $this->authorize('update', $customer);

        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerRequest $request, Customer $customer)
    {
        $this->authorize('update', $customer);

        $customer->update($request->validated());
        return redirect()->route('customers.index')->with('success', 'Customer updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $this->authorize('delete', $customer);

        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully!');
    }
}
