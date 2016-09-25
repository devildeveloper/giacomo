<?php
include("sesion.php");
include("bd/bd.php");
include("inc/funcion.php");
$o_bd  = new BD();

$res_cur = $o_bd->consulta( "select cur_id, cur_tit, cur_des from curso where cur_est='1'" );

?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>CAPACITACIÓN REDES</title>
    <link href="css/styles.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/bootstrap-theme.min.css" />
    <link rel="stylesheet" href="css/bootstrap-tagsinput.css" />
    
    <script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>  
    <script type="text/javascript" src="js/jquery.bxslider.min.js"></script>
    <script type="text/javascript" src="js/bootstrap-filestyle.min.js"></script>
    
</head>

<body>
<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container">
	    <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><h3><b>CAPACITACIÓN</b> REDES</h3></a>
        </div>
	<div id="navbar" class="navbar-collapse collapse">
		<ul class="nav navbar-nav">
    			<li class="active"><a href="taller.php"><b>Mis Cursos</b></a></li>
			<li><a href="#CentroRecursos" data-toggle="modal" data-target="#crModal"><b>Centro de Recursos</b></a></li>
		</ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $c_nomape; ?> <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#perfil" onClick="page('vista/formupd.php');">Editar Perfil</a></li>
                <li><a href="cerrar.php">Salir</a></li>
              </ul>
            </li>
          </ul>
        </div>
	</div>	
</nav>
<div class="container content">
<div class="row">
  <?php
    while($f=$o_bd->fetch_assoc($res_cur)){
      $_idcur = $f["cur_id"];
  ?>
    
    
    <div class="col-sm-6 col-md-3">
      <div class="thumbnail curso">
        <img class="" src="img/<?php echo $_idcur; ?>.png">
        <div class="caption">
          <h3 class="ctit"><?php echo mayuscula($f["cur_tit"]); ?></h3>
          <!--<p><?php //echo $f["cur_des"]; ?></p>-->
          <p><a onclick="page('vista/contenido.php?cur_id=<?php echo $_idcur; ?>')" href="#<?php echo mayuscula($f['cur_tit']); ?>" class="btn btn-y" role="button">Ingresar</a></p>
        </div>
      </div>
    </div>
  
  <?php
   }
  ?>
</div>
</div>
<script>
function page(url){
	$(".content").load(url);
	$('#crModal').modal('hide');
}
$(".nav a").on("click", function(){
   $(".nav").find(".active").removeClass("active");
   $(this).parent().addClass("active");
});
</script>


<!-- Modal -->
<div class="modal fade" id="crModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
            
            <div class="_bottom row">
                <div class="col-md-6 _box-content _right"><img onclick="page('vista/libreria.php?tip=libro');" width="150" src="img/lib.png" class="img-circle">
                <h4>LIBROS</h4>
                </div>

                <div class="col-md-6 _box-content"><img onclick="page('vista/libreria.php?tip=texto');" width="150" src="img/doc.png" class="img-circle">
                <h4>DOCUMENTOS</h4>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 _box-content _right"><img onclick="page('vista/libreria.php?tip=video');" width="150" src="img/vid.png" class="img-circle">
                <h4>VIDEOS</h4>
                </div>
                <div class="col-md-6 _box-content"><img onclick="page('vista/libreria.php?tip=audio');" width="150" src="img/aud.png" class="img-circle">
                <h4>AUDIOS</h4>
                </div>
            </div>
        </div>
    </div>
</div>

</body>

</html>