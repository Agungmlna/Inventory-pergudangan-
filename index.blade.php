@extends('layouts.app')

@section('content')
<div class="card">
    <div class="row" style="margin-bottom:16px">
        <h2 style="margin:0">Daftar Barang</h2>
        <a href="{{ route('items.create') }}" class="btn">+ Tambah Barang</a>
    </div>

    <form method="GET" action="{{ route('items.index') }}" style="display:flex; gap:8px; margin-bottom:16px">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kode, nama, atau kategori" style="margin:0">
        <button class="btn btn-light" type="submit">Cari</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>Kode</th><th>Nama</th><th>Kategori</th><th>Stok</th><th>Status</th><th></th>
            </tr>
        </thead>
        <tbody>
        @forelse ($items as $item)
            <tr>
                <td>{{ $item->code }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->category ?? '-' }}</td>
                <td>{{ $item->stock }} {{ $item->unit }}</td>
                <td>
                    @if ($item->isLowStock())
                        <span class="badge badge-low">Stok rendah</span>
                    @else
                        <span class="badge badge-ok">Aman</span>
                    @endif
                </td>
                <td><a href="{{ route('items.show', $item) }}">Detail</a></td>
            </tr>
        @empty
            <tr><td colspan="6">Belum ada barang.</td></tr>
        @endforelse
        </tbody>
    </table>

    <div class="pagination">{{ $items->links() }}</div>
</div>
@endsection
