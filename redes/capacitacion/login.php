<?php
	session_start();
	include("bd/bd.php");
	include("bd/usuario.php");
	$o_bd  = new BD();
	$o_usu = new usuario();

	$usu  = $_POST['usu'];
	$pass = $_POST['pass'];

	$num = $o_usu->editar("usu_dni='$usu' and usu_con='$pass' and usu_est='1'");
	if($num>0){
		$_SESSION['s_id']		= $o_usu->e_id();
		$_SESSION['s_tip']		= $o_usu->e_tip();
		$_SESSION['s_nomape']	= $o_usu->e_apenom();
		if($o_usu->e_tip()==1){
			header("location:home.php");
		}else{
			header("location:taller.php");
		}
		
	}else{
		header("location:index.php");
	}
?>