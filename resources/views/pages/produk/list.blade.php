<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>List Produk</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-white sm:ml-64 p-4 dark:bg-gray-900">
    @include('components.navbar')

    <h1 class="text-3xl font-semibold text-left my-4 text-gray-900 dark:text-white">List Produk || Kasir Michael</h1>

    <div class="flex justify-between items-center w-full mb-4">
        <button type="button"
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
        <!-- Grid Layout - Responsif -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($produks as $produk)
                <div
                    class="bg-white dark:bg-gray-800 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-200 dark:border-gray-700">
                    <!-- Header Card dengan Gambar -->
                    <div class="relative">
                        @if (empty($produk->foto_produk))
                            <div
                                class="h-48 bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-600 flex items-center justify-center rounded-t-xl">
                                <div class="text-center">
                                    <i class="fas fa-image text-4xl text-gray-400 dark:text-gray-500 mb-2"></i>
                                    <p class="text-red-500 italic font-semibold text-sm">Foto Tidak Tersedia</p>
                                </div>
                            </div>
                        @else
                            <div class="h-48 overflow-hidden rounded-t-xl">
                                <img src="{{ route('produk.gambar', $produk->foto_produk) }}"
                                    alt="{{ $produk->NamaProduk }}"
                                    class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
                            </div>
                        @endif

                        <!-- Badge ID Produk -->
                        <div class="absolute top-3 left-3">
                            <span class="bg-blue-500 text-white px-2 py-1 rounded-full text-xs font-semibold">
                                ID: {{ $produk->ProdukID }}
                            </span>
                        </div>

                        <!-- Badge Stok -->
                        <div class="absolute top-3 right-3">
                            <span @class([
                                'text-white px-2.5 py-1 rounded-full text-xs font-semibold',
                                'bg-[#6D67E4]' => $produk->Stok > 10,
                                'bg-[#FF6500]' => $produk->Stok > 0 && $produk->Stok <= 10,
                                'bg-[#F67280]' => $produk->Stok <= 0,
                            ])>
                                Stok: {{ $produk->Stok }}
                            </span>
                        </div>
                    </div>

                    <!-- Body Card -->
                    <div class="p-5">
                        <!-- Nama Produk -->
                        <h3 class="text-md font-bold text-gray-900 dark:text-white mb-2 min-h-[3.5rem]">
                            {{ $produk->NamaProduk }}
                        </h3>

                        <!-- Harga -->
                        <div class="mb-4">
                            <span class="text-2xl font-bold text-green-600 dark:text-green-400">
                                Rp{{ number_format($produk->Harga, 0, ',', '.') }}
                            </span>
                        </div>

                        <!-- Divider -->
                        <hr class="border-gray-200 dark:border-gray-600 mb-4">

                        <!-- Action Buttons -->
                        <div class="flex justify-between items-center gap-2">
                            <!-- Detail Button -->
                            <a href="{{ route('produk.detail')}}">
                                <button
                                    class="flex-1 bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center justify-center gap-1">
                                    <i class="fas fa-eye text-xs"></i>
                                    <span>Detail</span>
                                </button>
                            </a>

                            <!-- Edit Button -->
                            <button
                                class="flex-1 bg-amber-500 hover:bg-amber-600 text-white px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center justify-center gap-1">
                                <i class="fas fa-edit text-xs"></i>
                                <span>Edit</span>
                            </button>

                            <!-- Delete Button -->
                            <button
                                class="flex-1 bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center justify-center gap-1">
                                <i class="fas fa-trash text-xs"></i>
                                <span>Delete</span>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
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
