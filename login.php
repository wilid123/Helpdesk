<?php

include 'src/config/connect.php';

if (isset($_POST["submit"])) {  
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars(md5($_POST['password']));
    if (empty($username) || empty($password)) {
        $empty = "Username dan password harus di isi!";
    } else {
        $proses = mysqli_query($conn, "SELECT * FROM petugas WHERE username = '$username' AND password = '$password'");
        $user = mysqli_num_rows($proses);
        $db = mysqli_fetch_array($proses);

        $proses2 = mysqli_query($conn, "SELECT * FROM masyarakat WHERE username = '$username' AND password = '$password'");
        $user2 = mysqli_num_rows($proses2);
        $db2 = mysqli_fetch_array($proses2);

        if ($user > 0) {
            session_start();
            $_SESSION['id_petugas'] = $db['id_petugas'];
            $_SESSION['username'] = $db['username'];
            $_SESSION['nama_petugas'] = $db['nama_petugas'];
            $_SESSION['password'] = $db['password'];
            $_SESSION['level'] = $db['level'];
            if ($db['level'] == 'Admin'){
                  header('Location: index.php?module=dashboard-admin');
            }
            else {
                  header('Location: index.php?module=dashboard-petugas');
            }
            exit;
        } else if ($user2 > 0) {
            session_start();
            $_SESSION['id_masyarakat'] = $db2['id_masyarakat'];
            $_SESSION['nama'] = $db2['nama'];
            $_SESSION['username'] = $db2['username'];
            $_SESSION['telp'] = $db2['telp'];
            $_SESSION['password'] = $db2['password'];
            $_SESSION['level'] = $db2['level'];
            header('Location: index.php?module=dashboard-masyarakat');
            exit;
        } else {
            $error = 'Username atau password salah.';
        }
        mysqli_close($conn);
    }
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Help Desk</title>
  <link rel="shortcut icon" type="image/png" href="src/assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="src/assets/css/styles.min.css" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">

        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <a href="#" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <img src="src/assets/images/logos/dark-logo.svg" width="180" alt="">
                </a>
                <p class="text-center">Fix your Problem</p>
                <?php if (isset($empty)) : ?>
                        <p class="text-center" style="color: #f9322c; font-style: italic;"><?= $empty; ?></p>
                    <?php endif; ?>
                    <?php if (isset($error)) : ?>
                        <p class="text-center" style="color: #f9322c; font-style: italic;"><?= $error; ?></p>
                <?php endif; ?>
                <form method="POST">
                  <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="username" class="form-control" id="username" name="username">
                  </div>
                  <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                  </div>
                  <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-3 rounded-2" name="submit">Sign In</button>                  
                  <a aria-current="page" href="authentication-login.php"><button class="btn btn-primary w-100 py-8 fs-4" >Back</button></a>                  
                </form>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
  <script src="src/assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="src/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
