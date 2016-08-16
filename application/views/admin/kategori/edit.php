<div class="box box-primary">
    <!-- form start -->
    <form  id="kategoriForm" role="form" onsubmit="updateKategori();
            return false;">
        <input type="hidden" id="idkategori" name="idkategori" value="<?php echo $kategori['idkategori']; ?>">

        <div class="box-body">
            <div class="form-group">
                <label>Nama Kategori</label>
                <input type="text" class="form-control" placeholder="Masukkan nama kategori" name="namakategori" value="<?php echo $kategori['namakategori'] ?>" id="namakategori">
                <span id="messagenamakategori" class="text-red"></span>
            </div>
        </div><!-- /.box-body -->

        <div class="box-footer">
            <button type="submit" class="btn btn-primary act-simpan">Simpan</button>
            <?php
            echo anchor('backend/kategori', 'Kembali', array('class' => 'btn btn-primary'));
            ?>
        </div>
    </form>
</div><!-- /.box -->


<script type="text/javascript">
        function updateKategori() {
            var idkategori = $("#idkategori").val();
            var namakategori = $("#namakategori").val();
            var actSimpan = $(".act-simpan");
            actSimpan.button('loading');
            $.ajax({
                url: "<?php echo site_url(); ?>backend/kategori/update",
                type: "post",
                data: "&idkategori=" + idkategori + "&namakategori=" + namakategori,
                dataType: "json",
                success: function(data) {
                    if (data.correct == "salah") {
                        $("#messagenamakategori").html(data.messagenamakategori);
                    } else {
                        alert(data.message1);
                        $("#messagenamakategori").html("");
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