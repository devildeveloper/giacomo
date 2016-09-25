<?php
	include("../bd/bd.php");
	include("../bd/usuario.php");
	include("../inc/funcion.php");
	include("../sesion.php");
	$o_bd  = new BD();
	$o_usu = new usuario();

	$num		= $o_usu->editar("usu_id=$c_id");
	$nomape		= $o_usu->e_apenom();
	$dni		= $o_usu->e_dni();
	$mail		= $o_usu->e_cor();
	$reg		= $o_usu->e_reg();
	$pass		= $o_usu->e_con();
	
	$res_dep = $o_bd->consulta( "select * from ubigeo where pro_id='00' and dis_id='00'" );
	
?>
<script>
	function save(){
		var formData = new FormData($('form')[0]);
        $.ajax({
            url: 'control/usuario.php',
            type: 'POST',      
            data: formData,
            contentType: false,
            processData: false,
			success: function(data){
				alert(data);
			}
        });
		return false;
	}
</script>
	<div class="panel panel-default">
		<div class="panel-heading">Actualizar Datos</div>
		<div class="panel-body">
			<form onsubmit="return save();">
              <input name="modo" type="hidden" value="upd" />
              <input name="id" type="hidden" value="<?php echo $c_id; ?>" />
              <input name="tipo" type="hidden" value="<?php echo $c_tip; ?>" />
			  <div class="row">
              <div class="form-group col-md-6">
                <label>Nombres y Apellidos</label>
                <input required type="text" name="nom" class="form-control" value="<?php echo $nomape; ?>" placeholder="Nombres y Apellidos">
              </div>
              <div class="form-group col-md-6">
                <label>Usuario</label><br>
                <input required readonly="readonly" type="text" name="dni" class="form-control" value="<?php echo $dni; ?>" placeholder="Usuario">
              </div>
              <div class="form-group col-md-6">
                <label>E-mail</label>
                <input required type="text" class="form-control" name="mail" value="<?php echo $mail; ?>" placeholder="E-mail">
              </div>
              <div class="form-group col-md-6">
                <label>Región</label>
                <select required class="form-control" name="reg">
				<?php
				while($f=$o_bd->fetch_assoc($res_dep)){
					$cdg = $f["dep_id"].$f["pro_id"].$f["dis_id"];
				?>
					<option value="<?php echo $cdg; ?>" <?php if($reg==$cdg){ echo "selected"; } ?>><?php echo $f["nombre"]; ?></option>
				<?php
				}
				?>
				</select>
              </div>
              <div class="form-group col-md-6">
                <label>Password</label>
                <input required type="text" class="form-control" name="pass" value="<?php echo $pass; ?>" placeholder="Password">
              </div>
              <div class="form-group col-md-12">
              	<button type="submit" class="btn btn-default">Actualizar</button>
              </div>
            </form>
            </div>
		</div>
	</div>
