@extends('layout.app')

@section('title', 'Tambah Transaksi')

@section('content')

    <div class="bg-white dark:bg-gray-900 flex h-full ">
        <div class="sm:ml-64 p-4 flex flex-1 overflow-hidden h-full">
            <main class="flex-1 flex flex-col md:flex-row overflow-hidden">
                <div class="flex-1 max-h-screen overflow-y-scroll pr-4 pb-4"
                    style="scrollbar-width: none; -ms-overflow-style: none;">
                    <h1 class="text-3xl font-semibold text-left my-4 text-gray-900 dark:text-white">Tambahkan Transaksi</h1>

                    <form class="flex items-center max-w-sm my-1.5">
                        <label for="simple-search" class="sr-only">Search</label>
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6" />
                                </svg>
                            </div>
                            <input type="text" id="simple-search"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Search Product name..." required />
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

                    <div id="produk-wrapper" class="grid gap-4 grid-cols-2">
                        @foreach ($produks as $produk)
                            <div
                                class="rounded-lg border border-gray-200 bg-white p-3 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                                <div class="h-56 w-full">
                                    <img src="{{ route('produk.gambar', $produk->foto_produk) }}"
                                        alt="{{ $produk->NamaProduk }}" class="w-full h-full object-cover">
                                </div>
                                <div class="pt-6">
                                    <a href="#"
                                        class="text-lg font-semibold leading-tight text-gray-900 hover:underline dark:text-white">{{ $produk->NamaProduk }}</a>
                                    <ul class="mt-2 flex items-center gap-4">
                                        <li class="flex items-center gap-2">
                                            <svg class="w-[18px] h-[18px] text-gray-800 dark:text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="none" viewBox="0 0 24 24">
                                                <path fill="currentColor"
                                                    d="M6.94318 11h-.85227l.96023-2.90909h1.07954L9.09091 11h-.85227l-.63637-2.10795h-.02272L6.94318 11Zm-.15909-1.14773h1.60227v.59093H6.78409v-.59093ZM9.37109 11V8.09091h1.25571c.2159 0 .4048.04261.5667.12784.162.08523.2879.20502.3779.35937.0899.15436.1349.33476.1349.5412 0 .20833-.0464.38873-.1392.54119-.0918.15246-.2211.26989-.3878.35229-.1657.0824-.3593.1236-.5809.1236h-.75003v-.61367h.59093c.0928 0 .1719-.0161.2372-.0483.0663-.03314.1169-.08002.152-.14062.036-.06061.054-.13211.054-.21449 0-.08334-.018-.15436-.054-.21307-.0351-.05966-.0857-.10511-.152-.13636-.0653-.0322-.1444-.0483-.2372-.0483h-.2784V11h-.78981Zm3.41481-2.90909V11h-.7898V8.09091h.7898Z" />
                                                <path stroke="currentColor" stroke-linejoin="round" stroke-width="2"
                                                    d="M8.31818 2c-.55228 0-1 .44772-1 1v.72878c-.06079.0236-.12113.04809-.18098.07346l-.55228-.53789c-.38828-.37817-1.00715-.37817-1.39543 0L3.30923 5.09564c-.19327.18824-.30229.44659-.30229.71638 0 .26979.10902.52813.30229.71637l.52844.51468c-.01982.04526-.03911.0908-.05785.13662H3c-.55228 0-1 .44771-1 1v2.58981c0 .5523.44772 1 1 1h.77982c.01873.0458.03802.0914.05783.1366l-.52847.5147c-.19327.1883-.30228.4466-.30228.7164 0 .2698.10901.5281.30228.7164l1.88026 1.8313c.38828.3781 1.00715.3781 1.39544 0l.55228-.5379c.05987.0253.12021.0498.18102.0734v.7288c0 .5523.44772 1 1 1h2.65912c.5523 0 1-.4477 1-1v-.7288c.1316-.0511.2612-.1064.3883-.1657l.5435.2614v.4339c0 .5523.4477 1 1 1H14v.0625c0 .5523.4477 1 1 1h.0909v.0625c0 .5523.4477 1 1 1h.6844l.4952.4823c1.1648 1.1345 3.0214 1.1345 4.1863 0l.2409-.2347c.1961-.191.3053-.454.3022-.7277-.0031-.2737-.1183-.5342-.3187-.7207l-6.2162-5.7847c.0173-.0398.0342-.0798.0506-.12h.7799c.5522 0 1-.4477 1-1V8.17969c0-.55229-.4478-1-1-1h-.7799c-.0187-.04583-.038-.09139-.0578-.13666l.5284-.51464c.1933-.18824.3023-.44659.3023-.71638 0-.26979-.109-.52813-.3023-.71637l-1.8803-1.8313c-.3883-.37816-1.0071-.37816-1.3954 0l-.5523.53788c-.0598-.02536-.1201-.04985-.1809-.07344V3c0-.55228-.4477-1-1-1H8.31818Z" />
                                            </svg>
                                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                                {{ $produk->ProdukID }}
                                            </p>
                                        </li>
                                        <li class="flex items-center gap-2">
                                            <svg class="w-[18px] h-[18px] text-gray-800 dark:text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    d="M12.013 6.175 7.006 9.369l5.007 3.194-5.007 3.193L2 12.545l5.006-3.193L2 6.175l5.006-3.194 5.007 3.194ZM6.981 17.806l5.006-3.193 5.006 3.193L11.987 21l-5.006-3.194Z" />
                                                <path
                                                    d="m12.013 12.545 5.006-3.194-5.006-3.176 4.98-3.194L22 6.175l-5.007 3.194L22 12.562l-5.007 3.194-4.98-3.211Z" />
                                            </svg>
                                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                                {{ $produk->Stok }}</p>
                                        </li>
                                    </ul>
                                    <div class="mt-7 flex flex-col gap-2">
                                        <span class="text-xl font-extrabold leading-tight text-gray-900 dark:text-white">
                                            Rp {{ number_format($produk->Harga, 0, ',', '.') }}</span>

                                        <button type="button"
                                            onclick="addToCart('{{ $produk->ProdukID }}', '{{ $produk->NamaProduk }}', {{ $produk->Harga }})"
                                            class="text-white inline-flex items-center justify-center gap-1.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-1.5 me-1 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                            <svg class="w-6 h-6 text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd"
                                                    d="M5 3a1 1 0 0 0 0 2h.687L7.82 15.24A3 3 0 1 0 11.83 17h2.34A3 3 0 1 0 17 15H9.813l-.208-1h8.145a1 1 0 0 0 .979-.796l1.25-6A1 1 0 0 0 19 6h-2.268A2 2 0 0 1 15 9a2 2 0 1 1-4 0 2 2 0 0 1-1.732-3h-1.33L7.48 3.796A1 1 0 0 0 6.5 3H5Z"
                                                    clip-rule="evenodd" />
                                                <path fill-rule="evenodd"
                                                    d="M14 5a1 1 0 1 0-2 0v1h-1a1 1 0 1 0 0 2h1v1a1 1 0 1 0 2 0V8h1a1 1 0 1 0 0-2h-1V5Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <span>Add to cart</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div id="bill-product"
                    class="w-full h-screen md:w-lg px-4 py-8 bg-white dark:bg-gray-800 shadow-lg rounded-xl overflow-y-auto md:ml-4 flex-shrink-0">
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">Your Cart Summary</h2>

                    <div class="mb-6">
                        <label for="customer" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Pilih
                            Pelanggan:</label>
                        <select id="customer" name="customer"
                            class="block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <option value="">-- Pilih Pelanggan --</option>
                            @foreach ($pelanggans as $pelanggan)
                                <option value="{{ $pelanggan->PelangganID }}">{{ $pelanggan->NamaPelanggan }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="shadow-lg rounded-xl overflow-hidden mb-8">
                        <div class="p-6">
                            <div
                                class="hidden md:grid grid-cols-5 gap-4 text-sm font-semibold text-gray-600 dark:text-gray-400 border-b pb-3 mb-4">
                                <div class="col-span-2">Product</div>
                                <div class="text-center">Price</div>
                                <div class="text-center">Quantity</div>
                                <div class="text-right">Total</div>
                            </div>

                            <div id="cart-items">
                                <!-- Cart items will be dynamically added here -->
                            </div>
                        </div>

                        <div
                            class="bg-gray-50 dark:bg-gray-700 p-6 flex flex-col md:flex-row justify-between items-start md:items-center rounded-b-xl">
                            <div class="mb-4 md:mb-0">
                                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">Subtotal:</p>
                                <p id="subtotal" class="text-xl font-bold text-gray-900 dark:text-white">Rp 0</p>
                            </div>
                            <button type="button" onclick="proceedToCheckout()"
                                class="w-full md:w-auto inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200">
                                <svg class="w-5 h-5 mr-2 -ml-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2Zm-1 14a1 1 0 1 0 2 0v-3h3a1 1 0 1 0 0-2h-3V8a1 1 0 1 0-2 0v3H8a1 1 0 1 0 0 2h3v3Z"
                                        clip-rule="evenodd" />
                                </svg>
                                Proceed to Checkout
                            </button>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        let cart = {};

        function addToCart(productId, productName, productPrice) {
            if (cart[productId]) {
                cart[productId].quantity += 1;
            } else {
                cart[productId] = {
                    name: productName,
                    price: productPrice,
                    quantity: 1
                };
            }
            updateCartUI();
        }

        function updateCartUI() {
            const cartItemsContainer = document.getElementById('cart-items');
            cartItemsContainer.innerHTML = '';
            let subtotal = 0;

            for (const productId in cart) {
                const item = cart[productId];
                const total = item.price * item.quantity;
                subtotal += total;

                const cartItemHTML = `
            <div class="grid grid-cols-1 md:grid-cols-5 gap-4 items-center border-b border-gray-200 dark:border-gray-700 py-4 last:border-b-0">
                <div class="col-span-2 flex items-center">
                    <div>
                        <p class="font-semibold text-gray-900 dark:text-white">${item.name}</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">#${productId}</p>
                    </div>
                </div>
                <div class="text-center font-medium text-gray-800 dark:text-gray-300">Rp ${item.price.toLocaleString()}</div>
                <div class="text-center">
                    <div class="flex items-center justify-center space-x-2">
                        <button onclick="changeQuantity('${productId}', -1)" class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white px-2 py-1 rounded-md hover:bg-gray-300 dark:hover:bg-gray-600">-</button>
                        <span class="font-semibold text-gray-900 dark:text-white">${item.quantity}</span>
                        <button onclick="changeQuantity('${productId}', 1)" class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white px-2 py-1 rounded-md hover:bg-gray-300 dark:hover:bg-gray-600">+</button>
                    </div>
                </div>
                <div class="text-right font-bold text-gray-900 dark:text-white">Rp ${total.toLocaleString()}</div>
            </div>
        `;
                cartItemsContainer.innerHTML += cartItemHTML;
            }

            document.getElementById('subtotal').textContent = `Rp ${subtotal.toLocaleString()}`;
        }

        function changeQuantity(productId, delta) {
            if (cart[productId]) {
                cart[productId].quantity += delta;
                if (cart[productId].quantity <= 0) {
                    delete cart[productId];
                }
                updateCartUI();
            }
        }

        function proceedToCheckout() {
            const customerId = document.getElementById('customer').value;
            if (!customerId) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan!',
                    text: 'Silakan pilih pelanggan terlebih dahulu.',
                    confirmButtonText: 'OK'
                });
                return;
            }

            // Kumpulkan item dari keranjang
            const items = Object.keys(cart).map(productId => ({
                ProdukID: productId,
                JumlahProduk: cart[productId].quantity
            }));

            // Buat data yang akan dikirim
            const data = {
                PelangganID: customerId,
                items: items
            };

            // Tampilkan loading
            Swal.fire({
                title: 'Memproses transaksi...',
                text: 'Mohon tunggu sebentar.',
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Kirim data ke server
            fetch('http://127.0.0.1:8000/api/penjualan/store', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Ada masalah saat mengirim data');
                    }
                    return response.json();
                })
                .then(result => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Transaksi berhasil disimpan!',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Optional: Reset keranjang setelah berhasil
                            // cart = {};
                            // updateCartUI();
                        }
                    });
                    console.log('Berhasil:', result);
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Ada kesalahan saat menyimpan transaksi. Silakan coba lagi.',
                        confirmButtonText: 'OK'
                    });
                    console.log('Error:', error);
                });
        }
    </script>

@endsection
