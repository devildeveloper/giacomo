<?php include("admin/inc/cn.php");
$e = "1";
if(isset($_REQUEST['e'])){
	$e = $_REQUEST['e'];
}
?>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36811601-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

<table style="margin:20px" width="940" border="0">
  <tr>
    <td width="465" rowspan="2">
    <div id="slide" style=" width:412px ">

	<div id="slider" class="nivoSlider">
    <?php
		$sql_ban = "select * from baner where men_id=6 and ban_est='1' order by rand()";
		$res_ban = mysql_query($sql_ban, $cn);
		$num_ban = mysql_num_rows($res_ban);
		if($num_ban>0){
			$item = 0;
			while($f=mysql_fetch_assoc($res_ban)){
				$item++;
	?>
				<img src="admin/inc/timthumb.php?src=admin/foto/baner/<?php echo $f["ban_fot"]; ?>&h=412&w=412&zc=0" title="<?php echo $f["ban_tit"]; ?>" />
    <?php
			}
		}
	?>
    </div>
   
    <script type="text/javascript">
        $('#slider').nivoSlider();
    </script>
    </div>
    
    </td>
    <td width="465" height="282">
    	<fieldset style="height:260px; padding-bottom: 0px; overflow:hidden; position:relative" class="cajaLegend roundx6" id="noti_acti">
        <legend>Noticias y Actividades</legend>
        <div id="cont-noticias"><div id="subsubsub" style="margin-top:-115px"><!--CONT NOTICIA-->
            
            <?php
				$sql_not = "select * from contenido where men_id=7 and con_est='1' order by con_id desc limit 10";
				$res_not = mysql_query($sql_not, $cn);
				$num_not = mysql_num_rows($res_not);
				if($num_not>0){
					$item = 0;
					while($f=mysql_fetch_assoc($res_not)){
						$item++;
			?>
	        			<div id="n<?php echo $item; ?>" class="tip-noticia roundx6" onclick="cargaNoticia('<?php echo $f["con_id"]; ?>','U')">
						<img src="admin/foto/contenido/<?php echo $f["con_fot"]; ?>" />
        	            <span><strong><?php echo $f["con_fec"]; ?><br /><?php echo $f["con_tit"]; ?></strong></span><br />
            	        <span style="text-align:justify "><?php echo substr(strip_tags($f["con_con"]), 0, 100); ?></span>
                	    </div>
		    <?php
					}
				}
			?>
            
            </div></div><!--END CONT NOTICIA-->
        </fieldset>
    </td>
  </tr>
  <tr>
    <td>
    	<fieldset style="background:#96BFD9" class="cajaLegend roundx6" id="login">
        <legend style=" background:#F2F2F2; border:1px solid #295073">Intranet</legend>
        <div id="cont-cajas">
        <form id="frm" name="frm" method="post" action="http://sisedyge.ipae.edu.pe/santamaria/comprueba.php" style="margin:0">
        <table id="tabla-login" cellpadding="0" cellspacing="8" width="414" border="0">
        <tr>
            <td width="70" align="left" valign="middle"><label style="color:#000; font-size:14px; letter-spacing:1px"><strong>Usuario:</strong></label></td>
            <td width="226"><input onkeypress="enter(event)" style="width:100%; height:20px" type="text" name="login" id="cajaLogin" value="" /></td>
            <td width="86">&nbsp;</td>
        </tr>
        <tr>
            <td align="left" valign="middle"><label style="color:#000; font-size:14px; letter-spacing:1px"><strong>Password:</strong></label></td>
            <td><input onkeypress="enter(event)" style="width:100%; height:20px" type="password" name="pass" id="cajaPass" /></td>
            <td><div style="margin-left:14px" class="btn" onclick="entrar();">Entrar</div></td>
        </tr>
        <tr>
          <td colspan="3"><label id="error">
            <?php if($e=="0"){ echo "El usuario o clave es incorrecto"; } ?>
            <?php if($e=="2"){ echo "Su clave a caducado"; } ?>
            </label></td>
        </tr>
        </table>
        </form>
		<script language="javascript">
		$("#cancelar").click(function(){ $("input#cajaLogin").val(''); $("input#cajaPass").val(""); $("label#error").html(""); });
		function enter(e){
			if(((document.all)?e.keyCode:e.which)=="13"){
				entrar();
			}
		}
        $("#entrar").click(function(){ entrar(); });
		
		function entrar(){
		var usu = $("input#cajaLogin").val();
            var cla = $("input#cajaPass").val();
            if(usu==""){
                $("label#error").html("Ingrese Usuario.");
                $("input#cajaLogin").focus();
                return;
            }
            if(cla==""){
                $("label#error").html("Ingrese clave.");
                $("input#cajaPass").focus();
                return;
            }
			
			document.frm.submit();	
		}
        </script>
		</div>
        </fieldset>
    </td>
  </tr>
</table>