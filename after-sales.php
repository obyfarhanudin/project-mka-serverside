<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require 'vendor/autoload.php';


$mail = new PHPMailer(true);

if (isset($_POST['submit'])) {
   
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $alamat = isset($_POST['alamat']) ? $_POST['alamat'] : '';
    $merek = isset($_POST['merek']) ? $_POST['merek'] : '';
    $model = isset($_POST['model']) ? $_POST['model'] : '';
    $tahunbuat = isset($_POST['tahunbuat']) ? $_POST['tahunbuat'] : '';
    $nopol = isset($_POST['nopol']) ? $_POST['nopol'] : '';
    $norank = isset($_POST['norank']) ? $_POST['norank'] : '';
    $layanan = isset($_POST['layanan']) ? $_POST['layanan'] : '';
    $masalah = isset($_POST['masalah']) ? $_POST['masalah'] : '';
    $jadwal = isset($_POST['jadwal']) ? $_POST['jadwal'] : '';
    $lokasi = isset($_POST['lokasi']) ? $_POST['lokasi'] : '';

    try {
       
        $mail->SMTPDebug = SMTP::DEBUG_OFF;  
        $mail->isSMTP();  
        $mail->Host = 'smtp.gmail.com'; 
        $mail->SMTPAuth = true;  
        $mail->Username = 'si-23021@students.ithb.ac.id';  
        $mail->Password = 'qbpy ogzt mkcc afwd';  
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  
        $mail->Port = 587;  
        
        $mail->setFrom('ferdiansyahrafael01@gmail.com', 'Customer Service');
        $mail->addAddress('miayampangsit01@gmail.com', 'Recipient Name');  

        $mail->isHTML(true);  
        $mail->Subject = 'Formulir Purna Jual - Karoseri Mandiri Kerja Abadi';

 
        $mail->Body = '
            <h2>Formulir Purna Jual Diterima</h2>
            <p><strong>Informasi Pelanggan:</strong></p>
            <p>Nama: ' . $name . '</p>
            <p>Email: ' . $email . '</p>
            <p>No. Telepon: ' . $phone . '</p>
            <p>Alamat: ' . $alamat . '</p>
            <p><strong>Informasi Kendaraan:</strong></p>
            <p>Merek Kendaraan: ' . $merek . '</p>
            <p>Model Kendaraan: ' . $model . '</p>
            <p>Tahun Pembuatan: ' . $tahunbuat . '</p>
            <p>Nomor Polisi: ' . $nopol . '</p>
            <p>Nomor Rangka: ' . $norank . '</p>
            <p><strong>Layanan yang Diperlukan:</strong></p>
            <p>' . $layanan . '</p>
            <p><strong>Deskripsi Masalah:</strong></p>
            <p>' . $masalah . '</p>
            <p><strong>Jadwal dan Lokasi Layanan:</strong></p>
            <p>Jadwal: ' . $jadwal . '</p>
            <p>Lokasi: ' . $lokasi . '</p>
            <p>Terima kasih telah mengajukan layanan after sales. Tim kami akan segera merespon permintaan Anda.</p>
        ';

    
        $mail->AltBody = '
            Formulir Purna Jual Diterima

            Informasi Pelanggan:
            Nama: ' . $name . '
            Email: ' . $email . '
            No. Telepon: ' . $phone . '
            Alamat: ' . $alamat . '

            Informasi Kendaraan:
            Merek Kendaraan: ' . $merek . '
            Model Kendaraan: ' . $model . '
            Tahun Pembuatan: ' . $tahunbuat . '
            Nomor Polisi: ' . $nopol . '
            Nomor Rangka: ' . $norank . '

            Layanan yang Diperlukan:
            ' . $layanan . '

            Deskripsi Masalah:
            ' . $masalah . '

            Jadwal dan Lokasi Layanan:
            Jadwal: ' . $jadwal . '
            Lokasi: ' . $lokasi . '

            Terima kasih telah mengajukan layanan after sales. Tim kami akan segera merespon permintaan Anda.
        ';

     
        $mail->send();
        echo 'Pesan telah terkirim';
    } catch (Exception $e) {
        echo "Pesan gagal dikirim. Error: {$mail->ErrorInfo}";
    }
}


include "koneksi.php"; 

if (isset($_POST['submit'])) {
  
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $alamat = trim($_POST['alamat']);
    $merek = trim($_POST['merek']);
    $model = trim($_POST['model']);
    $tahunbuat = trim($_POST['tahunbuat']);
    $nopol = trim($_POST['nopol']);
    $norank = trim($_POST['norank']);
    $layanan = trim($_POST['layanan']);
    $masalah = trim($_POST['masalah']);
    $jadwal = trim($_POST['jadwal']);
    $lokasi = trim($_POST['lokasi']);
    $persetujuan = isset($_POST['persetujuan']) ? 1 : 0; 

    if (empty($name) || empty($email) || empty($phone)) {
        echo "Harap lengkapi nama, email, dan nomor HP!";
        exit;
    }

    $sql = "INSERT INTO purna_jual (name, email, phone, alamat, merek, model, tahunbuat, nopol, norank, layanan, masalah, jadwal, lokasi, persetujuan) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $db->prepare($sql);

    if ($stmt) {
        $stmt->bind_param(
            "sssssssssssssi", 
            $name, $email, $phone, $alamat, $merek, $model, $tahunbuat, 
            $nopol, $norank, $layanan, $masalah, $jadwal, $lokasi, $persetujuan
        );

        if ($stmt->execute()) {
            echo "<div style='color: green; text-align: center;'>Data berhasil disimpan!</div>";
        } else {
            echo "<div style='color: red; text-align: center;'>Gagal menyimpan data: " . $stmt->error . "</div>";
        }

        $stmt->close(); 
    } else {
        echo "Error pada query: " . $db->error;
    }

    $db->close(); 
}
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <title>CV. Mandiri Kerja Abadi</title>
        <meta name="description"
            content="CV. Mandiri Kerja Abadi, berdiri sejak 30 Maret 2016, adalah perusahaan karoseri terkemuka dengan komitmen pada kualitas tinggi dan kepuasan pelanggan.">
        <meta name="keywords"
            content="CV Mandiri Kerja Abadi, karoseri, kendaraan niaga, transportasi, solusi berkualitas, engineer berpengalaman, Dinas Perhubungan, industri karoseri, standar kualitas, inovasi, kepuasan pelanggan, karoseri mojokerto">
        <meta name="author" content="CV. Mandiri Kerja Abadi">
        <meta name="robots" content="index, follow">
        <meta property="og:title" content="CV. Mandiri Kerja Abadi - Karoseri Berkualitas Tinggi">
        <meta property="og:description"
            content="Dengan lebih dari 10 tahun pengalaman, CV. Mandiri Kerja Abadi menghadirkan solusi kendaraan niaga berkualitas tinggi, berkomitmen pada inovasi dan kepuasan pelanggan.">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="@MandiriKerjaAbadi">
        <meta name="twitter:title" content="CV. Mandiri Kerja Abadi - Karoseri Berkualitas Tinggi">
        <meta name="twitter:description"
            content="CV. Mandiri Kerja Abadi menyediakan solusi kendaraan niaga berkualitas tinggi, didukung oleh pengalaman lebih dari 10 tahun dan komitmen pada kepuasan pelanggan.">

        <!-- Favicons -->
        <link href="assets/logo/fav2.png" rel="icon">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com" rel="preconnect">
        <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
            rel="stylesheet">

        <!-- Vendor CSS Files -->
        <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link href="assets/vendor/aos/aos.css" rel="stylesheet">
        <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
        <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
        <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

        <!-- Main CSS File -->
        <link href="assets/css/main.css" rel="stylesheet">

    </head>

    <body class="index-page">

        <header id="header" class="header d-flex align-items-center fixed-top">
            <div
                class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

                <a href="index.php" class="logo d-flex align-items-center">
                    <img src="assets/logo/MKA-LOGO-WHITE.png" alt="logo cv" style="max-height: 200px;">
                </a>

                <nav id="navmenu" class="navmenu">
                    <ul>
                        <li><a href="index.php">Beranda</a></li>
                        <li><a href="about.html">Tentang Kami</a></li>
                        <li><a href="services.html">Layanan</a></li>
                        <li><a href="projects.html">Produk</a></li>
                        <li><a href="blog.html">Artikel</a></li>
                        <li><a href="galeri.html">Galeri</a></li>
                        <li><a href="contact.html">Kontak</a></li>
                        <li><a href="after-sales.php" class="active">Purna Jual</a></li>
                    </ul>
                    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
                </nav>

            </div>
        </header>

        <main class="main">

            <!-- Page Title -->
            <div class="page-title dark-background" style="background-image: url(assets/Foto/IMG_1486.JPG);">
                <div class="container position-relative">
                    <h1>Purna Jual</h1>
                    <nav class="breadcrumbs">
                        <ol>
                            <li><a href="index.php">Beranda</a></li>
                            <li class="current">Form Purna Jual</li>
                        </ol>
                    </nav>
                </div>
            </div><!-- End Page Title -->

            <!-- Contact Section -->
            <section id="contact" class="contact section">

                <div class="container" data-aos="fade-up" data-aos-delay="100">

                    <div class="row gy-4 mt-1">

                        <div class="col-lg-12">
                            <form method="POST" action="after-sales.php" id="postPengajuan" class="php-email-form" data-aos="fade-up"
                                data-aos-delay="400">
                                <div class="row gy-4">

                                    <div class="col-md-12">
                                        <h3 class="text-center">Form Purna Jual</h3>
                                    </div>

                              
                                    <div class="col-md-12">
                                        <label for="">Informasi pelanggan</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="name" class="form-control" placeholder="Nama Lengkap"
                                            required id="name">
                                    </div>

                                    <div class="col-md-4">
                                        <input type="email" name="email" class="form-control" placeholder="Email"
                                            id="email">
                                    </div>

                                    <div class="col-md-4 ">
                                        <input type="text" inputmode="numeric" class="form-control" name="phone"
                                            placeholder="Nomor Hp" id="phone">
                                    </div>

                                    <div class="col-md-12">
                                        <textarea class="form-control" name="alamat" rows="6" placeholder="Alamat"
                                            id="alamat"></textarea>
                                    </div>

                               
                                    <div class="col-md-12">
                                        <label for="">Informasi Kendaraan</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="merek" class="form-control"
                                            placeholder="Merek Kendaraan" id="merek">
                                    </div>

                                    <div class="col-md-4">
                                        <input type="text" name="model" class="form-control"
                                            placeholder="Model Kendaraan" id="model">
                                    </div>

                                    <div class="col-md-4 ">
                                        <input type="date" class="form-control" name="tahunbuat"
                                            placeholder="Tahun Pembuatan" id="tahunbuat">
                                    </div>

                                    <div class="col-md-6">
                                        <input type="text" name="nopol" class="form-control" placeholder="Nomor Polisi"
                                            id="nopol">
                                    </div>

                                    <div class="col-md-6">
                                        <input type="text" inputmode="numeric" class="form-control" name="norank"
                                            placeholder="Nomor Rangka" id="norank">
                                    </div>

                                  
                                    <div class="col-md-12">
                                        <label for="">Jenis Layanan</label>
                                    </div>
                                    <div class="col-md-12">
                                        <select name="layanan" id="layanan" class="form-select">
                                            <option value=""></option>
                                            <option value="pemeliharaan-rutin">Pemeliharaan Rutin</option>
                                            <option value="perbaikan-kerusakan">Perbaikan Kerusakan</option>
                                            <option value="penggantian-komponen">Penggantian Komponen</option>
                                            <option value="modifikasi-kendaraan">Modifikasi Kendaraan</option>
                                            <option value="lainnya">Lainnya</option>
                                        </select>
                                    </div>

                                    <!-- informasi Masalah -->
                                    <div class="col-md-12">
                                        <label for="">Deskripsi Masalah</label>
                                    </div>
                                    <div class="col-md-12">
                                        <textarea class="form-control" name="masalah" rows="6"
                                            placeholder="Deskripsikan Masalah Anda" id="masalah"></textarea>
                                    </div>


                                    <!-- informasi waktu pelayanan -->
                                    <div class="col-md-12">
                                        <label for="">Jadwal dan Lokasi Layanan</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="datetime-local" name="jadwal" class="form-control"
                                            placeholder="Jadwal dan Lokasi Layanan" id="jadwal">
                                    </div>

                                    <div class="col-md-6">
                                        <select name="lokasi" id="lokasi" class="form-select">
                                            <option value=""></option>
                                            <option value="di-bengkel">Di Bengkel</option>
                                            <option value="di-lokasi-pelanggan">Di Lokasi Pelanggan</option>
                                        </select>
                                    </div>

                                    <!--  -->
                                    <div class="col-md-12">
                                        <input type="checkbox" class="form-check" id="persetujuan" name="persetujuan">
                                        <label class="form-check-label" for="persetujuan">Dengan ini saya menyetujui
                                            syarat dan ketentuan layanan after
                                            sales yang telah ditetapkan.</label>
                                    </div>

                                    <!-- Tambahkan elemen ini di HTML Anda -->
                                    <div class="col-12 text-center">
                                        <div class="loading" style="display: none;">Loading...</div>
                                        <div class="error-message" style="display: none;">Tambah Data Gagal</div>
                                        <div class="sent-message" style="display: none;">
                                            <strong>Pesan Berhasil Terkirim</strong>Terima Kasih Atas Pengajuannya
                                        </div>
                                        <button type="submit" name="submit">Komentar Anda</button>
                                    </div>

                                </div>
                            </form>
                        </div><!-- End Contact Form -->

                    </div>

                </div>

            </section><!-- /Contact Section -->

        </main>

        <footer id="footer" class="footer dark-background">

            <div class="container footer-top">
                <div class="row gy-4">
                    <div class="col-lg-5 col-md-5 footer-about">
                        <a href="index.php" class="logo d-flex align-items-center">
                            <span class="sitename">Mandiri Kerja Abadi</span>
                        </a>
                        <div class="footer-contact pt-3">
                            <p>JL. Raya Jabon No : 6, Jokodayo Jabon, Kecamatan Mojoanyar, Kabupaten Mojokerto, Provinsi Jawa Timur</p>
                            <p class="mt-3"><strong>Phone : </strong> <span>0812-2222-8543</span></p>
                            <p><strong>Email : </strong> <span>karoserimandirikerjaabadi@gmail.com</span></p>
                        </div>
                        <div class="social-links d-flex mt-4">
                            <a href="https://www.tiktok.com/@karoseri_mka?_t=8oXG6z4FaFt&_r=1" class="me-2"><i
                                    class="bi bi-tiktok"></i></a>
                            <a href="https://www.facebook.com/profile.php?id=100072235188741&mibextid=ZbWKwL"
                                class="me-2"><i class="bi bi-facebook"></i></a>
                            <a href="https://www.instagram.com/karoserimandirikerjaabadi?igsh=MXJ5cTc4bDhvbjJjbQ=="
                                class="me-2"><i class="bi bi-instagram"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-1 col-md-1"></div>

                    <div class="col-lg-3 col-md-3 footer-links">
                        <h4>Direction</h4>
                        <ul>
                            <li><a href="index.php">Beranda</a></li>
                            <li><a href="about.html">Tentang Kami</a></li>
                            <li><a href="services.html">Layanan</a></li>
                            <li><a href="projects.html">Proyek</a></li>
                            <li><a href="blog.html">Artikel</a></li>
                            <li><a href="galeri.html">Galeri</a></li>
                            <li><a href="contact.html">Kontak</a></li>
                            <li><a href="#">Purna Jual</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-3 footer-hours">
                        <h4>Jam Operasional</h4>
                        <p>
                            <strong>Senin - Jumat : </strong> 08:00 - 17:00 <br>
                            <strong>Sabtu : </strong> 08:00 - 14:00 <br>
                            <strong>Minggu : </strong> Tutup
                        </p>
                    </div>
                </div>
            </div>

            <div class="container text-center mt-4">
                <div class="row">
                    <div class="col">
                        <p>© <span>Copyright</span> <strong class="px-1 sitename">Mandiri Kerja Abadi</strong> <span>All
                                Rights
                                Reserved</span></p>
                    </div>
                </div>
            </div>

        </footer>

        <!-- Scroll Top -->
        <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
                class="bi bi-arrow-up-short"></i></a>

        <!-- Preloader -->
        <div id="preloader"></div>

        <!-- Vendor JS Files -->
        <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/vendor/aos/aos.js"></script>
        <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
        <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
        <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
        <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
        <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>

        <!-- Main JS File -->
        <script src="assets/js/main.js"></script>
   

        <script>
          document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('postPengajuan');

    form.addEventListener('submit', function (event) {
     
        const useJavaScriptSim = false; 

        if (useJavaScriptSim) {
            event.preventDefault(); 
       
            document.querySelector('.loading').style.display = 'block';

      
            setTimeout(function () {
              
                document.querySelector('.loading').style.display = 'none';

         
                document.querySelector('.sent-message').style.display = 'block';

               
                setTimeout(function () {
                    document.querySelector('.sent-message').style.display = 'none';
                }, 3000);
            }, 2000);
        } 
       
    });
});

        </script>
    </body>

</html>