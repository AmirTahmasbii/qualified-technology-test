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
        $items = Item::with('media')->latest()->paginate(10);

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

        $item = Item::create([
            'title' => $validated['title'],
            'description' => $validated['description']
        ]);

        if ($request->hasFile('image')) {
            $item->addMediaFromRequest('image')->toMediaCollection();
        }

        return redirect()->route('items.index');
    }

    public function edit(Item $item)
    {
        $item->load('media');
        return inertia('Item/Edit', [
            'item' => $item,
        ]);
    }

    public function update(ItemStoreRequest $request, Item $item)
    {
        $validated = $request->validated();

        $item->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
        ]);

        if ($request->hasFile('image')) {
            $item->clearMediaCollection();
            $item->addMediaFromRequest('image')->toMediaCollection();
        }

        return redirect()->route('items.index');
    }

    public function destroy(Item $item)
    {
        $item->delete();

        return response()->noContent();
    }
}
