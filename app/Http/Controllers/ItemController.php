<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemRequest;
use App\Http\Resources\ItemResource;
use App\Models\Item;
use Inertia\Inertia;

class ItemController extends Controller
{
    public function index()
    {
        $items =  ItemResource::collection(Item::paginate(10));
        return Inertia::render('Model/Item/Index',[
            'resources' => $items,
        ]);
    }

    public function create()
    {
        return Inertia::render('Model/Item/Create',[
            
        ]);
    }

    public function store(ItemRequest $request)
    {
        $item = Item::create($request->validated());

        return back()->with('success', 'Item stored.');
    }

    public function show(Item $item)
    {
        return new ItemResource($item);
    }

    public function update(ItemRequest $request, Item $item)
    {
        $item->update($request->validated());

        return new ItemResource($item);
    }

    public function destroy(Item $item)
    {
        $item->delete();

        return back()->with('success', 'Item deleted.');
    }
}
