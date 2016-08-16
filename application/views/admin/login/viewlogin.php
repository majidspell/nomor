<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Senyum Cell | Log in</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

        <link href="<?php echo base_url() ?>template/adminlte/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- Font Awesome Icons -->
        <link href="<?php echo base_url() ?>template/adminlte/fontawesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />   
        <link href="<?php echo base_url() ?>template/adminlte/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />

        <!-- jQuery 2.1.4 -->
        <script src="<?php echo base_url() ?>template/adminlte/plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <!-- Bootstrap 3.3.2 JS -->
        <script src="<?php echo base_url() ?>template/adminlte/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>    

    </head>
    <body class="login-page" style="background-color: #050714;">
        <div class="login-box">
            <div class="login-logo">
                <a href="#"><b>Login</b> Page</a>
            </div><!-- /.login-logo -->
            <div class="login-box-body">
                <p class="login-box-msg">Masukkan Username dan Password Anda :</p>
                <form id="loginForm" role="form" onsubmit="simpanKategori();
                        return false;">
                    <div class="form-group has-feedback">
                        <input id="username" type="text" name="username" class="form-control" placeholder="Username"/>
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        <span id="messageusername" class="text-red"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input id="password" type="password" name="password" class="form-control" placeholder="Password"/>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        <span id="messagepassword" class="text-red"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">    
                            <?php
                            echo anchor(base_url() . 'home', '<< Back To Home', array('class' => 'btn btn-default btn-block btn-flat'));
                            ?>
                        </div>
                        <div class="col-xs-2">    

                        </div><!-- /.col -->
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat act-simpan">Login</button>
                        </div>
                </form>

            </div><!-- /.login-box-body -->
        </div><!-- /.login-box -->
    </body>
</html>

<script type="text/javascript">
                    function loadWelcome() {
                        location.href = "<?php echo base_url() ?>backend/welcome";
                        return false;
                    }
                    
                    function simpanKategori() {
                        var username = $("#username").val();
                        var password = $("#password").val();
                        var actSimpan = $(".act-simpan");
                        actSimpan.button('loading');
                        $.ajax({
                            url: "<?php echo base_url() ?>backend/auth/post",
                            type: "post",
                            data: "&username=" + username + "&password=" + password,
                            dataType: "json",
                            success: function(data) {
                                if (data.correct == "salah") {
                                    $("#messageusername").html(data.messageusername);
                                    $("#messagepassword").html(data.messagepassword);
                                } else if (data.correct == "tidakada") {
                                    alert(data.message1);
                                    $("#loginForm")[0].reset();
                                    $("#messageusername").html("");
                                    $("#messagepassword").html("");
                                } else {
                                    loadWelcome();
                                }
                                actSimpan.button('reset');
                            }
                        }
                        );
                    }

</script>