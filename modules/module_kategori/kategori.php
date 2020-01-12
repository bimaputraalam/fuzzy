<?php
$aksi = "modules/module_kategori/aksi_kategori.php";
switch ($_GET[act]) {
    // Tampil 
    default:
        ?>
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">KATEGORI</h4>
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
                                    <a type="button" href='?module=kategori&act=tambah' class="btn btn-primary waves-effect waves-light">Tambah Kategori</a>
                                </div>
                                <h4 class="m-b-30 m-t-0 header-title">DATA KATEGORI</h4>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead class="thead-light">
                                <tr>
                                    <th style="width: 20px">No.</th>									
                                    <th>Kategori</th>
                                    <th style="width: 20px">Aksi</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $tampil = mysql_query("SELECT * FROM kategori ORDER BY id_kategori ASC");
                                $no = 1;
                                while ($r = mysql_fetch_array($tampil)) {
                                    ?>
                                    <tr>
                                        <th scope="row"><?= $no++ ?></th>
                                        <th><?= $r[nama_kategori] ?></th>										
                                        <td><a type="button" href='?module=kategori&act=edit&id=<?= $r[id_kategori] ?>' class="btn btn-custom waves-effect waves-light"><i class="fa fa-edit"></i></a> 
                                            <a type="button" href=<?= $aksi ?>?module=kategori&act=hapus&id=<?= $r[id_kategori] ?> onClick="return confirm('Apakah Anda Yakin Untuk Menghapus Data Ini ?')" class="btn btn-danger waves-effect waves-light"><i class="fa fa-trash-o"></i></a>
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
                    <h4 class="page-title">TAMBAH KATEGORI</h4>
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
                            <form id="wizard-vertical" method=POST action='<?= $aksi ?>?module=kategori&act=input'>
                                <section>
                                    <div class="form-group row">

                                        <label class="col-lg-2 control-label" for="name1">Kategori</label>
                                        <div class="col-lg-10">
                                            <input id="name1" name="nama_kategori" type="text" class="form-control" placeholder="Masukan Kategori" required>
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
                    </div>
                    <hr>
                </div>
            </div>
        </div>
        <?php
        break;

    // Form Edit 
    case "edit":
        $edit = mysql_query("SELECT * FROM kategori WHERE id_kategori='$_GET[id]'");
        $r = mysql_fetch_array($edit);
        ?>
        <!-- end row -->


        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">TAMBAH KATEGORI</h4>
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
                            <form id="wizard-vertical" method=POST action='<?= $aksi ?>?module=kategori&act=update'>
                                <section>
                                    <div class="form-group row">

                                        <label class="col-lg-2 control-label" for="name1">Kategori</label>
                                        <div class="col-lg-10">
                                            <input id="name1" name="nama_kategori" type="text" class="form-control" value="<?= $r[nama_kategori] ?>" required>
                                        </div>
                                    </div>
                                </section>

                                <input  name="id_kategori" type="hidden" value="<?= $r[id_kategori] ?>">

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
}
?>