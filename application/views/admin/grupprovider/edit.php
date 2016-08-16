<div class="box box-primary">
    <!-- form start -->
    <form  id="grupProviderForm" role="form" onsubmit="updateGrupProvider();
            return false;">
        <input type="hidden" id="idgrupprovider" name="idgrupprovider" value="<?php echo $grupprovider['idgrupprovider']; ?>">

        <div class="box-body">
            <div class="form-group">
                <label>Grup Provider</label>
                <input type="text" class="form-control" placeholder="Masukkan nama grup provider" name="namagrupprovider" value="<?php echo $grupprovider['namagrupprovider'] ?>" id="namagrupprovider">
                <span id="messagenamagrupprovider" class="text-red"></span>
            </div>
        </div><!-- /.box-body -->

        <div class="box-footer">
            <button type="submit" class="btn btn-primary act-simpan">Simpan</button>
            <?php
            echo anchor('backend/grupprovider', 'Kembali', array('class' => 'btn btn-primary'));
            ?>
        </div>
    </form>
</div><!-- /.box -->


<script type="text/javascript">
        function updateGrupProvider() {
            var idgrupprovider = $("#idgrupprovider").val();
            var namagrupprovider = $("#namagrupprovider").val();
            var actSimpan = $(".act-simpan");
            actSimpan.button('loading');
            $.ajax({
                url: "<?php echo site_url(); ?>backend/grupprovider/update",
                type: "post",
                data: "&idgrupprovider=" + idgrupprovider + "&namagrupprovider=" + namagrupprovider,
                dataType: "json",
                success: function(data) {
                    if (data.correct == "salah") {
                        $("#messagenamagrupprovider").html(data.messagenamagrupprovider);
                    } else {
                        alert(data.message1);
                        $("#messagenamagrupprovider").html("");
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