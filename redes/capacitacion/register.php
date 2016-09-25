<?php
	include("bd/bd.php");
	$o_bd  = new BD();
	
	$res_dep = $o_bd->consulta( "select * from ubigeo where pro_id='00' and dis_id='00'" );
	
?>

<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Centro de Recursos</title>
    <link href="css/styles.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/bootstrap-theme.min.css" />
    <link href="css/jquery.bxslider.css" rel="stylesheet" />
    <link rel="icon" type="image/png" href="img/ico.png" />
    
    <script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>  
    <script type="text/javascript" src="js/jquery.bxslider.min.js"></script>

    <script>
		function save(){
			var formData = new FormData($('form')[0]);
	        $.ajax({
	            url: 'control/usuario.php',
	            type: 'POST',      
	            data: formData,
	            contentType: false,
	            processData: false,
				success: function(data){
					if(data==1){
						$("#register").hide();
						$(".row").html('<h4 style="text-align: center">Muchas gracias por registrarte a este portal de capacitación constante, puedes regresar e intentar logear para ingresar.</h4>');
					}
				}
	        });
			return false;
		}
	</script>
</head>

<body>

	<section class="container">
	    <section class="login-form">
		<form role="login" onsubmit="return save();">
			<input name="modo" type="hidden" value="add" />
			<input name="tipo" type="hidden" value="2" />
			<h3><b>REGISTRATE</b> AL PORTAL</h3>
			<div class="row">
				<div class="col-xs-12">
					<input type="text" name="nom" placeholder="Nombres y Apellidos" required class="form-control input-lg">
					<span class="glyphicon glyphicon-user"></span>
				</div>
				<div class="col-xs-12">
					<input type="text" name="dni" placeholder="DNI" required class="form-control input-lg">
					<span class="glyphicon glyphicon-th"></span>
				</div>
				<div class="col-xs-12">
					<input type="text" name="mail" placeholder="E-mail" required class="form-control input-lg">
					<span class="glyphicon glyphicon-envelope"></span>
				</div>
				<div class="col-xs-12">
					<select required class="form-control" name="reg">
						<option value="">Región</option>
					<?php
					while($f=$o_bd->fetch_assoc($res_dep)){
						$cdg = $f["dep_id"].$f["pro_id"].$f["dis_id"];
					?>
						<option value="<?php echo $cdg; ?>"><?php echo $f["nombre"]; ?></option>
					<?php
					}
					?>
					</select>
					<span class="glyphicon glyphicon-plane"></span>
				</div>
				<div class="col-xs-12">
					<input type="text" name="pass" placeholder="Password" required class="form-control input-lg">
					<span class="glyphicon glyphicon-lock"></span>
				</div>
			</div>
			<button id="register" type="submit" class="btn btn-lg btn-block btn-success">REGISTRAR</button>
			<section>
				<a href="index.php">Ingresar</a>
			</section>
		</form>
		</section>
	</section>
</body>

</html>