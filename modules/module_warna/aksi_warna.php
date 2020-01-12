<?php
session_start();

include "../../config/koneksi.php";


$module=$_GET[module];
$act=$_GET[act];

//echo $module;
//die();
// Hapus warna
if ($module=='warna' AND $act=='hapus'){
  mysql_query("DELETE FROM warna WHERE id_warna='$_GET[id]'");
  header('location:../../module.php?module='.$module);
 
}

// Input warna
elseif ($module=='warna' AND $act=='input'){
  
  mysql_query("INSERT INTO warna(nama_warna) VALUES('$_POST[nama_warna]')");
  header('location:../../module.php?module='.$module);
}

// Update warna
elseif ($module=='warna' AND $act=='update'){
  
  mysql_query("UPDATE warna SET nama_warna = '$_POST[nama_warna]' WHERE id_warna = '$_POST[id_warna]'");
  header('location:../../module.php?module='.$module);
}
?>