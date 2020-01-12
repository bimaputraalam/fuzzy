<?php
switch ($_GET[act]) {
    // Tampil 
    default:

        $id_brand = empty($_GET['id_brand']) ? 0 : $_GET['id_brand'];
        $id_tipe = empty($_GET['id_tipe']) ? 0 : $_GET['id_tipe'];
        $penjualan = empty($_GET['total_penjualan']) ? 0 : $_GET['total_penjualan'];
        $stok_akhir = empty($_GET['stok_akhir']) ? 0 : $_GET['stok_akhir'];
        ?>

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">OPTIMASI PENGADAAN BARANG</h4>
                </div>
            </div>
        </div>
        <!-- end row -->



        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="page-title-box">

                                <h4 class="m-b-30 m-t-0 header-title">OPTIMASI PENGADAAN BARANG</h4>
                                <hr>
                                <form>
                                    <input type="hidden" name="module" value="optimasi_pengadaan">

                                    <section>
                                        <div class="form-group row">
                                            <label class="col-lg-2 control-label" for="name1">Brand</label>
                                            <div class="col-lg-10">
                                                <select class="custom-select mb-3" name="id_brand" required>
                                                    <option value=""> Masukan Brand</option>
                                                    <?php
                                                    $tampil = mysql_query("SELECT * FROM brand ORDER BY id_brand ASC");

                                                    while ($r = mysql_fetch_array($tampil)) {
                                                        ?>
                                                        <option value="<?= $r[id_brand] ?>" <?= $r[id_brand] == $id_brand ? 'selected' : NULL ?>><?= $r[nama_brand] ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </section>
                                    <section>
                                        <div class="form-group row">
                                            <label class="col-lg-2 control-label " for="tipe">Tipe</label>

                                            <div class="col-lg-10">
                                                <select class="select2 form-control"  name="id_tipe">
                                                    <option value=""> Masukan Tipe </option>
                                                    <?php
                                                    $tampil = mysql_query("SELECT * FROM tipe "
                                                            . "JOIN kategori ON tipe.id_kategori=kategori.id_kategori "
                                                            . "ORDER BY kategori.nama_kategori, tipe.nama_tipe ASC");
                                                    $kategori = 0;

                                                    while ($rp = mysql_fetch_array($tampil)) {
                                                        if ($kategori != $rp[id_kategori]) {
                                                            $kategori = $rp[id_kategori];
                                                            ?>
                                                            <optgroup label="<?= $rp[nama_kategori] ?>">
                                                                <?php
                                                            }
                                                            ?>
                                                            <option value="<?= $rp[id_tipe] ?>" <?= $rp[id_tipe] == $id_tipe ? 'selected' : NULL ?> ><?= $rp[nama_tipe] ?></option>
                                                            <?php
                                                            if ($kategori != $rp[id_kategori]) {
                                                                ?>
                                                            </optgroup>
                                                            <?php
                                                        }
                                                        ?>


                                                        <?php
                                                    }
                                                    ?>
                                                </select>

                                            </div>
                                        </div>
                                    </section>
                                    <section>
                                        <div class="form-group row">
                                            <label class="col-lg-2 control-label " for="total_penjualan">Penjualan</label>
                                            <div class="col-lg-10">
                                                <input id="total_penjualan" name="total_penjualan" type="number" class="form-control" value="<?= $penjualan ?>" placeholder="Penjualan" required>
                                            </div>
                                        </div>
                                    </section>
                                    <section>
                                        <div class="form-group row">
                                            <label class="col-lg-2 control-label " for="stok_akhir">Stok Akhir</label>
                                            <div class="col-lg-10">
                                                <input id="stok_akhir" name="stok_akhir" type="number" class="form-control" value="<?= $stok_akhir ?>" placeholder="Stok Akhir" required>
                                            </div>
                                        </div>
                                    </section>
                                    <div class="form-group text-right m-b-0">
                                        <button class="btn btn-primary waves-effect waves-light" type="submit">
                                            Proses
                                        </button>
                                    </div>
                                    <hr>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php
                    if ($_GET['id_tipe']) {


                        $penjualan_max = 0;
                        $penjualan_min = 100000000;
                        $stok_akhir_max = 0;
                        $stok_akhir_min = 100000000;
                        $pengadaan_max = 0;
                        $pengadaan_min = 100000000;

                        $tampil = mysql_query("SELECT * FROM rekap "
                                . "JOIN brand  ON brand.id_brand=rekap.id_brand "
                                . "JOIN tipe ON tipe.id_tipe=rekap.id_tipe "
                                . "JOIN kategori ON kategori.id_kategori=tipe.id_kategori "
                                . "WHERE rekap.id_brand = $id_brand "
                                . "AND rekap.id_tipe = $id_tipe "
                                . "ORDER BY rekap.tanggal");
                        $no = 1;
                        while ($r = mysql_fetch_array($tampil)) {
                            $data_penjualan[$no] = $r[total_penjualan];
                            $data_stok_akhir[$no] = $r[stok_akhir];
                            $data_pengadaan[$no] = $r[total_pengadaan];

                            if ($data_penjualan[$no] > $penjualan_max) {
                                $penjualan_max = $data_penjualan[$no];
                            }

                            if ($data_penjualan[$no] < $penjualan_min) {
                                $penjualan_min = $data_penjualan[$no];
                            }

                            if ($data_stok_akhir[$no] > $stok_akhir_max) {
                                $stok_akhir_max = $data_stok_akhir[$no];
                            }

                            if ($data_stok_akhir[$no] < $stok_akhir_min) {
                                $stok_akhir_min = $data_stok_akhir[$no];
                            }

                            if ($data_pengadaan[$no] > $pengadaan_max) {
                                $pengadaan_max = $data_pengadaan[$no];
                            }

                            if ($data_pengadaan[$no] < $pengadaan_min) {
                                $pengadaan_min = $data_pengadaan[$no];
                            }


                            $no++;
                        }


                        $penjualan_turun = ($penjualan_max - $penjualan) / ($penjualan_max - $penjualan_min);
                        $penjualan_naik = ($penjualan - $penjualan_min) / ($penjualan_max - $penjualan_min);

                        $stok_akhir_sedikit = ($stok_akhir_max - $stok_akhir) / ($stok_akhir_max - $stok_akhir_min);
                        $stok_akhir_banyak = ($stok_akhir - $stok_akhir_min) / ($stok_akhir_max - $stok_akhir_min);


                        //R1 penjualan turun stok akhir banyak maka pengadaan berkurang
                        if ($penjualan_turun > $stok_akhir_banyak) {
                            $x[1] = $stok_akhir_banyak;
                        } else {
                            $x[1] = $penjualan_turun;
                        }

                        $z[1] = $pengadaan_max - ( $x[1] * ($pengadaan_max - $pengadaan_min));


                        //R2 penjualan turun stok akhir sedikit maka pengadaan berkurang
                        if ($penjualan_turun > $stok_akhir_sedikit) {
                            $x[2] = $stok_akhir_sedikit;
                        } else {
                            $x[2] = $penjualan_turun;
                        }

                        $z[2] = $pengadaan_max - ( $x[2] * ($pengadaan_max - $pengadaan_min));


                        //R3 penjualan naik stok akhir banyak maka pengadaan bertambah
                        if ($penjualan_naik > $stok_akhir_banyak) {
                            $x[3] = $stok_akhir_banyak;
                        } else {
                            $x[3] = $penjualan_naik;
                        }

                        $z[3] = $pengadaan_max + ( $x[3] * ($pengadaan_max - $pengadaan_min));


                        //R4 penjualan naik stok akhir sedikit maka pengadaan bertambah
                        if ($penjualan_naik > $stok_akhir_sedikit) {
                            $x[4] = $stok_akhir_sedikit;
                        } else {
                            $x[4] = $penjualan_naik;
                        }

                        $z[4] = $pengadaan_max + ( $x[4] * ($pengadaan_max - $pengadaan_min));


                        $hasil = ($x[1] * $z[1]) + ($x[2] * $z[2]) + ($x[3] * $z[3]) + ($x[4] * $z[4]) / $x[1] + $x[2] + $x[3] + $x[4];

                        if ($hasil < 0) {
                            $hasil = 0;
                        }
                    }
                    ?>




                    Hasil Peramalan, menyatakan bahwa harus melakukan pengadaan barang sejumlah <b><?= round($hasil) ?></b>
                    <hr>
                    <div class="hidden-print">
                        <div class="btn-group float-right m-t-15">
                            <a type="button" target="_blank" href='?module=optimasi_pengadaan&id_brand=<?= $id_brand ?>&id_tipe=<?= $id_tipe ?>&total_penjualan=<?= $penjualan ?>&stok_akhir=<?= $stok_akhir ?>&act=detail' class="btn btn-primary waves-effect waves-light">Detail Perhitungan</a>
                        </div>

                        <div class="clearfix"></div>

                    </div>

                </div>
            </div>
        </div>  


        <?php
        break;
    case 'detail':


        $id_brand = empty($_GET['id_brand']) ? 0 : $_GET['id_brand'];
        $id_tipe = empty($_GET['id_tipe']) ? 0 : $_GET['id_tipe'];
        $penjualan = empty($_GET['total_penjualan']) ? 0 : $_GET['total_penjualan'];
        $stok_akhir = empty($_GET['stok_akhir']) ? 0 : $_GET['stok_akhir'];
        ?>

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">DETAIL PERHITUNGAN OPTIMASI PENGADAAN BARANG</h4>
                </div>
            </div>
        </div>
        <!-- end row -->



        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="page-title-box">

                                <h4 class="m-b-30 m-t-0 header-title">DETAIL PERHITUNGAN OPTIMASI PENGADAAN BARANG</h4>
                                <hr>
                                <form>
                                    <input type="hidden" name="module" value="optimasi_pengadaan">
                                    <input type="hidden" name="act" value="detail">

                                    <section>
                                        <div class="form-group row">
                                            <label class="col-lg-2 control-label" for="name1">Brand</label>
                                            <div class="col-lg-10">
                                                <select class="custom-select mb-3" name="id_brand" required>
                                                    <option value=""> Masukan Brand</option>
                                                    <?php
                                                    $tampil = mysql_query("SELECT * FROM brand ORDER BY id_brand ASC");

                                                    while ($r = mysql_fetch_array($tampil)) {
                                                        ?>
                                                        <option value="<?= $r[id_brand] ?>" <?= $r[id_brand] == $id_brand ? 'selected' : NULL ?>><?= $r[nama_brand] ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </section>
                                    <section>
                                        <div class="form-group row">
                                            <label class="col-lg-2 control-label " for="tipe">Tipe</label>

                                            <div class="col-lg-10">
                                                <select class="select2 form-control"  name="id_tipe">
                                                    <option value=""> Masukan Tipe </option>
                                                    <?php
                                                    $tampil = mysql_query("SELECT * FROM tipe "
                                                            . "JOIN kategori ON tipe.id_kategori=kategori.id_kategori "
                                                            . "ORDER BY kategori.nama_kategori, tipe.nama_tipe ASC");
                                                    $kategori = 0;
                                                    $kategori_name = '';
                                                    while ($rp = mysql_fetch_array($tampil)) {
                                                        if ($kategori != $rp[id_kategori]) {
                                                            $kategori = $rp[id_kategori];
                                                            $kategori_name = $rp['nama_kategori'];
                                                            ?>
                                                            <optgroup label="<?= $rp[nama_kategori] ?>">
                                                                <?php
                                                            }
                                                            ?>
                                                            <option value="<?= $rp[id_tipe] ?>" <?= $rp[id_tipe] == $id_tipe ? 'selected' : NULL ?> ><?= $kategori_name . '  ' . $rp[nama_tipe] ?></option>
                                                            <?php
                                                            if ($kategori != $rp[id_kategori]) {
                                                                ?>
                                                            </optgroup>
                                                            <?php
                                                        }
                                                        ?>


                                                        <?php
                                                    }
                                                    ?>
                                                </select>

                                            </div>
                                        </div>
                                    </section>
                                    <section>
                                        <div class="form-group row">
                                            <label class="col-lg-2 control-label " for="total_penjualan">Penjualan</label>
                                            <div class="col-lg-10">
                                                <input id="total_penjualan" name="total_penjualan" type="number" class="form-control" value="<?= $penjualan ?>" placeholder="Penjualan" required>
                                            </div>
                                        </div>
                                    </section>
                                    <section>
                                        <div class="form-group row">
                                            <label class="col-lg-2 control-label " for="stok_akhir">Stok Akhir</label>
                                            <div class="col-lg-10">
                                                <input id="stok_akhir" name="stok_akhir" type="number" class="form-control" value="<?= $stok_akhir ?>" placeholder="Stok Akhir" required>
                                            </div>
                                        </div>
                                    </section>
                                    <div class="form-group text-right m-b-0">
                                        <button class="btn btn-primary waves-effect waves-light" type="submit">
                                            Tampilkan
                                        </button>
                                    </div>
                                    <hr>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php
                    if ($_GET['id_tipe']) {
                        echo '<pre>';

                        $penjualan_max = 0;
                        $penjualan_min = 100000000;
                        $stok_akhir_max = 0;
                        $stok_akhir_min = 100000000;
                        $pengadaan_max = 0;
                        $pengadaan_min = 100000000;

                        $tampil = mysql_query("SELECT * FROM rekap "
                                . "JOIN brand  ON brand.id_brand=rekap.id_brand "
                                . "JOIN tipe ON tipe.id_tipe=rekap.id_tipe "
                                . "JOIN kategori ON kategori.id_kategori=tipe.id_kategori "
                                . "WHERE rekap.id_brand = $id_brand "
                                . "AND rekap.id_tipe = $id_tipe "
                                . "ORDER BY rekap.tanggal");
                        $no = 1;
                        while ($r = mysql_fetch_array($tampil)) {
                            $data_penjualan[$no] = $r[total_penjualan];
                            $data_stok_akhir[$no] = $r[stok_akhir];
                            $data_pengadaan[$no] = $r[total_pengadaan];

                            if ($data_penjualan[$no] > $penjualan_max) {
                                $penjualan_max = $data_penjualan[$no];
                            }

                            if ($data_penjualan[$no] < $penjualan_min) {
                                $penjualan_min = $data_penjualan[$no];
                            }

                            if ($data_stok_akhir[$no] > $stok_akhir_max) {
                                $stok_akhir_max = $data_stok_akhir[$no];
                            }

                            if ($data_stok_akhir[$no] < $stok_akhir_min) {
                                $stok_akhir_min = $data_stok_akhir[$no];
                            }

                            if ($data_pengadaan[$no] > $pengadaan_max) {
                                $pengadaan_max = $data_pengadaan[$no];
                            }

                            if ($data_pengadaan[$no] < $pengadaan_min) {
                                $pengadaan_min = $data_pengadaan[$no];
                            }


                            $no++;
                        }

//                        echo 'penjualan :';
//                        echo '<br>';
//                        print_r($data_penjualan);
//
//                        echo 'Stok Akhir :';
//                        echo '<br>';
//                        print_r($data_stok_akhir);
//
//                        echo 'pengadaan :';
//                        echo '<br>';
//                        print_r($data_pengadaan);
//
//                        echo 'penjualan_max :';
//                        print_r($penjualan_max);
//                        echo '<br>';
//
//                        echo 'penjualan_min :';
//                        print_r($penjualan_min);
//                        echo '<br>';
//
//                        echo 'stok_akhir_max :';
//                        print_r($stok_akhir_max);
//                        echo '<br>';
//
//                        echo 'stok_akhir_min :';
//                        print_r($stok_akhir_min);
//                        echo '<br>';
//
//                        echo 'pengadaan_max :';
//                        print_r($pengadaan_max);
//                        echo '<br>';
//
//                        echo 'pengadaan_min :';
//                        print_r($pengadaan_min);
//                        echo '<br>';



                        $penjualan_turun = ($penjualan_max - $penjualan) / ($penjualan_max - $penjualan_min);
                        $penjualan_naik = ($penjualan - $penjualan_min) / ($penjualan_max - $penjualan_min);

                        $stok_akhir_sedikit = ($stok_akhir_max - $stok_akhir) / ($stok_akhir_max - $stok_akhir_min);
                        $stok_akhir_banyak = ($stok_akhir - $stok_akhir_min) / ($stok_akhir_max - $stok_akhir_min);

//                        echo '<br>';
//                        echo 'penjualan_turun :';
//                        print_r($penjualan_turun);
//                        echo '<br>';
//
//                        echo 'penjualan_naik :';
//                        print_r($penjualan_naik);
//                        echo '<br>';
//
//                        echo 'stok_akhir_sedikit :';
//                        print_r($stok_akhir_sedikit);
//                        echo '<br>';
//
//                        echo 'stok_akhir_banyak :';
//                        print_r($stok_akhir_banyak);
//                        echo '<br>';
                        //R1 penjualan turun stok akhir banyak maka pengadaan berkurang
                        if ($penjualan_turun > $stok_akhir_banyak) {
                            $x[1] = $stok_akhir_banyak;
                        } else {
                            $x[1] = $penjualan_turun;
                        }

                        $z[1] = $pengadaan_max - ( $x[1] * ($pengadaan_max - $pengadaan_min));


                        //R2 penjualan turun stok akhir sedikit maka pengadaan berkurang
                        if ($penjualan_turun > $stok_akhir_sedikit) {
                            $x[2] = $stok_akhir_sedikit;
                        } else {
                            $x[2] = $penjualan_turun;
                        }

                        $z[2] = $pengadaan_max - ( $x[2] * ($pengadaan_max - $pengadaan_min));


                        //R3 penjualan naik stok akhir banyak maka pengadaan bertambah
                        if ($penjualan_naik > $stok_akhir_banyak) {
                            $x[3] = $stok_akhir_banyak;
                        } else {
                            $x[3] = $penjualan_naik;
                        }

                        $z[3] = $pengadaan_max + ( $x[3] * ($pengadaan_max - $pengadaan_min));


                        //R4 penjualan naik stok akhir sedikit maka pengadaan bertambah
                        if ($penjualan_naik > $stok_akhir_sedikit) {
                            $x[4] = $stok_akhir_sedikit;
                        } else {
                            $x[4] = $penjualan_naik;
                        }

                        $z[4] = $pengadaan_max + ( $x[4] * ($pengadaan_max - $pengadaan_min));

//                        echo '<br>';
//                        echo 'konstanta X:';
//                        print_r($x);
//                        echo '<br>';
//
//                        echo 'konstanta Z :';
//                        print_r($z);
//                        echo '<br>';

                        $hasil = ($x[1] * $z[1]) + ($x[2] * $z[2]) + ($x[3] * $z[3]) + ($x[4] * $z[4]) / $x[1] + $x[2] + $x[3] + $x[4];

                        if ($hasil < 0) {
                            $hasil_akhir = 0;
                        }
//                        echo 'Hasil Optimasi :';
//                        print_r($hasil);
//                        echo '<br>';
//
                        echo '</pre>';
                    }
                    ?>
                    <div class="row m-t-50">
                        <div class="col-sm-4 m-t-20">
                            <h4 class="m-t-0 header-title">MAX & MIN</h4>
                            <p class="text-muted m-b-20 font-13">

                            </p>

                            <ul>
                                <li>
                                    Penjualan


                                    <ul>
                                        <li>
                                            Max = <?= $penjualan_max ?>
                                        </li>
                                        <li>
                                            Min = <?= $penjualan_min ?>
                                        </li>

                                    </ul>
                                </li>
                                <li>
                                    Stok


                                    <ul>
                                        <li>
                                            Max = <?= $stok_akhir_max ?>
                                        </li>
                                        <li>
                                            Min = <?= $stok_akhir_min ?>
                                        </li>

                                    </ul>
                                </li>
                                <li>
                                    Pengadaan


                                    <ul>
                                        <li>
                                            Max = <?= $pengadaan_max ?>
                                        </li>
                                        <li>
                                            Min = <?= $pengadaan_min ?>
                                        </li>

                                    </ul>
                                </li>

                            </ul>

                        </div>

                        <div class="col-sm-4 m-t-20">
                            <h4 class="m-t-0 header-title">Nilai Keanggotaan</h4>
                            <p class="text-muted m-b-20 font-13">
                            </p>
                            <ul>
                                <li>
                                    Penjualan


                                    <ul>
                                        <li>
                                            Turun = <?= $penjualan_turun ?>
                                        </li>
                                        <li>
                                            Naik = <?= $penjualan_naik ?>
                                        </li>

                                    </ul>
                                </li>
                                <li>
                                    Stok Akhir


                                    <ul>
                                        <li>
                                            Sedikit = <?= $stok_akhir_sedikit ?>
                                        </li>
                                        <li>
                                            Banyak = <?= $stok_akhir_banyak ?>
                                        </li>

                                    </ul>
                                </li>


                            </ul>
                        </div>

                        <div class="col-sm-4 m-t-20">
                            <h4 class="m-t-0 header-title">Inferensi</h4>
                            <ul>
                                <li>
                                    R[1] IF Penjualan Turun AND Stok Banyak THEN Pengadaan Barang Berkurang

                                    <ul>
                                        <li>
                                            predikat 1 = <?= $x[1] ?>
                                        </li>
                                        <li>
                                            Z = <?= $z[1] ?>
                                        </li>

                                    </ul>
                                </li>
                                <li>
                                    R[1] IF Penjualan Turun AND Stok Sedikit THEN Pengadaan Barang Berkurang

                                    <ul>
                                        <li>
                                            predikat 2 = <?= $x[2] ?>
                                        </li>
                                        <li>
                                            Z = <?= $z[2] ?>
                                        </li>

                                    </ul>
                                </li>
                                <li>
                                    R[1] IF Penjualan Naik AND Stok Banyak THEN Pengadaan Barang Bertambah

                                    <ul>
                                        <li>
                                           predikat 3 = <?= $x[3] ?>
                                        </li>
                                        <li>
                                            Z = <?= $z[3] ?>
                                        </li>

                                    </ul>
                                </li>
                                <li>
                                    R[1] IF Penjualan Naik AND Stok Sedikit THEN Pengadaan Barang Bertambah

                                    <ul>
                                        <li>
                                            predikat 4 = <?= $x[4] ?>
                                        </li>
                                        <li>
                                            Z = <?= $z[4] ?>
                                        </li>

                                    </ul>
                                </li>


                            </ul>

                            <h5>Defuzifikasi</h5>
                            <p class="text-muted m-b-15 font-13">
                                Defuzifikasi = <code><?= $hasil ?>  </code> => <?= $hasil_akhir ?>

                            </p>



                        </div>
                    </div>  
                    <table  class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>							
                            <tr>
                                <th style="width: 20px">No.</th>
                                <th>Bulan</th>
                                <th>Penjualan</th>
                                <th>Stok Akhir</th>
                                <th>Pengadaan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $tampil = mysql_query("SELECT * FROM rekap "
                                    . "JOIN brand  ON brand.id_brand=rekap.id_brand "
                                    . "JOIN tipe ON tipe.id_tipe=rekap.id_tipe "
                                    . "JOIN kategori ON kategori.id_kategori=tipe.id_kategori "
                                    . "WHERE rekap.id_brand = $id_brand "
                                    . "AND rekap.id_tipe = $id_tipe "
                                    . "ORDER BY rekap.tanggal");
                            $no = 1;
                            while ($r = mysql_fetch_array($tampil)) {
                                ?>

                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= date('Y-m', strtotime($r[tanggal])) ?></td>
                                    <td><?= $r[total_penjualan] ?></td>
                                    <td><?= $r[stok_akhir] ?></td>
                                    <td><?= $r[total_pengadaan] ?></td>

                                </tr>
                                <?php
                            }
                            ?>   
                        </tbody>
                        <?php
                        if ($_GET['id_tipe']) {
                            ?>
                            <tfoot>							
                                <tr>
                                    <th style="width: 20px"></th>
                                    <th>Hasil Optimasi</th>
                                    <th><?= $penjualan ?></th>
                                    <th><?= $stok_akhir ?></th>
                                    <th><?= round($hasil) ?></th>
                                </tr>
                            </tfoot>
                            <?php
                        }
                        ?>
                    </table>
                    <hr>

                    Hasil Peramalan, menyatakan bahwa harus melakukan pengadaan barang sejumlah <b><?= round($hasil) ?></b>
                    <div class="hidden-print">
                        <div class="btn-group float-right m-t-15">
                            <a type="button" target="_blank" href='?module=optimasi_pengadaan&act=sample' class="btn btn-primary waves-effect waves-light">Sample Perhitungan</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>  


        <?php
        break;
    case 'sample':
        echo '<pre>';

        $t = 7;
        $penjualan[1] = 21;
        $stok_akhir[1] = 352;
        $pengadaan[1] = 0;

        $penjualan[2] = 22;
        $stok_akhir[2] = 345;
        $pengadaan[2] = 109;

        $penjualan[3] = 12;
        $stok_akhir[3] = 426;
        $pengadaan[3] = 93;

        $penjualan[4] = 35;
        $stok_akhir[4] = 533;
        $pengadaan[4] = 142;

        $penjualan[5] = 58;
        $stok_akhir[5] = 510;
        $pengadaan[5] = 35;

        $penjualan[6] = 48;
        $stok_akhir[6] = 640;
        $pengadaan[6] = 178;

        $penjualan[7] = 55;
        $stok_akhir[7] = 720;
        $pengadaan[7] = 135;

        echo 'penjualan :';
        echo '<br>';
        print_r($penjualan);

        echo 'Stok Akhir :';
        echo '<br>';
        print_r($stok_akhir);

        echo 'pengadaan :';
        echo '<br>';
        print_r($pengadaan);

        $penjualan_max = 58;
        $penjualan_min = 12;
        $stok_akhir_max = 720;
        $stok_akhir_min = 345;
        $pengadaan_max = 178;
        $pengadaan_min = 0;

        $data_penjualan = 11;
        $data_stok_akhir = 400;

        $penjualan_turun = ($penjualan_max - $data_penjualan) / ($penjualan_max - $penjualan_min);
        $penjualan_naik = ($data_penjualan - $penjualan_min) / ($penjualan_max - $penjualan_min);

        $stok_akhir_sedikit = ($stok_akhir_max - $data_stok_akhir) / ($stok_akhir_max - $stok_akhir_min);
        $stok_akhir_banyak = ($data_stok_akhir - $stok_akhir_min) / ($stok_akhir_max - $stok_akhir_min);

        echo 'penjualan_max :';
        print_r($penjualan_max);
        echo '<br>';

        echo 'penjualan_min :';
        print_r($penjualan_min);
        echo '<br>';

        echo 'stok_akhir_max :';
        print_r($stok_akhir_max);
        echo '<br>';

        echo 'stok_akhir_min :';
        print_r($stok_akhir_min);
        echo '<br>';

        echo 'pengadaan_max :';
        print_r($pengadaan_max);
        echo '<br>';

        echo 'pengadaan_min :';
        print_r($pengadaan_min);
        echo '<br>';
        echo '<br>';
        echo 'penjualan_turun :';
        print_r($penjualan_turun);
        echo '<br>';

        echo 'penjualan_naik :';
        print_r($penjualan_naik);
        echo '<br>';

        echo 'stok_akhir_sedikit :';
        print_r($stok_akhir_sedikit);
        echo '<br>';

        echo 'stok_akhir_banyak :';
        print_r($stok_akhir_banyak);
        echo '<br>';

        //R1 penjualan turun stok akhir banyak maka pengadaan berkurang
        if ($penjualan_turun > $stok_akhir_banyak) {
            $x[1] = $stok_akhir_banyak;
        } else {
            $x[1] = $penjualan_turun;
        }

        $z[1] = $pengadaan_max - ( $x[1] * ($pengadaan_max - $pengadaan_min));


        //R2 penjualan turun stok akhir sedikit maka pengadaan berkurang
        if ($penjualan_turun > $stok_akhir_sedikit) {
            $x[2] = $stok_akhir_sedikit;
        } else {
            $x[2] = $penjualan_turun;
        }

        $z[2] = $pengadaan_max - ( $x[2] * ($pengadaan_max - $pengadaan_min));


        //R3 penjualan naik stok akhir banyak maka pengadaan bertambah
        if ($penjualan_naik > $stok_akhir_banyak) {
            $x[3] = $stok_akhir_banyak;
        } else {
            $x[3] = $penjualan_naik;
        }

        $z[3] = $pengadaan_max + ( $x[3] * ($pengadaan_max - $pengadaan_min));


        //R4 penjualan naik stok akhir sedikit maka pengadaan bertambah
        if ($penjualan_naik > $stok_akhir_sedikit) {
            $x[4] = $stok_akhir_sedikit;
        } else {
            $x[4] = $penjualan_naik;
        }

        $z[4] = $pengadaan_max + ( $x[4] * ($pengadaan_max - $pengadaan_min));

        echo '<br>';
        echo 'konstanta X:';
        print_r($x);
        echo '<br>';

        echo 'konstanta Z :';
        print_r($z);
        echo '<br>';

        $hasil = ($x[1] * $z[1]) + ($x[2] * $z[2]) + ($x[3] * $z[3]) + ($x[4] * $z[4]) / $x[1] + $x[2] + $x[3] + $x[4];
        echo 'Hasil Optimasi :';
        print_r($hasil);
        echo '<br>';
        break;
}
?>

