<!-- Navigation Menu-->
<ul class="navigation-menu">
    <li>
        <a href="module.php?module=home"><i class="zmdi zmdi-home"></i> <span> Home </span> </a>
    </li>


    <!--    <li>
            <a href="module.php?module=penjualan"><i class="zmdi zmdi-mall"></i> <span> Penjualan </span> </a>
        </li>-->
    <?php
    if ($_SESSION['level'] == 'admin') {
        ?>  
        <li>
            <a href="module.php?module=rekap"><i class="zmdi zmdi-collection-bookmark"></i> <span> Rekap </span> </a>
        </li>

        <?php
    }
    ?>

<!--    <li class="has-submenu">
        <a href="#"><i class="zmdi zmdi-format-list-bulleted"></i> <span>Laporan</span> </a>
        <ul class="submenu">
            <li><a href="module.php?module=laporan_tabel">Tabel</a></li>
            <li><a href="module.php?module=laporan_grafik">Grafik</a></li>
            <li><a href="module.php?module=laporan">Total Penjualan</a></li>
        </ul>
    </li>-->

    <li class="has-submenu">
        <a href="#"><i  class="zmdi zmdi-trending-up"></i> <span>Peramalan</span> </a>
        <ul class="submenu">
            <li><a href="module.php?module=peramalan_penjualan&act=all">Hasil Panen</a></li>
            <!--<li><a href="module.php?module=optimasi_pengadaan">Pengadaan</a></li>-->
        </ul>
    </li>
    <?php
    if ($_SESSION['level'] == 'admin') {
        ?>  
        <li class="has-submenu">
            <a href="#"><i class="zmdi zmdi-folder"></i> <span> Master Data </span> </a>
            <ul class="submenu">
                <li><a href="module.php?module=user_manajemen">User Manajemen</a></li>
                <!--<li><a href="module.php?module=produk">Produk</a></li>-->
                <li><a href="module.php?module=brand">Tanaman</a></li>
<!--                <li><a href="module.php?module=kategori">Kategori</a></li>
                <li><a href="module.php?module=tipe">Tipe</a></li>-->
                <!--       <li><a href="module.php?module=warna">Warna</a></li>
                           <li><a href="module.php?module=jenis_kelamin">Jenis Kelamin</a></li>
                           <li><a href="module.php?module=ukuran">Ukuran</a></li>-->
            </ul>
        </li>
        <?php
    }
    ?>  


</ul>

<!-- End navigation menu  -->