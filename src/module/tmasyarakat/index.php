<?php

include "src/config/connect.php";

$level = $_SESSION['level'];

if ($level != "Masyarakat") {
    echo "<script>
    alert('Anda tidak berhak mengakses modul ini!');
    document.location='?module=home';
    </script>";
}

$id_masyarakat = mysqli_real_escape_string($conn, $_SESSION['id_masyarakat']);

// Delete
if (isset($_POST['delete'])) {
    $foto = $_POST['foto'];
    $direktori = "src/report/img/";

    if (file_exists($direktori . $foto)) {
        unlink($direktori . $foto);
    }

    $deleteQuery = "DELETE pengaduan, tanggapan FROM pengaduan JOIN tanggapan ON pengaduan.id_pengaduan = tanggapan.id_pengaduan WHERE pengaduan.id_pengaduan = $_POST[id_pengaduan]";

    $delete = mysqli_query($conn, $deleteQuery);

    if ($delete) {
        echo "<script>
                alert('Tanggapan berhasil dihapus!');
                document.location='?module=tmasyarakat';
            </script>";
    } else {
        echo "<script>
                alert('Tanggapan gagal dihapus!');
                document.location='?module=tmasyarakat';
            </script>";
    }
}
// Delete

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="src/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="src/assets/datatables/datatables.css">
    <script src="src/assets/datatables/datatables.js"></script>
    <title>Document</title>
</head>

<script>
    $(document).ready(function() {
        $('#table').dataTable({
            "scrollY": "300px",
            "scrollCollapse": true,
            "paging": true
        });
    });
</script>

<body>
    <div class="card">
        <div class="card-header fw-bold">
            Tanggapan
        </div>
        <div class="card-body">
            <table id="table" class="table border table-hover">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Petugas</th>
                        <th scope="col">Tanggal Masuk</th>
                        <th scope="col">Tangga l Ditanggapi</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Status</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php $query = mysqli_query($conn, "SELECT * FROM pengaduan INNER JOIN masyarakat ON pengaduan.id_masyarakat=masyarakat.id_masyarakat INNER JOIN tanggapan ON pengaduan.id_pengaduan=tanggapan.id_pengaduan INNER JOIN petugas ON tanggapan.id_petugas=petugas.id_petugas WHERE pengaduan.id_masyarakat = $id_masyarakat AND pengaduan.status = 'Selesai' ORDER BY tanggapan.tgl_tanggapan DESC"); ?>
                    <?php while ($result = mysqli_fetch_array($query)) : ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $result['nama']; ?></td>
                            <td><?php echo $result['nama_petugas']; ?></td>
                            <td><?php echo $result['tgl_pengaduan']; ?></td>
                            <td><?php echo $result['tanggapan']; ?></td>
                            <td><?php echo $result['judul']; ?></td>
                            <td><?php echo $result['status']; ?></td>
                            <td>
                                <div class='text-center'>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#moreModal<?= $no ?>" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a> |
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $no ?>" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                        <!-- Edit Modal -->
                        <div class="modal fade" id="moreModal<?= $no ?>" tabindex="-1">
                            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Detail</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="POST" action="">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col">
                                                    <p class="fw-bold">id_masyarakat : <?= $result['id_masyarakat'] ?></p>
                                                    <p class="fw-bold">Dari : <?= $result['nama'] ?></p>
                                                    <p class="fw-bold">Petugas : <?= $result['nama_petugas'] ?></p>
                                                    <p class="fw-bold">Tanggal Masuk : <?= $result['tgl_pengaduan'] ?></p>
                                                    <p class="fw-bold">Tanggal Ditanggapi : <?= $result['tgl_tanggapan'] ?></p>
                                                    <br>
                                                    <p class="fw-bold">Judul : <?= $result['judul'] ?></p>
                                                    <img width="300" src="src/report/img/<?php echo $result['foto']; ?>">
                                                    <br>
                                                    <br><b>Pesan</b>
                                                    <p><?= $result['isi_laporan'] ?></p>
                                                    <b>
                                                        <p>Status : <?= $result['status'] ?></p>
                                                    </b>
                                                </div>
                                                <div class="col">
                                                    <p><b>Tanggapan</b>
                                                    <p><?= $result['tanggapan'] ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <?php if ($level == "Petugas") : ?>
                                                <button type="submit" class="btn btn-primary" name="tanggapi">Tanggapi</button>
                                            <?php endif; ?>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Edit Modal -->

                        <!-- Delete Modal -->
                        <div class="modal fade" id="deleteModal<?= $no ?>" tabindex="-1">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Delete</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="post" action="">
                                        <input type="hidden" name="id_pengaduan" value="<?= $result['id_pengaduan'] ?>">
                                        <input type="hidden" name="foto" value="<?= $result['foto'] ?>">
                                        <div class="modal-body text-center">
                                            <p>Apakah anda yakin ingin menghapus pengaduan ini? <br>
                                                <span class="fw-bold text-danger"><?= $result['judul'] ?></span>
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" name="delete">Delete</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Delete Modal -->
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>