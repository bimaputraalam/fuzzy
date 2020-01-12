<?php
$aksi = "modules/module_tipe/aksi_tipe.php";
switch ($_GET[act]) {
    // Tampil 
    default:
        ?>
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">TIPE</h4>
                </div>
            </div>
        </div>
        <!-- end row -->



        <!--- end row -->


        <div class="row">
            <div class="col-lg-12">
                <div class="card-box">

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="page-title-box">
                                <div class="btn-group float-right m-t-15">
                                    <a type="button" href='?module=tipe&act=tambah' class="btn btn-primary waves-effect waves-light">Tambah Tipe</a>
                                </div>
                                <h4 class="m-b-30 m-t-0 header-title">DATA TIPE</h4>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead class="thead-light">
                                <tr>
                                    <th style="width: 20px">No.</th>
                                    <th>Tipe</th>									
                                    <th>Kategori</th>
                                    <th style="width: 20px">Aksi</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $tampil = mysql_query("SELECT * FROM tipe JOIN kategori ON tipe.id_kategori = kategori.id_kategori");
                                $no = 1;
                                while ($r = mysql_fetch_array($tampil)) {
                                    ?>
                                    <tr>
                                        <th scope="row"><?= $no++ ?></th>
                                        <th><?= $r[nama_tipe] ?></th>
                                        <th><?= $r[nama_kategori] ?></th>										
                                        <td><a type="button" href='?module=tipe&act=edit&id=<?= $r[id_tipe] ?>' class="btn btn-custom waves-effect waves-light"><i class="fa fa-edit"></i></a> 
                                            <a type="button" href=<?= $aksi ?>?module=tipe&act=hapus&id=<?= $r[id_tipe] ?> onClick="return confirm('Apakah Anda Yakin Untuk Menghapus Data Ini ?')" class="btn btn-danger waves-effect waves-light"><i class="fa fa-trash-o"></i></a>
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
                    <h4 class="page-title">TAMBAH TIPE</h4>
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
                            <form id="wizard-vertical" method=POST action='<?= $aksi ?>?module=tipe&act=input'>
                                <section>
                                    <div class="form-group row">

                                        <label class="col-lg-2 control-label" for="name1">Nama Kategori</label>
                                        <div class="col-lg-10">
                                            <select class="custom-select mb-3" name="id_kategori" required>
                                                <option selected=""> Masukan Kategori</option>
                                                <?php
                                                $tampil = mysql_query("SELECT * FROM kategori ORDER BY id_kategori ASC");

                                                while ($r = mysql_fetch_array($tampil)) {
                                                    ?>
                                                    <option value="<?= $r[id_kategori] ?>"><?= $r[nama_kategori] ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </section>
                                <section>
                                    <div class="form-group row">
                                        <label class="col-lg-2 control-label" for="name1">Nama Tipe</label>
                                        <div class="col-lg-10">
                                            <input id="name1" name="nama_tipe" type="text" class="form-control" placeholder="Masukan Tipe" required>
                                        </div>
                                    </div>
                                </section>
                                <!--/ <div class="form-group row">
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
                    </div>
                    <hr>
                </div>
            </div>
        </div>
        <?php
        break;

    // Form Edit 
    case "edit":
        $edit = mysql_query("SELECT * FROM tipe WHERE id_tipe='$_GET[id]'");
        $r = mysql_fetch_array($edit);
        ?>
        <!-- end row -->


        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">UBAH TIPE</h4>
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
                            <form id="wizard-vertical" method=POST action='<?= $aksi ?>?module=tipe&act=update'>
                                <section>
                                    <div class="form-group row">

                                        <label class="col-lg-2 control-label" for="name1">Nama Kategori</label>
                                        <div class="col-lg-10">
                                            <select class="custom-select mb-3" name="id_kategori">
                                                <option selected=""> Masukan Kategori</option>
                                                <?php
                                                $tampil = mysql_query("SELECT * FROM kategori ORDER BY id_kategori ASC");

                                                while ($rk = mysql_fetch_array($tampil)) {
                                                    ?>
                                                    <option value="<?= $rk[id_kategori] ?>" <?= $rk[id_kategori] == $r[id_kategori] ? 'selected' : NULL ?> ><?= $rk[nama_kategori] ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </section>
                                <section>
                                    <div class="form-group row">

                                        <label class="col-lg-2 control-label" for="name_tipe">Nama Tipe</label>
                                        <div class="col-lg-10">
                                            <input id="name_tipe" name="nama_tipe" type="text" class="form-control" value="<?= $r[nama_tipe] ?>" required>
                                        </div>
                                    </div>
                                </section>
                                
                                <input  name="id_tipe" type="hidden" value="<?= $r[id_tipe] ?>">
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
                    </div>
                    <hr>
                </div>
            </div>
        </div>
        <?php
        break;
}
?>