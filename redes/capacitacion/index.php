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
    
</head>

<body>
	<section class="container">
	    <section class="login-form">
		<form method="post" role="login" action="login.php">
			<h3>
            	<!--<img src="img/isl.png" style="margin: 0px 62px 30px 62px;">-->
            	<b>CENTRO DE</b> RECURSOS
            </h3>
            
			<div class="row">
            	<!--<div class="col-xs-12">
					<select required class="form-control" name="reg">
						<option value="">[ Institución ]</option>
                        <option value="1">Cotabambas</option>
                        
                       <option value="1">Instituto Libertador</option>
                       <option value="">Las Bambas</option>
                        <option value="">Antamina</option> 
					</select>
					<span class="glyphicon glyphicon-home"></span>
				</div>-->
				<div class="col-xs-12">
					<input type="text" name="usu" placeholder="DNI" required class="form-control input-lg">
					<span class="glyphicon glyphicon-user"></span>
				</div>
				<div class="col-xs-12">
					<input type="password" name="pass" placeholder="Password" required class="form-control input-lg">
					<span class="glyphicon glyphicon-lock"></span>
				</div>
			</div>
			<button type="submit" name="go" class="btn btn-lg btn-block btn-success">ENTRAR</button>
			<section>
				<a href="register.php">Registrarme</a> or <a href="#">Cambiar Password</a>
			</section>
		</form>
		</section>
	</section>
</body>

</html>