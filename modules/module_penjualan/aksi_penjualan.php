<?php
session_start();

include "../../config/koneksi.php";


$module=$_GET[module];
$act=$_GET[act];

//echo $module;
//die();
// Hapus produk
if ($module == 'penjualan' AND $act == 'hapus') {
    mysql_query("DELETE FROM transaksi WHERE id_transaksi='$_GET[id]'");
    header('location:../../module.php?module=' . $module);
}

// Input penjualan
elseif ($module=='penjualan' AND $act=='input'){
  
  mysql_query("INSERT INTO transaksi(tanggal,id_ukuran_produk,qty_terjual) VALUES('$_POST[tanggal]','$_POST[id_ukuran_produk]','$_POST[qty_terjual]')");
  header('location:../../module.php?module='.$module);
}
// Update produk
elseif ($module == 'penjualan' AND $act == 'update') {

    mysql_query("UPDATE transaksi SET tanggal = '$_POST[tanggal]',id_ukuran_produk = '$_POST[id_ukuran_produk]',qty_terjual = '$_POST[qty_terjual] 'WHERE id_transaksi = '$_POST[id_transaksi]'");
    header('location:../../module.php?module=' . $module);
}
?>