<?php

include "src/config/connect.php";

$level = $_SESSION['level'];

$row = mysqli_query($conn, "SELECT * FROM masyarakat ORDER BY nama ASC");


// if ($level != "Admin") {
//     echo "<script>
//     alert('Anda tidak berhak mengakses modul ini!');
//     document.location='?module=home';
//     </script>";
// }

// Add
if (isset($_POST['add'])) {
    $id_masyarakat = htmlspecialchars($_POST['id_masyarakat']);
    $nama = htmlspecialchars($_POST['nama']);
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars(md5($_POST['password']));
    $telp = htmlspecialchars($_POST['telp']);

    $query = mysqli_query($conn, "INSERT INTO masyarakat (id_masyarakat, nama, username, password, telp) VALUES ('$id_masyarakat', '$nama', '$username', '$password', '$telp')");

    if ($query) {
        echo "<script>
                alert('Data berhasil disimpan!');
                document.location='?module=datamasyarakat';
            </script>";
    } else {
        echo "<script>
                alert('Data gagal disimpan!');
                document.location='?module=datamasyarakat';
            </script>";
    }
}
// Add

// Edit
if (isset($_POST['edit'])) {
    $id_masyarakat = htmlspecialchars($_POST['id_masyarakat']);
    $nama = htmlspecialchars($_POST['nama']);
    $username = htmlspecialchars($_POST['username']);
    $telp = htmlspecialchars($_POST['telp']);

    $query = mysqli_query($conn, "UPDATE masyarakat SET nama = '$nama', username = '$username', telp = '$telp' WHERE id_masyarakat = '$id_masyarakat'");

    if ($query) {
        echo "<script>
                alert('Data berhasil diubah!');
                document.location='?module=datamasyarakat';
            </script>";
    } else {
        echo "<script>
                alert('Data gagal diubah!');
                document.location='?module=datamasyarakat';
            </script>";
    }
}
// Edit


// Delete
if (isset($_POST['delete'])) {
    $foto = $_POST['foto'];
    $direktori = "src/account/img/";

    if($foto == 'UserImage.png'){
        // Hapus entri dari database
    $query = mysqli_query($conn, "DELETE FROM masyarakat WHERE id_masyarakat = '$_POST[id_masyarakat]'");

    if ($query) {
        echo "<script>
                document.location='?module=datamasyarakat';
            </script>";
    }
    }
    else{
    // Hapus file dari direktori
    if (file_exists($direktori . $foto)) {
        if (unlink($direktori . $foto)) {
            echo "File berhasil dihapus.";
        } else {
            echo "Gagal menghapus file.";
        }
    } else {
        echo "File tidak ditemukan.";
    }

    // Hapus entri dari database
    $query = mysqli_query($conn, "DELETE FROM masyarakat WHERE id_masyarakat = '$_POST[id_masyarakat]'");

    if ($query) {
        echo "<script>
                document.location='?module=datamasyarakat';
            </script>";
    } 
    }
    
}

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
    <title>Petugas</title>
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
            Users
        </div>
        <div class="card-body">
            <table id="table" class="table border table-hover">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Photo</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Username</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php while ($result = mysqli_fetch_array($row)) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><img class="rounded-circle bg-dark" width="50" height="50" src="src/account/img/<?= $result['foto_masyarakat'] ?>"></td>
                            <td><?= $result["nama"] ?></td>
                            <td><?= $result["username"] ?></td>
                            <td>
                                <div class='text-center'>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#editModal<?= $no ?>" class="btn btn-warning"><i class="fa-solid fa-edit"></i></a>   |
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $no ?>" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal<?= $no ?>" tabindex="-1">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="post" action="">
                                        <div class="modal-body">
                                            <div class="text-center mb-3">
                                                <img class="rounded-circle bg-dark" width="50" height="50" src="src/account/img/<?= $result['foto_masyarakat'] ?>">
                                            </div>
                                            <input type="hidden" name="id_masyarakat" value="<?= $result['id_masyarakat'] ?>">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" placeholder="Nama" name="nama" value="<?= $result['nama'] ?>" required>
                                                <label>Nama</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" placeholder="Username" name="username" value="<?= $result['username'] ?>" required>
                                                <label>Username</label>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" name="edit">Save</button>
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
                                        <input type="hidden" name="id_masyarakat" value="<?= $result['id_masyarakat'] ?>">
                                        <input type="hidden" name="foto" value="<?= $result['foto_masyarakat'] ?>">
                                        <div class="modal-body text-center">
                                            <h5>Apakah anda yakin ingin menghapus data ini? <br><br>
                                                 <img class="rounded-circle bg-dark mb-3" width="50" height="50" src="src/account/img/<?= $result['foto_masyarakat'] ?>"><br>
                                                <span class="fw-bold text-danger mt-3"><?= $result['nama'] ?></span>
                                            </h5>
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
            <a class='btn btn-success px-4' href="?module=add-datamasyarakat"><i class="fa-solid fa-plus"></i></a>




            <!-- <div class="modal fade" id="insertModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" action="">
                        <div class="modal-body">
                            <input type="hidden" name="id_masyarakat" value="<?= $result['id_masyarakat'] ?>">
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" placeholder="id_masyarakat" name="id_masyarakat" required>
                                <label>id_masyarakat</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" placeholder="Nama" name="nama" required>
                                <label>Nama</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" placeholder="Username" name="username" required>
                                <label>Username</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" placeholder="Password" name="password" required>
                                <label>Password</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" placeholder="Telp" name="telp" required>
                                <label>Telp</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="add">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> -->


    </div>
</body>

</html>