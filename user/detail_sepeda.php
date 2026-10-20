<?php
session_start();
$_SESSION['title'] = "tamplate";

include "../includes/baseURL.php";
include "../koneksi.php";
include "../includes/header_user.php";
?>

<head>
    <link rel="stylesheet" href="<?= base_url ?>assets/css/detail.css">
</head>

<?php
$id_sepeda = $_GET['id'];
$sql = "SELECT 
    tb_sepeda.tipe_sepeda, 
    tb_sepeda.berat, 
    tb_sepeda.ukuran, 
    tb_sepeda.harga, 
    tb_sepeda.fd, 
    tb_sepeda.rd, 
    tb_sepeda.foto, 
    tb_kategori.nama_kategori, 
    tb_kategori.deskripsi_kategori, 
    tb_stok.stok
FROM tb_sepeda 
INNER JOIN tb_kategori 
    ON tb_sepeda.id_kategori = tb_kategori.id_kategori 
INNER JOIN tb_stok 
    ON tb_sepeda.id_sepeda = tb_stok.id_sepeda 
INNER JOIN tb_dealer 
    ON tb_stok.id_dealer = tb_dealer.id_dealer 
WHERE tb_sepeda.id_sepeda = '$id_sepeda';";

$sql_dealer = "SELECT 
    tb_dealer.id_dealer,
    tb_dealer.nama_dealer, 
    tb_dealer.alamat, 
    tb_dealer.no_hp, 
    tb_dealer.email, 
    tb_dealer.instagram
FROM tb_stok
INNER JOIN tb_sepeda 
    ON tb_stok.id_sepeda = tb_sepeda.id_sepeda
INNER JOIN tb_dealer 
    ON tb_stok.id_dealer = tb_dealer.id_dealer 
WHERE tb_stok.id_sepeda = $id_sepeda
GROUP BY tb_dealer.id_dealer";


$sql_eksekusi = mysqli_query($koneksi, $sql);
$sql_eksekusi2 = mysqli_query($koneksi, $sql_dealer);
$data = mysqli_fetch_array($sql_eksekusi);
$data_dealer = mysqli_fetch_array($sql_eksekusi2);

?>
<div class="product-page">
    <div class="container py-5">

        <!-- Fitur Breadcrumb Navigasi -->
         <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a href="<?= base_url ?>" class="text-dark text-decoration-none fw-bold">Beranda</a>
                        </li>
                        <li class="breadcrumb-item active fw-bold" style="color: #1E3A8A;" aria-current="page">
                            <?= $data['nama_kategori']?>
                        </li>
                        <li class="breadcrumb-item active fw-bold" style="color: #1E3A8A;" aria-current="page">
                            <?= $data['tipe_sepeda']?>
                        </li>
                    </ol>
                </nav>

        <div class="row g-4 align-items-start">

            <!-- =====================================
            FITUR KOLOM KIRI: GALERI GAMBAR PRODUK
       ====================================== -->
            <div class="col-12 col-md-5">

                <!-- Kotak Tampilan Gambar Utama -->
                <div class="product-image-box d-flex align-items-center justify-content-center p-4">
                    <img
                        src="../assets/kategori/kategori5.jpg"
                        alt="Preview Produk"
                        class="img-fluid product-main-image">
                </div>

                <!-- Daftar Gambar Thumbnail -->
                <div class="d-flex gap-3 mt-3">
                    <div class="product-thumbnail-wrapper active">
                        <img
                            src="../assets/kategori/kategori5.jpg"
                            alt="Thumbnail 1"
                            class="product-thumbnail">
                    </div>
                    <div class="product-thumbnail-wrapper">
                        <img
                            src="../assets/kategori/kategori5.jpg"
                            alt="Thumbnail 2"
                            class="product-thumbnail">
                    </div>
                </div>  

            </div>


            <!-- =====================================
            FITUR KOLOM KANAN: INFORMASI DETAIL PRODUK
       ====================================== -->
            <div class="col-12 col-md-7">
                <div class="product-info">

                    <!-- Fitur Badge Kategori -->
                    <span class="product-category">
                        <?= $data['nama_kategori'] ?>
                    </span>

                    <!-- Fitur Judul Produk -->
                    <h1 class="fw-bold fs-3 mb-2">
                        <?= $data['tipe_sepeda'] ?>
                    </h1>

                    <!-- Fitur Harga Produk -->
                    <div class="product-price">
                        <?= "Rp. " . $data['harga']?>
                    </div>

                    <!-- Fitur Deskripsi Lengkap Produk -->
                    <div class="product-description mb-3">
                        <p class="mb-2">Sepeda serbaguna berukuran <b><?= $data['ukuran']?></b> yang dirancang khusus untuk menemani berbagai aktivitas harian maupun petualangan Anda. Mengusung desain fungsional dan modern, sepeda ini memadukan material rangka yang kokoh, kenyamanan tinggi, serta gaya yang trendi.

                            Fitur Utama: Rangka tangguh dan stabil, komponen yang andal di kelasnya, serta posisi berkendara yang ergonomis.

                            Peruntukan: Sangat ideal dan nyaman digunakan untuk mobilitas harian, berolahraga ringan, maupun sekadar bersepeda santai di akhir pekan.</p>
                    </div>

                    <!-- Fitur Catatan Harga -->
                    <p class="fst-italic text-muted opacity-75 small mb-3">
                        *Harga wilayah Pulau Jawa &amp; Bali
                    </p>

                    <!-- Fitur Pilihan Varian Warna -->
                    <div class="accordion product-accordion" id="productAccordion">
                        <div class="accordion-item border-0 rounded-3 overflow-hidden">
                            <h2 class="accordion-header">
                                <button
                                    class="accordion-button collapsed fw-semibold small py-2"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#componentAccordion"
                                    aria-expanded="false"
                                    aria-controls="componentAccordion">
                                    Dealer yang menjual Sepeda Ini
                                </button>
                            </h2>
                            <div
                                id="componentAccordion"
                                class="accordion-collapse collapse"
                                data-bs-parent="#productAccordion">
                                <div class="accordion-body small text-secondary py-2">
                                    <ul class="mb-0 ps-3">
                                        <?php foreach($data_dealer as $dlr) :?>
                                        <li class="mb-1">Dealer : <?= $data_dealer['nama_dealer'] ?></li>
                                        <li class="mb-1">alamat : <?= $data_dealer['alamat'] ?></li>
                                        <li class="mb-1">Dealer : <?= $data_dealer['instagram'] ?></li>
                                        <li class="mb-1">Dealer : <?= $data_dealer['no_hp'] ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    <!-- Fitur Accordion Komponen / Spesifikasi -->
                    <div class="accordion product-accordion" id="productAccordion">
                        <div class="accordion-item border-0 rounded-3 overflow-hidden">
                            <h2 class="accordion-header">
                                <button
                                    class="accordion-button collapsed fw-semibold small py-2"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#componentAccordion"
                                    aria-expanded="false"
                                    aria-controls="componentAccordion">
                                    Komponen & Spesifikasi
                                </button>
                            </h2>
                            <div
                                id="componentAccordion"
                                class="accordion-collapse collapse"
                                data-bs-parent="#productAccordion">
                                <div class="accordion-body small text-secondary py-2">
                                    <ul class="mb-0 ps-3">
                                        <li class="mb-1">Ukuran : <?= $data['ukuran'] ?></li>
                                        <li class="mb-1">Berat  : <?= $data['berat'] ?></li>
                                        <li class="mb-1">FD     : <?= $data['fd'] ?></li>
                                        <li class="mb-1">RD: <?= $data['rd'] ?></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <!-- =====================================
          FITUR TOMBOL BAGIKAN (SHARE TO SOCIAL MEDIA)
     ====================================== -->
        <div class="container-fluid px-0 my-5">
            <div class="row g-2">
                <!-- Tombol Facebook -->
                <div class="col-12 col-sm-6 col-md-3">
                    <a href="#" class="btn-share">
                        <i class="bi bi-facebook text-primary"></i>
                        Bagikan di Facebook
                    </a>
                </div>
                <!-- Tombol WhatsApp -->
                <div class="col-12 col-sm-6 col-md-3">
                    <a href="#" class="btn-share">
                        <i class="bi bi-whatsapp text-success"></i>
                        Bagikan di WhatsApp
                    </a>
                </div>
                <!-- Tombol Twitter / X -->
                <div class="col-12 col-sm-6 col-md-3">
                    <a href="#" class="btn-share">
                        <i class="bi bi-twitter-x text-dark"></i>
                        Bagikan di Twitter
                    </a>
                </div>
                <!-- Tombol Email -->
                <div class="col-12 col-sm-6 col-md-3">
                    <a href="#" class="btn-share">
                        <i class="bi bi-envelope text-danger"></i>
                        Bagikan via Email
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include "../includes/footer.php";
?>