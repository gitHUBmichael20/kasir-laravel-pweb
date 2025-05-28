@extends('layout.app')

@section('title', 'Dashboard')

@section('content')

    <div class="sm:ml-64 p-4 md:p-6 bg-gray-50 dark:bg-gray-900 font-sans antialiased">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <div
                class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md border border-slate-500 transform transition duration-200 hover:-translate-y-0.5 hover:shadow-xl">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-gradient-to-br from-orange-500 to-orange-400">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4zM18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">Total
                            Penjualan Hari Ini</p>
                        <p class="text-xl font-bold text-gray-900 dark:text-white mt-1">Rp 2,450,000</p>
                    </div>
                </div>
            </div>

            <div
                class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md border border-slate-500 transform transition duration-200 hover:-translate-y-0.5 hover:shadow-xl">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-gradient-to-br from-orange-500 to-orange-400">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">
                            Transaksi Hari Ini</p>
                        <p class="text-xl font-bold text-gray-900 dark:text-white mt-1">43</p>
                    </div>
                </div>
            </div>

            <div
                class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md border border-slate-500 transform transition duration-200 hover:-translate-y-0.5 hover:shadow-xl">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-gradient-to-br from-orange-500 to-orange-400">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M17 5.923A1 1 0 0 0 16 5h-3V4a4 4 0 1 0-8 0v1H2a1 1 0 0 0-1 .923L.086 17.846A2 2 0 0 0 2.08 20h13.84a2 2 0 0 0 1.994-2.153L17 5.923Z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">Total
                            Produk</p>
                        <p class="text-xl font-bold text-gray-900 dark:text-white mt-1">127</p>
                    </div>
                </div>
            </div>

            <div
                class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md border border-slate-500 transform transition duration-200 hover:-translate-y-0.5 hover:shadow-xl">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-gradient-to-br from-orange-500 to-orange-400">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">Total
                            Pelanggan</p>
                        <p class="text-xl font-bold text-gray-900 dark:text-white mt-1">89</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-6">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Aksi Cepat</h2>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('penjualan.all') }}">
                    <button
                        class="px-4 py-2 text-white rounded-lg shadow-md bg-gradient-to-br from-orange-500 to-orange-400 hover:from-orange-400 hover:to-orange-500 transition duration-300">Tambah
                        Transaksi</button>
                </a>
                <a href="{{ route('produk.tambah') }}">
                    <button
                        class="px-4 py-2 text-white rounded-lg shadow-md bg-gradient-to-br from-orange-500 to-orange-400 hover:from-orange-400 hover:to-orange-500 transition duration-300">Tambah
                        Produk</button>
                </a>
                <a href="{{ route('pelanggan.all')}}">
                    <button
                        class="px-4 py-2 text-white rounded-lg shadow-md bg-gradient-to-br from-orange-500 to-orange-400 hover:from-orange-400 hover:to-orange-500 transition duration-300">Tambah
                        Pelanggan</button></a>
            </div>
        </div>

        {{-- Daftar Transaksi Terakhir --}}
        <div class="relative overflow-x-auto my-4">
            <table class="mx-auto w-full text-sm text-center rtl:text-right text-gray-500 dark:text-gray-300">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-800 dark:text-gray-200">
                    <tr>
                        <th class="px-3 py-3 w-20 text-xs font-semibold tracking-wider">ID Penjualan</th>
                        <th scope="col" class="px-6 py-3">
                            Tanggal Penjualan
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Total Harga
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Pelanggan ID
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Aksi Cepat
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($penjualans as $penjualan)
                        <tr class="bg-white border-b dark:bg-gray-700 dark:border-gray-600 border-gray-200">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $penjualan->PenjualanID }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $penjualan->TanggalPenjualan }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $penjualan->TotalHarga }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $penjualan->PelangganID }}
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('penjualan.receipt.pdf', ['id' => $penjualan->PenjualanID]) }}">
                                    <button type="button"
                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Cetak
                                        Resi</button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

@include('layout.tambah-transaksi')
