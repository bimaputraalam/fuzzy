<?php
$aksi = "modules/module_produk/aksi_produk.php";
switch ($_GET[act]) {
    // Tampil 
    default:
        ?>  

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">PRODUK</h4>
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
                                    <a type="button" href='?module=produk&act=tambah' class="btn btn-primary waves-effect waves-light">Tambah Produk</a>
                                </div>
                                <h4 class="m-b-30 m-t-0 header-title">DATA PRODUK</h4>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead class="thead-light">
                                <tr>
                                    <th style="width: 20px">No.</th>
                                    <th>Nama Produk</th>
                                    <th>Brand</th>
                                    <th>Kategori</th>
                                    <th>Tipe</th>
                                    <th>Warna</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Harga</th>
                                    <th style="width: 20px">Aksi</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $tampil = mysql_query("SELECT * FROM produk
                                                        JOIN brand ON brand.id_brand=produk.id_brand
                                                        JOIN tipe ON tipe.id_tipe=produk.id_tipe
                                                        JOIN kategori ON tipe.id_kategori = kategori.id_kategori
                                                        JOIN warna ON warna.id_warna=produk.id_warna
                                                        JOIN jenis_kelamin ON jenis_kelamin.id_jenis_kelamin=produk.id_jenis_kelamin");
                                $no = 1;
                                while ($r = mysql_fetch_array($tampil)) {
                                    ?>
                                    <tr>
                                        <th scope="row"><?= $no++ ?></th>
                                        <td><?= $r[nama_produk] ?></td>
                                        <td><?= $r[nama_brand] ?></td>
                                        <td><?= $r[nama_kategori] ?></td>
                                        <td><?= $r[nama_tipe] ?></td>
                                        <td><?= $r[nama_warna] ?></td>
                                        <td><?= $r[nama_jenis_kelamin] ?></td>
                                        <th><?= $r[harga] ?></th>
                                        <td><a type="button" href='?module=produk&act=detail&id=<?= $r[id_produk] ?>' class="btn waves-effect waves-light btn-success"><i class="fa fa-info"></i></a> 
                                            <a type="button" href='?module=produk&act=edit&id=<?= $r[id_produk] ?>' class="btn btn-custom waves-effect waves-light"><i class="fa fa-edit"></i></a> 
                                            <a type="button" href=<?= $aksi ?>?module=produk&act=hapus&id=<?= $r[id_produk] ?> onClick="return confirm('Apakah Anda Yakin Untuk Menghapus Data Ini ?')" class="btn btn-danger waves-effect waves-light"><i class="fa fa-trash-o"></i></a>
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
        <!--- end row -->

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">TAMBAH PRODUK</h4>
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
                            <form id="wizard-vertical" method=POST action='<?= $aksi ?>?module=produk&act=input'>
                                <section>
                                    <div class="form-group row">
                                        <label class="col-lg-2 control-label " for="nama_produk">Nama Produk</label>
                                        <div class="col-lg-10">
                                            <input id="nama_produk" name="nama_produk" type="text" class="form-control" placeholder="Masukan Nama Produk" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-2 control-label" for="brand">Brand</label>
                                        <div class="col-lg-10">
                                            <select class="custom-select mb-3" name="id_brand">
                                                <option selected=""> Masukan Brand</option>
                                                <?php
                                                $tampil = mysql_query("SELECT * FROM brand ORDER BY id_brand ASC");

                                                while ($r = mysql_fetch_array($tampil)) {
                                                    ?>
                                                    <option value="<?= $r[id_brand] ?>"><?= $r[nama_brand] ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-2 control-label " for="tipe">Tipe</label>
                                        <div class="col-lg-10">
                                            <select class="custom-select mb-3" name="id_tipe">
                                                <option selected=""> Masukan Tipe</option>
                                                <?php
                                                $tampil = mysql_query("SELECT * FROM tipe ORDER BY id_tipe ASC");

                                                while ($r = mysql_fetch_array($tampil)) {
                                                    ?>
                                                    <option value="<?= $r[id_tipe] ?>"><?= $r[nama_tipe] ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>  
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-2 control-label" for="warna">Warna</label>
                                        <div class="col-lg-10">
                                            <select class="custom-select mb-3" name="id_warna">
                                                <option selected=""> Masukan Warna</option>
                                                <?php
                                                $tampil = mysql_query("SELECT * FROM warna ORDER BY id_warna ASC");

                                                while ($r = mysql_fetch_array($tampil)) {
                                                    ?>
                                                    <option value="<?= $r[id_warna] ?>"><?= $r[nama_warna] ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-2 control-label" for="jenis_kelamin">Jenis Kelamin</label>
                                        <div class="col-lg-10">
                                            <select class="custom-select mb-3" name="id_jenis_kelamin">
                                                <option selected=""> Masukan Jenis Kelamin</option>
                                                <?php
                                                $tampil = mysql_query("SELECT * FROM jenis_kelamin ORDER BY id_jenis_kelamin ASC");

                                                while ($r = mysql_fetch_array($tampil)) {
                                                    ?>
                                                    <option value="<?= $r[id_jenis_kelamin] ?>"><?= $r[nama_jenis_kelamin] ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-2 control-label " for="harga">Harga</label>
                                        <div class="col-lg-10">
                                            <input id="harga" name="harga" type="number" class="form-control" placeholder="Masukan Harga" required>
                                        </div>
                                    </div>

                                </section>
                                <!--/
                                <div class="form-group row">
                                    <label class="col-lg-12 control-label ">(*) Mandatory</label>
                                </div> -->

                                <div class="form-group text-right m-b-0">
                                    <button class="btn btn-primary waves-effect waves-light" type="submit">
                                        Submit
                                    </button>
                                    <button type="reset" onclick='self.history.back()' class="btn btn-secondary waves-effect m-l-5">
                                        Cancel
                                    </button>
                                </div>

                            </form>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
        <?php
        break;

    // Form Edit 
    case "edit":
        $edit = mysql_query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
        $r = mysql_fetch_array($edit);
        ?>
        <!-- end row -->

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">UBAH PRODUK</h4>
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
                            <form id="wizard-vertical" method=POST action='<?= $aksi ?>?module=produk&act=update'>
                                <section>
                                    <div class="form-group row">
                                        <label class="col-lg-2 control-label " for="nama_produk">Nama Produk</label>
                                        <div class="col-lg-10">
                                            <input id="nama_produk" name="nama_produk" type="text" class="form-control" value="<?= $r[nama_produk] ?>" required>
                                        </div>
                                    </div>
                                </section>    
                                <div class="form-group row">
                                    <label class="col-lg-2 control-label" for="brand">Brand</label>
                                    <div class="col-lg-10">
                                        <select class="custom-select mb-3" name="id_brand">
                                            <option selected=""> Masukan Brand</option>
                                            <?php
                                            $tampil = mysql_query("SELECT * FROM brand ORDER BY id_brand ASC");

                                            while ($rk = mysql_fetch_array($tampil)) {
                                                ?>
                                                <option value="<?= $rk[id_brand] ?>" <?= $rk[id_brand] == $r[id_brand] ? 'selected' : NULL ?> ><?= $rk[nama_brand] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-2 control-label " for="tipe">Tipe</label>
                                    <div class="col-lg-10">
                                        <select class="custom-select mb-3" name="id_tipe">
                                            <option selected=""> Masukan Tipe</option>
                                            <?php
                                            $tampil = mysql_query("SELECT * FROM tipe ORDER BY id_tipe ASC");

                                            while ($rk = mysql_fetch_array($tampil)) {
                                                ?>
                                                <option value="<?= $rk[id_tipe] ?>" <?= $rk[id_tipe] == $r[id_tipe] ? 'selected' : NULL ?> ><?= $rk[nama_tipe] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>  
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-2 control-label" for="warna">Warna</label>
                                    <div class="col-lg-10">
                                        <select class="custom-select mb-3" name="id_warna">
                                            <option selected=""> Masukan Warna</option>
                                            <?php
                                            $tampil = mysql_query("SELECT * FROM warna ORDER BY id_warna ASC");

                                            while ($rk = mysql_fetch_array($tampil)) {
                                                ?>
                                                <option value="<?= $rk[id_warna] ?>" <?= $rk[id_warna] == $r[id_warna] ? 'selected' : NULL ?> ><?= $rk[nama_warna] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-2 control-label" for="jenis_kelamin">Jenis Kelamin</label>
                                    <div class="col-lg-10">
                                        <select class="custom-select mb-3" name="id_jenis_kelamin">
                                            <option selected=""> Masukan Jenis Kelamin</option>
                                            <?php
                                            $tampil = mysql_query("SELECT * FROM jenis_kelamin ORDER BY id_jenis_kelamin ASC");

                                            while ($rk = mysql_fetch_array($tampil)) {
                                                ?>
                                                <option value="<?= $rk[id_jenis_kelamin] ?>" <?= $rk[id_jenis_kelamin] == $r[id_jenis_kelamin] ? 'selected' : NULL ?> ><?= $rk[nama_jenis_kelamin] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <section>
                                    <div class="form-group row">
                                        <label class="col-lg-2 control-label " for="harga">Harga</label>
                                        <div class="col-lg-10">
                                            <input id="harga" name="harga" type="text" class="form-control"  value="<?= $r[harga] ?>" required>
                                        </div>
                                    </div>
                                </section>
                                <!--/
                                <div class="form-group row">
                                    <label class="col-lg-12 control-label ">(*) Mandatory</label>
                                </div> -->

                                <input  name="id_produk" type="hidden" value="<?= $r[id_produk] ?>">

                                <div class="form-group text-right m-b-0">
                                    <button class="btn btn-primary waves-effect waves-light" type="submit">
                                        Submit
                                    </button>
                                    <button type="reset" onclick='self.history.back()' class="btn btn-secondary waves-effect m-l-5">
                                        Cancel
                                    </button>
                                </div>

                            </form>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
        <?php
        break;

    // Form Edit 
    case "detail":
        $edit = mysql_query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
        $r = mysql_fetch_array($edit);
        ?>

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">DETAIL PRODUK</h4>
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
                                    <a type="button" href='?module=produk&act=detail_tambah&id=<?= $_GET[id] ?>' class="btn btn-primary waves-effect waves-light">Tambah Detail</a>
                                </div>
                                <h4 class="m-b-30 m-t-0 header-title">DATA DETAIL PRODUK</h4>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead class="thead-light">
                                <tr>
                                    <th style="width: 20px">No.</th>
                                    <th>Nama Produk</th>
                                    <th>Ukuran</th>
                                    <th>Qty</th>
                                    <th style="width: 20px">Aksi</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $tampil = mysql_query("SELECT * FROM ukuran_produk
                                                        JOIN produk ON produk.id_produk=ukuran_produk.id_produk
                                                        JOIN ukuran ON ukuran.id_ukuran=ukuran_produk.id_ukuran
                                                        WHERE ukuran_produk.id_produk='$_GET[id]'");
                                $no = 1;
                                while ($r = mysql_fetch_array($tampil)) {
                                    ?>
                                    <tr>
                                        <th scope="row"><?= $no++ ?></th>
                                        <td><?= $r[nama_produk] ?></td>
                                        <th><?= $r[nama_ukuran] ?></th>
                                        <th><?= $r[qty] ?></th>
                                        <td><a type="button" href='?module=produk&act=detail_edit&id=<?= $r[id_ukuran_produk] ?>' class="btn btn-custom waves-effect waves-light"><i class="fa fa-edit"></i></a> 
                                            <a type="button" href=<?= $aksi ?>?module=produk&act=detail_hapus&id=<?= $r[id_ukuran_produk] ?>&id_produk=<?= $r[id_produk] ?> onClick="return confirm('Apakah Anda Yakin Untuk Menghapus Data Ini ?')" class="btn btn-danger waves-effect waves-light"><i class="fa fa-trash-o"></i></a>
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

    // Form Edit 
    case "detail_tambah":
        $edit = mysql_query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
        $r = mysql_fetch_array($edit);
        ?>
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">TAMBAH DETAIL PRODUK</h4>
                </div>
            </div>
        </div>
        <!-- end row -->
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <div class="col-lg-12">

                        <hr>

                        <div class="p-20">
                            <form id="wizard-vertical" method=POST action='<?= $aksi ?>?module=produk&act=detail_input'>
                                <section>
                                    <div class="form-group row">
                                        <label class="col-lg-2 control-label " for="nama_produk">Nama Produk</label>
                                        <div class="col-lg-10">
                                            <input id="nama_produk" name="nama_produk" readonly type="text" class="form-control" placeholder="Masukan Nama Produk"  value="<?= $r[nama_produk] ?>">
                                        </div>
                                    </div>
                                    <input id="id_produk" name="id_produk"  type="hidden" value="<?= $r[id_produk] ?>">

                                    <div class="form-group row">
                                        <label class="col-lg-2 control-label" for="brand">Ukuran</label>
                                        <div class="col-lg-10">
                                            <select class="select2 form-control"  name="id_ukuran">
                                                <option selected=""> Masukan Ukuran</option>
                                                <?php
                                                $tampil = mysql_query("SELECT * FROM ukuran ORDER BY id_ukuran ASC");
                                                $tipe = '';
                                                while ($ru = mysql_fetch_array($tampil)) {
                                                    if ($tipe != $ru[tipe_ukuran]) {
                                                        $tipe = $ru[tipe_ukuran];
                                                        ?>
                                                        <optgroup label="<?= $ru[tipe_ukuran] ?>">
                                                            <?php
                                                        }
                                                        ?>
                                                        <option value="<?= $ru[id_ukuran] ?>"><?= $ru[nama_ukuran] ?></option>
                                                        <?php
                                                        if ($tipe != $ru[tipe_ukuran]) {
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
                                    <div class="form-group row">
                                        <label class="col-lg-2 control-label " for="qty">Qty</label>
                                        <div class="col-lg-10">
                                            <input id="qty" name="qty" type="number" class="form-control" placeholder="Masukan Qty" required>
                                        </div>
                                    </div>

                                </section>
                                <!--/
                                <div class="form-group row">
                                    <label class="col-lg-12 control-label ">(*) Mandatory</label>
                                </div> -->

                                <div class="form-group text-right m-b-0">
                                    <button class="btn btn-primary waves-effect waves-light" type="submit">
                                        Submit
                                    </button>
                                    <button type="reset" onclick='self.history.back()' class="btn btn-secondary waves-effect m-l-5">
                                        Cancel
                                    </button>
                                </div>

                            </form>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>

        <?php
        break;

// Form Edit 
    case "detail_edit":
        $edit = mysql_query("SELECT * FROM ukuran_produk
                            JOIN produk ON produk.id_produk=ukuran_produk.id_produk
                            JOIN ukuran ON ukuran.id_ukuran=ukuran_produk.id_ukuran
                            WHERE ukuran_produk.id_ukuran_produk='$_GET[id]'");
        $r = mysql_fetch_array($edit);
        ?>
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">EDIT DETAIL PRODUK</h4>
                </div>
            </div>
        </div>
        <!-- end row -->
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <div class="col-lg-12">

                        <hr>

                        <div class="p-20">
                            <form id="wizard-vertical" method=POST action='<?= $aksi ?>?module=produk&act=detail_update'>
                                <section>
                                    <div class="form-group row">
                                        <label class="col-lg-2 control-label " for="nama_produk">Nama Produk</label>
                                        <div class="col-lg-10">
                                            <input id="nama_produk" name="nama_produk" readonly type="text" class="form-control" placeholder="Masukan Nama Produk"  value="<?= $r[nama_produk] ?>">
                                        </div>
                                    </div>
                                    <input id="id_produk" name="id_produk"  type="hidden" value="<?= $r[id_produk] ?>">
                                    <input id="id_ukuran_produk" name="id_ukuran_produk"  type="hidden" value="<?= $r[id_ukuran_produk] ?>">

                                    <div class="form-group row">
                                        <label class="col-lg-2 control-label" for="brand">Ukuran</label>
                                        <div class="col-lg-10">
                                            <select class="select2 form-control"  name="id_ukuran">
                                                <option selected=""> Masukan Ukuran</option>
                                                <?php
                                                $tampil = mysql_query("SELECT * FROM ukuran ORDER BY id_ukuran ASC");
                                                $tipe = '';
                                                while ($ru = mysql_fetch_array($tampil)) {
                                                    if ($tipe != $ru[tipe_ukuran]) {
                                                        $tipe = $ru[tipe_ukuran];
                                                        ?>
                                                        <optgroup label="<?= $ru[tipe_ukuran] ?>">
                                                            <?php
                                                        }
                                                        ?>
                                                        <option value="<?= $ru[id_ukuran] ?>" <?= $ru[id_ukuran] == $r[id_ukuran] ? 'selected' : NULL ?>><?= $ru[nama_ukuran] ?></option>
                                                        <?php
                                                        if ($tipe != $ru[tipe_ukuran]) {
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
                                    <div class="form-group row">
                                        <label class="col-lg-2 control-label " for="qty">Qty</label>
                                        <div class="col-lg-10">
                                            <input id="qty" name="qty" type="number" value="<?= $r[qty] ?>" class="form-control" placeholder="Masukan Qty" required>
                                        </div>
                                    </div>

                                </section>
                                <!--/
                                <div class="form-group row">
                                    <label class="col-lg-12 control-label ">(*) Mandatory</label>
                                </div> -->

                                <div class="form-group text-right m-b-0">
                                    <button class="btn btn-primary waves-effect waves-light" type="submit">
                                        Submit
                                    </button>
                                    <button type="reset" onclick='self.history.back()' class="btn btn-secondary waves-effect m-l-5">
                                        Cancel
                                    </button>
                                </div>

                            </form>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
        <?php
        break;
}
?>