<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Perhitungan - Prediksi Populasi</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
  <header>
    <img src="logo.png" alt="Logo" style="height: 50px;">
    <nav>
      <a href="home.php">Home</a>
      <a href="metode.php">Metode</a>
      <a href="hitungan.php" class="active">Hitung</a>
    </nav>
    <h2 style="color: #7A3E9D; font-weight: bold;">Fitri Romadhona</h2>
  </header>

  <main class="main-content">
    <section class="form-section" id="hitung">
      <h2>PREDIKSI JUMLAH PENDUDUK</h2>
      <form id="populationForm">
        <label for="populasiAwal">Populasi Awal </label>
        <input type="number" id="populasiAwal" placeholder="Contoh: 1000" required>

        <label for="lajuPertumbuhan">Laju Pertumbuhan (k, dalam % per tahun)</label>
        <input type="number" id="lajuPertumbuhan" step="0.01" placeholder="Contoh: 2" required>

        <label for="jumlahTahun">Jumlah Tahun (t)</label>
        <input type="number" id="jumlahTahun" placeholder="Contoh: 10" required>

        <label for="metode">Metode yang digunakan</label>
        <select id="metode">
          <option value="euler">Euler</option>
          <option value="rk4">RK4 (Runge-Kutta Orde 4)</option>
        </select>

        <button type="submit">HITUNG PREDIKSI</button>
      </form>

      <div id="hasilPrediksi" style="margin-top: 30px; padding: 20px; background-color: #e9f5e9; border-left: 5px solid #4CAF50; border-radius: 5px; display: none;">
        <h3>Hasil Prediksi:</h3>
        <p id="teksHasil"></p>
        <canvas id="grafikPopulasi" width="400" height="200"></canvas>
      </div>
    </section>
  </main>

  <footer>
    &copy; Fitri Romadhona - Prediksi Populasi
  </footer>

  <script>
    function dpdt(p, k) {
      return k * p;
    }

    function eulerMethod(p0, k_percent, t, dt = 1) {
      let p = p0;
      const k = k_percent / 100;
      const numSteps = Math.round(t / dt);
      for (let i = 0; i < numSteps; i++) {
        p = p + dpdt(p, k) * dt;
      }
      return Math.round(p);
    }

    function rk4Method(p0, k_percent, t, dt = 1) {
      let p = p0;
      const k = k_percent / 100;
      const numSteps = Math.round(t / dt);
      for (let i = 0; i < numSteps; i++) {
        const k1 = dpdt(p, k);
        const k2 = dpdt(p + 0.5 * dt * k1, k);
        const k3 = dpdt(p + 0.5 * dt * k2, k);
        const k4 = dpdt(p + dt * k3, k);
        p = p + (dt / 6) * (k1 + 2 * k2 + 2 * k3 + k4);
      }
      return Math.round(p);
    }

    document.getElementById('populationForm').addEventListener('submit', function(event) {
      event.preventDefault();

      const p0 = parseFloat(document.getElementById('populasiAwal').value);
      const k_percent = parseFloat(document.getElementById('lajuPertumbuhan').value);
      const t = parseFloat(document.getElementById('jumlahTahun').value);
      const metode = document.getElementById('metode').value;

      if (isNaN(p0) || isNaN(k_percent) || isNaN(t)) {
        alert("Harap masukkan semua nilai dengan benar.");
        return;
      }
      if (p0 <= 0 || t < 0) {
        alert("Populasi awal harus lebih besar dari 0 dan jumlah tahun tidak boleh negatif.");
        return;
      }

      let hasil, namaMetode;
      if (metode === 'euler') {
        hasil = eulerMethod(p0, k_percent, t);
        namaMetode = "Euler";
      } else if (metode === 'rk4') {
        hasil = rk4Method(p0, k_percent, t);
        namaMetode = "RK4 (Runge-Kutta Orde 4)";
      }

      const hasilPrediksiDiv = document.getElementById('hasilPrediksi');
      const teksHasilP = document.getElementById('teksHasil');

      teksHasilP.innerHTML = `Dengan populasi awal <strong>${p0.toLocaleString()}</strong>, laju pertumbuhan <strong>${k_percent}%</strong> per tahun, dan periode <strong>${t} tahun</strong>, prediksi jumlah penduduk menggunakan metode <strong>${namaMetode}</strong> adalah sekitar <strong>${hasil.toLocaleString()}</strong>.`;
      hasilPrediksiDiv.style.display = 'block';

      // Data grafik
      let populasiSetiapTahun = [];
      let tahun = [];

      let currentPop = p0;
      const k = k_percent / 100;

      for (let i = 0; i <= t; i++) {
        tahun.push(`Tahun ${i}`);
        populasiSetiapTahun.push(Math.round(currentPop));

        if (metode === 'euler') {
          currentPop = currentPop + dpdt(currentPop, k);
        } else if (metode === 'rk4') {
          const k1 = dpdt(currentPop, k);
          const k2 = dpdt(currentPop + 0.5 * k1, k);
          const k3 = dpdt(currentPop + 0.5 * k2, k);
          const k4 = dpdt(currentPop + k3, k);
          currentPop = currentPop + (1 / 6) * (k1 + 2 * k2 + 2 * k3 + k4);
        }
      }

      const ctx = document.getElementById('grafikPopulasi').getContext('2d');
      if (window.myChart) {
        window.myChart.destroy();
      }

      window.myChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: tahun,
          datasets: [{
            label: 'Prediksi Populasi',
            data: populasiSetiapTahun,
            backgroundColor: 'rgba(123, 63, 168, 0.2)',
            borderColor: '#7A3E9D',
            borderWidth: 2,
            pointRadius: 4,
            fill: true
          }]
        },
        options: {
          responsive: true,
          plugins: {
            legend: {
              display: true
            },
            tooltip: {
              callbacks: {
                label: function(context) {
                  return ` ${context.parsed.y.toLocaleString()} jiwa`;
                }
              }
            }
          },
          scales: {
            y: {
              beginAtZero: true,
              title: {
                display: true,
                text: 'Jumlah Penduduk'
              }
            },
            x: {
              title: {
                display: true,
                text: 'Tahun ke-'
              }
            }
          }
        }
      });
    });
  </script>
</body>
</html>
