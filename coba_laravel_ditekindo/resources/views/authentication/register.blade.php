@extends('layouts.auth')

@section('content')
<div class="card card-auth px-4 py-2 mb-5">
    <div class="card-body">
        <div class="text-center mb-4">
            <h1 class="h4 text-gray-900 font-weight-bold">Daftar Akun</h1>
            <p class="small text-muted">Lengkapi data untuk mulai belanja gamedi Louis Game Store</p>
        </div>

        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="small font-weight-bold">Nama Lengkap</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nama asli kamu" value="{{ old('name') }}" required>
                @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="small font-weight-bold">Email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="email@toko.com" value="{{ old('email') }}" required>
                @error('email') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="small font-weight-bold">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="small font-weight-bold">Konfirmasi</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="small font-weight-bold text-primary">Buat PIN Pembayaran (6 Angka)</label>
                <input type="password" name="pin" class="form-control @error('pin') is-invalid @enderror" maxlength="6" placeholder="Contoh: 123456" required>
                <small class="text-muted">PIN ini akan ditanyakan saat kamu membeli game.</small>
                @error('pin') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="btn btn-success btn-block shadow-sm font-weight-bold py-2 mt-4">
                Daftar & Belanja
            </button>
        </form>

        <hr>
        <div class="text-center">
            <p class="small mb-0">Sudah punya akun? <a href="{{ route('login') }}" class="font-weight-bold">Login</a></p>
        </div>
    </div>
</div>
@endsection
