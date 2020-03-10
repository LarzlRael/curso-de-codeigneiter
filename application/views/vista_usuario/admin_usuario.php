 <!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    BIENVENIDO AL SISTEMA
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-home"></i> INICIO</a></li>
    <li class="active">ADMIN USUARIO</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="box">
      <div class="box-header">
        <h3 class="box-title">ADMINISTRACION DE USUARIOS</h3>
      </div>
      <button class="btn btn-success" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> INGRESAR USUARIO</button>
      <a href="<?php echo base_url();?>Cotroller_sistema/imprimir_reporte_pdf" class="btn btn-warning" target="_black"><i class="fa fa-file-pdf-o"> Imprimir PDF</i></a>
      <a href="<?php echo base_url();?>/Cotroller_sistema/imprimir_reporte_exel" class="btn btn-success"><i class="fa fa-file-excel-o"> Imprimir Excel</i></a>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="tbl_fer" class="table table-bordered table-striped">
          <thead>
          <tr class="bg-primary">
            <th>#</th>
            <th>CANERT</th>
            <th>NOMBRE & APELLIDO</th>
            <th>TIPO USUARIO</th>
            <th>ESTADO</th>
            <th>FECHA</th>
            <th>IMAGEN</th>
            <th>ACCION</th>
          </tr>
          </thead>
          <tbody>
            <?php $co=1; foreach ($listar_usuarios as $obj) { ?>
            <tr>
              <td><?php echo $co++; ?></td>
              <td><?php echo $obj->ci.' '.$obj->dpto; ?></td>
              <td><?php echo $obj->nombre.' '.$obj->paterno.' '.$obj->materno; ?></td>
              <td> <?php echo $obj->tipo_usuario; ?></td>
              <td>
              <?php if($obj->u_estado=='activo'){ ?>
                  <small class="label label-success"><i class="fa fa-power-off"></i> activo</small>
              <?php }else{ ?>
                  <small class="label label-danger"><i class="fa fa-power-off"></i> inactivo</small>
              <?php } ?>
              </td>
              <td><?php echo fecha_literal($obj->u_fecha_reg,4); ?></td>
              <td>
                <?php if($obj->imagen==null){ ?>
                  <img width="40px" src="<?php echo base_url();?>assets/dist/img/user2-160x160.jpg"  alt="User Image">
                <?php }else{ ?>
                    <img width="40px" src="<?php echo base_url();?>assets/imagen_perfil/<?php echo $obj->imagen; ?>" alt="User Image">
                <?php } ?>
              </td>
              <td>
                <button class="btn btn-primary" onclick="editar_usuario('<?php echo $obj->idusuario; ?>')"><i class="fa fa-pencil"></i></button>

                <button class="btn btn-primary"><i class="fa fa-power-off"></i></button>

                <button class="btn btn-primary" onclick="eliminar_usuario('<?php echo $obj->idusuario; ?>')"><i class="fa fa-trash-o"></i></button>
              </td>
            </tr>
            <?php } ?>
          </tbody>
          
        </table>
      </div>
      <!-- /.box-body -->
    </div>
</section>




<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">INGRESAR NUEVO USUARIO</h4>
        </div>
        <div class="modal-body">
        <form method="post" id="guardar_nuevo_usuario" enctype="multipart/form-data">
          <div class="panel-body">

            <div class="col-md-4">
              <div class="form-group1 ">
                  <label >CARNET</label>
                    <input type="number" class="form-control input-sm" name="ci" required>
                </div>
            </div>
            <div class="col-md-4">
              <div class="form-group1 ">
                  <label >EXPEDIDO</label>
                    <select name="dpto" class="form-control input-sm" required>
                      <option></option>
                      <option value="LP">LA PAZ</option>
                      <option value="CBB">COCHABAMBA</option>
                      <option value="SC">SUCRE</option>
                      <option value="PD">PANDO</option>
                      <option value="BN">BENI</option>
                      <option value="TJ">TARIJA</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
              <div class="form-group1 ">
                  <label >NOMBRE</label>
                    <input type="text" class="form-control input-sm" name="nombre" required>
                </div>
            </div>


            <div class="col-md-4">
              <div class="form-group1 ">
                  <label >PATERNO</label>
                    <input type="text" class="form-control input-sm" name="paterno">
                </div>
            </div>
            <div class="col-md-4">
              <div class="form-group1 ">
                  <label >MATERNO</label>
                    <input type="text" class="form-control input-sm" name="materno">
                </div>
            </div>
            <div class="col-md-4">
              <div class="form-group1 ">
                  <label >TELEFONO</label>
                    <input type="number" class="form-control input-sm" name="telf">
                </div>
            </div>


            <div class="col-md-4">
              <div class="form-group1 ">
                  <label >GENERO</label>
                    <select name="genero"  class="form-control input-sm" required>
                      <option></option>
                      <option value="M">MASCULINO</option>
                      <option value="F">FEMENINO</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
              <div class="form-group1 ">
                  <label >TIPO USUARIO</label>
                    <select name="t_usuario"  class="form-control input-sm" required>
                      <option></option>
                      <?php foreach ($this->db->get("tipo_usuario")->result() as $ti) { ?>
                        <option value="<?php echo $ti->idtipo_usuario; ?>"><?php echo $ti->tipo_usuario; ?></option>
                      <?php } ?>
                      
                    </select>
                </div>
            </div>
            <div class="col-md-4">
              <div class="form-group1 ">
                  <label >IMAGEN</label>
                    <input type="file" class="form-control input-sm" name="imagen">
                </div>
            </div>

            <div class="col-md-4">
              <div class="form-group1 ">
                  <label >USUARIO</label>
                    <input type="text" class="form-control input-sm" name="usuario">
                </div>
            </div>
            <div class="col-md-4">
              <div class="form-group1 ">
                  <label >NUEVO PASSWORD</label>
                    <input type="password" class="form-control input-sm" name="pass1" id="pass1" onkeyup="verificar_pass1(this.value)">
                    <span id="p_error"></span>
                </div>
            </div>
            <div class="col-md-4">
              <div class="form-group1 ">
                  <label >REPETIR PASSWORD</label>
                    <input type="password" class="form-control input-sm" name="pass2" id="pass2" onkeyup="verificar_pass2(this.value)">
                    <span id="p_error1"></span>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" ><i  class="fa fa-save"></i> GUARDAR DATOS</button>

            <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-close"></i> CALCELAR</button>
          </div>
        </form>

        </div>
        
    </div>
  </div>
</div>



<div id="editar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">MODIFICAR USUARIO</h4>
        </div>
        <div class="modal-body" id="ver_contenido">
          
        </div>
        
    </div>
  </div>
</div>



<script>
  function verificar_pass1(pass1){
    var pass2=$("#pass2").val();
    validar_password(pass1,pass2)
  }
  function verificar_pass2(pass2){
    var pass1=$("#pass1").val();
    validar_password(pass1,pass2)
  }
  function validar_password(pass1,pass2){
    if (pass1==pass2) {
      $("#p_error").html('<b style="color:#008000">Los password son iguales</b><input type="hidden" id="validar" value="1">')
      $("#p_error1").html('<b style="color:#008000">Los password son iguales</b>')
    }else{
      $("#p_error").html('<b style="color:#ff0000">Los password no son iguales</b><input type="hidden" id="validar" value="0">')
      $("#p_error1").html('<b style="color:#ff0000">Los password no son iguales</b>')
    }
  }


  $("#guardar_nuevo_usuario").submit(function(event) {
    event.preventDefault();
    var formData=new FormData($("#guardar_nuevo_usuario")[0]);
    $.ajax({
        url:'<?php echo base_url();?>Cotroller_sistema/guardar_nuevo_usuario',
        type:'POST',
        data:formData,
        cache:false,
        processData:false,
        contentType:false,
        success:function(objeto){ 
          alertify.success("<b>Datos enviados...</b>"); 
          alertify.alert("<b style='color: #008000;'>"+objeto+"</b> ", function () { 
            window.location='';
          }); 
        }
    });
  });

  function eliminar_usuario(idusuario){
    alertify.confirm("<p>ESTA SEGURO QUE DESEA ELIMINAR ??<br><br><b>ENTER</b> y <b>ESC</b> corresponden a <b>Aceptar</b> o <b>Cancelar</b></p>", function (e) {
        if (e) {
          alertify.success("Has pulsado Aceptar");
          $.post('<?php echo base_url();?>Cotroller_sistema/eliminar_usuario', {idusuario}, function(dato) {
            window.location=''
          });
        } else { 
          alertify.error("Has pulsado cancelar");
        }
      }); 
      return false
  }
  function editar_usuario(idusuario){
    $("#editar").modal('show');
    $.post('<?php echo base_url();?>Cotroller_sistema/editar_usuario', {idusuario:idusuario}, function(dato) {
      $("#ver_contenido").html(dato)
    });

    // $("#ver_contenido").html('hola fernando........')
  }
</script>




<!-- page script -->
<script>
  $(function () {
    $('#tbl_fer').DataTable({
        "pagingType": "full_numbers",
        "lengthMenu": [[10, 25, 50, 100, 200, -1], [10, 25, 50, 100, 200, "All"]],
        responsive: true,
        language: {
          search: "_INPUT_",
          searchPlaceholder: "Buscar datos...",
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrar registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "<i class='fa fa-angle-double-left'></i>",
                "sLast":     "<i class='fa fa-angle-double-right'></i>",
                "sNext":     "<i class='fa fa-angle-right'></i>",
                "sPrevious": "<i class='fa fa-angle-left'></i>"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
    });
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": false,
      "autoWidth": false
    });
  });
</script>

