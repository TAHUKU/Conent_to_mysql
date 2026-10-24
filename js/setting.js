function togglePassword(fieldId, iconElement) {
    const inputField = document.getElementById(fieldId);
    
    if (inputField.type === "password") {
        inputField.type = "text";
        iconElement.classList.remove("fa-eye");
        iconElement.classList.add("fa-eye-slash"); // Ubah ikon jadi mata dicoret (sembunyikan)
    } else {
        inputField.type = "password";
        iconElement.classList.remove("fa-eye-slash");
        iconElement.classList.add("fa-eye"); // Ubah ikon kembali jadi mata biasa
    }
}
