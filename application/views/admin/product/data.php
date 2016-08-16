<link href="<?php echo base_url() ?>template/adminlte/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<div class="box" id="productresult">
    <div class="box-header">
        <div><?php
            echo anchor('backend/product/add', 'Input Product', array('class' => 'btn btn-primary btn-sm'));
            ?></div>
    </div><!-- /.box-header -->
    <!--&nbsp;&nbsp;&nbsp;-->

    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Id Product</th>
                    <th>Nomor Product</th>
                    <th>Harga</th>
                    <th>Id Provider</th>
                    <th>Id Kategori</th>
                    <th>Status Pasangan</th>
                    <th></th>
                    <th></th> 
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($record as $r) {
                    echo" <tr class='dataprod$r->idproduct'>
                                <td width='5'>$no</td>
                                <td width='5'>$r->idproduct</td>
                                <td width='48'>$r->nomorproduct</td>
                                <td width='48'>$r->hargaproduct</td>";
                    $provider = $this->db->get_where('provider', array('idprovider' => $r->idprovider))->row_array();
                    $kategori = $this->db->get_where('kategori', array('idkategori' => $r->idkategori))->row_array();
                    echo" <td width='48'>$r->idprovider -- ";
                    echo $provider['namaprovider'];
                    echo" <td width='48'>$r->idkategori -- ";
                    echo $kategori['namakategori'];
                    if ($r->statuspasangan == 0) {
                        echo" <td width = '48'>single number</td> ";
                    } else {
                        echo" <td width = '48'>paired number -- $r->statuspasangan</td> ";
                    }
                    echo "<td width = '10'>" . anchor("backend/product/edit/" . $r->idproduct, "<i class = 'fa fa-edit'>", array('title' => 'edit data')) . "</td>
                    <td width = '10'><a class = 'fa fa-trash' title = 'hapus data' onclick = 'deleteprod($r->idproduct)'><a> </td>
                    </tr>
                    ";
                    $no++;
                }
                ?>
            </tbody>
        </table>
    </div><!-- /.box-body -->
</div><!-- /.box -->
<script src="<?php echo base_url()
                ?>template/adminlte/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>template/adminlte/plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>

<!-- page script -->
<script type="text/javascript">
    $(function() {
        $("#example1").dataTable();
    });

    function deleteprod(id) {
        $.ajax({
            type: "GET",
            url: "product/delete",
            data: "idproduct=" + id,
            success: function(html) {
                $(".dataprod" + id).hide(500);
            }
        });
        return false;
    }


</script>