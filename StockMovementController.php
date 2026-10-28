<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\StockMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class StockMovementController extends Controller
{
    public function store(Request $request, Item $item)
    {
        $data = $request->validate([
            'type' => ['required', 'in:in,out'],
            'quantity' => ['required', 'integer', 'min:1'],
            'note' => ['nullable', 'string', 'max:255'],
        ]);

        DB::transaction(function () use ($item, $data) {
            // Kunci baris agar stok tidak salah saat ada transaksi bersamaan
            $item = Item::whereKey($item->id)->lockForUpdate()->first();

            $newStock = $data['type'] === 'in'
                ? $item->stock + $data['quantity']
                : $item->stock - $data['quantity'];

            if ($newStock < 0) {
                throw ValidationException::withMessages([
                    'quantity' => "Stok tidak cukup. Sisa stok saat ini: {$item->stock}.",
                ]);
            }

            $item->update(['stock' => $newStock]);

            StockMovement::create([
                'item_id' => $item->id,
                'type' => $data['type'],
                'quantity' => $data['quantity'],
                'note' => $data['note'] ?? null,
            ]);
        });

        return redirect()->route('items.show', $item)->with('success', 'Transaksi stok berhasil dicatat.');
    }
}
