<!DOCTYPE html>
<html>

<head>
    <title>Struk Penjualan #{{ $penjualan->PenjualanID }}</title>
    <style>
        body {
            font-family: sans-serif;
        }

        .container {
            border: 1px solid #000;
            padding: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Struk Penjualan #{{ $penjualan->PenjualanID }}</h1>
        <p>Tanggal: {{ $penjualan->TanggalPenjualan->format('d M Y, H:i:s') }}</p>
        <p>Pelanggan: {{ $penjualan->pelanggan->NamaPelanggan }}</p>

        <table>
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($penjualan->detailpenjualans as $detail)
                    <tr>
                        <td>{{ $detail->produk->NamaProduk }}</td>
                        <td>{{ $detail->JumlahProduk }}</td>
                        <td>Rp {{ number_format($detail->produk->Harga, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($detail->Subtotal, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p>Total: Rp {{ number_format($penjualan->TotalHarga, 0, ',', '.') }}</p>
    </div>
</body>

</html>
