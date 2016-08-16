<div class="box box-primary">
    <!-- form start -->
    <form  id="jenisOperatorForm" role="form" onsubmit="updateJenisOperator();
            return false;">
        <input type="hidden" id="idjenisoperator" name="idjenisoperator" value="<?php echo $jenisoperator['idjenisoperator']; ?>">

        <div class="box-body">
            <div class="form-group">
                <label>Jenis Operator</label>
                <input type="text" class="form-control" placeholder="Masukkan nama jenis operator" name="namajenisoperator" value="<?php echo $jenisoperator['namajenisoperator'] ?>" id="namajenisoperator">
                <span id="messagenamajenisoperator" class="text-red"></span>
            </div>
        </div><!-- /.box-body -->

        <div class="box-footer">
            <button type="submit" class="btn btn-primary act-simpan">Simpan</button>
            <?php
            echo anchor('backend/jenisoperator', 'Kembali', array('class' => 'btn btn-primary'));
            ?>
        </div>
    </form>
</div><!-- /.box -->


<script type="text/javascript">
        function updateJenisOperator() {
            var idjenisoperator = $("#idjenisoperator").val();
            var namajenisoperator = $("#namajenisoperator").val();
            var actSimpan = $(".act-simpan");
            actSimpan.button('loading');
            $.ajax({
                url: "<?php echo site_url(); ?>backend/jenisoperator/update",
                type: "post",
                data: "&idjenisoperator=" + idjenisoperator + "&namajenisoperator=" + namajenisoperator,
                dataType: "json",
                success: function(data) {
                    if (data.correct == "salah") {
                        $("#messagenamajenisoperator").html(data.messagenamajenisoperator);
                    } else {
                        alert(data.message1);
                        $("#messagenamajenisoperator").html("");
                    }
                    actSimpan.button('reset');
                }
            }
//            ).fail(function(data) {
//                console.log(data)
//                actSimpan.button('reset');
//            }
            );
        }

</script>