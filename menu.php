<?php

include "src/config/connect.php";

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

if ($_SESSION['level'] == 'Admin') {
    $sql = mysqli_query($conn, "SELECT * FROM module WHERE (status='Admin' OR status='Petugas' OR status='All') AND aktif='Y' ORDER BY urutan");
} else if ($_SESSION['level'] == 'Petugas') {
    $sql = mysqli_query($conn, "SELECT * FROM module WHERE (status='Petugas' OR status='All') AND aktif='Y' ORDER BY urutan");
} else if ($_SESSION['level'] == 'Masyarakat') {
    $sql = mysqli_query($conn, "SELECT * FROM module WHERE (status='Masyarakat' OR status='All') AND aktif='Y' ORDER BY urutan");
}
while ($m = mysqli_fetch_array($sql)) {
    echo "<a class='sidebar-link' href='$m[link]' aria-expanded='false'><span><i class='$m[icon]'></i></span><span class='hide-menu'>$m[nama_modul]</span></a>";
}