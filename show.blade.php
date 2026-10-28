@extends('layouts.app')

@section('title', $item->name)

@section('content')
<div class="card">
    <div class="row">
        <h2 style="margin:0">{{ $item->name }}</h2>
        <div>
            <a href="{{ route('items.edit', $item) }}" class="btn btn-light">Edit</a>
            <form method="POST" action="{{ route('items.destroy', $item) }}" style="display:inline" onsubmit="return confirm('Hapus barang ini?')">
                @csrf @method('DELETE')
                <button class="btn btn-danger" type="submit">Hapus</button>
            </form>
        </div>
    </div>
    <p>Kode: <strong>{{ $item->code }}</strong> | Kategori: {{ $item->category ?? '-' }} | Harga: Rp {{ number_format($item->price, 0, ',', '.') }}</p>
    <p>Stok saat ini: <strong>{{ $item->stock }} {{ $item->unit }}</strong> (minimum {{ $item->min_stock }})
        @if ($item->isLowStock()) <span class="badge badge-low">Stok rendah</span> @endif
    </p>
</div>

<div class="card">
    <h3 style="margin-top:0">Catat Transaksi</h3>
    <form method="POST" action="{{ route('movements.store', $item) }}">
        @csrf
        <div class="grid">
            <div>
                <label>Jenis</label>
                <select name="type">
                    <option value="in">Barang Masuk</option>
                    <option value="out">Barang Keluar</option>
                </select>
            </div>
            <div>
                <label>Jumlah</label>
                <input type="number" min="1" name="quantity" required>
                @error('quantity') <div class="error">{{ $message }}</div> @enderror
            </div>
        </div>
        <label>Catatan</label>
        <input name="note" placeholder="Contoh: pembelian dari supplier A">
        <button class="btn" type="submit">Simpan Transaksi</button>
    </form>
</div>

<div class="card">
    <h3 style="margin-top:0">Riwayat Stok</h3>
    <table>
        <thead><tr><th>Tanggal</th><th>Jenis</th><th>Jumlah</th><th>Catatan</th></tr></thead>
        <tbody>
        @forelse ($item->movements as $m)
            <tr>
                <td>{{ $m->created_at->format('d/m/Y H:i') }}</td>
                <td>{{ $m->type === 'in' ? 'Masuk' : 'Keluar' }}</td>
                <td>{{ $m->quantity }} {{ $item->unit }}</td>
                <td>{{ $m->note ?? '-' }}</td>
            </tr>
        @empty
            <tr><td colspan="4">Belum ada riwayat.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
