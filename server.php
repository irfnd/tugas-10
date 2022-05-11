<?php
    // Session start & Connect the MySql
    session_start();
    $db = mysqli_connect("localhost", "root", "", "pijarcamp");

    // Initialize Variables
    $nama_produk = "";
    $keterangan = "";
    $harga = "";
    $jumlah = "";
    $id = 0;
    $update = false;

    // POST Add new data
    if (isset($_POST['save'])) {
        $nama_produk = $_POST['nama-produk'];
        $keterangan = $_POST['keterangan'];
        $harga = $_POST['harga'];
        $jumlah = $_POST['jumlah'];

        mysqli_query($db, "INSERT INTO produk (nama_produk, keterangan, harga, jumlah) VALUES ('$nama_produk', '$keterangan', '$harga', '$jumlah')");
        $_SESSION['alert'] = "Data saved!";
        header("location: index.php");
    }

    // POST Update data
    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $nama_produk = $_POST['nama-produk'];
        $keterangan = $_POST['keterangan'];
        $harga = $_POST['harga'];
        $jumlah = $_POST['jumlah'];

        mysqli_query($db, "UPDATE produk SET nama_produk='$nama_produk', keterangan='$keterangan', harga='$harga', jumlah='$jumlah' WHERE id=$id");
        $_SESSION['alert'] = "Data updated!";
        header("location: index.php");
    }

    // GET Delete data
    if (isset($_GET['del'])) {
        $id = $_GET['del'];
        
        mysqli_query($db, "DELETE FROM produk WHERE id=$id");
        $_SESSION['alert'] = "Data deleted!";
        header("location: index.php");
    }
?>