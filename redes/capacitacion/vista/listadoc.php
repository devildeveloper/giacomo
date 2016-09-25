<?php
	include("../bd/bd.php");
	include("../bd/documento.php");
	include("../inc/funcion.php");
	$o_bd  = new BD();
	$o_doc = new documento();

	//paginacion
	$tot_reg = 0;
	$tot_pag = 1;
	$registros = 20;
	if(isset($_REQUEST['pagina'])){
		$inicio = ($_REQUEST['pagina']-1)*$registros;
	}else{
		$inicio = 0;
		$pagina = 1;
	}
	$res_doc = $o_doc->consultar("doc_id", "doc_est=1", "doc_id");
	$tot_reg = $o_bd->num_rows($res_doc);
	$tot_pag = ceil($tot_reg/$registros);
	$limit   = "LIMIT $inicio, $registros";
	//fin paginacion

	$res = $o_doc->consultar("doc_id, doc_tip, doc_nom, doc_des, doc_tag, doc_fec, doc_url", "doc_est=1", "doc_id $limit");
	$num = $o_bd->num_rows($res);
?>

	<div class="panel panel-default">
		<div class="panel-heading">Documentos Almacenados</div>
		<div class="panel-body">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>#</th>
						<th>Nombre</th>
						<th>Descripción</th>
						<th>Tags</th>
                        <th>Fecha</th>
                        <th>Link</th>
                        <th>Quitar</th>
					</tr>
				</thead>
				<tbody>
                	<?php
						if($num>0){
							$item = $inicio;
							while($f=$o_bd->fetch_assoc($res)){
								$item++;
								$arrTag = explode(",",$f["doc_tag"]);
					?>
					<tr id="tr<?php echo $f["doc_id"]; ?>" >
						<th scope="row"><?php echo $item; ?></th>
						<td><?php echo may_min($f["doc_nom"]); ?></td>
						<td><?php echo $f["doc_des"]; ?></td>
						<td><?php foreach ($arrTag as $val) { echo '<span class="label label-primary">#'.$val.'</span> '; } ?></td>
                        <td><?php echo formato_fecha($f["doc_fec"],1); ?></td>
                        <td><a href="<?php echo $f["doc_url"]; ?>" target="_blank" download="<?php echo $f["doc_nom"].".".$f["doc_tip"]; ?>"><span class="btn btn-default btn-xs glyphicon glyphicon-download-alt" aria-hidden="true"></span></a></td>
                        <td><span onclick="eliminar('<?php echo $f["doc_id"]; ?>','<?php echo $f["doc_url"]; ?>','documento.php')" class="btn btn-default btn-xs glyphicon glyphicon-remove" aria-hidden="true"></span></td>
					</tr>
                    <?php
							}
						}
					?>
				</tbody>
			</table>
			<?php if($tot_pag>1){ ?>
				<p class="text-primary pull-left">Mostrando Pagina: <?php echo $pagina; ?> de <?php echo $tot_pag; ?></p>
			    <ul class="pagination pagination-sm pull-right">
					<?php if($pagina!=1){ ?><li><a href="#" onclick="paginar('listadoc.php?','<?php echo $pagina-1; ?>')">«</a></li><?php } ?>
			        <?php for($i=1; $i<=$tot_pag; $i++){ ?>
			   			<?php if($pagina==$i){ ?>
							<li class="active"><a href="#"><?php echo $i; ?></a></li>
			   		    <?php }else{ ?>
			       			<li><a href="#" onclick="paginar('listadoc.php?','<?php echo $i; ?>')"><?php echo $i; ?></a></li>
			            <?php } ?>
			   		<?php } ?>
					<?php if($pagina!=$tot_pag){ ?><li><a href="#" onclick="paginar('listadoc.php?','<?php echo $pagina+1; ?>')">»</a></li><?php } ?>
				</ul>
			<?php } ?>
		</div>
	</div>