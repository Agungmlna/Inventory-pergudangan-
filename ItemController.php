<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $items = Item::query()
            ->when($request->search, fn ($q, $s) => $q->where(function ($q) use ($s) {
                $q->where('name', 'like', "%$s%")
                  ->orWhere('code', 'like', "%$s%")
                  ->orWhere('category', 'like', "%$s%");
            }))
            ->orderBy('name')
            ->paginate(15)
            ->withQueryString();

        return view('items.index', compact('items'));
    }

    public function create()
    {
        return view('items.form', ['item' => new Item()]);
    }

    public function store(Request $request)
    {
        $item = Item::create($this->validated($request));

        return redirect()->route('items.show', $item)->with('success', 'Barang berhasil ditambahkan.');
    }

    public function show(Item $item)
    {
        $item->load('movements');

        return view('items.show', compact('item'));
    }

    public function edit(Item $item)
    {
        return view('items.form', compact('item'));
    }

    public function update(Request $request, Item $item)
    {
        $item->update($this->validated($request, $item));

        return redirect()->route('items.show', $item)->with('success', 'Barang berhasil diperbarui.');
    }

    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()->route('items.index')->with('success', 'Barang berhasil dihapus.');
    }

    private function validated(Request $request, ?Item $item = null): array
    {
        $unique = 'unique:items,code' . ($item ? ',' . $item->id : '');

        return $request->validate([
            'code' => ['required', 'string', 'max:50', $unique],
            'name' => ['required', 'string', 'max:150'],
            'category' => ['nullable', 'string', 'max:100'],
            'unit' => ['required', 'string', 'max:20'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'min_stock' => ['required', 'integer', 'min:0'],
        ]);
    }
}
