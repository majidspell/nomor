<link href="<?php echo base_url() ?>template/adminlte/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<div class="box" id="jenisoperatorresult">
    <div class="box-header">
        <div><?php
            echo anchor('backend/jenisoperator/add', 'Input Jenis Operator', array('class' => 'btn btn-primary btn-sm'));
            ?></div>
    </div><!-- /.box-header -->
    <!--&nbsp;&nbsp;&nbsp;-->

    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Id Jenis Operator</th>
                    <th>Jenis Operator</th>
                    <th></th>
                    <th></th> 
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($record as $r) {
                    echo" <tr class='datajenopt$r->idjenisoperator'>
                                <td width='5'>$no</td>
                                <td width='5'>$r->idjenisoperator</td>
                                <td width='480'>$r->namajenisoperator</td>
                                <td width='10'>" . anchor("backend/jenisoperator/edit/" . $r->idjenisoperator, "<i class='fa fa-edit'>", array('title' => 'edit data')) . "</td>
                                <td width='10'><a class='fa fa-trash' title='hapus data' onclick='deletejenopt($r->idjenisoperator)'><a> </td>
                          </tr>       
                            ";
                    $no++;
                }
                ?>
            </tbody>
        </table>
    </div><!-- /.box-body -->
</div><!-- /.box -->
<script src="<?php echo base_url() ?>template/adminlte/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>template/adminlte/plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>

<!-- page script -->
<script type="text/javascript">
    $(function() {
        $("#example1").dataTable();
    });

    function deletejenopt(id) {
        $.ajax({
            type: "GET",
            url: "jenisoperator/delete",
            data: "idjenisoperator=" + id,
            success: function(html) {
                $(".datajenopt" + id).hide(500);
            }
        });
        return false;
    }


</script>