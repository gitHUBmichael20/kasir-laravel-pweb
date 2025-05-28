@extends('layout.app')

@section('title', 'Edit Produk')

@section('content')
    <div class="bg-white sm:ml-64 p-4 dark:bg-gray-900 h-full">

        <nav class="flex px-5 py-3 text-gray-700 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700"
            aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="{{ route('produk.all') }}"
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                        <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 20">
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

                    <div class="mt-6 sm:mt-8 lg:mt-0 border-2 border-gray-300 dark:border-gray-600 rounded-xl p-4">
                        <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">
                            Edit Barang | <span class="font-bold text-orange-400 italic">{{ $produk->NamaProduk }}</span>
                        </h1>

                        <hr class="border-gray-200 dark:border-gray-600 mb-4 my-4">

                        <form id="editProdukForm" action="{{ route('produk.update', $produk->ProdukID) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT') {{-- Method Spoofing for Laravel's PUT request --}}

                            <div class="relative z-0 w-full mb-5 group">
                                <input type="text" name="NamaProduk" id="NamaProduk"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                    placeholder=" " required value="{{ old('NamaProduk', $produk->NamaProduk) }}" />
                                <label for="NamaProduk"
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
                                    <input type="text" id="Harga" name="Harga"
                                        class="rupiah-input block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 text-right text-lg font-semibold text-gray-800 dark:text-white"
                                        placeholder="0" value="{{ old('Harga', $produk->Harga) }}">
                                </div>
                                <p class="mt-1 text-xs text-gray-500">Masukkan harga dalam Rupiah tanpa titik atau koma</p>
                            </div>

                            <label for="Stok"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah Stok:</label>
                            <div class="relative flex items-center max-w-[8rem] mb-5">
                                <button type="button" id="decrement-button" data-input-counter-decrement="Stok"
                                    class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-s-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                    <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M1 1h16" />
                                    </svg>
                                </button>
                                <input type="text" id="Stok" name="Stok" data-input-counter
                                    aria-describedby="helper-text-explanation"
                                    class="bg-gray-50 border-x-0 border-gray-300 h-11 text-center text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full py-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    required value="{{ old('Stok', $produk->Stok) }}" />
                                <button type="button" id="increment-button" data-input-counter-increment="Stok"
                                    class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-e-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                    <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M9 1v16M1 9h16" />
                                    </svg>
                                </button>
                            </div>
                            <p id="helper-text-explanation" class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                Pilih jumlah stok produk.
                            </p>

                            <div class="mb-5">
                                <label for="foto_produk"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Foto Produk Baru
                                    (opsional):</label>
                                <input type="file" id="foto_produk" name="foto_produk" accept="image/*"
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">JPG, PNG, JPEG, GIF (MAX. 100MB).
                                </p>
                            </div>


                            <button type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto mt-2 px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Update Produk
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

{{-- Include the common JavaScript file --}}
@include('layout.tambah-transaksi')

{{-- You might need a separate script for the rupiah input formatting,
     or integrate it directly into your main app.js if it's general --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const rupiahInputs = document.querySelectorAll('.rupiah-input');

        rupiahInputs.forEach(input => {
            let initialValue = parseFloat(input.value);
            if (!isNaN(initialValue)) {
                input.value = formatRupiah(initialValue.toString());
            }

            input.addEventListener('keyup', function(e) {
                this.value = formatRupiah(this.value, 'Rp. ');
            });

            input.addEventListener('change', function() {
                // Ensure the hidden input or the form data picks up the numeric value
                // when the form is submitted. This is handled by FormData in handleFormSubmission
                // but if you manually extract values, keep this in mind.
            });
        });

        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                let separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }

        // Increment/Decrement logic for Stok
        document.querySelectorAll('[data-input-counter-decrement]').forEach(button => {
            button.addEventListener('click', function() {
                const targetId = this.dataset.inputCounterDecrement;
                const input = document.getElementById(targetId);
                let value = parseInt(input.value) || 0;
                if (value > 0) { // Ensure it doesn't go below 0
                    input.value = value - 1;
                }
            });
        });

        document.querySelectorAll('[data-input-counter-increment]').forEach(button => {
            button.addEventListener('click', function() {
                const targetId = this.dataset.inputCounterIncrement;
                const input = document.getElementById(targetId);
                let value = parseInt(input.value) || 0;
                input.value = value + 1;
            });
        });
    });
</script>
