       function toggleDropdown() {
            const menu = document.getElementById('dropdownMenu');
            menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
        }

        // Tutup dropdown jika klik di luar area avatar
        window.onclick = function(event) {
            if (!event.target.closest('.profile-dropdown-container')) {
                const menu = document.getElementById('dropdownMenu');
                if (menu && menu.style.display === 'block') {
                    menu.style.display = 'none';
                }
            }
        }