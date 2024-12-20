<?php
session_start();
if (!isset($_SESSION['username'])) {
    // Redirect jika tidak ada session
    header("Location: ../login/form_login.html");
    exit();
}
?>

<?php
// Koneksi ke database
include 'db/koneksi.php';

$queryTotalRekap = "SELECT COUNT(*) as total_rekap FROM migrasi";
$queryAspirasiMasuk = "SELECT COUNT(*) as total_aspirasi FROM aspirasi";

$resultRekap = mysqli_query($conn, $queryTotalRekap);
$resultAspirasi = mysqli_query($conn, $queryAspirasiMasuk);

$totalRekap = mysqli_fetch_assoc($resultRekap)['total_rekap'];
$totalAspirasi = mysqli_fetch_assoc($resultAspirasi)['total_aspirasi'];

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <script src="my_chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.js"></script>
</head>

<body>
    <!-- navigation -->
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="#">
                        <span class="icon"><img src="logo1.png" width="75%" height="85%"></span>
                        <span class="title"><img src="Logo.png" width="85%" height="80%"></span>
                    </a>
                </li>
                <li>
                    <a href="../beranda/beranda.php">
                        <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
                        <span class="title">Home</span>
                    </a>
                </li>
                <li>
                    <a href="../upload/UploadFile.php">
                        <span class="icon"><ion-icon name="add-circle-outline"></ion-icon></span>
                        <span class="title">Upload Berita</span>
                    </a>
                </li>
                <!-- <li>
                    <a href="#">
                        <span class="icon"><ion-icon name="reader-outline"></ion-icon></span>
                        <span class="title">Pesan Aspirasi</span>
                    </a>
                </li>-->
                <li>
                    <a href="../migrasi/formMigrasi.php">
                        <span class="icon"><ion-icon name="documents-outline"></ion-icon></span>
                        <span class="title">Data Migrasi</span>

                    </a>
                </li>
                <li>
                    <a href="../migrasi/rekapMigrasi.php">
                        <span class="icon"><ion-icon name="folder-outline"></ion-icon></span>
                        <span class="title">Rekap Migrasi</span>
                    </a>
                </li>

                <!--  <li>
                    <a href="../data_login/index.php">
                        <span class="icon"><ion-icon name="bag-outline"></ion-icon></span>
                        <span class="title">Data Log In</span>
                    </a>
                </li>-->
                <li>
                    <a href="../halaman_utama/index.php">
                        <span class="icon"><ion-icon name="log-out-outline"></ion-icon></span>
                        <span class="title">Keluar</span>
                    </a>
                </li>
            </ul>

        </div>

        <!--Main-->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>
                <div class="search">
                    <label>
                        <input type="text" placeholder="search here" />
                        <ion-icon name="search-outline"></ion-icon>
                    </label>
                </div>
                <div class="user">
                    <img src="../img/Profil.jpeg" alt="" style="margin-top: 4%;" />
                </div>
            </div>

            <!-- ======= card ===== -->
            <div class="cardBox">
                <div class="card">
                    <div>
                        <div class="number"><?= $totalRekap ?></div>
                        <div class="cardName">Data Migrasi Masuk</div>
                    </div>
                    <div class="iconBox"><ion-icon name="folder-outline"></ion-icon></div>
                </div>
                <div class="card">
                    <div>
                        <div class="number"><?= $totalAspirasi ?></div>
                        <div class="cardName">Data Aspirasi Masuk</div>
                    </div>
                    <div class="iconBox"><ion-icon name="reader-outline"></ion-icon></div>
                </div>
                <div class="card">
                    <div>
                        <div class="number"></div>
                        <div class="cardName">Data Login</div>
                    </div>
                    <div class="iconBox"><ion-icon name="documents-outline"></ion-icon></div>
                </div>
            </div>
            <!--Add Chart-->
            <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.js"></script>
            <script>
                // Data from PHP to JS
                const totalMigrasi = <?= $totalRekap ?>;
                const totalAspirasi = <?= $totalAspirasi ?>;
                const totalBerita = <?= $totalBerita ?>;
            </script>
            <script src="my_chart.js"></script>

            <div class="graphBox">
                <div class="box">
                    <canvas id="myChart"></canvas>
                </div>
                <div class="box">
                    <canvas id="earning"></canvas>
                </div>
            </div>

        </div>

    </div>
    <!--memanggil file javascript / main.js -->

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script>
        //menambahkankan hover pada klik menu
        let list = document.querySelectorAll(".navigation li");

        function activeLink() {
            list.forEach((item) => {
                item.classList.remove("hovered");
            });
            this.classList.add("hovered");
        }
        list.forEach((item) => item.addEventListener("mouseover", activeLink));
        // menu toggle
        let toggle = document.querySelector(".toggle");
        let navigation = document.querySelector(".navigation");
        let main = document.querySelector(".main");
        toggle.onclick = function() {
            navigation.classList.toggle("active");
            main.classList.toggle("active");
        };
    </script>
    <script>
        // Data dari PHP
        const chartData = <?= $chartDataJson; ?>;
    </script>

</body>

</html>