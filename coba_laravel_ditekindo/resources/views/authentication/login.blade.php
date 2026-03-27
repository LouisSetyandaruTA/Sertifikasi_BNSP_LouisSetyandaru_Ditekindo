@extends('layouts.auth')

@section('content')
<div class="card card-auth px-4 py-2">
    <div class="card-body">
        <div class="text-center mb-4">
            <h1 class="h4 text-gray-900 font-weight-bold">Selamat Datang!</h1>
            <p class="small text-muted">Silakan masuk ke Louis Game Store</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success small">{{ session('success') }}</div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="small font-weight-bold">Email Address</label>
                <input type="email" name="email" class="form-control form-control-user @error('email') is-invalid @enderror" placeholder="nama@email.com" value="{{ old('email') }}" required autofocus>
                @error('email') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="small font-weight-bold">Password</label>
                <input type="password" name="password" class="form-control form-control-user" placeholder="Masukkan password" required>
            </div>

            <button type="submit" class="btn btn-primary btn-block shadow-sm font-weight-bold py-2 mt-4">
                Login Sekarang
            </button>
        </form>

        <hr>
        <div class="text-center">
            <p class="small mb-0">Belum punya akun? <a href="{{ route('register') }}" class="font-weight-bold">Daftar di sini</a></p>
        </div>
    </div>
</div>
@endsection
