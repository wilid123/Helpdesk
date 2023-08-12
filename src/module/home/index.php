<?php

include "src/config/connect.php";

$level = $_SESSION['level'];
// Delete
if (isset($_POST['delete'])) {
    $foto = $_POST['foto'];
    $direktori = "src/report/img/";

    unlink($direktori . $foto);

    $query = mysqli_query($conn, "DELETE FROM pengaduan WHERE id_pengaduan = '$_POST[id_pengaduan]'");

    if ($query) {
        echo "<script>
                alert('Pengaduan berhasil dihapus!');
                document.location='?module=pengaduan';
            </script>";
    } else {
        echo "<script>
                alert('Hapus data gagal!');
                document.location='?module=pengaduan';
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
            Pengaduan
        </div>
        <div class="card-body">
            <table id="table" class="table border table-hover">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">NIK</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Tanggal Masuk</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Status</th>
                        <?php if ($level == "Petugas") : ?>
                        <th scope="col" class="text-center">Action</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php $query = mysqli_query($conn, "SELECT * FROM pengaduan INNER JOIN masyarakat ON pengaduan.nik=masyarakat.nik WHERE status = 'Proses' ORDER BY pengaduan.tgl_pengaduan DESC"); ?>
                    <?php while ($result = mysqli_fetch_array($query)) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $result['nik']; ?></td>
                            <td><?= $result['nama']; ?></td>
                            <td><?= $result['tgl_pengaduan']; ?></td>
                            <td><?= $result['judul']; ?></td>
                            <td><?= $result['status']; ?></td>
                            <td>
                            <?php if ($level == "Petugas") : ?>
                                <div class='text-center'>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#moreModal<?= $no ?>" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a> |
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $no ?>" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                                </div>
                            <?php endif; ?>
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
                                                    <p class="fw-bold">NIK : <?= $result['nik'] ?></p>
                                                    <p class="fw-bold">Dari : <?= $result['nama'] ?></p>
                                                    <p class="fw-bold">Tanggal Masuk : <?= $result['tgl_pengaduan'] ?></p>
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
                                                    <?php if ($level == "Petugas") : ?>
                                                        <?php if ($result['status'] == "Proses") : ?>
                                                            <div class="mb-3 container">
                                                                <label for="exampleFormControlTextarea1" class="form-label fw-bold">Tanggapan Anda</label>
                                                                <textarea class="form-control" name="tanggapan" id="exampleFormControlTextarea1" rows="5" required></textarea>
                                                            </div>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
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

                        <!-- Tanggapan Modal -->
                        <?php
                        if (isset($_POST['tanggapi'])) {
                            $tgl = date('Y-m-d');
                            $query = mysqli_query($conn, "INSERT INTO tanggapan VALUES (NULL,'" . $result['id_pengaduan'] . "','" . $tgl . "','" . $_POST['tanggapan'] . "','" . $id_petugas . "')");
                            if ($query) {
                                $update = mysqli_query($conn, "UPDATE pengaduan SET status='Selesai' WHERE id_pengaduan='" . $result['id_pengaduan'] . "'");
                                if ($update) {
                                    echo "<script>alert('Tanggapan berhasil terkirim!')</script>";
                                    echo "<script>location='?module=pengaduan';</script>";
                                }
                            }
                        }
                        ?>
                        <!-- Tanggapan Modal -->

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