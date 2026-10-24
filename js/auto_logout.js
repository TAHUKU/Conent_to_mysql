/**
 * auto_logout.js
 * Logout otomatis setelah periode tidak aktif (default 15 menit).
 */
(function () {
    "use strict";

    const BATAS_WAKTU_MENIT = 15;          // ubah sesuai kebutuhan
    const BATAS_MS = BATAS_WAKTU_MENIT * 60 * 1000;
    const HALAMAN_LOGOUT = "../logout.php";

    let timer = null;

    function logout() {
        window.location.href = HALAMAN_LOGOUT;
    }

    function resetTimer() {
        clearTimeout(timer);
        timer = setTimeout(logout, BATAS_MS);
    }

    function init() {
        // Pantau aktivitas pengguna
        ["mousemove", "keydown", "scroll", "click", "touchstart"].forEach(function (evt) {
            document.addEventListener(evt, resetTimer, { passive: true });
        });

        resetTimer();

        // Opsional: peringatan 1 menit sebelum logout
        setInterval(function () {
            // logika peringatan bisa ditambahkan di sini
        }, 60 * 1000);
    }

    document.addEventListener("DOMContentLoaded", init);
})();