<link href="<?php echo base_url() ?>template/adminlte/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<!--<body onload="loadSearch();
        return false;"></body>-->

<div><br><br><br><br></div>
<div class="cari">
    <div class="col-md-12">
        <div class="row">
            <div class="callout callout-info">
                <div class="container">
                    <p><h4><strong>Hasil Pencarian Nomor :  
                            '<span class="nomoronload"><?php
                                echo $this->session->flashdata('nomorcari');
                                ?></span>'
                        </strong></h4></p>
                    <p class="pesanonload"><?php
                        if ($product->num_rows() == 0) {
                            echo 'nomor yang anda cari tidak ditemukan,silahkan <a href="javascript:void(0)"><code>pesan nomor</code></a> atau cari nomor lainnya...!';
                        }
                        ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container bt">
    <div class="row">
        <div class="col-md-3">
            <div class="col-md-12">
                <div class="row">
                    <div class="box box-primary" style="background: #f4f4f4; border-bottom: 3px solid #3498db;">
                        <div class="box-header">
                            <h4 class="box-title">Cari <span style="color: #3498db;">Nomor berdasarkan</span> :</h4>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        <form role="form">
                            <div class="box-body">
                                <div class="form-group">
                                    <label>Masukkan nomor yang dicari</label>
                                    <input id="nomorcari" name="nomorcari" onchange="getNomor();
                                            return false;" type="text" value="<?php echo $this->session->flashdata('nomorcari'); ?>" class="form-control" placeholder="Masukkan nomor yang dicari">
                                </div>
                                <div class="form-group">
                                    <label>Pilih Posisi</label>
                                    <select id="posisicari" name="posisicari" class="form-control">
                                        <option value = "0">semua posisi</option>
                                        <option value = "1">posisi depan</option>
                                        <option value = "2">posisi tengah</option>
                                        <option value = "3">posisi belakang</option>
                                    </select>
                                </div>                                
                                <div class="form-group">
                                    <label>Pilih Operator</label>
                                    <select id="operatorcari" name="operatorcari" class="form-control">
                                        <option value = "0">semua povider operator</option>
                                        <?php
                                        foreach ($operator->result() as $p) {
                                            echo "<option value = '$p->idprovider'>$p->namaprovider</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Pilih Kategori</label>
                                    <select id="kategoricari" name="kategori" class="form-control">
                                        <option value = "0">semua kategori</option>
                                        <?php
                                        foreach ($kategori->result() as $k) {
                                            echo "<option value = '$k->idkategori'>$k->namakategori</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">   
                                    <label>Kisaran Harga</label>
                                    <div class="form-inline">   
                                        <input id="hargacari1" style="width: 107px;" type="text" class="form-control" placeholder="Tipe">    
                                        s/d
                                        <input id="hargacari2" style="width: 107px;" type="text" class="form-control" id="exampleInputPassword1" placeholder="Tipe">    
                                        <span id="messagehargacari1" class="text-red"></span>
                                        <span id="messagehargacari2" class="text-red"></span>
                                    </div>
                                </div>
                            </div><!-- /.box-body -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="col-md-12">

                <div class="row">

                    <!-- datatable -->
                    <div class="box" style="border: 3px solid #3498db;">
                        <div class="box-header">
                            <div> <h4>Hasil <span style="color: #3498db;">Pencarian Nomor</span> : '<span class="nomoronload"><?php
                                        echo $this->session->flashdata('nomorcari');
                                        ?></span>'</h4></div>
                        </div><!-- /.box-header -->
                        <!--&nbsp;&nbsp;&nbsp;-->

                        <div class="box-body table-responsive" id="tablefirst">
                            <table class="table table-bordered table-hover display">
                                <thead>
                                    <tr>
                                        <th class='text-center'>No</th>
                                        <th class='text-center'>Logo</th>
                                        <th class='text-center'>Nomor</th>
                                        <th class='text-center'>Kategori</th>
                                        <th class='text-center'>Tipe</th>
                                        <th class='text-center'>Harga</th>
                                        <th class='text-center'>Action</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($product->result() as $p) {
                                        echo" <tr class='dataproduct$p->idproduct'>
                                <td class='text-center senyumcell-table-center' width='5px'>$no</td>
                                <td width='50px'><img width='50px' height='40px' class = 'media-object' src = " . base_url() . "pictures/" . $p->logoprovider . " alt = 'logo operator'></td>
                                <td class='text-center senyumcell-table-center'>$p->nomorproduct</td>
                                <td class='text-center senyumcell-table-center'>$p->namakategori</td>
                                <td width='50px' class='text-center senyumcell-table-center'>$p->namajenisoperator</td>
                                <td class='text-right senyumcell-table-center'>$p->hargaproduct</td>
                                <td class='text-center senyumcell-table-center'><button type = 'button' class = 'btn btn-primary btn-sm'>Beli</button></td>
                          </tr>       
                            ";
                                        $no++;
                                    }
                                    ?>                               
                                </tbody>                               
                            </table>
                        </div><!-- /.box-body -->
                        <div class="box-body table-responsive" id="tablesecond">
                            <table class="table table-bordered table-hover display">
                                <thead>
                                    <tr>
                                        <th class='text-center'>No</th>
                                        <th class='text-center'>Logo</th>
                                        <th class='text-center'>Nomor</th>
                                        <th class='text-center'>Kategori</th>
                                        <th class='text-center'>Tipe</th>
                                        <th class='text-center'>Harga</th>
                                        <th class='text-center'>Action</th> 
                                    </tr>
                                </thead> 
                                <tbody id="refreshtable">

                                </tbody>
                            </table>
                        </div>

                    </div><!-- /.box -->


                    <!-- end datatable -->
                </div>

            </div>

        </div>
    </div>
</div>






<div class="senyumcell-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">



            </div>
        </div>
    </div>
</div>

</div>

<!-- content -->



<!-- End content -->


<!-- End Here -->

<script src="<?php echo base_url() ?>template/adminlte/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>template/adminlte/plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>

<!-- page script -->
<script type="text/javascript">
                                        $("#tablesecond").hide();
                                        
                                        $(function() {
                                            $('table.display').dataTable({
                                                "bPaginate": true,
                                                "bLengthChange": true,
                                                "bFilter": false,
                                                "bSort": true,
                                                "bInfo": true,
                                                "bAutoWidth": false
                                            });
                                        });

                                        function loadPesanError() {

                                        }

                                        function loadTableCari() {
                                            var nomorcari = $("#nomorcari").val();
                                            var posisicari = $("#posisicari").val();
                                            var operatorcari = $("#operatorcari").val();
                                            var kategoricari = $("#kategoricari").val();
                                            var hargacari1 = $("#hargacari1").val();
                                            var hargacari2 = $("#hargacari2").val();
                                            $.ajax({
                                                type: 'post',
                                                url: "<?php echo site_url(); ?>home/searchRefreshShow",
                                                data: "&nomorcari=" + nomorcari + "&posisicari=" + posisicari + "&operatorcari=" + operatorcari + "&kategoricari=" + kategoricari + "&hargacari1=" + hargacari1 + "&hargacari2=" + hargacari2,
                                                success: function(html) {
                                                    $("#refreshtable").html(html);
                                                }
                                            });
                                        }

                                        function getNomor() {
                                            var nomorcari = $("#nomorcari").val();
                                            var posisicari = $("#posisicari").val();
                                            var operatorcari = $("#operatorcari").val();
                                            var kategoricari = $("#kategoricari").val();
                                            var hargacari1 = $("#hargacari1").val();
                                            var hargacari2 = $("#hargacari2").val();
                                            $.ajax({
                                                url: "<?php echo base_url() ?>home/searchRefresh",
                                                type: "post",
                                                data: "&nomorcari=" + nomorcari + "&posisicari=" + posisicari + "&operatorcari=" + operatorcari + "&kategoricari=" + kategoricari + "&hargacari1=" + hargacari1 + "&hargacari2=" + hargacari2,
                                                dataType: "json",
                                                success: function(data) {
                                                    if (data.correct == "salah") {
                                                        loadPesanError();
                                                        var errorCari = data.messagenomorcari + "<br>" + data.messagehargacari1 + "<br>" + data.messagehargacari2;
                                                        swal({
                                                            title: "Error Message!",
                                                            text: "<div class='text-red'>" + errorCari + "</div>",
                                                            type: "error",
                                                            html: true
                                                        });
                                                    }
                                                },
                                                complete: function(response) {
                                                    $("#tablefirst").hide();
                                                    $("#tablesecond").show();
//                                                    loadPesanError();
                                                    loadTableCari();
                                                    $(".nomoronload").html(nomorcari);
                                                }
                                            });
                                        }


</script>