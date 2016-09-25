<?php
	include("admin/inc/cn.php");
	
	$con = $_REQUEST["con"];
	$sec = $_REQUEST["sec"];
	
	if($sec=="U"){
		$sql = "select * from contenido where con_id=$con";
	}else{
		$sql = "select * from contenido where substring(con_fec, 4)='$con' and men_id=7 and con_est='1' order by con_id";
	}
	
	$res = mysql_query($sql, $cn);
	$num = mysql_num_rows($res);
	
	$sql_not = "select * from contenido where men_id=7 and con_est='1' order by con_id desc";
	$res_not = mysql_query($sql_not, $cn);
	$num_not = mysql_num_rows($res_not);
	
	$a_mes = array("", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Setiembre", "Octubre", "Noviembre", "Diciembre");
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

<div id="divPasivo" style="width:204px; padding: 20px 0; float:right; line-height:15px !important; height:auto; min-height:400px; background:#C47C89; margin:10px 10px 10px 0; text-align:center">
<?php
	$ano_1 = date("Y");
	$ano_2 = $ano_1 - 1;
	for($i=$ano_1; $i>=$ano_2; $i--){
		echo "<strong>".$i."</strong><br />";
		for($j=1; $j<=12; $j++){
			$mes_1 = str_pad($j, 2, "0", STR_PAD_LEFT);
			
			$sql = "select * from contenido where substring(con_fec, 4)='".$mes_1."-".$i."' and men_id=7 and con_est='1' order by con_id";
			$res_fec_ano = mysql_query($sql, $cn);
			$num_fec_ano = mysql_num_rows($res_fec_ano);
			if($num_fec_ano>0){
?>
			<a style="font-family:Tahoma, Geneva, sans-serif; font-size:12px; font-style:italic; color:#000" href="javascript:void(0)" onclick="cargaNoticia('<?php echo $mes_1."-".$i; ?>','D')"><?php echo $a_mes[$j]; ?></a><br />
<?php		}else{ ?>
			<a style="font-family:Tahoma, Geneva, sans-serif; font-size:12px; font-style:italic; color:#000; text-decoration:none;" href="javascript:void(0)"><?php echo $a_mes[$j]; ?></a><br />
<?php
			}
		}
		echo "<br />";
	}
?>
</div>
<script>
var alto = $("#altoMatriz").height();
	   $("#divPasivo").height(alto);
</script>
<style>
#altoMatriz p{ font-family:Arial, Helvetica, sans-serif !important; text-align:justify !important; font-size:12px }
#altoMatriz p span{ font-family:Arial, Helvetica, sans-serif !important; text-align:justify !important; font-size:12px }
</style>
<div id="altoMatriz" style="width:540px; padding: 20px; float:right; height:auto; min-height:400px; background:#BBD3E3; margin:10px 0">

<?php
	if($num>0){
		while($f=mysql_fetch_assoc($res)){
			$w = "";
			if(file_exists("admin/foto/contenido/".$f["con_fot"]) && $f["con_fot"]!=""){
				$siz = GetImageSize("admin/foto/contenido/".$f["con_fot"]);
				$anc = $siz[0];
				$alt = $siz[1]; 
				if($anc>500){
					$w = "500";
				}
			}
			
			echo "<strong>".$f["con_tit"]."</strong>";
			echo "<br />";
			echo $f["con_con"];
			echo "<br />";
?>
			<!--<center><img src="admin/foto/contenido/<?php //echo $f["con_fot"]; ?>" width="<?php //echo $w; ?>" /></center><br />-->
<?php
		}
	}
?>

</div>