<?php
$aksi = "modules/module_ukuran/aksi_ukuran.php";
switch ($_GET[act]) {
    // Tampil 
    default:
        ?>
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">UKURAN</h4>
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
                                    <a type="button" href='?module=ukuran&act=tambah' class="btn btn-primary waves-effect waves-light">Tambah Ukuran</a>
                                </div>
                                <h4 class="m-b-30 m-t-0 header-title">DATA UKURAN</h4>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead class="thead-light">
                                <tr>
                                    <th style="width: 20px">No.</th>
                                    <th>Ukuran</th>										
                                    <th>Tipe Ukuran</th>	
                                    <th style="width: 20px">Aksi</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $tampil = mysql_query("SELECT * FROM ukuran ORDER BY id_ukuran ASC");
                                $no = 1;
                                while ($r = mysql_fetch_array($tampil)) {
                                    ?>
                                    <tr>
                                        <th scope="row"><?= $no++ ?></th>
                                        <th><?= $r[nama_ukuran] ?></th>										
                                        <th><?= $r[tipe_ukuran] ?></th>
                                        
                                        <td><a type="button" href='?module=ukuran&act=edit&id=<?= $r[id_ukuran] ?>' class="btn btn-custom waves-effect waves-light"><i class="fa fa-edit"></i></a> 
                                            <a type="button" href=<?= $aksi ?>?module=ukuran&act=hapus&id=<?= $r[id_ukuran] ?> onClick="return confirm('Apakah Anda Yakin Untuk Menghapus Data Ini ?')" class="btn btn-danger waves-effect waves-light"><i class="fa fa-trash-o"></i></a>
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
                    <h4 class="page-title">TAMBAH UKURAN</h4>
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
                                        <form id="wizard-vertical" method=POST action='<?= $aksi ?>?module=ukuran&act=input'>
                                            <section>
                                                <div class="form-group row">
                                                    <label class="col-lg-2 control-label" for="nama_ukuran">Ukuran</label>
                                                    <div class="col-lg-10">
                                                        <input id="nama_ukuran" name="nama_ukuran" type="text" class="form-control" placeholder="Masukan Ukuran" required>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-2 control-label " for="tipe_ukuran">Tipe Ukuran</label>
                                                    <div class="col-lg-10">
                                                        <input id="tipe_ukuran" name="tipe_ukuran" type="text" class="form-control" placeholder="Masukan Tipe Ukuran" required>
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
                                    <!-- end row -->

                                    <?php
                                    break;

                                // Form Edit 
                                case "edit":
                                    $edit = mysql_query("SELECT * FROM ukuran WHERE id_ukuran='$_GET[id]'");
                                    $r = mysql_fetch_array($edit);
                                    ?>

                                    <!-- Page-Title -->
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="page-title-box">
                                                <h4 class="page-title">UBAH UKURAN</h4>
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
                                                        <form id="wizard-vertical" method=POST action='<?= $aksi ?>?module=ukuran&act=update'>
                                                            <section>
                                                                <div class="form-group row">

                                                                    <label class="col-lg-2 control-label" for="nama_ukuran">Ukuran</label>
                                                                    <div class="col-lg-10">
                                                                        <input id="nama_ukuran" name="nama_ukuran" type="text" class="form-control" value="<?= $r[nama_ukuran] ?>" required>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label class="col-lg-2 control-label " for="tipe_ukuran">Tipe Ukuran</label>
                                                                    <div class="col-lg-10">
                                                                        <input id="tipe_ukuran" name="tipe_ukuran" type="text" class="form-control" value="<?= $r[tipe_ukuran] ?>" required>
                                                                    </div>
                                                                </div>     
                                                            </section>

                                                            <input  name="id_ukuran" type="hidden" value="<?= $r[id_ukuran] ?>">
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
                                    <!-- end row -->

                                    <?php
                                    break;
                            }
                            ?>