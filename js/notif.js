function toggleNotificationDropdown() {
    const dropdown = document.getElementById('notifDropdown');
    const badge = document.getElementById('notificationBadge');
    
    // Buka/tutup dropdown
    dropdown.classList.toggle('active');
    
    // Jika dropdown dibuka, sembunyikan badge angka merahnya
    if (dropdown.classList.contains('active') && badge) {
        badge.style.display = 'none';
        
        // Simpan jumlah notif terakhir yang sudah dilihat ke browser
        const currentCount = badge.getAttribute('data-count');
        localStorage.setItem('seen_notif_count', currentCount);
    }
}

// Cek saat halaman dimuat: jika jumlah pendaftar sama dengan yang terakhir dilihat, sembunyikan badge
window.addEventListener('DOMContentLoaded', function() {
    const badge = document.getElementById('notificationBadge');
    if (badge) {
        const currentCount = badge.getAttribute('data-count');
        const seenCount = localStorage.getItem('seen_notif_count');
        
        // Jika jumlah pendaftar hari ini sama dengan yang sudah pernah diklik sebelumnya
        if (seenCount === currentCount) {
            badge.style.display = 'none';
        }
    }
});

// Menutup dropdown jika diklik di luar area lonceng
window.addEventListener('click', function(e) {
    const wrapper = document.querySelector('.notification-wrapper');
    const dropdown = document.getElementById('notifDropdown');
    if (wrapper && dropdown && !wrapper.contains(e.target)) {
        dropdown.classList.remove('active');
    }
});