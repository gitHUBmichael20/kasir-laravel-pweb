@extends('layout.app')

@section('title', 'Tambah Pelanggan')

@section('content')
    <div class="bg-white sm:ml-64 p-4 dark:bg-gray-900 min-h-screen">

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
                        pelanggan List
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 mx-1 text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Tambah pelanggan</span>
                    </div>
                </li>
            </ol>
        </nav>

        <section
            class="py-8 bg-white md:py-16 dark:bg-gray-900 antialiased h-full min-h-full flex items-center justify-center">
            <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0 w-full">
                <div class="lg:grid lg:grid-cols-2 lg:gap-8 xl:gap-16 items-center">
                    <div class="shrink-0 max-w-2xl lg:max-w-3xl mx-auto mb-8 lg:mb-0">
                        <div id="image-preview"
                            class="p-10 aspect-square bg-gray-100 border-2 border-dashed border-gray-300 flex justify-center items-center overflow-hidden rounded-xl relative dark:bg-gray-800 dark:border-gray-600 transition-all duration-300 hover:border-blue-500">
                            <span id="placeholder-text"
                                class="text-gray-400 text-lg font-medium text-center dark:text-gray-500">Pratinjau Gambar
                                pelanggan</span>
                        </div>
                    </div>

                    <div
                        class="mt-6 sm:mt-8 lg:mt-0 border-2 border-gray-300 dark:border-gray-600 rounded-xl p-6 bg-gray-50 dark:bg-gray-800">
                        <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white mb-4">
                            Tambah pelanggan Baru
                        </h1>

                        <hr class="border-gray-200 dark:border-gray-800 mb-6" />

                        <form id="storepelangganForm" class="max-w-lg mx-auto" action="{{ route('pelanggan.store') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-5">
                                <label for="Namapelanggan"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                    pelanggan</label>
                                <input type="text" id="Namapelanggan" name="Namapelanggan"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Masukkan nama pelanggan" required>
                            </div>
                            <div class="grid md:grid-cols-2 md:gap-6">
                                <div class="mb-5">
                                    <label for="Harga"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga</label>
                                    <input type="number" id="Harga" name="Harga" step="0.01"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="e.g. 150000" required>
                                </div>
                                <div class="mb-5">
                                    <label for="Stok"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stok</label>
                                    <input type="number" id="Stok" name="Stok"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="e.g. 100" required>
                                </div>
                            </div>
                            <div class="mb-5">
                                <label for="foto_pelanggan"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gambar
                                    pelanggan</label>
                                <div class="relative">
                                    <input type="file" id="foto_pelanggan" name="foto_pelanggan" accept="image/*"
                                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-l-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-blue-900 dark:file:text-blue-200 dark:hover:file:bg-blue-800 transition-all duration-300">
                                    <p class="mt-2 text-xs text-gray-500 dark:text-gray-300" id="file_input_help">PNG, JPG
                                        or GIF (MAX. 800x400px).</p>
                                </div>
                            </div>

                            <button type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition-all duration-200 store-pelanggan-form">
                                Tambah pelanggan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const productImageInput = document.getElementById('foto_pelanggan'); // Changed ID to match name
                const imagePreviewContainer = document.getElementById('image-preview');
                const placeholderText = document.getElementById('placeholder-text');

                productImageInput.addEventListener('change', (event) => {
                    const file = event.target.files[0];

                    if (file) {
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            imagePreviewContainer.innerHTML = '';
                            if (placeholderText) {
                                placeholderText.classList.add('hidden');
                            }

                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.alt = 'Product Image Preview';
                            img.classList.add('max-w-full', 'max-h-full', 'object-contain', 'rounded-xl',
                                'shadow-md');
                            imagePreviewContainer.appendChild(img);
                        };
                        reader.readAsDataURL(file);
                    } else {
                        imagePreviewContainer.innerHTML = '';
                        if (placeholderText) {
                            placeholderText.classList.remove('hidden');
                            imagePreviewContainer.appendChild(placeholderText);
                        } else {
                            const newPlaceholder = document.createElement('span');
                            newPlaceholder.id = 'placeholder-text';
                            newPlaceholder.classList.add('text-gray-400', 'text-lg', 'font-medium',
                                'text-center', 'dark:text-gray-500');
                            newPlaceholder.textContent = 'Pratinjau Gambar pelanggan';
                            imagePreviewContainer.appendChild(newPlaceholder);
                        }
                    }
                });
            });
        </script>
    </div>
@endsection
