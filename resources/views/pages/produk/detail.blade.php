<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail Produk {{$produkDetail->NamaProduk}}</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-white dark:bg-gray-900 sm:ml-64 p-4 overflow-hidden">
    @include('components.navbar')

    <nav class="flex px-5 py-3 text-gray-700 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700"
        aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="inline-flex items-center">
                <a href="{{ route('produk.all') }}"
                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                    <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                    </svg>
                    Produk List
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 block w-3 h-3 mx-1 text-gray-400 " aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <a href="#"
                        class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Detail
                        Produk</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="rtl:rotate-180  w-3 h-3 mx-1 text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <span
                        class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">{{ $produkDetail->NamaProduk }}</span>
                </div>
            </li>
        </ol>
    </nav>

    <section class="py-2 bg-white md:py-16 dark:bg-gray-900 antialiased">
        <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0">
            <div class="lg:grid lg:grid-cols-2 lg:gap-8 xl:gap-16">
                <div class="shrink-0 max-w-md lg:max-w-lg mx-auto">
                    @if ($produkDetail->foto_produk)
                        <img class="w-full" src="{{ route('produk.gambar', $produkDetail->foto_produk) }}"
                            alt="{{ $produkDetail->NamaProduk }}" />
                    @else
                        <span class="block w-full h-48 bg-gray-300 text-white"> Image not available</span>
                    @endif
                </div>

                <div class="mt-2">
                    <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">
                        {{ $produkDetail->NamaProduk }}
                    </h1>
                    <div class="mt-4 sm:items-center sm:gap-4 sm:flex">
                        <p class="text-2xl font-extrabold text-gray-900 sm:text-3xl dark:text-white">
                            Rp {{ number_format($produkDetail->Harga, 0, ',', '.') }}
                        </p>

                        <div class="flex items-center gap-2 mt-2 sm:mt-0">
                            {{-- Calculate total sales dynamically if possible --}}
                            <span class="text-sm font-medium leading-none text-gray-900 dark:text-white">
                                {{ $transaksiProduk->sum('JumlahProduk') }} Penjualan
                            </span>
                        </div>
                    </div>

                    <hr class=" border-gray-200 dark:border-gray-800" />

                    <div class="flex items-center justify-between">
                        <h2 class="text-2xl font-bold dark:text-white my-4">Riwayat Penjualan</h2>
                        <p class="text-sm font-medium text-gray-900 dark:text-white">Stok Tersisa = <span
                                class="font-bold">{{ $produkDetail->Stok }}</span></p>
                    </div>
                    <div class="p-4">
                        {{ $transaksiProduk->links() }}
                    </div>
                    <div class="max-h-72 overflow-x-auto shadow-md sm:rounded-lg" style="scrollbar-width: none;::-webkit-scrollbar {width: 0px; background: transparent;}">
                        @if ($transaksiProduk->isEmpty())
                            <p class="text-center py-4 text-gray-600 dark:text-gray-400">Belum ada riwayat penjualan
                                untuk produk ini.</p>
                        @else
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Tanggal Penjualan
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Jumlah Terjual
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Subtotal Item
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Nama Pelanggan
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transaksiProduk as $detail)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <td class="px-6 py-4">
                                                {{ \Carbon\Carbon::parse($detail->penjualan->TanggalPenjualan)->format('d F Y') }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $detail->JumlahProduk }}
                                            </td>
                                            <td class="px-6 py-4">
                                                Rp {{ number_format($detail->Subtotal, 0, ',', '.') }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $detail->penjualan->pelanggan->NamaPelanggan }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        @endif
                    </div>

                </div>
            </div>
        </div>
    </section>
</body>

</html>
