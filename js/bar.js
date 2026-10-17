document.addEventListener("DOMContentLoaded", function () {
    const canvasElement = document.getElementById('genderChart');
    if (!canvasElement) return;

    // Ambil data angka dari atribut data-* yang dikirim dari PHP
    const totalLaki = parseInt(canvasElement.getAttribute('data-laki')) || 0;
    const totalPerempuan = parseInt(canvasElement.getAttribute('data-perempuan')) || 0;

    const ctx = canvasElement.getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Laki-Laki', 'Perempuan'],
            datasets: [{
                label: 'Jumlah Pendaftar',
                data: [totalLaki, totalPerempuan],
                backgroundColor: [
                    'rgba(52, 152, 219, 0.7)', // Biru
                    'rgba(46, 204, 113, 0.7)'  // Hijau
                ],
                borderColor: [
                    'rgba(41, 128, 185, 1)',
                    'rgba(39, 174, 96, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
});