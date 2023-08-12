<?php
include "src/config/connect.php";

$level = $_SESSION['level'];

$row = mysqli_query($conn, "SELECT * FROM masyarakat ORDER BY nama ASC");

if ($level != "Admin") {
    echo "<script>
    alert('Anda tidak berhak mengakses modul ini!');
    document.location='?module=home';
    </script>";
}

// Tambahkan
if (isset($_POST['add'])) {
  $nama = htmlspecialchars($_POST['nama']);
  $username = htmlspecialchars($_POST['username']);
  $password = htmlspecialchars(md5($_POST['password']));
  $id_sec = htmlspecialchars($_POST['section']);

  // Query untuk menambahkan data ke dalam tabel 'masyarakat'
  $query_masyarakat = mysqli_query($conn, "INSERT INTO masyarakat (nama, username, password, id_sec) VALUES ('$nama', '$username', '$password', '$id_sec')");

  if ($query_masyarakat) {
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
// Tambahkan



?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Modernize Free</title>
  <link rel="shortcut icon" type="image/png" href="/ukk/src/assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="/ukk/src/assets/css/styles.min.css" />
</head>
<body>
<div class="container-fluid">
        <div class="container-fluid">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title fw-semibold mb-4 text-center">Add Form</h5>
              <div class="card">
              <form method="POST" action="">
                   
                <div class="card-body">
                    <input type="hidden" name="id_masyarakat" value="<?= $result['id_masyarakat'] ?>">
                    <div class="mb-3">
                      <label class="form-label">Nama</label>
                      <input type="text" class="form-control" name="nama" id="nama">
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Username</label>
                      <input type="text" class="form-control" name="username" id="username">
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Password</label>
                      <input type="password" class="form-control" name="password" id="password">
                    </div>
                    <label for="" class="form-label">Section</label>
                    <div class="input-group mb-3">
                      <select class="form-select" id="sec" name="section">
                        <option value="1">ADM</option>
                        <option value="2">CA</option>
                        <option value="3">EI</option>
                        <option value="4">ENG PET</option>
                        <option value="5">FIN</option>
                        <option value="6">IFB</option>
                        <option value="7">IFC</option>
                        <option value="8">KTF</option>
                        <option value="9">LOG</option>
                        <option value="10">MC</option>
                        <option value="11">MFG PET</option>
                        <option value="12">MKT PET KTF</option>
                        <option value="13">MKT PF</option>
                        <option value="14">Proc</option>
                        <option value="15">QQC</option>
                        <option value="16">QQC PET</option>
                        <option value="17">SHE</option>
                        <option value="18">TC</option>
                      </select>
                    </div>
                </div>
                <div class="card-footer">
                    <a type="button" class="btn btn-secondary" href="?module=datamasyarakat">Cancel</a>
                    <button type="submit" class="btn btn-primary" name="add">Submit</button>    
                </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
  <script src="/ukk/src/assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="/ukk/src/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="/ukk/src/assets/js/sidebarmenu.js"></script>
  <script src="/ukk/src/assets/js/app.min.js"></script>
  <script src="/ukk/src/assets/libs/simplebar/dist/simplebar.js"></script>
</body>
</html>