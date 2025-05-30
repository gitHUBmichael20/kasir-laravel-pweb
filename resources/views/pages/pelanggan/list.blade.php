@extends('layout.app')

@section('title', 'List Pelanggan')

@section('content')

    <div class="bg-white dark:bg-gray-900 sm:ml-64 p-4 px-5 min-h-screen">

        <h1 class="text-3xl font-semibold text-left my-4 text-gray-900 dark:text-white">List Pelanggan || Kasir Michael</h1>

        <div class="flex justify-between items-center w-full mb-4">
            <a href="{{ route('pelanggan.tambah') }}">
                <button type="button"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Tambah Pelanggan
                </button>
            </a>

            <form class="flex items-center">
                <label for="simple-search" class="sr-only">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input type="text" id="simple-search"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Cari Nama Pelanggan..." required />
                </div>
                <button type="submit"
                    class="p-2.5 ms-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                    <span class="sr-only">Search</span>
                </button>
            </form>
        </div>


        <div class="relative overflow-x-auto my-4 sm:rounded-lg">
            <table class="w-full text-sm text-center rtl:text-right text-gray-500 dark:text-gray-300">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-800 dark:text-gray-200">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            ID Pelanggan
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nama Pelanggan
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Alamat
                        </th>
                        <th scope="col" class="px-6 py-3">
                            No Telepon
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Gambar Pelanggan
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Aksi Cepat
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pelanggans as $pelanggan)
                        <tr class="bg-white border-b dark:bg-gray-700 dark:border-gray-600 border-gray-200">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $pelanggan->PelangganID }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $pelanggan->NamaPelanggan }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $pelanggan->Alamat }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $pelanggan->NomorTelepon }}
                            </td>
                            <td class="px-6 py-4 flex justify-center">
                                @if (empty($pelanggan->foto_pelanggan))
                                    <span class="text-red-500 italic font-bold">Foto Tidak Tersedia</span>
                                @else
                                    <div class="overflow-hidden rounded-full w-16 h-16 mx-auto">
                                        <img src="{{ route('pelanggan.gambar', $pelanggan->foto_pelanggan) }}"
                                            alt="{{ $pelanggan->NamaPelanggan }}" class="object-cover w-full h-full">
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-row items-center gap-3">
                                    <a href="{{ route('pelanggan.detail', $pelanggan->PelangganID) }}"
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Detail</a>
                                    <a href="{{ route('pelanggan.edit', $pelanggan->PelangganID) }}"
                                        class="font-medium text-yellow-600 dark:text-yellow-500 hover:underline">Edit</a>

                                    <form id="deleteForm-{{ $pelanggan->PelangganID }}"
                                        action="{{ route('pelanggan.delete', $pelanggan->PelangganID) }}" method="POST"
                                        class="inline delete-pelanggan-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                            class="font-medium text-red-600 dark:text-red-500 hover:underline"
                                            data-pelanggan-id="{{ $pelanggan->PelangganID }}">
                                            Remove
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Empty State jika tidak ada produk -->
            @if (count($pelanggans) == 0)
                <div class="text-center py-16">
                    <i class="fas fa-box-open text-6xl text-gray-400 dark:text-gray-500 mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-600 dark:text-gray-300 mb-2">Tidak Ada Pelanggan</h3>
                    <p class="text-gray-500 dark:text-gray-400">Belum ada Pelanggan yang tersedia saat ini.</p>
                </div>
            @endif

    </div>

@endsection

@include('layout.tambah-transaksi')
