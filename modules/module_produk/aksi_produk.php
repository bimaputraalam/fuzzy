<?php

session_start();

include "../../config/koneksi.php";


$module = $_GET[module];
$act = $_GET[act];

//echo $module;
//print_r($_POST);
//die();
// Hapus produk
if ($module == 'produk' AND $act == 'hapus') {
    mysql_query("DELETE FROM produk WHERE id_produk='$_GET[id]'");
    header('location:../../module.php?module=' . $module);
}

// Input produk
elseif ($module == 'produk' AND $act == 'input') {

    mysql_query("INSERT INTO produk(nama_produk,id_brand,id_tipe,id_warna,id_jenis_kelamin,harga) VALUES('$_POST[nama_produk]','$_POST[id_brand]','$_POST[id_tipe]','$_POST[id_warna]','$_POST[id_jenis_kelamin]','$_POST[harga]')");
    header('location:../../module.php?module=' . $module);
}

// Update produk
elseif ($module == 'produk' AND $act == 'update') {

    mysql_query("UPDATE produk SET nama_produk = '$_POST[nama_produk]',id_brand = '$_POST[id_brand]',id_tipe = '$_POST[id_tipe]',id_warna = '$_POST[id_warna]',id_jenis_kelamin = '$_POST[id_jenis_kelamin]',harga = '$_POST[harga]'  WHERE id_produk = '$_POST[id_produk]'");
    header('location:../../module.php?module=' . $module);
}

// Input ukuran produk
elseif ($module == 'produk' AND $act == 'detail_input') {

    mysql_query("INSERT INTO ukuran_produk(id_produk,id_ukuran,qty) VALUES('$_POST[id_produk]','$_POST[id_ukuran]','$_POST[qty]')");
    header('location:../../module.php?module=' . $module . '&act=detail&id=' . $_POST[id_produk]);
}


// Update ukuran produk
elseif ($module == 'produk' AND $act == 'detail_update') {

    mysql_query("UPDATE ukuran_produk SET id_ukuran = '$_POST[id_ukuran]',qty = '$_POST[qty]'  WHERE id_ukuran_produk = '$_POST[id_ukuran_produk]'");
    header('location:../../module.php?module=' . $module . '&act=detail&id=' . $_POST[id_produk]);
}
// Hapus produk
if ($module == 'produk' AND $act == 'detail_hapus') {
    mysql_query("DELETE FROM ukuran_produk WHERE id_ukuran_produk='$_GET[id]'");

    header('location:../../module.php?module=' . $module . '&act=detail&id=' . $_GET[id_produk]);
}
?>