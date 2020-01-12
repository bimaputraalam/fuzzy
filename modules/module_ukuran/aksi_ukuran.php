<?php
session_start();

include "../../config/koneksi.php";


$module=$_GET[module];
$act=$_GET[act];

//echo $module;
//die();
// Hapus ukuran
if ($module=='ukuran' AND $act=='hapus'){
  mysql_query("DELETE FROM ukuran WHERE id_ukuran='$_GET[id]'");
  header('location:../../module.php?module='.$module);
 
}

// Input ukuran
elseif ($module=='ukuran' AND $act=='input'){
  
  mysql_query("INSERT INTO ukuran(nama_ukuran,tipe_ukuran) VALUES('$_POST[nama_ukuran]','$_POST[tipe_ukuran]')");
  header('location:../../module.php?module='.$module);
}

// Update ukuran
elseif ($module=='ukuran' AND $act=='update'){
  
  mysql_query("UPDATE ukuran SET nama_ukuran = '$_POST[nama_ukuran]',tipe_ukuran = '$_POST[tipe_ukuran]' WHERE id_ukuran = '$_POST[id_ukuran]'");
  header('location:../../module.php?module='.$module);
}
?>