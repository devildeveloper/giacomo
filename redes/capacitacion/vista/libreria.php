<?php
	include("../bd/bd.php");
	include("../bd/documento.php");
	include("../inc/funcion.php");
	$o_bd  = new BD();
	$o_doc = new documento();
	
	$tipo = $_REQUEST['tip'];
	if(isset($tipo)){
		if($tipo=="libro"){
			$w = " and doc_tip IN('pdf')";
		}elseif($tipo=="texto"){
			$w = " and doc_tip IN('docx', 'docm', 'dotx', 'dotm', 'xlsx', 'xlsm', 'xltx', 'xltm', 'xlsb', 'xlam', 'pptx', 'pptm', 'potx', 'potm', 'ppam', 'ppsx', 'ppsm', 'sldx', 'sldm', 'thmx', 'doc', 'xls', 'ppt')";
		}if($tipo=="audio"){
			$w = " and doc_tip IN('mp3','mid','midi','wav','wma','cda','ogg','ogm','aac','ac3','flac','mp4')";
		}if($tipo=="video"){
			$w = " and doc_tip IN('mp4')";
		}
	}

	//paginacion
	$tot_reg = 0;
	$tot_pag = 1;
	$registros = 30;
	if(isset($_REQUEST['pagina'])){
		$inicio = ($_REQUEST['pagina']-1)*$registros;
	}else{
		$inicio = 0;
		$pagina = 1;
	}
	$res_doc = $o_doc->consultar("doc_id", "doc_est=1 $w", "doc_id");
	$tot_reg = $o_bd->num_rows($res_doc);
	$tot_pag = ceil($tot_reg/$registros);
	$limit   = "LIMIT $inicio, $registros";
	//fin paginacion

	$res = $o_doc->consultar("doc_id, doc_tip, doc_nom, doc_des, doc_tag, doc_fec, doc_url", "doc_est=1 $w", "doc_id $limit");
	$num = $o_bd->num_rows($res);
?>

	<div class="panel panel-default">
		<div class="panel-heading">CENTRO DE RECURSOS</div>
		<div class="panel-body">
			<div class="row">
        
			<?php
				if($num>0){
					$item = $inicio;
					while($f=$o_bd->fetch_assoc($res)){
			?>
				<div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
					<div class="item">
						<div class="pos-rlt">
							<div class="opacity">
								<div class="desc">
									<p><?php echo $f["doc_des"]; ?></p>
								</div>
								<div class="bottom padder">
									<a href="<?php echo $f["doc_url"]; ?>" target="_blank" download="<?php echo $f["doc_nom"].".".$f["doc_tip"]; ?>"><span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span></a>
								</div>
							</div>
							<a href="#"><img src="<?php echo urlDoc($f["doc_tip"]); ?>" alt="" class="img-full"></a>
						</div>
						<div class="padder-v recu">
							<h4><?php echo may_min($f["doc_nom"]); ?></h4>
						</div>
					</div>
				</div>
			<?php
				}
			}else{
				echo "<div style='margin: 12px;'><h4>No hay registros aún.</h4></div>";
			}
			?>

			</div>
			<?php if($tot_pag>1){ ?>
				<p class="text-primary pull-left">Mostrando Pagina: <?php echo $pagina; ?> de <?php echo $tot_pag; ?></p>
			    <ul class="pagination pagination-sm pull-right">
					<?php if($pagina!=1){ ?><li><a href="#" onclick="paginar('libreria.php?tip=<?php echo $tipo; ?>&','<?php echo $pagina-1; ?>')">«</a></li><?php } ?>
			        <?php for($i=1; $i<=$tot_pag; $i++){ ?>
			   			<?php if($pagina==$i){ ?>
							<li class="active"><a href="#"><?php echo $i; ?></a></li>
			   		    <?php }else{ ?>
			       			<li><a href="#" onclick="paginar('libreria.php?tip=<?php echo $tipo; ?>&','<?php echo $i; ?>')"><?php echo $i; ?></a></li>
			            <?php } ?>
			   		<?php } ?>
					<?php if($pagina!=$tot_pag){ ?><li><a href="#" onclick="paginar('libreria.php?tip=<?php echo $tipo; ?>&','<?php echo $pagina+1; ?>')">»</a></li><?php } ?>
				</ul>
			<?php } ?>
		</div>
	</div>