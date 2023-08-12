
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
  
<!-- Nav -->
      <nav class="navbar navbar-expand-lg shadow pt-3 pb-3 fixed-top" style="background-color: #ffffff">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Helpdesk</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
             <ul class="navbar-nav me-auto">
                <li class="nav-item">
                  <a class="nav-link disabled" aria-disabled="true"></a>
                </li>
              </ul>
              <a class="nav-link navbar-nav active" aria-current="page" href="login.php"><i class="fa-solid fa-users"></i>Login</a> 
          </div>
        </div>
      </nav>

<!--  Body Wrapper -->
  <div class="p-3 text-black" style="background-image: url('src/assets/images/backgrounds/bg2.jpg'); background-size: cover; background-repeat: no-repeat; background-position: center">
    <br><br><br>
      <div class="d-flex align-items-center justify-content-center w-100 mt-5">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6">
            <div class="card mb-0">
              <div class="card-body">
                <a href="#" class="text-nowrap logo-img text-center d-block p-3 w-100">
                  <img src="src/assets/images/logos/dark-logo.svg" width="180" alt="">
                </a>
                <p class="text-center">Fix your Problem</p>
                <form method="POST">
                  <label for="" class="form-label">Section</label>
                <div class="input-group mb-3">
                    <select class="form-select" id="inputGroupSelect01" name="sec">
                        <option value="id_sec_1">Section 1</option>
                        <option value="id_sec_2">Section 2</option>
                        <option value="id_sec_3">Section 3</option>
                        <!-- Tambahkan opsi lain jika diperlukan -->
                    </select>
                </div>
                  <label for="" class="form-label">Nama</label>
                      <div class="input-group mb-3">
                        <select class="form-select" id="inputGroupSelect01" name="sec">
                          <option value="username1">Username 1</option>
                          <option value="username2">Username 2</option>
                          <!-- Add more options here if needed -->
                        </select>
                      </div>
                    <label for="password" class="form-label text-center">Complaints</label>
                    <div class="mb-3">
                      <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Judul Laporan" name="judul">
                    </div>
                  <textarea class="form-control" placeholder="Isi Laporan" name="isi" id="floatingTextarea" style="height: 200px" required></textarea>
                  <br>
                    <label for="" class="form-label">Complaint Photo</label>
                  <br>
                    <input type="file" class="form-control" id="file" name="file" >
                  <br>
                  <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" name="send">Send</button>                  
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <br><br><br>
    </div>
  <script src="src/assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="src/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
