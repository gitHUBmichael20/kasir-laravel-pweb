@extends('layout.app')

@section('title', 'Edit pelanggan')

@section('content')
    <div class="bg-white sm:ml-64 p-4 dark:bg-gray-900 h-full">

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
                        List pelanggan
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
                            pelanggan</a>
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
                            class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">{{ $pelanggan->NamaPelanggan }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <section class="py-8 bg-white md:py-16 dark:bg-gray-900 antialiased">
            <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0">
                <div class="lg:grid lg:grid-cols-2 lg:gap-8 xl:gap-16">
                    <div class="shrink-0 max-w-md lg:max-w-lg mx-auto" id="imageContainer">
                        @if ($pelanggan->foto_pelanggan)
                            <img class="w-full" src="{{ route('pelanggan.gambar', $pelanggan->foto_pelanggan) }}"
                                alt="{{ $pelanggan->NamaPelanggan }}" />
                        @else
                            <span class="block w-full h-48 bg-gray-300 text-white"> Image not available</span>
                        @endif
                    </div>

                    <div
                        class="mt-6 sm:mt-8 lg:mt-0 border-2 border-gray-300 dark:border-gray-600 rounded-xl p-6 bg-gray-50 dark:bg-gray-800">
                        <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white mb-4">
                            Edit
                            <span class="text-gray-600 dark:text-white">
                                {{ $pelanggan->NamaPelanggan }}
                            </span>
                        </h1>

                        <hr class="border-gray-200 dark:border-gray-800 mb-6" />

                        <form id="editPelangganForm-{{ $pelanggan->PelangganID }}" class="max-w-lg mx-auto edit-pelanggan-form"
                            action="{{ route('pelanggan.update', $pelanggan->PelangganID) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-5">
                                <label for="NamaPelanggan"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Pelanggan</label>
                                <input type="text" id="NamaPelanggan" name="NamaPelanggan"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Masukkan nama pelanggan" required value="{{ $pelanggan->NamaPelanggan }}">
                            </div>
                            <div class="mb-5">
                                <label for="NamaPelanggan"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat Pelanggan</label>
                                <input type="text" id="NamaPelanggan" name="Alamat"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                     required value="{{ $pelanggan->Alamat }}">
                            </div>
                            <div class="mb-5">
                                <label for="NamaPelanggan"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Telepon Pelanggan</label>
                                <input type="text" id="NamaPelanggan" name="NomorTelepon"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                     required value="{{ $pelanggan->NomorTelepon }}">
                            </div>
                            <div class="mb-5">
                                <label for="foto_pelanggan"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gambar
                                    pelanggan</label>
                                <div class="relative">
                                    <input type="file" id="foto_pelanggan" name="foto_pelanggan" accept="image/*"
                                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-l-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-blue-900 dark:file:text-blue-200 dark:hover:file:bg-blue-800 transition-all duration-300">
                                    <p class="mt-2 text-xs text-gray-500 dark:text-gray-300" id="file_input_help">PNG, JPG
                                        or GIF.</p>
                                </div>
                            </div>

                            <button type="submit"
                                class="text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800 transition-all duration-200">
                                Edit pelanggan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection


<script>
    document.addEventListener("DOMContentLoaded", function() {
        const fotoInput = document.getElementById('foto_pelanggan');
        const imageContainer = document.getElementById('imageContainer');

        // Image preview functionality
        if (fotoInput && imageContainer) {
            fotoInput.addEventListener('change', function(e) {
                const file = e.target.files[0];

                if (file) {
                    // Validate file type
                    const validTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
                    if (!validTypes.includes(file.type)) {
                        alert('Harap pilih file gambar yang valid (PNG, JPG, atau GIF)');
                        this.value = '';
                        return;
                    }

                    // Validate file size (10MB limit)
                    const maxSize = 10 * 1024 * 1024; // 10MB
                    if (file.size > maxSize) {
                        alert('Ukuran file terlalu besar. Maksimal 10MB');
                        this.value = '';
                        return;
                    }

                    // Create FileReader to read the file
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        // Replace the image container content with new image
                        imageContainer.innerHTML = `
                            <img class="w-full rounded-lg shadow-md" 
                                 src="${e.target.result}" 
                                 alt="Preview gambar baru" 
                                 style="max-height: 400px; object-fit: contain;" />
                            <p class="text-sm text-gray-500 mt-2 text-center">Preview gambar baru</p>
                        `;
                    };

                    reader.onerror = function() {
                        alert('Terjadi kesalahan saat membaca file');
                    };

                    // Read file as data URL
                    reader.readAsDataURL(file);
                }
            });
        }

    });
</script>
