<?php
session_start();

include "../../config/koneksi.php";

$module=$_GET[module];
$act=$_GET[act];

//echo $module;
//die();
// Hapus Rekap
if ($module == 'rekap' AND $act== 'hapus') {
  mysql_query("DELETE FROM padi WHERE id='$_GET[id]'");
  header('location:../../module.php?module=' .$module);
}

// Input Reakap
elseif ($module=='rekap' AND $act=='input'){
  mysql_query("INSERT INTO padi(id,hasil_panen,tanggal) VALUES('$_POST[id]','$_POST[hasil_panen]','$_POST[tanggal]')");
  header('location:../../module.php?module='.$module);
}

// Update Rekap
elseif ($module=='rekap' AND $act=='update'){ 
    
  mysql_query("UPDATE padi SET id = '$_POST[id]',hasil_panen = '$_POST[hasil_panen]',tanggal = '$_POST[tanggal]' WHERE id = '$_POST[id]'");
  header('location:../../module.php?module='.$module);
}
?>