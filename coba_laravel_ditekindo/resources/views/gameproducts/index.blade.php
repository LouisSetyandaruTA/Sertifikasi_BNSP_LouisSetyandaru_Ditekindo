@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Etalase Game</h1>

            @if (Auth::check() && Auth::user()->role == 'admin')
                <a href="{{ route('gameproducts.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Produk
                </a>
            @endif
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
            @forelse($gameProducts as $gameProduct)
                <div class="col mb-5">
                    <div class="card h-100 shadow-sm border-0 mb-2 ">

                        <div class="d-flex align-items-center justify-content-center"
                            style="height: 180px; overflow: hidden; border-radius: 8px 8px 0 0; background-color: #f8f9fa;">
                            @if ($gameProduct->image)
                                <img src="{{ asset('storage/' . $gameProduct->image) }}" class="w-100 h-100"
                                    style="object-fit: cover;">
                            @else
                                <div class="text-center text-muted">
                                    <i class="fas fa-gamepad fa-3x d-block mb-2"></i>
                                    <small>No Image</small>
                                </div>
                            @endif
                        </div>

                        <div class="card-body d-flex flex-column">
                            <div class="mb-2">
                                <span class="badge bg-info text-dark">{{ $gameProduct->category }}</span>
                            </div>
                            <h5 class="card-title fw-bold text-truncate">{{ $gameProduct->name }}</h5>
                            <p class="card-text text-muted small text-truncate-2" style="height: 3rem;">
                                {{ $gameProduct->description ?? 'Tidak ada deskripsi.' }}
                            </p>

                            <div class="mt-auto">
                                <h5 class="text-primary fw-bold mb-1">
                                    Rp {{ number_format($gameProduct->harga, 0, ',', '.') }}
                                </h5>
                                <p class="small text-{{ $gameProduct->stok > 0 ? 'success' : 'danger' }}">
                                    Stok: {{ $gameProduct->stok }}
                                </p>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-top-0 pb-3">
                            <div class="d-grid gap-2">
                                @if (Auth::check() && Auth::user()->role == 'admin')
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('gameproducts.edit', $gameProduct) }}"
                                            class="btn btn-outline-warning btn-sm flex-fill">Edit</a>
                                        <form action="{{ route('gameproducts.destroy', $gameProduct) }}" method="POST"
                                            class="flex-fill d-grid">
                                            @csrf @method('DELETE')
                                            <button onclick="return confirm('Hapus?')"
                                                class="btn btn-outline-danger btn-sm w-100">Hapus</button>
                                        </form>
                                    </div>
                                @else
                                    @if (auth()->check() && in_array($gameProduct->id, $ownedGameIds))
                                        <button class="btn btn-secondary btn-sm disabled w-100">
                                            <i class="fas fa-check-circle"></i> Sudah Dimiliki
                                        </button>
                                    @elseif($gameProduct->stok <= 0)
                                        <button class="btn btn-danger btn-sm disabled w-100">
                                            <i class="fas fa-times-circle"></i> Stok Habis
                                        </button>
                                    @else
                                        <a href="{{ route('cart.add', $gameProduct) }}"
                                            class="btn btn-primary btn-sm w-100">
                                            <i class="fas fa-shopping-cart"></i>
                                            {{ Auth::check() ? 'Beli Sekarang' : 'Login untuk Beli' }}
                                        </a>
                                    @endif
                                @endif
                            </div>
                        </div>


                    </div>
                </div>
            @empty
                <div class="col-12 w-100 text-center py-5">
                    <div class="alert alert-light border">
                        <p class="mb-0">Belum ada produk game yang tersedia.</p>
                    </div>
                </div>
            @endforelse
        </div>

        <div class="mt-4 d-flex justify-content-center">
            {{ $gameProducts->links() }}
        </div>
    </div>
@endsection
