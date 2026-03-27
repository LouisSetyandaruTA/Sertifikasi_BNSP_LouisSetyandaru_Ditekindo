@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Manajemen Akun & Koleksi</h1>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="row">
            <div class="col-lg-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 bg-primary">
                        <h6 class="m-0 font-weight-bold text-white">Edit Profil & Keamanan</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('profile.update') }}" method="POST">
                            @csrf @method('PUT')
                            <div class="form-group">
                                <label class="small font-weight-bold">Nama Lengkap</label>
                                <input type="text" name="name" class="form-control"
                                    value="{{ old('name', $user->name) }}">
                            </div>
                            <div class="form-group">
                                <label class="small font-weight-bold">Email</label>
                                <input type="email" name="email" class="form-control"
                                    value="{{ old('email', $user->email) }}">
                            </div>
                            <hr>
                            <div class="form-group">
                                <label class="small font-weight-bold">Password Baru</label>
                                <input type="password" name="password" class="form-control"
                                    placeholder="Kosongkan jika tidak ganti">
                            </div>
                            <div class="form-group">
                                <label class="small font-weight-bold">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" class="form-control">
                            </div>
                            <hr>
                            <div class="form-group">
                                <label class="small font-weight-bold text-danger">PIN Transaksi Baru (6 Digit)</label>
                                <input type="password" name="pin" class="form-control" maxlength="6"
                                    placeholder="******">
                            </div>
                            <button type="submit" class="btn btn-primary btn-block font-weight-bold">Update Data</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 bg-success">
                        <h6 class="m-0 font-weight-bold text-white">Riwayat Pembelian</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover" width="100%" cellspacing="0">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Item</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($orders as $order)
                                        <tr>
                                            <td class="small">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                            <td class="small">
                                                @foreach ($order->items as $item)
                                                    <span
                                                        class="badge badge-light border">{{ $item->gameProduct->name }}</span>
                                                @endforeach
                                            </td>
                                            <td class="font-weight-bold">Rp
                                                {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                            <td><span class="badge badge-success text-uppercase">Paid</span></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">Belum ada transaksi.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

     <div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 bg-dark">
                <h6 class="m-0 font-weight-bold text-white">Library Game Saya</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    @forelse($myGames as $game)
                        <div class="col-xl-2 col-md-3 col-sm-6 mb-4">
                            <div class="card h-100 shadow-sm border-0 overflow-hidden">
                                <div style="height: 140px; background-color: #f8f9fa;">
                                    @if($game->image)
                                        <img src="{{ asset('storage/' . $game->image) }}"
                                             class="w-100 h-100"
                                             style="object-fit: cover;">
                                    @else
                                        <div class="w-100 h-100 d-flex align-items-center justify-content-center bg-light">
                                            <i class="fas fa-gamepad fa-2x text-gray-300"></i>
                                        </div>
                                    @endif
                                </div>

                                <div class="card-body p-2 text-center">
                                    <h6 class="font-weight-bold mb-0 text-truncate" style="font-size: 0.9rem;" title="{{ $game->name }}">
                                        {{ $game->name }}
                                    </a></h6>
                                    <small class="text-muted" style="font-size: 0.75rem;">{{ $game->category }}</small>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5">
                            <i class="fas fa-ghost fa-3x text-gray-200 mb-3"></i>
                            <p class="text-muted">Kamu belum memiliki game apapun.</p>
                            <a href="{{ route('gameproducts.index') }}" class="btn btn-primary btn-sm">Mulai Belanja</a>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
