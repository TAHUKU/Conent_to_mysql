document.addEventListener("DOMContentLoaded", function () {
    // Ambil jam saat ini dari perangkat user (0 - 23)
    const jam = new Date().getHours();
    let sapaan = "";

    // Tentukan sapaan berdasarkan jam
    if (jam >= 3 && jam < 11) {
        sapaan = "Selamat Pagi";
    } else if (jam >= 11 && jam < 15) {
        sapaan = "Selamat Siang";
    } else if (jam >= 15 && jam < 18) {
        sapaan = "Selamat Sore";
    } else {
        sapaan = "Selamat Malam";
    }

    // Cari elemen HTML yang punya id "teks-sapaan" lalu masukkan teksnya
    const elemenSapaan = document.getElementById("teks-sapaan");
    if (elemenSapaan) {
        // Ambil nama dari atribut data-nama yang kita simpan dari PHP
        const namaUser = elemenSapaan.getAttribute("data-nama");
        elemenSapaan.innerText = `${sapaan}, ${namaUser}`;
    }
});