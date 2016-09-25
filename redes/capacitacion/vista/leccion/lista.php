<?php
	include("../../bd/bd.php");
	include("../../bd/leccion.php");
	include("../../bd/curso.php");
	include("../../bd/documento.php");
	include("../../inc/funcion.php");
	$o_bd  = new BD();
	$o_lec = new leccion();
	$o_cur = new curso();
	$o_doc = new documento();

	//paginacion
	$tot_reg = 0;
	$tot_pag = 1;
	$registros = 20;

	if(isset($_REQUEST['pagina'])){
		$pagina = $_REQUEST['pagina'];
		$inicio = ($pagina-1)*$registros;
	}else{
		$inicio = 0;
		$pagina = 1;
	}
	$res_lec = $o_lec->consultar("lec_id", "1=1", "lec_id");
	$tot_reg = $o_bd->num_rows($res_lec);
	$tot_pag = ceil($tot_reg/$registros);
	$limit   = "LIMIT $inicio, $registros";
	//fin paginacion

	$res = $o_lec->consultar("lec_id, cur_id, lec_tit, lec_des, lec_url, lec_obj, lec_mis, lec_fil", "1=1", "lec_id $limit");
	$num = $o_bd->num_rows($res);
?>

	<div class="panel panel-default">
		<div class="panel-heading">Lecciones Registrados</div>
		<div class="panel-body">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>#</th>
						<th>Curso</th>
						<th>Título</th>
						<th>Descripción</th>
						<th>URL</th>
						<th>Objetivos</th>
						<th>Misión</th>
						<th>Documentos</th>
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
								$_id = $f['lec_id'];
								$idcur = $f["cur_id"];
								$num = $o_cur->editar("cur_id='$idcur' and cur_est='1'");
								$arrURL = explode(",", $f["lec_url"]);				
					?>
					<tr id="tr<?php echo $f["lec_id"]; ?>" >
						<th scope="row"><?php echo $item; ?></th>
						<td><?php echo $o_cur->e_tit(); ?></td>
						<td><?php echo may_min($f["lec_tit"]); ?></td>
						<td><?php echo $f["lec_des"]; ?></td>
						<td><?php
							if(count($arrURL)>0){ for($i=0;$i<count($arrURL);$i++){ echo "<span class='label label-primary'>".$arrURL[$i]."</span> "; } }
						?></td>
						<td><?php echo $f["lec_obj"]; ?></td>
						<td><?php echo $f["lec_mis"]; ?></td>
						<td>
							<?php
							if($f["lec_fil"]!=""){
								$arr = explode(",", $f["lec_fil"]);
								foreach ($arr as $key) {
								    $o_doc->editar("doc_id='$key' and doc_est='2'");
								    echo "<span class='label label-primary'>".$o_doc->e_nom()."</span> ";
								}
							}
							?>
						</td>
                        <td><span onclick="page('vista/leccion/nuevo.php?id=<?php echo $_id; ?>');" class="btn btn-default btn-xs glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
                        <td><span onclick="eliminar('<?php echo $f["lec_id"]; ?>','','leccion.php')" class="btn btn-default btn-xs glyphicon glyphicon-remove" aria-hidden="true"></span></td>
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
					<?php if($pagina!=1){ ?><li><a href="#" onclick="paginar('leccion/lista.php?','<?php echo $pagina-1; ?>')">«</a></li><?php } ?>
			        <?php for($i=1; $i<=$tot_pag; $i++){ ?>
			   			<?php if($pagina==$i){ ?>
							<li class="active"><a href="#"><?php echo $i; ?></a></li>
			   		    <?php }else{ ?>
			       			<li><a href="#" onclick="paginar('leccion/lista.php?','<?php echo $i; ?>')"><?php echo $i; ?></a></li>
			            <?php } ?>
			   		<?php } ?>
					<?php if($pagina!=$tot_pag){ ?><li><a href="#" onclick="paginar('leccion/lista.php?','<?php echo $pagina+1; ?>')">»</a></li><?php } ?>
				</ul>
			<?php } ?>
		</div>
	</div>