import "./bootstrap";
import Swal from "sweetalert2";

/**
 * Initializes SweetAlert2 for flashed session messages.
 * This function should be called on page load.
 * (Keep this for other non-AJAX form submissions that redirect)
 */
function initFlashedMessages() {
    const successMessage = document.querySelector(
        'meta[name="success-message"]'
    );
    if (successMessage && successMessage.content) {
        Swal.fire({
            icon: "success",
            title: "Sukses!",
            text: successMessage.content,
            showConfirmButton: false,
            timer: 3000,
        });
    }

    const errorMessage = document.querySelector('meta[name="error-message"]');
    if (errorMessage && errorMessage.content) {
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: errorMessage.content,
            showConfirmButton: true,
        });
    }
}

/**
 * Attaches event listeners to all delete buttons.
 */
function setupDeleteListeners() {
    const deleteButtons = document.querySelectorAll(
        ".delete-produk-form button[data-produk-id]"
    );

    deleteButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const produkId = this.dataset.produkId;
            const form = document.getElementById(`deleteForm-${produkId}`);
            const actionUrl = form.getAttribute("action");
            const csrfToken = form.querySelector('input[name="_token"]').value;
            const methodSpoofing = form.querySelector(
                'input[name="_method"]'
            ).value;

            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Anda tidak akan bisa mengembalikan ini!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Batal",
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(actionUrl, {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": csrfToken,
                            "Content-Type": "application/json",
                            Accept: "application/json",
                        },
                        body: JSON.stringify({
                            _method: methodSpoofing,
                        }),
                    })
                        .then((response) => {
                            if (response.redirected) {
                                window.location.href = response.url;
                                return;
                            }
                            return response.json();
                        })
                        .then((data) => {
                            if (data.status === "success") {
                                Swal.fire({
                                    icon: "success",
                                    title: "Dihapus!",
                                    text: data.message,
                                    showConfirmButton: false,
                                    timer: 2000,
                                });

                                form.closest("tr").remove();
                            } else {
                                Swal.fire({
                                    icon: "error",
                                    title: "Gagal!",
                                    text: data.message,
                                    showConfirmButton: true,
                                });
                            }
                        })
                        .catch((error) => {
                            console.error("Error:", error);
                            Swal.fire({
                                icon: "error",
                                title: "Kesalahan Jaringan!",
                                text: "Terjadi kesalahan saat menghubungi server.",
                                showConfirmButton: true,
                            });
                        });
                }
            });
        });
    });
}

/**
 * Attaches event listener to the store product form.
 */
function setupStoreListener() {
    const storeForm = document.getElementById("storeProdukForm");

    if (storeForm) {
        storeForm.addEventListener("submit", function (event) {
            event.preventDefault();

            const formData = new FormData(this);
            const actionUrl = this.getAttribute("action");
            const csrfToken = this.querySelector('input[name="_token"]').value;

            Swal.fire({
                title: "Menyimpan Produk...",
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                },
            });

            fetch(actionUrl, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": csrfToken,

                    Accept: "application/json",
                },
                body: formData,
            })
                .then((response) => {
                    if (response.redirected) {
                        window.location.href = response.url;
                        return;
                    }
                    return response.json();
                })
                .then((data) => {
                    Swal.close();

                    if (data.status === "success") {
                        Swal.fire({
                            icon: "success",
                            title: "Berhasil!",
                            text: data.message,
                            showConfirmButton: false,
                            timer: 2000,
                        }).then(() => {
                            storeForm.reset();
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Gagal!",
                            text: data.message,
                            showConfirmButton: true,
                        });
                    }
                })
                .catch((error) => {
                    Swal.close();
                    console.error("Error:", error);
                    Swal.fire({
                        icon: "error",
                        title: "Kesalahan Jaringan!",
                        text: "Terjadi kesalahan saat menghubungi server.",
                        showConfirmButton: true,
                    });
                });
        });
    }
}

function setupUpdateListener() {
    const editForm = document.getElementById("editProdukForm");

    if (editForm) {
        handleFormSubmission(editForm, {
            loadingTitle: "Mengupdate Produk...",
            successTitle: "Berhasil Diupdate!",
            successText: (data) => data.message || "Produk berhasil diupdate!",
            errorTitle: "Gagal Mengupdate!",
            errorText: (data) => data.message || "Terjadi kesalahan saat mengupdate produk.",
            onSuccess: (data) => {
                // Optional: Update UI elements on the page with new data if needed
                // For example, if you have a product name displayed outside the form:
                // document.querySelector('.product-name-display').innerText = data.data.NamaProduk;
                // If you want to redirect after a successful update (for non-SPA flows)
                // window.location.href = "{{ route('produk.all') }}"; // Redirect to product list
                // If you just want to stay on the page, no action is needed here.
            },
            // You might want a confirmation dialog for updates too, uncomment if desired:
            // confirm: true,
            // confirmOptions: {
            //     title: "Konfirmasi Update?",
            //     text: "Apakah Anda yakin ingin menyimpan perubahan ini?",
            //     icon: "question",
            //     confirmButtonText: "Ya, Update!",
            //     cancelButtonText: "Batal",
            // },
        });
    }
}

document.addEventListener("DOMContentLoaded", () => {
    initFlashedMessages();
    setupDeleteListeners();
    setupStoreListener();
    setupUpdateListener();
});
