<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Penjualan #{{ $penjualan->PenjualanID }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        /* General Body Styles */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
            /* bg-gray-100 */
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 1rem;
            /* p-4 */
            margin: 0;
        }

        /* Main Container for the Receipt */
        .receipt-container {
            background-color: #fff;
            /* bg-white */
            border-radius: 0.5rem;
            /* rounded-lg */
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
            /* shadow-xl */
            padding: 2rem;
            /* p-8 */
            max-width: 800px;
            /* Disesuaikan untuk lebar A4 potrait (sekitar 21cm) */
            width: 100%;
            margin-left: auto;
            /* mx-auto */
            margin-right: auto;
            /* mx-auto */
        }

        /* Header Section */
        .receipt-header {
            text-align: center;
            /* text-center */
            margin-bottom: 2rem;
            /* mb-8 */
        }

        .receipt-header h1 {
            font-size: 1.875rem;
            /* text-3xl */
            font-weight: 700;
            /* font-bold */
            color: #1f2937;
            /* text-gray-800 */
            margin-bottom: 0.5rem;
            /* mb-2 */
        }

        .receipt-header p {
            font-size: 0.875rem;
            /* text-sm */
            color: #4b5563;
            /* text-gray-600 */
        }

        /* Transaction Details Section */
        .transaction-details {
            margin-bottom: 1.5rem;
            /* mb-6 */
            border-bottom: 1px solid #e5e7eb;
            /* border-b border-gray-200 */
            padding-bottom: 1rem;
            /* pb-4 */
        }

        .detail-row {
            display: flex;
            /* flex */
            justify-content: space-between;
            /* justify-between */
            margin-bottom: 0.5rem;
            /* mb-2 */
        }

        .detail-row:last-child {
            margin-bottom: 0;
            /* Remove margin for the last row */
        }

        .detail-label {
            color: #374151;
            /* text-gray-700 */
            font-weight: 600;
            /* font-semibold */
        }

        .detail-value {
            color: #111827;
            /* text-gray-900 */
            font-weight: 500;
            /* font-medium */
        }

        /* Items Table Section */
        .items-table-wrapper {
            margin-bottom: 2rem;
            /* mb-8 */
        }

        .items-table {
            width: 100%;
            text-align: left;
            border-collapse: collapse;
            /* table-auto (implied by collapse) */
        }

        .items-table thead tr {
            background-color: #f9fafb;
            /* bg-gray-50 */
            border-bottom: 1px solid #e5e7eb;
            /* border-b border-gray-200 */
        }

        .items-table th {
            padding: 0.75rem 1rem;
            /* py-3 px-4 */
            color: #4b5563;
            /* text-gray-600 */
            font-weight: 600;
            /* font-semibold */
            font-size: 0.875rem;
            /* text-sm */
        }

        .items-table th:first-child {
            border-top-left-radius: 0.375rem;
            /* rounded-tl-md */
        }

        .items-table th:last-child {
            border-top-right-radius: 0.375rem;
            /* rounded-tr-md */
        }

        .items-table th.text-center {
            text-align: center;
        }

        .items-table th.text-right {
            text-align: right;
        }

        .items-table tbody tr {
            border-bottom: 1px solid #e5e7eb;
            /* border-b border-gray-200 */
        }

        .items-table tbody tr:last-child {
            border-bottom: 0;
            /* last:border-b-0 */
        }

        .items-table td {
            padding: 0.75rem 1rem;
            /* py-3 px-4 */
            color: #1f2937;
            /* text-gray-800 */
        }

        .items-table td.text-center {
            text-align: center;
        }

        .items-table td.text-right {
            text-align: right;
        }

        /* Total Section */
        .total-section {
            text-align: right;
            /* text-right */
            border-top: 1px solid #e5e7eb;
            /* border-t border-gray-200 */
            padding-top: 1rem;
            /* pt-4 */
        }

        .total-row {
            display: flex;
            /* flex */
            justify-content: space-between;
            /* justify-between */
            align-items: center;
            /* items-center */
            margin-bottom: 0.5rem;
            /* mb-2 */
        }

        .total-label {
            font-size: 1.25rem;
            /* text-xl */
            font-weight: 700;
            /* font-bold */
            color: #374151;
            /* text-gray-700 */
        }

        .total-value {
            font-size: 1.5rem;
            /* text-2xl */
            font-weight: 800;
            /* font-extrabold */
            color: #4f46e5;
            /* text-indigo-600 */
        }

        /* Footer Section */
        .receipt-footer {
            text-align: center;
            /* text-center */
            margin-top: 2rem;
            /* mt-8 */
            color: #6b7280;
            /* text-gray-500 */
            font-size: 0.875rem;
            /* text-sm */
        }
    </style>
</head>

<body>
    <div class="receipt-container">
        <div class="receipt-header">
            <h1>STRUK PENJUALAN KASIR MICHAEL</h1>
            <p>Terima kasih atas pembelian Anda!</p>
        </div>

        <div class="transaction-details">
            <div class="detail-row">
                <span class="detail-label">Nomor Transaksi:</span>
                <span class="detail-value">{{ $penjualan->PenjualanID }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Tanggal:</span>
                <span class="detail-value">{{ $penjualan->TanggalPenjualan->format('d F Y, H:i:s') }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Pelanggan:</span>
                <span class="detail-value">{{ $penjualan->pelanggan->NamaPelanggan }}</span>
            </div>
        </div>

        <div class="items-table-wrapper">
            <table class="items-table">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th class="text-center">Jumlah</th>
                        <th class="text-right">Harga Satuan</th>
                        <th class="text-right">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($penjualan->detailpenjualans as $detail)
                        <tr>
                            <td>{{ $detail->produk->NamaProduk }}</td>
                            <td class="text-center">{{ $detail->JumlahProduk }}</td>
                            <td class="text-right">Rp {{ number_format($detail->produk->Harga, 0, ',', '.') }}</td>
                            <td class="text-right">Rp {{ number_format($detail->Subtotal, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="total-section">
            <div class="total-row">
                <span class="total-label">TOTAL:</span>
                <span class="total-value">Rp {{ number_format($penjualan->TotalHarga, 0, ',', '.') }}</span>
            </div>
        </div>

        <div class="receipt-footer">
            <p>Struk ini adalah bukti sah pembayaran Anda.</p>
            <p>Terima kasih telah berbelanja dengan kami!</p>
        </div>
    </div>
</body>

</html>
