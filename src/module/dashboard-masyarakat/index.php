<?

include 'src/config/connect.php';

?>
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header fw-bold text-center">
          Welcome <?= $level ?>
        </div>
        <div class="card-body">
          <p>Selamat datang, <?= $nama; ?>! Kami senang Anda kembali ke dashboard pribadi Anda.</br> Kami ingin memastikan Anda mendapatkan pengalaman yang optimal saat menggunakan platform ini. Jadi, di sini ada beberapa informasi tambahan untuk membantu Anda menjelajahi modul-modul yang tersedia</p>
        </div>
      </div>
    </div>
    <!-- Incoming Reports -->
    <div class="card overflow-hidden">
      <div class="card-body p-4">
        <h5 class="card-title mb-9 fw-semibold">Jumlah Laporan Anda </h5>
        <div class="row align-items-center">
          <div class="col-8">
            <?php {
              if ($level == "Masyarakat") {
                $sql = "SELECT COUNT(*) as pengaduan FROM pengaduan WHERE status = 'Proses' AND id_masyarakat = $id_masyarakat";
              }

              $pengaduan = mysqli_query($conn, $sql);
              if (mysqli_num_rows($pengaduan) > 0) {
                $row = mysqli_fetch_assoc($pengaduan);
                $pengaduan = $row["pengaduan"];
              } else {
                echo "Belum ada user dalam database.";
              }
            } ?>
            <h4 class="fw-semibold mb-3"><?= $pengaduan ?></h4>
          </div>

          <div class="col-4">
            <div class="d-flex justify-content-center">

              <i class="ti ti-arrow-bar-to-right fs-6"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--  Row 1 -->
  <div class="row">
    <div class="col-lg-12 d-flex align-items-stretch">
      <div class="card w-100">
        <div class="card-body p-4 shadow">
          <h5 class="card-title fw-semibold mb-4">Recent Complaint</h5>
          <div class="table-responsive">
            <table class="table text-nowrap mb-0 align-middle border">
              <thead class="text-dark fs-4 border">
                <tr>
                  <th class="border-bottom-0 ">
                    <h6 class="fw-semibold mb-0">Id</h6>
                  </th>
                  <th class="border-bottom-0 ">
                    <h6 class="fw-semibold mb-0">Title</h6>
                  </th>
                  <th class="border-bottom-0 ">
                    <h6 class="fw-semibold mb-0">Date</h6>
                  </th>
                  <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Priority</h6>
                  </th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1; ?>
                <?php $query = mysqli_query($conn, "SELECT * FROM pengaduan INNER JOIN masyarakat ON pengaduan.id_masyarakat=masyarakat.id_masyarakat WHERE pengaduan.id_masyarakat = $id_masyarakat ORDER BY tgl_pengaduan DESC"); ?>
                <?php while ($result = mysqli_fetch_array($query)) : ?>
                  <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $result['judul']; ?></td>
                    <td><?php echo $result['tgl_pengaduan']; ?></td>
                    <td><?php echo $result['status']; ?></td>

                  </tr>
                <?php endwhile; ?>


                <!-- <tr>
                        <td class="border-bottom-0"><h6 class="fw-semibold mb-0">1</h6></td>
                        <td class="border-bottom-0">
                            <h6 class="fw-semibold mb-1">Sunil Joshi</h6>
                            <span class="fw-normal">Web Designer</span>                          
                        </td>
                        <td class="border-bottom-0">
                          <p class="mb-0 fw-normal">Elite Admin</p>
                        </td> -->
                <!-- <td class="border-bottom-0">
                          <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-primary rounded-3 fw-semibold">Process</span>
                          </div>
                        </td>                       
                      </tr> 

                      

                      

                      <tr>
                        <td class="border-bottom-0"><h6 class="fw-semibold mb-0">2</h6></td>
                        <td class="border-bottom-0">
                            <h6 class="fw-semibold mb-1">Nirav Joshi</h6>
                            <span class="fw-normal">Frontend Engineer</span>                          
                        </td>
                        <td class="border-bottom-0">
                          <p class="mb-0 fw-normal">Hosting Press HTML</p>
                        </td>
                         <td class="border-bottom-0">
                          <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-success rounded-3 fw-semibold">Finished</span>
                          </div>
                        </td> 
                        
                      </tr>  -->
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>