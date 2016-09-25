<?php
	include("../sesion.php");
	include("../bd/bd.php");
	include("../bd/comentario.php");
	include("../inc/funcion.php");
	$o_bd  = new BD();
	$o_com = new comentario();

	$modo = $_REQUEST['modo'];

	if($modo=="add" || $modo=="upd"){		
		$id  = $_REQUEST['id'];
		$cur = $_REQUEST['cur'];
		$lec = $_REQUEST['lec'];
		$usu = $c_id;
		$msj = $_REQUEST['msj'];
		$fec = date("Ymd");
		$est = "1";
		if($modo=="add"){
			$id = $o_com->grabar($cur, $lec, $usu, $msj, $fec, $est);
			$msj = "1";
		}elseif($modo=="upd"){
			$o_com->actualizar($id, $cur, $lec, $usu, $msj, $fec, $est);
			$msj = "Comentario actualizado correctamente.";
		}
		echo $msj;
	}elseif($modo=="del"){
		$id		= $_REQUEST['id'];
		$o_com->eliminar($id);
	}elseif($modo=="est"){
		$id  = $_REQUEST['id'];
		$est = $_REQUEST['est'];
		$o_bd->proceso("update comentario set com_est='$est' where com_id=$id");
	}
?>