<?php

namespace App\Http\Controllers;

use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $value = $request->input('search');
        $customers = Customer::query()
            ->where('name', 'like', "$value%")
            ->limit(10)
            ->get();

        return CustomerResource::collection($customers);
    }

    public function store(Request $request)
    {
        $customer_details = $request->validate([
            'name' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:50',
            'phone' => 'required|string|max:20',
        ]);
        $customer = Customer::create($customer_details);
        return new CustomerResource($customer);
    }
}
