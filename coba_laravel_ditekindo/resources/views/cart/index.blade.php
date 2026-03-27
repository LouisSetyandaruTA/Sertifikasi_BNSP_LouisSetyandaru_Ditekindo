@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Keranjang Belanja Kamu</h1>

        @if (session('cart'))
            <div class="card shadow mb-4">
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Subtotal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cart as $id => $details)
                                <tr>
                                    <td>
                                        <strong>{{ $details['name'] }}</strong><br>
                                        <small class="text-muted">{{ $details['category'] }}</small>
                                    </td>
                                    <td>Rp {{ number_format($details['harga'], 0, ',', '.') }}</td>
                                    <td>{{ $details['quantity'] }}</td>
                                    <td>Rp {{ number_format($details['harga'] * $details['quantity'], 0, ',', '.') }}</td>
                                    <td>
                                        <form action="{{ route('cart.remove') }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="id" value="{{ $id }}">
                                            <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-right"><strong>Total Pembayaran:</strong></td>
                                <td colspan="2"><strong>Rp {{ number_format($total, 0, ',', '.') }}</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="text-right">
                        <a href="{{ route('gameproducts.index') }}" class="btn btn-secondary">Lanjut Belanja</a>
                        <button class="btn btn-success" data-toggle="modal" data-target="#checkoutModal">Bayar
                            Sekarang</button>
                    </div>
                </div>
            </div>
        @else
            <div class="alert alert-info">Keranjang kamu masih kosong. Ayo pilih game seru!</div>
            <a href="{{ route('gameproducts.index') }}" class="btn btn-primary">Lihat Katalog Game</a>
        @endif
    </div>
    <div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Pembayaran</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('cart.checkout') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p class="text-center">Total yang harus dibayar:</p>
                        <h3 class="text-center text-primary font-weight-bold mb-4">Rp
                            {{ number_format($total, 0, ',', '.') }}</h3>

                        <div class="form-group px-4">
                            <label class="font-weight-bold">Masukkan PIN 6 Digit Kamu</label>
                            <input type="password" name="pin" class="form-control text-center" maxlength="6"
                                placeholder="******" style="font-size: 24px; letter-spacing: 10px;" required>
                            <small class="text-muted text-center d-block mt-2">PIN diperlukan untuk keamanan
                                transaksi.</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success font-weight-bold">Konfirmasi & Bayar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
