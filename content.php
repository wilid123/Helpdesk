<?php

include "src/config/connect.php";

if (!isset($_SESSION['username'])) {
    header("Location: authentication-login.php");
    exit;
}

if ($_GET['module'] == 'dashboard-admin') {
    include "src/module/dashboard-admin/index.php";
}
if ($_GET['module'] == 'dashboard-masyarakat') {
    include "src/module/dashboard-masyarakat/index.php";
}
if ($_GET['module'] == 'dashboard-petugas') {
    include "src/module/dashboard-petugas/index.php";
}
if ($_GET['module'] == 'spengaduan') {
    include "src/module/spengaduan/index.php";
}
if ($_GET['module'] == 'datamasyarakat') {
    include "src/module/masyarakat/index.php";
}
if ($_GET['module'] == 'add-datamasyarakat') {
    include "src/module/masyarakat/add.php";
}
if ($_GET['module'] == 'edit-datamasyarakat') {
    include "src/module/masyarakat/edit.php";
}
if ($_GET['module'] == 'datapetugas') {
    include "src/module/petugas/index.php";
}
if ($_GET['module'] == 'pengaduan') {
    include "src/module/pengaduan/index.php";
}
if ($_GET['module'] == 'tanggapan') {
    include "src/module/tanggapan/index.php";
}
if ($_GET['module'] == 'pmasyarakat') {
    include "src/module/pmasyarakat/index.php";
}
if ($_GET['module'] == 'tmasyarakat') {
    include "src/module/tmasyarakat/index.php";
}
if ($_GET['module'] == 'account') {
    include "src/module/account/index.php";
}