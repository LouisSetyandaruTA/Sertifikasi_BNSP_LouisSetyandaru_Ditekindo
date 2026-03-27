<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penjualan Louis Game Store</title>
    <style>
        /* CSS Murni untuk PDF */
        body { font-family: 'Helvetica', 'Arial', sans-serif; color: #333; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #4e73df; padding-bottom: 10px; }
        .header h2 { margin: 0; color: #4e73df; text-transform: uppercase; }
        .header p { margin: 5px 0; font-size: 12px; color: #666; }

        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #e3e6f0; padding: 10px; text-align: left; font-size: 11px; }
        th { background-color: #f8f9fc; color: #4e73df; font-weight: bold; text-transform: uppercase; }
        tr:nth-child(even) { background-color: #fcfcfc; }

        .footer { margin-top: 30px; text-align: right; }
        .total-box { display: inline-block; background: #4e73df; color: white; padding: 10px 20px; border-radius: 5px; }
        .total-label { font-size: 12px; }
        .total-amount { font-size: 16px; font-weight: bold; display: block; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Laporan Penjualan Resmi</h2>
        <p>Louis Game Store - Dashboard System</p>
        <p>Dicetak pada: {{ date('d F Y, H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%">No</th>
                <th style="width: 20%">ID Transaksi</th>
                <th style="width: 25%">Nama Pembeli</th>
                <th style="width: 30%">Daftar Game</th>
                <th style="width: 20%">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $key => $order)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>#ORD-{{ $order->id }}</td>
                <td>{{ $order->user->name }}</td>
                <td>
                    @foreach($order->items as $item)
                        • {{ $item->gameProduct->name }}<br>
                    @endforeach
                </td>
                <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <div class="total-box">
            <span class="total-label">AKUMULASI PENDAPATAN:</span>
            <span class="total-amount">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</span>
        </div>
    </div>
</body>
</html>
