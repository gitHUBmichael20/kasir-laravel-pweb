@extends('layout.app')

@section('title', "Detail {{ $pelangganDetail->NamaPelanggan }}")

@section('content')

    <div class="bg-white dark:bg-gray-900 sm:ml-64 p-4 px-5">
        <nav class="flex px-5 py-3 text-gray-700 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700"
            aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="{{ route('pelanggan.all') }}"
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                        <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                        </svg>
                        Pelanggan List
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
                            Pelanggan</a>
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
                            class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">{{ $pelangganDetail->NamaPelanggan }}</span>
                    </div>
                </li>
            </ol>
        </nav>
        {{-- Deskripsi pelanggan --}}
        <section class="py-2  bg-white md:py-16 dark:bg-gray-900 antialiased">
            <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0 ">
                <div class="lg:grid lg:grid-cols-2 lg:gap-8 xl:gap-10 ">
                    <div class="shrink-0 max-w-md lg:max-w-lg mx-auto">
                        @if ($pelangganDetail->foto_pelanggan)
                            <img class="w-full" src="{{ route('pelanggan.gambar', $pelangganDetail->foto_pelanggan) }}"
                                alt="{{ $pelangganDetail->NamaPelanggan }}" />
                        @else
                            <span class="block w-full h-48 bg-gray-300 text-white"> Image not available</span>
                        @endif
                    </div>
                    <div class="mt-2 border-2 border-gray-300 dark:border-gray-600 rounded-xl p-4 w-fit max-w-xl">
                        <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">
                            {{ $pelangganDetail->NamaPelanggan }}
                        </h1>
                        <div class="mt-4 sm:items-center sm:gap-4 sm:flex ">
                            <p class="text-2xl font-extrabold text-gray-900 sm:text-3xl dark:text-white">
                                {{ $pelangganDetail->NomorTelepon }}
                            </p>
                            <div class="flex justify-end items-center gap-2 mt-2 sm:mt-0">
                                <p class="text-gray-700 dark:text-gray-300">{{ $pelangganDetail->Alamat }}</p>
                            </div>
                        </div>
                        <hr class="border-2 border-gray-200 dark:border-gray-800 mt-3" />
                        <div class="flex items-center justify-between">
                            <h2 class="text-2xl font-bold dark:text-white my-4">Riwayat Pembelian</h2>
                            <span class="text-sm font-medium leading-none text-gray-900 dark:text-white">
                                {{ $transaksiPelanggan->sum('total_jumlah_produk_dari_detail') }} Pembelian
                            </span>
                        </div>
                        <div class="max-h-80 overflow-x-scroll shadow-md sm:rounded-lg max-w-full"
                            style="scrollbar-width: none;::-webkit-scrollbar {width: 0px; background: transparent;}">
                            @if ($transaksiPelanggan->isEmpty())
                                <p class="text-center py-4 text-gray-600 dark:text-gray-400">Belum ada riwayat penjualan
                                    untuk pelanggan ini.</p>
                            @else
                                <table class="w-full text-sm text-center rtl:text-right text-gray-500 dark:text-gray-400">
                                    <thead
                                        class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="px-6 py-3">
                                                ID Penjualan
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Tanggal Pembelian
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Total Harga Penjualan
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Total Jumlah Produk
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Detail Penjualan
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Struk Belanja
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transaksiPelanggan as $penjualan)
                                            <tr
                                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                                <td
                                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    {{ $penjualan->PenjualanID }}
                                                </td>
                                                <td class="px-6 py-4">
                                                    {{ \Carbon\Carbon::parse($penjualan->TanggalPenjualan)->format('d F Y') }}
                                                </td>
                                                <td class="px-6 py-4">
                                                    Rp {{ number_format($penjualan->TotalHarga, 0, ',', '.') }}
                                                </td>
                                                <td class="px-6 py-4">
                                                    {{ $penjualan->total_jumlah_produk_dari_detail }}
                                                </td>
                                                <td class="px-6 py-4">
                                                    Rp
                                                    {{ number_format($penjualan->total_subtotal_dari_detail, 0, ',', '.') }}
                                                </td>
                                                <td class="px-6 py-4">
                                                    <a href="{{ route('penjualan.receipt.pdf', $penjualan->PenjualanID) }}"
                                                        class="font-medium text-blue-600 hover:underline">
                                                        Download
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                        <div class="p-4">
                            {{ $transaksiPelanggan->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@include('layout.tambah-transaksi')
