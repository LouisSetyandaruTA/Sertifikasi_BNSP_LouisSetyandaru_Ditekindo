@extends('layouts.admin')
@section('content')
    <div class="container-fluid">

        <h1>Edit Produk Game</h1>
        <form action="{{ route('gameproducts.update', $gameProduct) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label>Ganti Gambar Produk (Kosongkan jika tidak ingin ganti)</label>
                <input type="file" name="image" class="form-control mb-2">
                @if ($gameProduct->image)
                    <div class="mt-2">
                        <small class="text-muted d-block mb-1">Gambar saat ini:</small>
                        <img src="{{ asset('storage/' . $gameProduct->image) }}" width="150" class="img-thumbnail">
                    </div>
                @endif
                @error('image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label>Nama</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $gameProduct->name) }}">
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label>Kategori</label>
                <input type="text" name="category" class="form-control"
                    value="{{ old('category', $gameProduct->category) }}">
                @error('category')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label>Keterangan</label>
                <textarea name="description" class="form-control" rows="3">{{ old('description', $gameProduct->description) }}</textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label>Stok</label>
                <input type="number" name="stok" class="form-control" value="{{ old('stok', $gameProduct->stok) }}">
                @error('stok')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label>Harga</label>
                <input type="number" step="0.01" name="harga" class="form-control"
                    value="{{ old('harga', $gameProduct->harga) }}">
                @error('harga')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button class="btn btn-success">Update</button>
            <a href="{{ route('gameproducts.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
