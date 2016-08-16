<!DOCTYPE html>
<html>
    <head>
        <title>nomorpolitan.com</title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>template/senyumcell/css/style.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>template/senyumcell/css/bootstrap.min.css" />
        <link href="<?php echo base_url() ?>template/adminlte/fontawesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" /> 
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>template/senyumcell/css/animate.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/sweetalert.min.css" />

        <link href="<?php echo base_url() ?>template/adminlte/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
        <script src="<?php echo base_url() ?>template/adminlte/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    </head>

    <body>
        <!-- Start Here -->
        <div class="navbar-small">
            <div class="container">
                <ul class="left">
                    <li><a href="#"><i class="fa fa-whatsapp"></i> 085733163557</a></li>
                    <li><a href="#"><i class="fa fa-phone"></i> 085733163557</a></li>
                    <li><a href="#"><i class="fa fa-envelope"></i> majid.spell@gmail.com</a></li>
                </ul>
                <ul class="right">
                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                </ul>
            </div>
        </div>

        <nav class="senyumcell-navbar navbar navbar-default" style="border-bottom: 1px solid #dfdfdf !important;">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">nomorpolitan</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <form method="post" action="<?php echo base_url() ?>home/search" onsubmit="return cekSearchForm();" class="navbar-form navbar-left" role="search">
                        <div class="input-group">
                            <input  id="nomor" name="nomor" type="text" class="form-control" placeholder="Cari nomor" style="width: 215px;">
                            <span class="input-group-btn">
                                <select name="kategori" class="form-control" style="width: 177px;">
                                    <option value = "0">semua kategori</option>
                                    <?php
                                    foreach ($kategori->result() as $k) {
                                        echo "<option value = '$k->idkategori'>$k->namakategori</option>";
                                    }
                                    ?>
                                </select>
                            </span>
                            <span class="input-group-btn">			
                                <button type="submit" name="submit" class="btn btn-default"><i class="fa fa-search"></i> Cari</button>
                            </span>
                        </div>
                    </form>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="active"><a href="#">Home <span class="sr-only">(current)</span></a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Provider Operator <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Im3</a></li>
                                <li><a href="#">xl</a></li>
                                <li><a href="#">simpati as</a></li>
                                <li><a href="#">axis</a></li>
                                <li><a href="#">smartfren</a></li>
                            </ul>
                        </li>
                        <li>
                        <li><a href="#">Cara Berbelanja</a></li>
                        <li><a href="#">Info Resi</a></li>
                        <div class="navbar-form navbar-right">		  			
                            <a href="#" class="btn btn-default"><span class="fa fa-shopping-cart"><strong> Cart</strong></span></a>
                        </div>
                        </li>
                    </ul>			
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>

        <script type="text/javascript">
                        function cekSearchForm() {
                            var nomor = $("#nomor").val()
                            if (nomor == null || nomor == "") {
                                swal({
                                    title: "Error Message!",
                                    text: "<div class='text-red'>Form cari nomor tidak boleh kosong !!!</div>",
                                    type: "error",
                                    html: true
                                });
                                return false;
                            } else if (!nomor.match(/^[0-9]+$/)) {
                                swal({
                                    title: "Error Message!",
                                    text: "<div class='text-red'>Form cari nomor harus berupa angka !!!</div>",
                                    type: "error",
                                    html: true
                                });
                                $("#nomor").val("");
                                return false;
                            } else if (nomor.length > 20) {
                                swal({
                                    title: "Error Message!",
                                    text: "<div class='text-red'>nomor telepon tidak lebih dari 20 angka !!!</div>",
                                    type: "error",
                                    html: true
                                });
                                $("#nomor").val("");
                                return false;
                            }
                        }
        </script>
