<?php
	include("../../bd/bd.php");
	include("../../bd/curso.php");
	include("../../inc/funcion.php");
	$o_bd  = new BD();
	$o_cur = new curso();

	//paginacion
	$tot_reg = 0;
	$tot_pag = 1;
	$registros = 10;
	if(isset($_REQUEST['pagina'])){
		$inicio = ($pagina-1)*$registros;
	}else{
		$inicio = 0;
		$pagina = 1;
	}
	$res_cur = $o_cur->consultar("cur_id", "1=1", "cur_id");
	$tot_reg = $o_bd->num_rows($res_cur);
	$tot_pag = ceil($tot_reg/$registros);
	$limit   = "LIMIT $inicio, $registros";
	//fin paginacion

	$res = $o_cur->consultar("cur_id, cur_tit, cur_des", "1=1", "cur_id $limit");
	$num = $o_bd->num_rows($res);
?>

	<div class="panel panel-default">
		<div class="panel-heading">Cursos Registrados</div>
		<div class="panel-body">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>#</th>
						<th>Título</th>
						<th>Descripción</th>
						<th>Editar</th>
                        <th>Quitar</th>
					</tr>
				</thead>
				<tbody>
                	<?php
						if($num>0){
							$item = $inicio;
							while($f=$o_bd->fetch_assoc($res)){
								$item++;
								$_id = $f['cur_id'];
								
					?>
					<tr id="tr<?php echo $f["cur_id"]; ?>" >
						<th scope="row"><?php echo $item; ?></th>
						<td><?php echo may_min($f["cur_tit"]); ?></td>
						<td><?php echo $f["cur_des"]; ?></td>
                        <td><span onclick="page('vista/curso/nuevo.php?id=<?php echo $_id; ?>');" class="btn btn-default btn-xs glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
                        <td><span onclick="eliminar('<?php echo $f["cur_id"]; ?>','','curso')" class="btn btn-default btn-xs glyphicon glyphicon-remove" aria-hidden="true"></span></td>
					</tr>
                    <?php
							}
						}
					?>
				</tbody>
			</table>
		</div>
	</div>
    
<?php if($tot_pag>1){ ?>
	<p class="text-primary pull-left">Mostrando Pagina: <?php echo $pagina; ?> de <?php echo $tot_pag; ?></p>
    <ul class="pagination pagination-sm pull-right">
		<?php if($pagina!=1){ ?><li><a href="#" onclick="paginar('lista.php?','<?php echo $pagina-1; ?>')">«</a></li><?php } ?>
        <?php for($i=1; $i<=$tot_pag; $i++){ ?>
   			<?php if($pagina==$i){ ?>
				<li class="active"><a href="#"><?php echo $i; ?></a></li>
   		    <?php }else{ ?>
       			<li><a href="#" onclick="paginar('lista.php?','<?php echo $i; ?>')"><?php echo $i; ?></a></li>
            <?php } ?>
   		<?php } ?>
		<?php if($pagina!=$tot_pag){ ?><li><a href="#" onclick="paginar('lista.php?','<?php echo $pagina+1; ?>')">»</a></li><?php } ?>
	</ul>
<?php } ?>