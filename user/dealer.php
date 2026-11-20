<?php
session_start();
$_SESSION['title'] = "tamplate";

include "../includes/baseURL.php";
include "../koneksi.php";
include "../includes/header_user.php";

$sql = "SELECT * FROM tb_dealer";
$sql_eksekusi = mysqli_query($koneksi, $sql);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Sepeda</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
</head>
<body class="bg-light">

<div class="container my-5">
    <h2 class="mb-4 text-center">Daftar Dealer</h2>
    <div class="row">
        <?php
        while ($data = mysqli_fetch_assoc($sql_eksekusi)) :
        ?>
             <div class="col-12 col-md-6 col-lg-3 my-3">
                <div class="card h-100 shadow-sm " >
                    <img src="../assets/kategori/dealer.jpg" class="card-img-top" alt="<?= $data['tipe_sepeda']; ?>" style="height: 180px; object-fit: cover;">
                    
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold text-primary"><?= $data['nama_dealer']; ?></h5>
                        <p class="card-text fw-bold fs-5 mb-2">
                            <?=$data['alamat']?>
                        </p>
                        <ul class="list-group list-group-flush mb-1">
                            <li class="list-group-item px-0 py-1"><strong>No HP     :</strong> <?= $data['no_hp']; ?> kg</li>
                            <li class="list-group-item px-0 py-1"><strong>Email     :</strong> <?= $data['email']; ?></li>
                            <li class="list-group-item px-0 py-1"><strong>Instagram     :</strong> <?= $data['instagram']; ?></li>
                        </ul>
                    </div>

                   
                    <div class="card-footer bg-transparent border-0 pb-3 pt-0">
                        <a href="tampil_filter_dealer.php?id_kategori=<?= $data['nama_dealer']; ?>" class="btn btn-dark w-100" style="background-color: #1E3A8A;">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        <?php
        endwhile;
        ?>
    </div>
</div>

</body>
</html>

<?php
include "../includes/footer.php";
?>