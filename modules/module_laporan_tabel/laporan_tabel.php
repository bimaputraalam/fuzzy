<?php
switch ($_GET[act]) {
    // Tampil 
    default:
        $id = empty($_GET['id']) ? 0 : $_GET['id'];
        
        ?>

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">LAPORAN</h4>
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

                                <h4 class="m-b-30 m-t-0 header-title">LAPORAN TABEL</h4>
                                <hr>
                                <form>
                                    <input type="hidden" name="module" value="laporan_tabel">
                                    <section>
                                        <div class="form-group row">
                                            <label class="col-lg-2 control-label" for="name1">Tanaman</label>
                                            <div class="col-lg-10">
                                                <select class="custom-select mb-3" name="id" required onchange="myFunction(this)">
                                                    <option selected=""> Masukan Tanaman</option>
                                                    <?php
                                                    $tampil = mysql_query("SELECT * FROM padi ORDER BY id ASC");

                                                    while ($r = mysql_fetch_array($tampil)) {
                                                        ?>
                                                        <option value="<?= $r[id    ] ?>" <?= $r[id] == $id_brand ? 'selected' : NULL ?>><?= $r[nama_brand] ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </section>
<!--                                    <section>
                                        <div class="form-group row">
                                            <label class="col-lg-2 control-label " for="tipe">Tipe</label>

                                            <div class="col-lg-10">
                                                <select class="select2 form-control"  name="id_tipe">
                                                    <option selected=""> Masukan Tipe </option>
                                                    <?php
//                                                    $tampil = mysql_query("SELECT * FROM rekap "
//                                                            . "JOIN tipe ON tipe.id_tipe = rekap.id_tipe "
//                                                            . "JOIN kategori ON kategori.id_kategori = tipe.id_kategori "
//                                                            . "WHERE id_brand=$id_brand "
//                                                            . "GROUP BY tipe.id_tipe "
//                                                            . "ORDER BY kategori.nama_kategori ASC");
//                                                    $kategori = 0;
//                                                    while ($rp = mysql_fetch_array($tampil)) {
//                                                        if ($kategori != $rp[id_kategori]) {
//                                                            $kategori = $rp[id_kategori];
                                                            ?>
                                                            <optgroup label="<?php// $rp[nama_kategori] ?>">
                                                                <?php
                                                            //}
                                                            ?>
                                                            <option value="<? $rp[id_tipe] ?>" <? $rp[id_tipe] == $id_tipe ? 'selected' : NULL ?> ><? $rp[nama_tipe] ?></option>
                                                            <?php
                                                            if ($kategori != $rp[id_kategori]) {
                                                                ?>
                                                            </optgroup>
                                                            <?php
                                                        //}
                                                        ?>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>

                                            </div>
                                        </div>
                                    </section>-->

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


                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>							
                            <tr>
                                <th style="width: 20px">No.</th>
                                <th>Bulan</th>
<!--                                <th>Stok Awal</th>
                                <th>Pengadaan</th>
                                <th>Pengembalian</th>-->
                                <th>Hasil Panen</th>
<!--                                <th>Stok Akhir</th>-->
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
<!--                                    <td><? $r[stok_awal] ?></td>
                                    <td><? $r[total_pengadaan] ?></td>
                                    <td><? $r[total_pengembalian] ?></td>-->
                                    <td><?= $r[total_penjualan] ?></td>
<!--                                    <td><? $r[stok_akhir] ?></td>-->
                                </tr>
                                <?php
                            }
                            ?>   
                        </tbody>
                    </table>
                    <hr>

                </div>
            </div>
        </div>     
        <script src="assets/js/jquery.min.js"></script>

        <script>

                                                    function myFunction(id) {
        //                alert("The input value has changed. The new value is: " + id.value);
                                                        window.location.href = "?module=laporan_tabel&id_brand=" + id.value;
                                                    }
        </script>


        <?php
        break;
}
?>