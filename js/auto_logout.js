// js/auto_logout.js

// Waktu timeout dalam milidetik (30 menit = 30 * 60 * 1000 = 1,800,000 ms)
const timeoutLimit = 30 * 60 * 1000; 
let logoutTimer;

function doLogout() {
    alert("Sesi Anda telah habis karena tidak ada aktivitas selama 30 menit.");
    // Mengarahkan ke file logout, sesuaikan jalur file jika diperlukan
    window.location.href = "../logout.php"; 
}

function resetTimer() {
    clearTimeout(logoutTimer);
    logoutTimer = setTimeout(doLogout, timeoutLimit);
}

// Daftarkan event listener untuk memantau aktivitas user
window.onload = resetTimer;
window.onmousemove = resetTimer;
window.onkeypress = resetTimer;
window.onclick = resetTimer;
window.onscroll = resetTimer;