<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/iCheck/square/blue.css">

</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="../../index2.html"><b>LOGIN</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">BIENVENIDO AL SISTEMA</p>

      <form id="ingreso" method="post">
        <div class="form-group has-feedback">
          <input type="text" class="form-control" placeholder="Ingresar usuario..." required name="usu" id="usu">
          <span class="fa fa-user form-control-feedback"></span>
          <span id="error_u"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" class="form-control" placeholder="Ingresar contraseña..." required name="pas" id="pas">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          <span id="error_p"></span>
        </div>
        <div class="row">
          <div class="col-xs-8">
            <div class="checkbox icheck">
              <label><input type="checkbox" required> MARCAR!</label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">INGRESAR</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="social-auth-links text-center">
        <p id="error_usuario"></p>
      </div>
    </div>
    <!-- /.login-box-body -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery 2.2.0 -->
  <script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.2.0.min.js"></script>
  <!-- Bootstrap 3.3.6 -->
  <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
  <!-- iCheck -->
  <script src="<?php echo base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script>
  <script>
    $(function() {
      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
      });
    });
    $("#ingreso").submit(function(event) {
      event.preventDefault();
      var usu = $("#usu").val();
      var pas = $("#pas").val();
      var expresion = /^[A-Za-z0-9_\&\*\#\@/.-]+$/;

      if (!expresion.test(usu)) {
        $("#error_u").html('<b style="color:#ff0000;">No escriba carracteres especiales...</b>');
      } else {
        $("#error_u").html('');
        if (!expresion.test(pas)) {
          $("#error_p").html('<b style="color:#ff0000;">No escriba carracteres especiales...</b>');
        } else {
          $.ajax({
            url: '<?php echo base_url(); ?>fa14fbe9b4591e',
            type: 'POST',
            data: $("form").serialize(),
            success: function(dato) {
              var valores = eval(dato);
              if (valores[0] == 1) {
                window.location = '<?php echo base_url(); ?>';
              } else {
                $("#error_usuario").html('<b style="color:#ff0000">Usuario y contraseña no validas</b>')
              }

            }
          });
        }
      }
      // 


    });
  </script>
</body>

</html>