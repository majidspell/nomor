<div class="box box-primary">
    <!-- form start -->
    <form  id="productForm" role="form" onsubmit="simpanProduct();
            return false;">
        <div class="box-body">
            <div class="form-group">
                <label>Nomor Product</label>
                <input type="text" class="form-control" placeholder="Masukkan nomor product" name="nomorproduct" id="nomorproduct">
                <span id="messagenomorproduct" class="text-red"></span>
            </div>
            <div class="form-group">
                <label>Harga</label>
                <input type="text" class="form-control" placeholder="Masukkan harga product" name="hargaproduct" id="hargaproduct">
                <span id="messagehargaproduct" class="text-red"></span>
            </div>
            <div class="form-group">
                <label>Id Provider</label>
                <select name="idprovider" class="form-control" id="idprovider">
                    <?php
                    if (count($provider) > 0) {
                        ?>
                        <option value = "">--pilih provider--</option>
                        <!--<option value ="0">Menu Parent</option>-->
                        <?php
                        foreach ($provider as $p) {
                            echo "<option value = '$p->idprovider'>$p->idprovider -- $p->namaprovider</option>";
                        }
                    } else {
                        echo "<option>--Data Belum Tersedia--</option>";
                    }
                    ?>
                </select>
                <span id="messageidprovider" class="text-red"></span>
            </div>
            <div class="form-group">
                <label>Id Kategori</label>
                <select name="idkategori" class="form-control" id="idkategori">
                    <?php
                    if (count($kategori) > 0) {
                        ?>
                        <option value = "">--pilih kategori--</option>
                        <!--<option value ="0">Menu Parent</option>-->
                        <?php
                        foreach ($kategori as $k) {
                            echo "<option value = '$k->idkategori'>$k->idkategori -- $k->namakategori</option>";
                        }
                    } else {
                        echo "<option>--Data Belum Tersedia--</option>";
                    }
                    ?>
                </select>
                <span id="messageidkategori" class="text-red"></span>
            </div>
            <div class="form-group">
                <label>Status Pasangan ( *Isi dengan 0 jika nomor product merupakan single number )</label>
                <input type="text" class="form-control" placeholder="Masukkan nomor pasangan dari nomor product yang mau dipasangkan" name="statuspasangan" id="statuspasangan">
                <span id="messagestatuspasangan" class="text-red"></span>
            </div>
        </div><!-- /.box-body -->

        <div class="box-footer">
            <button type="submit" class="btn btn-primary act-simpan">Simpan</button>
            <?php
            echo anchor('backend/product', 'Kembali', array('class' => 'btn btn-primary'));
            ?>
        </div>
    </form>
</div><!-- /.box -->


<script type="text/javascript">
        function simpanProduct() {
            var nomorproduct = $("#nomorproduct").val();
            var hargaproduct = $("#hargaproduct").val();
            var idprovider = $("#idprovider").val();
            var idkategori = $("#idkategori").val();
            var statuspasangan = $("#statuspasangan").val();
//            alert(statuspasangan);
//            alert(idkategori);
            var actSimpan = $(".act-simpan");
            actSimpan.button('loading');
            $.ajax({
                url: "<?php echo site_url(); ?>backend/product/insert",
                type: "post",
                data: "&nomorproduct=" + nomorproduct + "&hargaproduct=" + hargaproduct + "&idprovider=" +
                        idprovider + "&idkategori=" + idkategori + "&statuspasangan=" + statuspasangan,
                dataType: "json",
                success: function(data) {
                    if (data.correct == "salah") {
                        $("#messagenomorproduct").html(data.messagenomorproduct);
                        $("#messagehargaproduct").html(data.messagehargaproduct);
                        $("#messageidprovider").html(data.messageidprovider);
                        $("#messageidkategori").html(data.messageidkategori);
                        $("#messagestatuspasangan").html(data.messagestatuspasangan);
                    } else {
                        alert(data.message1);
                        $("#productForm")[0].reset();
                        $("#messagenomorproduct").html("");
                        $("#messagehargaproduct").html("");
                        $("#messageidprovider").html("");
                        $("#messageidkategori").html("");
                        $("#messagestatuspasangan").html("");                      
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