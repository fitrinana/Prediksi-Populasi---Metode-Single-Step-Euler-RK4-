<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Metode - Prediksi Populasi</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <img src="logo.png" alt="Logo" style="height: 50px;">
    <nav>
      <a href="home.php">Home</a>
      <a href="metode.php" class="active">Metode</a>
      <a href="hitung.php">Hitung</a>
    </nav>
    <h2 style="color: #7A3E9D; font-weight: bold;">Fitri Romadhona</h2>
  </header>

  <main class="main-content">
    <section class="method-section" id="metode">
        <h2>METODE PERHITUNGAN</h2>
        <div class="methods-container">
            <div class="method">
              <h3>SINGLE STEP METHOD</h3>
              <p>Single Step Method (Metode Satu Langkah) adalah teknik numerik yang digunakan untuk menyelesaikan persamaan diferensial biasa (ordinary differential equations/ODE) dengan menggunakan nilai solusi pada titik sebelumnya saja untuk menghitung solusi pada titik berikutnya.</p>
            </div>
            <div class="method">
              <h3>METODE EULER</h3>
              <p>Metode Euler adalah metode numerik paling sederhana untuk menyelesaikan persamaan diferensial biasa (ODE). Metode ini menggunakan nilai gradien (kemiringan) dari fungsi pada satu titik untuk memperkirakan nilai selanjutnya. Meskipun akurasinya rendah, metode ini merupakan dasar dari semua metode numerik lainnya.</p>
            </div>
            <div class="method">
              <h3>METODE RK4 (RUNGE-KUTTA ORDE 4)</h3>
              <p>Metode Runge-Kutta Orde 4 (RK4) adalah metode single step yang paling banyak digunakan karena menghasilkan akurasi tinggi tanpa perlu langkah sangat kecil. RK4 menggunakan empat perkiraan kemiringan (slope) dalam satu langkah untuk menghitung nilai berikutnya secara lebih akurat.</p>
            </div>
        </div>
    </section>
  </main>

  <footer>
    &copy; Fitri Romadhona - Prediksi Populasi
  </footer>
</body>
</html>