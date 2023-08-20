<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Http\Resources\IdLabelResource;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Services\ItemService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with('creator:id,username')->paginate();
        return Inertia::render('Model/Order/Index', [
            'resources' => $orders
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = IdLabelResource::collection(Product::all());
        $brands = IdLabelResource::collection(Brand::all());
        $suppliers = IdLabelResource::collection(User::role('supplier')->get());
        return Inertia::render('Model/Order/Create', [
            'products' => $products,
            'brands' => $brands,
            'suppliers' => $suppliers
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderRequest $request)
    {
        $order = Order::make($request->validated());
        $order->creator()->associate(auth()->user());
        $order->calculate(collect($request->input('items')));
        $order->save();
        ItemService::createMany($order, collect($request->input('items')));
        return to_route('order.index')->with('success', 'Order created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return $order->load('items');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->items()->delete();
        $order->delete();
        return to_route('order.index')->with('success', 'Order deleted.');
    }

    public function destroy_all(array $ids)
    {
        Order::whereIn('id', $ids)->delete();
        return to_route('order.index')->with('success', 'Orders deleted.');
    }
}
