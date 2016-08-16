<div class="box box-primary">
    <!-- form start -->
    <form role="form" id="providerForm">
        <div class="box-body">
            <div class="form-group">
                <label>Nama Provider</label>
                <input type="text" class="form-control" placeholder="Masukkan nama provider" name="namaprovider" id="namaprovider">
                <span id="messagenamaprovider" class="text-red"></span>
            </div>
            <div class="form-group">
                <label>Logo Provider</label>
                <input type="file" id="logoprovider" name="logoprovider"/>
                <span id="messagelogoprovider" class="text-red"></span>
            </div>
            <div class="form-group">
                <label>Id Grup Provider</label>
                <select name="idgrupprovider" class="form-control" id="idgrupprovider">
                    <?php
                    if (count($grupprovider) > 0) {
                        ?>
                        <option value = "">--pilih grup provider--</option>
                        <?php
                        foreach ($grupprovider as $g) {
                            echo "<option value = '$g->idgrupprovider'>$g->idgrupprovider -- $g->namagrupprovider</option>";
                        }
                    } else {
                        echo "<option>--Data Belum Tersedia--</option>";
                    }
                    ?>
                </select>
                <span id="messageidgrupprovider" class="text-red"></span>
            </div>
            <div class="form-group">
                <label>Id Jenis Operator</label>
                <select name="idjenisoperator" class="form-control" id="idjenisoperator">
                    <?php
                    if (count($jenisoperator) > 0) {
                        ?>
                        <option value = "">--pilih jenis operator--</option>
                        <!--<option value ="0">Menu Parent</option>-->
                        <?php
                        foreach ($jenisoperator as $j) {
                            echo "<option value = '$j->idjenisoperator'>$j->idjenisoperator -- $j->namajenisoperator</option>";
                        }
                    } else {
                        echo "<option>--Data Belum Tersedia--</option>";
                    }
                    ?>
                </select>
                <span id="messageidjenisoperator" class="text-red"></span>
            </div>
            <div class="progress">
                <div class="progress-bar progress-bar-primary progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                    <span class="sr-only">0% Complete (success)</span>
                </div>
            </div>
        </div><!-- /.box-body -->

        <div class="box-footer">
            <button type="submit" class="btn btn-primary act-simpan">Simpan</button>
            <?php
            echo anchor('backend/provider', 'Kembali', array('class' => 'btn btn-primary'));
            ?>
        </div>
    </form>
</div><!-- /.box -->

<script src="<?php echo base_url() ?>assets/js/jquery.form.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(".progress").hide();
    jQuery(document).ready(function() {
        jQuery("#providerForm").submit(function(e) {
            e.preventDefault();
            var pict = $("#logoprovider").val();
            var actSimpan = $(".act-simpan");
            actSimpan.button('loading');
            jQuery.ajax({
                url: "<?php echo site_url(); ?>backend/provider/insert",
                type: 'post',
                dataType: "json",
                cache: false,
                contentType: false,
                processData: false,
                data: function() {
                    var data = new FormData();
                    data.append("namaprovider", jQuery("#namaprovider").val());
                    data.append("logoprovider", jQuery("#logoprovider").get(0).files[0]);
                    data.append("idgrupprovider", jQuery("#idgrupprovider").val());
                    data.append("idjenisoperator", jQuery("#idjenisoperator").val());
                    return data;
                    //return new FormData(jQuery("form")[0]);
                }(),
                beforeSend: function() {
                    $(".progress").show();
                },
                uploadProgress: function(event, position, total, percentComplete) {
                    $(".progress-bar progress-bar-primary progress-bar-striped").width(percentComplete + '%');
                    $(".sr-only").html(percentComplete + '%')
                },
                error: function(_, textStatus, errorThrown) {
                    alert("Error Uploading");
                    console.log(textStatus, errorThrown);
                },
                success: function(data) {
                    if (data.correct == "salah") {
                        $("#messagenamaprovider").html(data.messagenamaprovider);
                        $("#messageidgrupprovider").html(data.messageidgrupprovider);
                        $("#messageidjenisoperator").html(data.messageidjenisoperator);
                        if (pict == "") {
                            $("#messagelogoprovider").html("You did not select a file to upload.");
                        } else {
                            $("#messagelogoprovider").html(data.messagelogoprovider);
                        }
                    } else {
                        alert(data.message1);
                        $("#messagenamaprovider").html("");
                        $("#messagelogoprovider").html("");
                        $("#messageidgrupprovider").html("");
                        $("#messageidjenisoperator").html("")
                        $("#providerForm")[0].reset();
                    }
                    $(".progress").hide();
                    actSimpan.button('reset');
                },
                complete: function(response) {

                }
            });
            return false;
        });
    });

</script>