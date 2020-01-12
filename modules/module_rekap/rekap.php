<?php
$aksi = "modules/module_rekap/aksi_rekap.php";
switch ($_GET[act]) {
    // Tampil 
    default:
        ?>
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">REKAP</h4>
                </div>
            </div>
        </div>
        <!-- end row -->


        <div class="row">
            <div class="col-lg-12">
                <div class="card-box">

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="page-title-box">
                                <div class="btn-group float-right m-t-15">
                                    <a type="button" href='?module=rekap&act=tambah' class="btn btn-primary waves-effect waves-light">Tambah Rekap</a>
                                </div>
                                <h4 class="m-b-30 m-t-0 header-title">DATA REKAP</h4>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead class="thead-light">
                                <tr>
                                    <th style="width: 20px">No.</th>
                                    <th>Tanggal</th>
<!--                                    <th>Tanaman</th>										-->
<!--                                    <th>Kategori</th>
                                    <th>Tipe</th>
                                    <th>Stok Awal</th>
                                    <th>Pengadaan</th>
                                    <th>Pengembalian</th>-->
                                    <th>Hasil Panen</th>
<!--                                    <th>Stok Akhir</th>-->
                                    <th style="width: 20px">Aksi</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $tampil = mysql_query("SELECT * FROM padi ");
//                                var_dump($tampil);
//                                die;
                                $no = 1;
                                while ($r = mysql_fetch_array($tampil)) {
                                    ?>
                                    <tr>
                                        <th scope="row"><?= $no++ ?></th>
                                        <td><?= $r[tanggal] ?></td>
                                        <td><?= $r[hasil_panen] ?></td>
<!--                                        <th><? $r[nama_kategori] ?></th>
                                        <th><? $r[nama_tipe] ?></th>
                                        <td><? $r[stok_awal] ?></td>
                                        <td><? $r[total_pengadaan] ?></td>
                                        <td><? $r[total_pengembalian] ?></td>-->
<!--                                        <td><? $r[total_penjualan] ?></td>-->
<!--                                        <td><? $r[stok_akhir] ?></td>-->
                                        <td>
                                            <a type="button" href='?module=rekap&act=edit&id=<?= $r[id] ?>' class="btn btn-custom waves-effect waves-light"><i class="fa fa-edit"></i></a> 
                                            <a type="button" href=<?= $aksi ?>?module=rekap&act=hapus&id=<?= $r[id] ?> onClick="return confirm('Apakah Anda Yakin Untuk Menghapus Data Ini ?')" class="btn btn-danger waves-effect waves-light"><i class="fa fa-trash-o"></i></a>
                                        </td>
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
        </div>
        <?php
        break;

    // Form Tambah 
    case "tambah":
        ?>
        <!-- end row -->

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">TAMBAH REKAP</h4>
                </div>
            </div>
        </div>
        <!-- end row -->


        <div class="row">
            <div class="col-12">
                <div class="card-box">

                    <div class="col-lg-12">

                        <hr>

                        <div class="p-20">
                            <form id="wizard-vertical" method=POST action='<?= $aksi ?>?module=rekap&act=input'>
                                <section>
                                    <div class="form-group row">
                                        <label class="col-lg-2 control-label" for="tanggal">Tanggal</label>
                                        <div class="col-lg-10">
                                            <input class="form-control input-daterange-datepicker" type="date" name="tanggal" >
                                        </div>
                                    </div>

                                    

<!--                                    <div class="form-group row">
                                        <label class="col-lg-2 control-label " for="tipe">Tipe</label>
                                        <div class="col-lg-10">
                                            <select class="custom-select mb-3" name="id_tipe">
                                                <option selected=""> Masukan Tipe</option>
                                                <?php
//                                                $tampil = mysql_query("SELECT * FROM tipe ORDER BY id_tipe ASC");
//
//                                                while ($r = mysql_fetch_array($tampil)) {
                                                    ?>
                                                    <option value="<?php// $r[id_tipe] ?>"><?php// $r[nama_tipe] ?></option>
                                                    <?php
                                                //}
                                                ?>
                                            </select>  
                                        </div>
                                    </div>-->

<!--                                    <div class="form-group row">
                                        <label class="col-lg-2 control-label " for="stok_awal">Stok Awal</label>
                                        <div class="col-lg-10">
                                            <input id="stok_awal" name="stok_awal" type="number" class="form-control" placeholder="Stok Awal" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-2 control-label " for="total_pengadaan">Pengadaan</label>
                                        <div class="col-lg-10">
                                            <input id="total_pengadaan" name="total_pengadaan" type="number" class="form-control" placeholder="Pengadaan" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-2 control-label " for="total_pengembalian">Pengembalian</label>
                                        <div class="col-lg-10">
                                            <input id="total_pengembalian" name="total_pengembalian" type="number" class="form-control" placeholder="Pengembalian" required>
                                        </div>
                                    </div>-->

                                    <div class="form-group row">
                                        <label class="col-lg-2 control-label " for="hasil_panen">Hasil Panen</label>
                                        <div class="col-lg-10">
                                            <input id="hasil_panen" name="hasil_panen" type="number" class="form-control" placeholder="Hasil Panen" required>
                                        </div>
                                    </div>

<!--                                    <div class="form-group row">
                                        <label class="col-lg-2 control-label " for="stok_akhir">Stok Akhir</label>
                                        <div class="col-lg-10">
                                            <input id="stok_akhir" name="stok_akhir" type="number" class="form-control" placeholder="Stok Akhir" required>
                                        </div>
                                    </div>-->
                                </section>
                                <!--/
                                <div class="form-group row">
                                    <label class="col-lg-12 control-label ">(*) Mandatory</label>
                                </div> -->
                                <div class="form-group text-right m-b-0">
                                    <button class="btn btn-primary waves-effect waves-light" type="submit">
                                        Submit
                                    </button>
                                    <button type="button"  onclick='self.history.back()' class="btn btn-secondary waves-effect m-l-5">
                                        Cancel
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
        <!-- end row -->

        <?php
        break;

    // Form Edit 
    case "edit":
        $edit = mysql_query("SELECT * FROM padi WHERE id='$_GET[id]'");
        $r = mysql_fetch_array($edit);
        ?>


        <!-- end row -->

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">UBAH REKAP</h4>
                </div>
            </div>
        </div>
        <!-- end row -->


        <div class="row">
            <div class="col-12">
                <div clas   s="card-box">

                    <div class="col-lg-12">

                        <hr>

                        <div class="p-20">
                            <form id="wizard-vertical" method=POST action='<?= $aksi ?>?module=rekap&act=update'>
                                <section>
                                    <div class="form-group row">
                                        <label class="col-lg-2 control-label" for="tanggal">Tanggal</label>
                                        <div class="col-lg-10">
                                            <input class="form-control input-daterange-datepicker" type="date" name="tanggal" value="<?= $r[tanggal] ?>">
                                        </div>
                                    </div>

                                    
<!--                                    <div class="form-group row">
                                        <label class="col-lg-2 control-label " for="tipe">Tipe</label>
                                        <div class="col-lg-10">
                                            <select class="custom-select mb-3" name="id_tipe">
                                                <option selected=""> Masukan Tipe</option>
                                                <?php
//                                                $tampil = mysql_query("SELECT * FROM tipe ORDER BY id_tipe ASC");
//
//                                                while ($rk = mysql_fetch_array($tampil)) {
                                                    ?>
                                                    <option value="<?php// $rk[id_tipe] ?>" <?php// $rk[id_tipe] == $r[id_tipe] ? 'selected' : NULL ?> ><?php// $rk[nama_tipe] ?></option>
                                                    <?php
                                                //}
                                                ?>
                                            </select>  
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-2 control-label " for="stok_awal">Stok Awal</label>
                                        <div class="col-lg-10">
                                            <input id="stok_awal" name="stok_awal" type="number" class="form-control" value="<? $r[stok_awal] ?>" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-2 control-label " for="total_pengadaan">Pengadaan</label>
                                        <div class="col-lg-10">
                                            <input id="total_pengadaan" name="total_pengadaan" type="number" class="form-control" value="<? $r[total_pengadaan] ?>" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-2 control-label " for="total_pengembalian">Pengembalian</label>
                                        <div class="col-lg-10">
                                            <input id="total_pengembalian" name="total_pengembalian" type="number" class="form-control" value="<? $r[total_pengembalian] ?>" required>
                                        </div>
                                    </div>-->

                                    <div class="form-group row">
                                        <label class="col-lg-2 control-label " for="hasil_panen">Hasil Panen</label>
                                        <div class="col-lg-10">
                                            <input id="hasil_panen" name="hasil_panen" type="number" class="form-control" value="<?= $r[hasil_panen] ?>" required>
                                        </div>
                                    </div>

<!--                                    <div class="form-group row">
                                        <label class="col-lg-2 control-label " for="stok_akhir">Stok Akhir</label>
                                        <div class="col-lg-10">
                                            <input id="stok_akhir" name="stok_akhir" type="number" class="form-control" value="<? $r[stok_akhir] ?>" required>
                                        </div>
                                    </div>-->
                                </section>
                                <!--/
                                <div class="form-group row">
                                    <label class="col-lg-12 control-label ">(*) Mandatory</label>
                                </div> -->

                                <input  name="id" type="hidden" value="<?= $r[id] ?>">

                                <div class="form-group text-right m-b-0">
                                    <button class="btn btn-primary waves-effect waves-light" type="submit">
                                        Submit
                                    </button>
                                    <button type="button"  onclick='self.history.back()' class="btn btn-secondary waves-effect m-l-5">
                                        Cancel
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
        <!-- end row -->

        <?php
        break;
}
?>