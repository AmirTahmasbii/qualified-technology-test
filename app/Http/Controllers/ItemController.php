<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Item\ItemStoreRequest;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $items = Item::paginate(10);

        if ($request->wantsJson()) {
            return response()->json($items);
        }
        
        return inertia('Item/Index', ['items' => $items]);
    }

    public function create()
    {
        return inertia('Item/Create');
    }

    public function store(ItemStoreRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('images', 'public');
        }

        $item = Item::create($validated);
        $item->addMedia($validated['image'])
        ->toMediaCollection();

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Item created successfully']);
        }

        return redirect()->route('items.index')->with('success', 'Item created successfully');
    }
}
