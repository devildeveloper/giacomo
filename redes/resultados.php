<?php
	include("admin/inc/cn.php");
	
	if(isset($_REQUEST["bus"])){
		$bus = $_REQUEST["bus"];
		$bus = str_replace("_", " ", $bus);
	}else{
		$bus = "";
	}
	
	$num = 0;
	$tot_reg = 0;
	$tot_pag = 1;

	//paginacion
	$registros = 5;
	if(isset($_REQUEST['pagina'])){
		$inicio = ($pagina-1)*$registros;
	}else{
		$inicio = 0;
		$pagina = 1;
	}
	$sql = "select * from contenido where con_tit like '%$bus%' and con_con like '%$bus%' and con_est='1' order by con_id";
	$res = mysql_query($sql, $cn);
	$tot_reg = mysql_num_rows($res);
	$tot_pag = ceil($tot_reg/$registros);

	$limit   = "LIMIT $inicio, $registros";
	//fin paginacion

	$res = mysql_query("select * from contenido where con_tit like '%$bus%' and con_con like '%$bus%' and con_est='1' order by con_id $limit", $cn);
	$num = mysql_num_rows($res);
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

<div id="banner-section">
	<div id="slide2">
	<div id="slider" class="nivoSlider">

    <?php
		$sql_ban = "select * from baner where men_id=1 and ban_est='1' order by rand()";
		$res_ban = mysql_query($sql_ban, $cn);
		$num_ban = mysql_num_rows($res_ban);
		if($num_ban>0){
			while($f=mysql_fetch_assoc($res_ban)){
    ?>
    			<img src="admin/inc/timthumb.php?src=admin/foto/baner/<?php echo $f["ban_fot"]; ?>&h=260&w=784&zc=0" title="<?php echo $f["ban_tit"]; ?>" />
    <?php
			}
		}
    ?>
    
    </div>
    <script type="text/javascript">
    	$('#slider').nivoSlider();
    </script>
    </div>
</div>

<div style="width:784px; float:right; height:auto; background:#BBD3E3; margin:10px 10px 10px 0">
<div id="cont_resultados">
<?php
	if($num>0){
		while($f=mysql_fetch_assoc($res)){
?>
		<div class="roundx6" style="width:743px; margin:10px; overflow:hidden; height:100px; background:#F2F2F2; padding:10px">
		<img style="float:left; margin-right:10px;" width="100" height="100" src="admin/inc/timthumb.php?src=admin/foto/contenido/<?php echo $f["con_fot"]; ?>&h=120&w=100&zc=0" />
	    <span style="font-size:16px; text-decoration:underline; color:#295073; cursor:pointer;" onclick="detalle('<?php echo $f["con_id"]; ?>')"><?php echo $f["con_tit"]; ?></span><br />
<style> #cont_cont span{ font-family:Arial, Helvetica !important; line-height:16px }  </style>    	
<div id="cont_cont" style=" font-size:14px; color:#000; height:80px; overflow:hidden; font-family:Arial, Helvetica, line-height:16px; sans-serif; text-align:justify">
        <?php echo substr(strip_tags($f["con_con"]), 0, 200)."..."; ?>
		</div>
		</div>
<?php
		}
	}else{
		echo "<h2>NO SE ENCONTRARON DATOS</h2>";
	}
?>

<?php if($tot_reg>0 && $tot_pag>1){ ?>
    <table width="100%" border="0">
    <tr>
    	<td align="left" width="48%" style="color:#00F; padding-left:10px;"><div style="color:#295073; font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; float:left ">Página: <?php echo $pagina; ?> de <?php echo $tot_pag; ?></div></td>
        <td align="right" width="52%" style="padding-right:10px;">
	    <?php if(($pagina-1)>0){ ?>
    			<a href="javascript:void(0)" onclick="paginar('<?php echo $bus; ?>','<?php echo $pagina-1; ?>')"><img src="admin/img/p_anterior.gif" border="0" alt="Anterior" title="Anterior" /></a>
		<?php }else{ ?>
	    		<img src="admin/img/p_anterior_a.gif" border="0" alt="Anterior" title="Anterior" />
    	<?php } ?>
        <?php if(($pagina+1)<=$tot_pag){ ?>
        		<a href="javascript:void(0)" onclick="paginar('<?php echo $bus; ?>','<?php echo $pagina+1; ?>')"><img src="admin/img/p_siguiente.gif" border="0" alt="Siguiente" title="Siguiente" /></a>
		<?php }else{ ?>
        		<img src="admin/img/p_siguiente_a.gif" border="0" alt="Siguiente" title="Siguiente" />
		<?php } ?>
	    </td>
    </tr>
    </table>
	<?php } ?>

<style> #contenido-detalle p{ text-align: justify !important; font-family:Arial, Helvetica !important; font-size:12px } 
		#contenido-detalle p span{ text-align: justify !important; font-family:Arial, Helvetica !important; font-size:12px }
</style>
</div>

<div style="padding:10px; display:none; text=aling:justify; font-family:Arial, Helvetica " id="contenido-detalle"></div>
</div>
