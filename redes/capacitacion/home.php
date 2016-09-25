<?php include("sesion.php"); ?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Centro de Recursos</title>
    <link href="css/styles.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/bootstrap-theme.min.css" />
    <link rel="stylesheet" href="css/bootstrap-tagsinput.css" />
    
    <script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>  
    <script type="text/javascript" src="js/jquery.bxslider.min.js"></script>
    <script type="text/javascript" src="js/bootstrap-tagsinput.min.js"></script>
    
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
          <a class="navbar-brand" href="#"><h3><b>CENTRO DE</b> RECURSOS</h3></a>
        </div>
		<div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Documentos<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#RegistroDocumento" onClick="page('vista/formdoc.php');">Subir</a></li>
                <li><a href="#ListaDocumento" onClick="page('vista/listadoc.php');">Lista</a></li>
              </ul>
            </li>
            <li><a href="#Cursos" onClick="page('vista/curso/nuevo.php');">Cursos</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Lecciones<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#RegistroLeccion" onClick="page('vista/leccion/nuevo.php');">Registrar</a></li>
                <li><a href="#ListaLeccion" onClick="page('vista/leccion/lista.php');">Lista</a></li>
              </ul>
            </li>
            <li><a href="#comentarios">Comentarios</a></li>
            
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
	
	<?php include("vista/formdoc.php"); ?>
    <?php //include("vista/listadoc.php"); ?>
    
</div>

<script>
function paginar(url, pagina){
	page("vista/"+url+"&pagina="+pagina);
}
function page(url){
	$(".content").load(url);
}
function eliminar(id, doc, url){
	var msj = confirm("Estas seguro de eliminar este registro?")
	if(msj){
		$.ajax({
			type: "POST",
			data: "id="+id+"&doc="+doc+"&modo=del",
			url: "control/"+url,
			success: function(rpt){
				$("#tr"+id).remove();
			}
		});
	}
}
$(".nav a").on("click", function(){
   $(".nav").find(".active").removeClass("active");
   $(this).parent().addClass("active");
});
</script>

</body>

</html>