/**
 * time.js
 * Menampilkan sapaan dinamis berdasarkan waktu (pagi/siang/sore/malam)
 * dan nama pengguna dari atribut data-nama.
 */
(function () {
    "use strict";

    function getSapaan() {
        const jam = new Date().getHours();

        if (jam >= 4 && jam < 11)  return { teks: "Selamat Pagi",   emoji: "🌤️" };
        if (jam >= 11 && jam < 15) return { teks: "Selamat Siang",  emoji: "☀️" };
        if (jam >= 15 && jam < 18) return { teks: "Selamat Sore",   emoji: "🌇" };
        return { teks: "Selamat Malam", emoji: "🌙" };
    }

    document.addEventListener("DOMContentLoaded", function () {
        const el = document.getElementById("teks-sapaan");
        if (!el) return;

        const nama = el.dataset.nama || "Pengguna";
        const { teks, emoji } = getSapaan();

        el.textContent = `${emoji} ${teks}, ${nama}!`;

        // Animasi fade-in halus
        el.style.opacity = "0";
        el.style.transition = "opacity .6s ease";
        requestAnimationFrame(() => { el.style.opacity = "1"; });
    });
})();