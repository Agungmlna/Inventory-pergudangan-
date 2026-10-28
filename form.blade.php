@extends('layouts.app')

@section('title', $item->exists ? 'Edit Barang' : 'Tambah Barang')

@section('content')
<div class="card">
    <h2 style="margin-top:0">{{ $item->exists ? 'Edit Barang' : 'Tambah Barang' }}</h2>

    <form method="POST" action="{{ $item->exists ? route('items.update', $item) : route('items.store') }}">
        @csrf
        @if ($item->exists) @method('PUT') @endif

        <div class="grid">
            <div>
                <label>Kode</label>
                <input name="code" value="{{ old('code', $item->code) }}" required>
                @error('code') <div class="error">{{ $message }}</div> @enderror
            </div>
            <div>
                <label>Nama</label>
                <input name="name" value="{{ old('name', $item->name) }}" required>
                @error('name') <div class="error">{{ $message }}</div> @enderror
            </div>
            <div>
                <label>Kategori</label>
                <input name="category" value="{{ old('category', $item->category) }}">
                @error('category') <div class="error">{{ $message }}</div> @enderror
            </div>
            <div>
                <label>Satuan</label>
                <input name="unit" value="{{ old('unit', $item->unit ?? 'pcs') }}" required>
                @error('unit') <div class="error">{{ $message }}</div> @enderror
            </div>
            <div>
                <label>Harga</label>
                <input type="number" step="0.01" min="0" name="price" value="{{ old('price', $item->price ?? 0) }}" required>
                @error('price') <div class="error">{{ $message }}</div> @enderror
            </div>
            <div>
                <label>Stok Awal</label>
                <input type="number" min="0" name="stock" value="{{ old('stock', $item->stock ?? 0) }}" required>
                @error('stock') <div class="error">{{ $message }}</div> @enderror
            </div>
            <div>
                <label>Batas Stok Minimum</label>
                <input type="number" min="0" name="min_stock" value="{{ old('min_stock', $item->min_stock ?? 0) }}" required>
                @error('min_stock') <div class="error">{{ $message }}</div> @enderror
            </div>
        </div>

        <button class="btn" type="submit">Simpan</button>
        <a href="{{ route('items.index') }}" class="btn btn-light">Batal</a>
    </form>
</div>
@endsection
