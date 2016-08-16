<body onload="loadForm();
        return false;"></body>

<!-- form start -->
<div class="col-md-8">
    <div class="box box-primary">

        <form id="providerForm" role="form" onsubmit="updateProvider();
        return false;">
            <input type="hidden" id="idprovider" name="idprovider" value="<?php echo $provider['idprovider']; ?>">

            <div class="box-body">
                <div class="form-group">
                    <label>Nama Provider</label>
                    <input type="text" class="form-control" placeholder="Masukkan nama provider" name="namaprovider" value="<?php echo $provider['namaprovider'] ?>" id="namaprovider">
                    <span id="messagenamaprovider" class="text-red"></span>
                </div>
                <div class="form-group">
                    <input type="hidden" class="form-control" name="setidgrupprovider" value="<?php echo $provider['idgrupprovider']; ?>" id="setidgrupprovider">
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
                    <input type="hidden" class="form-control" name="setidjenisoperator" value="<?php echo $provider['idjenisoperator']; ?>" id="setidjenisoperator">
                    <label>Id Jenis Operator</label>
                    <select name="idjenisoperator" class="form-control" id="idjenisoperator">
                        <?php
                        if (count($jenisoperator) > 0) {
                            ?>
                            <option value = "">--pilih jenis operator--</option>
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

            </div><!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary act-simpan">Simpan</button>
                <?php
                echo anchor('backend/provider', 'Kembali', array('class' => 'btn btn-primary'));
                ?>
            </div>
        </form>
    </div>
</div>

<div class="col-md-4">
    <div class="box box-primary">
        <form role="form" method="post" enctype="multipart/form-data" id="providerFormUpload">
            <div class="box-body"><br>
                <input type="hidden" name="idupload" id="idupload" value="<?php echo $provider['idprovider']; ?>">
                <div align="center" class="imagePriview" id="refresh">
                </div>
                <br>
                <div class="form-group">
                    <label>Logo Provider</label>
                    <input type="file" class="btn btn-default form-control" id="logoprovider" name="logoprovider">
                    <span id="messagelogogambar" class="text-red"></span>
                </div>
                <div class="progress">
                    <div class="progress-bar progress-bar-primary progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                        <span class="sr-only">0% Complete (success)</span>
                    </div>
                </div>                   
                <input type="submit" name="submit" class="btn btn-success" value="Upload">
            </div>
        </form>       
    </div>
</div>
<div class="box-body">
</div>


<script src="<?php echo base_url() ?>assets/js/jquery.form.min.js" type="text/javascript"></script>
<script type="text/javascript">
    var setidgrupprovider = $("#setidgrupprovider").val();
    $("#idgrupprovider").val(setidgrupprovider);

    var setidjenisoperator = $("#setidjenisoperator").val();
    $("#idjenisoperator").val(setidjenisoperator);

    $(".progress").hide();

    function loadForm() {
        var idupload = $("#idupload").val();
        $.ajax({
            type: 'post',
            url: "<?php echo site_url(); ?>backend/provider/refresh",
            data: "idupload=" + idupload,
            success: function(html) {
                $("#refresh").html(html);
            }
        });
    }

    function updateProvider() {
        var idprovider = $("#idprovider").val();
        var namaprovider = $("#namaprovider").val();
        var idgrupprovider = $("#idgrupprovider").val();
        var idjenisoperator = $("#idjenisoperator").val();

        var actSimpan = $(".act-simpan");
        actSimpan.button('loading');
        $.ajax({
            url: "<?php echo site_url(); ?>backend/provider/update",
            type: "post",
            data: "&idprovider=" + idprovider + "&namaprovider=" + namaprovider + "&idgrupprovider=" + idgrupprovider +
                    "&idjenisoperator=" + idjenisoperator,
            dataType: "json",
            success: function(data) {
                if (data.correct == "salah") {
                    $("#messagenamaprovider").html(data.messagenamaprovider);
                    $("#messageidgrupprovider").html(data.messageidgrupprovider);
                    $("#messageidjenisoperator").html(data.messageidjenisoperator);
                } else {
                    alert(data.message1);
                    $("#messagenamaprovider").html("");
                    $("#messageidgrupprovider").html("");
                    $("#messageidjenisoperator").html("");
                }
                actSimpan.button('reset');
            }
        }
        );
    }

    jQuery(document).ready(function() {
        jQuery("#providerFormUpload").submit(function(e) {
            e.preventDefault();
            var data = new FormData();
            data.append("idprovider", jQuery("#idupload").val());
            data.append("logoprovider", jQuery("#logoprovider").get(0).files[0]);
            jQuery.ajax({
                url: "<?php echo site_url(); ?>backend/provider/upload",
                type: 'post',
                data: data,
                cache: false,
                contentType: false,
                processData: false,
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
                success: function() {
                    if (jQuery("#logoprovider").get(0).files[0] == null) {
                        loadForm();
                        $("#messagelogoprovider").html("")
                        $(".progress").hide();
                        alert("You did not select a file to upload.");
                    } else {
                        loadForm();
                        $("#messagelogoprovider").html("")
                        $(".progress").hide();
                        alert('Upload Complete');
                    }

                },
                complete: function(response) {

                }
            });


        });
    });


</script>