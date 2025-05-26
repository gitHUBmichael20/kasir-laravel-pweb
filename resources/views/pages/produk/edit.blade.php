<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Produk</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-white sm:ml-64 p-4 dark:bg-gray-900">

    @include('components.navbar')



    <!-- Breadcrumb -->
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
                    List Produk
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
                        class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Edit
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
                        class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">{{ $produk->NamaProduk }}</span>
                </div>
            </li>
        </ol>
    </nav>


    <section class="py-8 bg-white md:py-16 dark:bg-gray-900 antialiased">
        <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0">
            <div class="lg:grid lg:grid-cols-2 lg:gap-8 xl:gap-16">
                <div class="shrink-0 max-w-md lg:max-w-lg mx-auto">
                    @if ($produk->foto_produk)
                        <img class="w-full" src="{{ route('produk.gambar', $produk->foto_produk) }}"
                            alt="{{ $produk->NamaProduk }}" />
                    @else
                        <span class="block w-full h-48 bg-gray-300 text-white"> Image not available</span>
                    @endif
                </div>

                <div class="mt-6 sm:mt-8 lg:mt-0">
                    <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">
                        Edit Barang | <span class="font-bold text-orange-400 italic">{{ $produk->NamaProduk }}</span>
                    </h1>

                    <hr class="border-gray-200 dark:border-gray-600 mb-4 my-4">

                    <form class="w-full">
                        <div class="relative z-0 w-full mb-5 group">
                            <input type="nama" name="floating_nama" id="floating_nama"
                                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=" " required value="{{ $produk->NamaProduk }}" />
                            <label for="floating_nama"
                                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nama
                                Produk</label>
                        </div>
                        <div class="relative w-full mb-5">
                            <label class="block text-sm font-medium dark:text-white text-gray-800 mb-2">
                                Harga Produk
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-600 dark:text-white font-bold text-lg">Rp</span>
                                </div>
                                <input type="text" id="harga_modern"
                                    class="rupiah-input block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 text-right text-lg font-semibold text-gray-800 dark:text-white"
                                    placeholder="0" value="{{ $produk->Harga }}">
                            </div>
                            <p class="mt-1 text-xs text-gray-500">Masukkan harga dalam Rupiah tanpa titik atau koma</p>
                        </div>


                        <label for="quantity-input"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Choose
                            quantity:</label>
                        <div class="relative flex items-center max-w-[8rem]">
                            <button type="button" id="decrement-button" data-input-counter-decrement="quantity-input"
                                class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-s-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M1 1h16" />
                                </svg>
                            </button>
                            <input type="text" id="quantity-input" data-input-counter
                                aria-describedby="helper-text-explanation"
                                class="bg-gray-50 border-x-0 border-gray-300 h-11 text-center text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full py-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required value="{{ $produk->Stok }}"/>
                            <button type="button" id="increment-button" data-input-counter-increment="quantity-input"
                                class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-e-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M9 1v16M1 9h16" />
                                </svg>
                            </button>
                        </div>
                        <p id="helper-text-explanation" class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                            Please select a 5 digit number from 0 to 9.</p>

                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto mt-2 px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
