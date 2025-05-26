import "./bootstrap";
// Import SweetAlert2
import Swal from "sweetalert2";

// Make Swal globally available if you need to access it outside of this file
// window.Swal = Swal; // Uncomment if you need to call Swal.fire directly from other inline scripts

/**
 * Initializes SweetAlert2 for flashed session messages.
 * This function should be called on page load.
 */
function initFlashedMessages() {
    // Check for success message
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

    // Check for error message
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
 * Function to handle delete confirmation with SweetAlert2.
 * This function will be called from your Blade templates.
 * @param {number} produkId - The ID of the product to be deleted.
 */
window.confirmDelete = function (produkId) {
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
            document.getElementById("deleteForm-" + produkId).submit();
        }
    });
};

// Call the initFlashedMessages function when the DOM is fully loaded
document.addEventListener("DOMContentLoaded", () => {
    initFlashedMessages();
});
