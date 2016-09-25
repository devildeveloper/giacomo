<?php
	include("../sesion.php");
	include("../bd/bd.php");
	include("../bd/documento.php");
	include("../inc/funcion.php");
	$o_bd  = new BD();
	$o_doc = new documento();

	$modo = $_REQUEST['modo'];

	if($modo=="add" || $modo=="upd"){
		$microt = number_format(round(microtime(true) * 1000), 2, '', '');
		
		$id  = $_REQUEST['id'];
		$tip = pathinfo($_FILES['doc']['name'], PATHINFO_EXTENSION);
		$nom = $_REQUEST['nom'];
		$des = $_REQUEST['des'];
		$tag = $_REQUEST['tag'];
		$url = "docs/".$microt.".".$tip;
		$fec = date("Ymd");
		$est = $_REQUEST['est'];
		if($modo=="add"){
			$id = $o_doc->grabar($tip, $nom, $des, $tag, $url, $fec, $est);
			$target_path = "../" . $url; 
			if(move_uploaded_file($_FILES['doc']['tmp_name'], $target_path))
			{
				$msj = "Documento registrado correctamente.|".$id;
			}
		}elseif($modo=="upd"){
			$o_doc->actualizar($id, $tip, $nom, $des, $tag, $url, $fec, $est);
			$msj = "Documento actualizado correctamente.";
		}
		echo $msj;
	}elseif($modo=="del"){
		$id		= $_REQUEST['id'];
		$_file	= $_REQUEST['doc'];
		if(is_file("../".$_file))
		{
			unlink("../".$_file);
			$o_doc->eliminar($id);
		}else{ echo "no is file"; }
	}elseif($modo=="est"){
		$id  = $_REQUEST['id'];
		$est = $_REQUEST['est'];
		$o_bd->proceso("update documento set doc_est='$est' where doc_id=$id");
	}
?>