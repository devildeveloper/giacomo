<?php
	include("../../bd/bd.php");
	include("../../bd/curso.php");
	include("../../inc/funcion.php");
	include("../../sesion.php");
	$o_bd  = new BD();
	$o_cur = new curso();

	$modo = "add";
	$_id  = $_REQUEST['id'];
	
	if(isset($_id)){
		$num		= $o_cur->editar("cur_id=$_id");
		$tit		= $o_cur->e_tit();
		$des		= $o_cur->e_des();
		$modo		= "upd";
	}	
	
	
?>
<script>
	function save(){
		var formData = new FormData($('form')[0]);
        $.ajax({
            url: 'control/curso.php',
            type: 'POST',      
            data: formData,
            contentType: false,
            processData: false,
			success: function(data){
				page('vista/curso/nuevo.php');
			}
        });
		return false;
	}
</script>
	<div class="panel panel-default">
		<div class="panel-heading">Registrar Curso</div>
		<div class="panel-body">
			<div class="col-md-4">
				<form onsubmit="return save();">
	              <input name="modo" type="hidden" value="<?php echo $modo; ?>" />
	              <input name="id" type="hidden" value="<?php echo $_id; ?>" />
				  <div class="row">
		              <div class="form-group">
		                <label>Nombre de curso</label>
		                <input required type="text" name="tit" class="form-control" value="<?php echo $tit; ?>" placeholder="Nombres del curso">
		              </div>
		              <div class="form-group">
		                <label>Descripción</label>
		                <textarea class="form-control" name="des" rows="3" placeholder="Ingrese la descripción del curso"><?php echo $des; ?></textarea>
		              </div>
		              <div class="form-group">
		              	<button type="submit" class="btn btn-primary">Registrar</button>
		              </div>
		          </div>
	            </form>
            </div>
            <div class="col-md-8">
            	<div id="listacur"></div>
            	<script type="text/javascript">
            		$("#listacur").load("vista/curso/lista.php");
            	</script>
            </div>

		</div>
	</div>
