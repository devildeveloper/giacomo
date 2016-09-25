<?php
	include("../sesion.php");
	include("../bd/bd.php");
	include("../bd/leccion.php");
	include("../inc/funcion.php");
	$o_bd  = new BD();
	$o_lec = new leccion();

	$modo = $_REQUEST['modo'];

	if($modo=="add" || $modo=="upd"){
		$id		= $_POST['id'];
		$cur	= $_POST['cur'];
		$tit	= $_POST['tit'];
		$des	= $_POST['des'];
		$url	= $_POST['url'];
		$obj	= $_POST['obj'];
		$mis	= $_POST['mis'];
		$fil	= $_POST['fil'];
		$fec	= date("Ymd");
		$est	= "1";

		if($modo=="add"){
			$id = $o_lec->grabar($cur, $tit, $des, $url, $obj, $mis, $fil, $fec, $est);
			$msj = "1";
		}elseif($modo=="upd"){
			$o_lec->actualizar($id, $cur, $tit, $des, $url, $obj, $mis, $fil, $fec, $est);
			$msj = "1";
		}
		echo $msj;
	}elseif($modo=="del"){
		$id  = $_REQUEST['id'];
		$o_lec->eliminar($id);
	}elseif($modo=="est"){
		$id  = $_REQUEST['id'];
		$est = $_REQUEST['est'];
		$o_bd->proceso("update leccion set lec_est='$est' where lec_id=$id");
	}
?>