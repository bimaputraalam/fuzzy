<?php
session_start();

include "../../config/koneksi.php";


$module=$_GET[module];
$act=$_GET[act];

//echo $module;
//die();
// Hapus tipe
if ($module=='tipe' AND $act=='hapus'){
  mysql_query("DELETE FROM tipe WHERE id_tipe='$_GET[id]'");
  header('location:../../module.php?module='.$module);
 
}

// Input tipe
elseif ($module=='tipe' AND $act=='input'){
  
  mysql_query("INSERT INTO tipe(nama_tipe,id_kategori) VALUES('$_POST[nama_tipe]','$_POST[id_kategori]')");
  header('location:../../module.php?module='.$module);
}

// Update tipe
elseif ($module=='tipe' AND $act=='update'){
  
  mysql_query("UPDATE tipe SET nama_tipe = '$_POST[nama_tipe]',id_kategori = '$_POST[id_kategori]'  WHERE id_tipe = '$_POST[id_tipe]'");
  header('location:../../module.php?module='.$module);
}
?>