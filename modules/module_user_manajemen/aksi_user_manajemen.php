<?php
session_start();

include "../../config/koneksi.php";


$module=$_GET[module];
$act=$_GET[act];

//echo $module;
//die();
// Hapus akun
if ($module=='user_manajemen' AND $act=='hapus'){
  mysql_query("DELETE FROM user_akun WHERE id_user_akun='$_GET[id]'");
  header('location:../../module.php?module='.$module);
 
}

// Input akun
elseif ($module=='user_manajemen' AND $act=='input'){
    
    $password =  md5($_POST[password]);
  
  mysql_query("INSERT INTO user_akun(username,nama,email,alamat,password,nomr_tlp,level) VALUES('$_POST[username]','$_POST[nama]','$_POST[email]','$_POST[alamat]','$password','$_POST[nomr_tlp]','$_POST[level]')");
  header('location:../../module.php?module='.$module);
}

// Update akun
elseif ($module=='user_manajemen' AND $act=='update'){
  $password =  md5($_POST[password]);

	if($password == ''){
		 mysql_query("UPDATE user_akun SET username = '$_POST[username]',nama = '$_POST[nama]',email = '$_POST[email]',alamat = '$_POST[alamat]',nomr_tlp = '$_POST[nomr_tlp]',level = '$_POST[level]' WHERE id_user_akun = '$_POST[id_user_akun]'");
	}else{
		 mysql_query("UPDATE user_akun SET username = '$_POST[username]',nama = '$_POST[nama]',email = '$_POST[email]',alamat = '$_POST[alamat]',password = '$password',nomr_tlp = '$_POST[nomr_tlp]',level = '$_POST[level]' WHERE id_user_akun = '$_POST[id_user_akun]'");
	}
    
  
  header('location:../../module.php?module='.$module);
}
?>