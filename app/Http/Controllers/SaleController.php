<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaleRequest;
use App\Http\Resources\CustomerResource;
use App\Http\Resources\SaleResource;
use App\Models\Sale;
use App\Models\User;
use App\Services\SaleService;
use Inertia\Inertia;

class SaleController extends Controller
{
    public function index()
    {
        return Inertia::render('Model/Sale/Index', [
            'resources' => SaleResource::collection(Sale::all()),
        ]);
    }

    public function create()
    {
        return Inertia::render('Model/Sale/Create',[
            'payment_methods' => ['data'=>Sale::getPaymentMethods()],
        ]);
    }

    public function store(SaleRequest $request)
    {
        $sale = SaleService::create($request->validated());
        // dd($sale->load('items'));
        return back()->with('success', 'Sale created successfully..');
    }

    public function show(Sale $sale)
    {
        return new SaleResource($sale);
    }

    public function update(SaleRequest $request, Sale $sale)
    {
        $sale->update($request->validated());

        return new SaleResource($sale);
    }

    public function destroy(Sale $sale)
    {
        $sale->items()->delete();
        $sale->delete();

        return back()->with('success', 'Sale deleted successfully.');
    }
}
