<?php

include "config/koneksi.php";
$username = $_POST['username'];
$pass     = md5($_POST['password']);

$login=mysql_query("SELECT * FROM user_akun WHERE username ='$username' AND password='$pass'");
$ketemu=mysql_num_rows($login);
$r=mysql_fetch_array($login);
/*echo $pass;
print_r($r);
die();*/
// Apabila username dan password ditemukan
if ($ketemu > 0){
  session_start();
  $_SESSION[id_user_akun] = $r[id_user_akun];
  $_SESSION[username]     = $r[username];
   $_SESSION[level]     = $r[level];
  header('location:module.php?module=home');
}
else{
  echo "<center>LOGIN GAGAL! <br> 
        Username atau Password Anda tidak benar.<br>
        Atau account Anda sedang diblokir<br>";
  echo "<a href=index.php><b>ULANGI LAGI</b></a></center>";
}
?>
