<?php
	//include("../sesion.php");
	include("../bd/bd.php");
	include("../bd/usuario.php");
	include("../inc/funcion.php");
	$o_bd  = new BD();
	$o_usu = new usuario();

	$modo = $_REQUEST['modo'];

	if($modo=="add" || $modo=="upd"){
		$id		= $_POST['id'];
		$nom	= $_POST['nom'];
		$dni	= $_POST['dni'];
		$mail	= $_POST['mail'];
		$reg	= $_POST['reg'];
		$pass	= $_POST['pass'];
		$fec	= date("Ymd");
		$est	= "1";
		$tip	= $_POST['tipo'];
		if($modo=="add"){
			$id = $o_usu->grabar($tip, $nom, $mail, $reg, $dni, $pass, $fec, $est);
			$msj = "1";
		}elseif($modo=="upd"){
			$o_usu->actualizar($id, $tip, $nom, $mail, $reg, $dni, $pass, $fec, $est);
			$msj = "Datos actualizados correctamente.";
		}
		echo $msj;
	}elseif($modo=="del"){
		$id  = $_REQUEST['id'];
		$o_usu->eliminar($id);
	}elseif($modo=="est"){
		$id  = $_REQUEST['id'];
		$est = $_REQUEST['est'];
		$o_bd->proceso("update usuario set usu_est='$est' where usu_id=$id");
	}
?>