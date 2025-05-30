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
        ".delete-produk-form button[data-produk-id], .delete-pelanggan-form button[data-pelanggan-id]"
    );

    deleteButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const itemId = this.dataset.produkId || this.dataset.pelangganId;
            const form = document.getElementById(`deleteForm-${itemId}`);
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
    const storeForm = document.getElementById("storeDataForm");

    if (storeForm) {
        storeForm.addEventListener("submit", function (event) {
            event.preventDefault();

            const formData = new FormData(this);
            const actionUrl = this.getAttribute("action");
            const csrfToken = this.querySelector('input[name="_token"]').value;

            Swal.fire({
                title: "Menyimpan Data...",
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
    const editForms = document.querySelectorAll(
        "form.edit-produk-form, form.edit-pelanggan-form"
    );

    editForms.forEach((form) => {
        form.addEventListener("submit", function (event) {
            event.preventDefault();

            const formData = new FormData(this);
            const actionUrl = this.getAttribute("action");
            const csrfToken = this.querySelector('input[name="_token"]').value;
            const isProduk = this.classList.contains("edit-produk-form");
            const entityType = isProduk ? "Produk" : "Pelanggan";
            const nameField = isProduk ? "NamaProduk" : "NamaPelanggan";

            // Show loading SweetAlert
            Swal.fire({
                title: `Mengupdate ${entityType}...`,
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

                    if (data && data.status === "success") {
                        Swal.fire({
                            icon: "success",
                            title: `${entityType} Berhasil Diupdate!`,
                            text:
                                data.message ||
                                `${entityType} berhasil diupdate!`,
                            showConfirmButton: false,
                            timer: 2000,
                        }).then(() => {
                            // Update the name in breadcrumb if changed
                            if (data.data && data.data[nameField]) {
                                const breadcrumbName = document.querySelector(
                                    ".ms-1.text-sm.font-medium.text-gray-500.md\\:ms-2.dark\\:text-gray-400"
                                );
                                if (breadcrumbName) {
                                    breadcrumbName.textContent =
                                        data.data[nameField];
                                }

                                // Update the header title
                                const headerTitle = document.querySelector(
                                    "h1 span.text-gray-600"
                                );
                                if (headerTitle) {
                                    headerTitle.textContent =
                                        data.data[nameField];
                                }
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: `Gagal Mengupdate ${entityType}!`,
                            text:
                                data.message ||
                                `Terjadi kesalahan saat mengupdate ${entityType.toLowerCase()}.`,
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
    });
}

document.addEventListener("DOMContentLoaded", () => {
    initFlashedMessages();
    setupDeleteListeners();
    setupStoreListener();
    setupUpdateListener();
});
