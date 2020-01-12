<?php
session_start();

include "../../config/koneksi.php";


$module=$_GET[module];
$act=$_GET[act];

//echo $module;
//die();
// Hapus brand
if ($module=='brand' AND $act=='hapus'){
  mysql_query("DELETE FROM brand WHERE id_brand='$_GET[id]'");
  header('location:../../module.php?module='.$module);
 
}

// Input brand
elseif ($module=='brand' AND $act=='input'){
  
  mysql_query("INSERT INTO brand(nama_brand,alamat_brand,email,nomr_tlp) VALUES('$_POST[nama_brand]','$_POST[alamat_brand]','$_POST[email]','$_POST[nomr_tlp]')");
  header('location:../../module.php?module='.$module);
}

// Update brand
elseif ($module=='brand' AND $act=='update'){
  
  mysql_query("UPDATE brand SET nama_brand = '$_POST[nama_brand]',alamat_brand = '$_POST[alamat_brand]',email = '$_POST[email]',nomr_tlp = '$_POST[nomr_tlp]' WHERE id_brand = '$_POST[id_brand]'");
  header('location:../../module.php?module='.$module);
}
?>