<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>List Produk</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('success'))
        <meta name="success-message" content="{{ session('success') }}">
    @endif
    @if (session('error'))
        <meta name="error-message" content="{{ session('error') }}">
    @endif
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white sm:ml-64 p-4 dark:bg-gray-900">
    @include('components.navbar')

    <h1 class="text-3xl font-semibold text-left my-4 text-gray-900 dark:text-white">List Produk || Kasir Michael</h1>

    <div class="flex justify-between items-center w-full mb-4">
        <button type="button" onclick="window.location.href='{{ route('produk.tambah') }}'"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Tambah Produk
        </button>

        <form class="flex items-center">
            <label for="simple-search" class="sr-only">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M14 7h-4v3a1 1 0 0 1-2 0V7H6a1 1 0 0 0-.997.923l-.917 11.924A2 2 0 0 0 6.08 22h11.84a2 2 0 0 0 1.994-2.153l-.917-11.924A1 1 0 0 0 18 7h-2v3a1 1 0 1 1-2 0V7Zm-2-3a2 2 0 0 0-2 2v1H8V6a4 4 0 0 1 8 0v1h-2V6a2 2 0 0 0-2-2Z"
                            clip-rule="evenodd" />
                    </svg>

                </div>
                <input type="text" id="simple-search"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Cari Nama Produk..." required />
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

    <div class="container mx-auto px-4 py-6">

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-center rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="p-4">
                            <div class="flex items-center">
                                <input id="checkbox-all-search" type="checkbox"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="checkbox-all-search" class="sr-only">checkbox</label>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            ID Produk
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Produk name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Stok Barang
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Harga Barang
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Ketersediaan
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Gambar Barang
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($produks as $produk)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="w-4 p-4">
                                <div class="flex items-center">
                                    <input id="checkbox-table-search-1" type="checkbox"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                {{ $produk->ProdukID }}
                            </td>
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $produk->NamaProduk }}
                            </th>
                            <td class="px-6 py-4">
                                @php
                                    $harga = 'Rp ' . number_format($produk->Harga, 0, ',', '.');
                                @endphp
                                {{ $harga }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $produk->Stok }}
                            </td>
                            <td class="px-6 py-4">
                                @if ($produk->Stok > 0)
                                    <span
                                        class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">Tersedia</span>
                                @else
                                    <span
                                        class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">Tidak
                                        Tersedia</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                <img class="inline-block w-14 h-14 rounded-full"
                                    src="{{ route('produk.gambar', $produk->foto_produk) }}"
                                    alt="{{ $produk->NamaProduk }}">
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-row items-center gap-3">
                                    <a href="{{ route('produk.detail', $produk->ProdukID) }}"
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Detail</a>
                                    <a href="{{ route('produk.edit', $produk->ProdukID) }}"
                                        class="font-medium text-yellow-600 dark:text-yellow-500 hover:underline">Edit</a>
                                    <form id="deleteForm-{{ $produk->ProdukID }}"
                                        action="{{ route('produk.delete', $produk->ProdukID) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                            onclick="window.confirmDelete({{ $produk->ProdukID }})"
                                            class="font-medium text-red-600 dark:text-red-500 hover:underline">
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
        @if (count($produks) == 0)
            <div class="text-center py-16">
                <i class="fas fa-box-open text-6xl text-gray-400 dark:text-gray-500 mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-600 dark:text-gray-300 mb-2">Tidak Ada Produk</h3>
                <p class="text-gray-500 dark:text-gray-400">Belum ada produk yang tersedia saat ini.</p>
            </div>
        @endif
    </div>

    @include('components.tambah-transaksi')
</body>

</html>
