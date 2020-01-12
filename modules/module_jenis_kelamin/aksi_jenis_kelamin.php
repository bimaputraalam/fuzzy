<?php
session_start();

include "../../config/koneksi.php";


$module=$_GET[module];
$act=$_GET[act];

//echo $module;
//die();
// Hapus Jenis Kelamin
if ($module=='jenis_kelamin' AND $act=='hapus'){
  mysql_query("DELETE FROM jenis_kelamin WHERE id_jenis_kelamin='$_GET[id]'");
  header('location:../../module.php?module='.$module);
 
}

// Input Jenis Kelamin
elseif ($module=='jenis_kelamin' AND $act=='input'){
  
  mysql_query("INSERT INTO jenis_kelamin(nama_jenis_kelamin,kode_jenis_kelamin) VALUES('$_POST[nama_jenis_kelamin]','$_POST[kode_jenis_kelamin]')");
  header('location:../../module.php?module='.$module);
}

// Update Jenis Kelamin
elseif ($module=='jenis_kelamin' AND $act=='update'){
  
  mysql_query("UPDATE jenis_kelamin SET nama_jenis_kelamin = '$_POST[nama_jenis_kelamin]',kode_jenis_kelamin = '$_POST[kode_jenis_kelamin]' WHERE id_jenis_kelamin = '$_POST[id_jenis_kelamin]'");
  header('location:../../module.php?module='.$module);
}
?>