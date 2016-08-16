<div class="box box-primary">
    <!-- form start -->
    <form  id="jenisOperatorForm" role="form" onsubmit="simpanJenisOperator();
            return false;">
        <div class="box-body">
            <div class="form-group">
                <label>Jenis Operator</label>
                <input type="text" class="form-control" placeholder="Masukkan nama jenis operator" name="namajenisoperator" id="namajenisoperator">
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
        function simpanJenisOperator() {
            var namajenisoperator = $("#namajenisoperator").val();
            var actSimpan = $(".act-simpan");
            actSimpan.button('loading');
            $.ajax({
                url: "<?php echo site_url(); ?>backend/jenisoperator/insert",
                type: "post",
                data: "&namajenisoperator=" + namajenisoperator,
                dataType: "json",
                success: function(data) {
                    if (data.correct == "salah") {
                        $("#messagenamajenisoperator").html(data.messagenamajenisoperator);
                    } else {
                        alert(data.message1);
                        $("#messagenamajenisoperator").html("");
                        $("#jenisOperatorForm")[0].reset();
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