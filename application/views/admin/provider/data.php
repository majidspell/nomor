<link href="<?php echo base_url() ?>template/adminlte/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<div class="box">
    <div class="box-header">
        <div><?php
            echo anchor('backend/provider/add', 'Input Provider', array('class' => 'btn btn-primary btn-sm'));
            ?></div>
    </div><!-- /.box-header -->
    <!--&nbsp;&nbsp;&nbsp;-->

    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Id Provider</th>
                    <th>Nama Provider</th>
                    <th>Logo Provider</th>
                    <th>Id Grup Provider</th>
                    <th>Id Jenis Operator</th>
                    <th></th>
                    <th></th> 
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($record as $r) {
                    echo" <tr class='dataprod$r->idprovider'>
                                <td width='5'>$no</td>
                                <td width='5'>$r->idprovider</td>
                                <td width='48'>$r->namaprovider</td>
                                <td width='48'><img src=".  base_url()."pictures/".$r->logoprovider." width='50px' height='30px' alt='no image found' class ='img-rounded'></td>";
                    $grupprovider = $this->db->get_where('grupprovider', array('idgrupprovider' => $r->idgrupprovider))->row_array();
                    $jenisoperator = $this->db->get_where('jenisoperator', array('idjenisoperator' => $r->idjenisoperator))->row_array();
                    echo" <td width='48'>$r->idgrupprovider -- ";
                    echo $grupprovider['namagrupprovider'];
                    echo" <td width='48'>$r->idjenisoperator -- ";
                    echo $jenisoperator['namajenisoperator'];
                    echo "<td width = '10'>" . anchor("backend/provider/edit/" . $r->idprovider, "<i class = 'fa fa-edit'>", array('title' => 'edit data')) . "</td>
                    <td width = '10'><a class = 'fa fa-trash' title = 'hapus data' onclick = 'deleteprod($r->idprovider)'><a> </td>
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
        alert(id);
        $.ajax({
            type: "GET",
            url: "provider/delete",
            data: "idprovider=" + id,
            success: function(html) {
                $(".dataprod" + id).hide(500);
            }
        });
        return false;
    }


</script>