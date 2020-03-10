<form method="post" id="guardar_nuevo_usuario" enctype="multipart/form-data">
          <div class="panel-body">

            <div class="col-md-4">
              <div class="form-group1 ">
                  <label >CARNET</label>
                    <input type="number" class="form-control input-sm" name="ci" required value="<?php echo $obj1->ci; ?>">
                </div>
            </div>
            <div class="col-md-4">
              <div class="form-group1 ">
                  <label >EXPEDIDO</label>
                    <select name="dpto" class="form-control input-sm" required>
                      <option></option>
                      <option value="LP" <?php if($obj1->dpto=='LP') echo "selected"; ?>>LA PAZ</option>
                      <option value="CBB" <?php if($obj1->dpto=='CBB') echo "selected"; ?>>COCHABAMBA</option>
                      <option value="SC" <?php if($obj1->dpto=='SC') echo "selected"; ?>>SUCRE</option>
                      <option value="PD" <?php if($obj1->dpto=='PD') echo "selected"; ?>>PANDO</option>
                      <option value="BN" <?php if($obj1->dpto=='BN') echo "selected"; ?>>BENI</option>
                      <option value="TJ" <?php if($obj1->dpto=='TJ') echo "selected"; ?>>TARIJA</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
              <div class="form-group1 ">
                  <label >NOMBRE</label>
                    <input type="text" class="form-control input-sm" name="nombre" required  value="<?php echo $obj1->nombre; ?>">
                </div>
            </div>


            <div class="col-md-4">
              <div class="form-group1 ">
                  <label >PATERNO</label>
                    <input type="text" class="form-control input-sm" name="paterno"  value="<?php echo $obj1->paterno; ?>">
                </div>
            </div>
            <div class="col-md-4">
              <div class="form-group1 ">
                  <label >MATERNO</label>
                    <input type="text" class="form-control input-sm" name="materno"  value="<?php echo $obj1->materno; ?>">
                </div>
            </div>
            <div class="col-md-4">
              <div class="form-group1 ">
                  <label >TELEFONO</label>
                    <input type="number" class="form-control input-sm" name="telf"  value="<?php echo $obj1->telefono; ?>">
                </div>
            </div>


            <div class="col-md-6">
              <div class="form-group1 ">
                  <label >GENERO</label>
                    <select name="genero"  class="form-control input-sm" required>
                      <option></option>
                      <option value="M" <?php if($obj1->genero=='M') echo "selected"; ?>>MASCULINO</option>
                      <option value="F" <?php if($obj1->genero=='F') echo "selected"; ?>>FEMENINO</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
              <div class="form-group1 ">
                  <label >TIPO USUARIO</label>
                    <select name="t_usuario"  class="form-control input-sm" required>
                      <option></option>
                      <?php foreach ($this->db->get("tipo_usuario")->result() as $ti) { ?>
                        <option value="<?php echo $ti->idtipo_usuario; ?>"  <?php if($ti->idtipo_usuario==$obj1->idtipo_usuario) echo "selected"; ?>><?php echo $ti->tipo_usuario; ?></option>
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
                  <label >VISUALIZAR IMAGEN</label>
                    <img src="<?php echo base_url();?>assets/imagen_perfil/<?php echo $obj1->imagen; ?>" width="50px">
                </div>
            </div>

          
            
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" ><i  class="fa fa-save"></i> GUARDAR DATOS</button>

            <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-close"></i> CALCELAR</button>
          </div>
        </form>
