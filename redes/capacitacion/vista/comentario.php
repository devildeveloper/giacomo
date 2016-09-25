<?php
include("../sesion.php");
include("../bd/bd.php");
include("../bd/usuario.php");
include("../inc/funcion.php");

$o_bd  = new BD();
$o_usu = new usuario();

$cur = $_REQUEST["cur_id"];
$lec = $_REQUEST["lec_id"];

$res_com = $o_bd->consulta("select usu_id, com_msj, com_fec from comentario where cur_id='$cur' and lec_id='$lec' and com_est=1");
$num_com = $o_bd->num_rows($res_com);
?>

<script>
	function save_com(){
		var formData = new FormData($('form')[0]);
        $.ajax({
            url: 'control/comentario.php',
            type: 'POST',      
            data: formData,
            contentType: false,
            processData: false,
			success: function(data){
        		if(data==1){
					//alert("Consulta ingresada");
					$("#com_box").load("vista/comentario.php?cur_id=<?php echo $cur; ?>&lec_id=<?php echo $lec; ?>");
				}
			}
        });
		return false;
	}
</script>


<div class="row">
	<?php
		if($num_com>0){
		while($f=$o_bd->fetch_assoc($res_com)){
			$_idusu = $f['usu_id'];
			$o_usu->editar("usu_id='$_idusu'");
			
			$dias = intval((strtotime('now') - strtotime($f['com_fec']))/60/60/24);
			if($dias==0){
				$dias="Hace unas horas";
			}elseif($dias==1){
				$dias="Hace un día";
			}else{
				$dias="Hace ".$dias." días";
			}	
    ?>
    <div class="col-md-2">
        <div class="thumbnail">
        	<img class="img-responsive user-photo" src="http://lorempixel.com/50/50/people/?<?php echo (rand(1,1000)); ?>">
        </div>
    </div>
    <div class="col-md-10">
        <div class="panel panel-default">
            <div class="panel-heading">
            	<strong><?php echo $o_usu->e_apenom(); ?></strong> <span class="text-muted"><?php echo $dias; ?></span>
            </div>
            <div class="panel-body"><?php echo $f['com_msj']; ?></div>
        </div>
    </div>
    <?php
		}
	}
	?>
    <div class="col-md-12">
        <form class="form" role="form" onsubmit="return save_com();">
            <input type="hidden" name="modo" value="add">
            <input type="hidden" name="cur" value="<?php echo $cur; ?>">
            <input type="hidden" name="lec" value="<?php echo $lec; ?>">
            <div class="input-group">
                <input name="msj" type="text" class="form-control input-sm" placeholder="Ingresa tu consulta aquí...">
                <span class="input-group-btn">
                    <button class="btn btn-primary btn-sm" id="btn-chat">Enviar</button>
                </span>
            </div>
        </form>
    </div>
</div><!-- /row -->


