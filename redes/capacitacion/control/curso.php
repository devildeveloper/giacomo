<?php
	include("../sesion.php");
	include("../bd/bd.php");
	include("../bd/curso.php");
	include("../inc/funcion.php");
	$o_bd  = new BD();
	$o_cur = new curso();

	$modo = $_REQUEST['modo'];

	if($modo=="add" || $modo=="upd"){		
		$id  = $_REQUEST['id'];
		$tit = $_REQUEST['tit'];
		$des = $_REQUEST['des'];
		$fec = date("Ymd");
		$est = "1";
		if($modo=="add"){
			$id = $o_cur->grabar($tit, $des, $fec, $est);
			$msj = "Curso registrado correctamente.";
		}elseif($modo=="upd"){
			$o_cur->actualizar($id, $tit, $des, $fec, $est);
			$msj = "Curso actualizado correctamente.";
		}
		echo $msj;
	}elseif($modo=="del"){
		$id		= $_REQUEST['id'];
		$o_cur->eliminar($id);
	}elseif($modo=="est"){
		$id  = $_REQUEST['id'];
		$est = $_REQUEST['est'];
		$o_bd->proceso("update curso set cur_est='$est' where cur_id=$id");
	}
?>