<?php
	include "config/koneksi.php";
   
// Bagian Home
if ($_GET['module']=='home'){
	include"modules/module_home/home.php";
        } else

// Bagian olah Penjualan
if ($_GET['module']=='penjualan'){
    include"modules/module_penjualan/penjualan.php";
        } else
           
// Bagian olah Peramalan_Penjualan
if ($_GET['module']=='peramalan_penjualan'){
    include"modules/module_peramalan_penjualan/peramalan_penjualan.php";
        } else
            
            
// Bagian olah Optimasi_Pengadaan
if ($_GET['module']=='optimasi_pengadaan'){
    include"modules/module_optimasi_pengadaan/optimasi_pengadaan.php";
        } else
           
// Bagian Rekap
if ($_GET['module']=='rekap'){
    include"modules/module_rekap/rekap.php";
        } else
            
// Bagian Laporan
if ($_GET['module']=='laporan_tabel'){
    include"modules/module_laporan_tabel/laporan_tabel.php";
        } else


// Bagian Laporan
if ($_GET['module']=='laporan_grafik'){
	include"modules/module_laporan_grafik/laporan_grafik.php";
        } else

if ($_GET['module']=='laporan'){
    include"modules/module_laporan/laporan.php";
        } else            
            
 // Bagian Peramalan 
 if ($_GET['module']=='peramalan'){
	include"modules/module_peramalan/peramalan.php";
        }else

// Bagian Master data
if ($_GET['module']=='user_manajemen'){
    include"modules/module_user_manajemen/user_manajemen.php";
        } else

// Bagian Master data
if ($_GET['module']=='produk'){
	include"modules/module_produk/produk.php";
        } else

// Bagian Master data
if ($_GET['module']=='brand'){
    include "modules/module_brand/brand.php";
}else

// Bagian Master data
if ($_GET['module']=='kategori'){
    include "modules/module_kategori/kategori.php";
} else

// Bagian Master data
if ($_GET['module']=='tipe'){
    include "modules/module_tipe/tipe.php";
} else

// Bagian Master data
if ($_GET['module']=='warna'){
    include "modules/module_warna/warna.php";
} else

// Bagian Master data
if ($_GET['module']=='jenis_kelamin'){
    include "modules/module_jenis_kelamin/jenis_kelamin.php";
} else

// Bagian Master data
if ($_GET['module']=='ukuran'){
    include "modules/module_ukuran/ukuran.php";
} 
// Apabila modul tidak ditemukan
else{
  echo "<p><b>MODUL BELUM ADA ATAU BELUM LENGKAP</b></p>";
}
?>
