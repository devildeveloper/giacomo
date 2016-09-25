<?php
	include("admin/inc/cn.php");
	//include("admin/inc/class.cropcanvas.php");
      
    //$sx = $sy = 1;
	//$ex = 784;
	//$ey = 260;

    //$cc =& new CropCanvas();
    //if($cc->loadImage("admin/foto/baner/14.jpg")){
		//$cc->cropToDimensions($sx, $sy, $ex, $ey);
		//$cc->saveImage('miImagenFinal_111.jpg');
	//}else{  
		//die("Error");
	//}
?>
<div style="float:left" class="roundxMenuInt" id="menu-int">
<ul>
	<?php
		$men    = $_REQUEST['men'];
		if($men!="8" || $men!="9"){ $submen = $_REQUEST['submen']; }
		if($submen==""){
			$sql = "select submen_id from submenu where men_id=$men and submen_est='1' order by submen_id asc limit 1";
			$res = mysql_query($sql, $cn);
			$num = mysql_num_rows($res);
			if($num>0){ $submen=mysql_result($res, 0, "submen_id"); }
		}
		
		$sql_submen = "select * from submenu where men_id=$men and submen_est='1' order by submen_id";
		$res_submen = mysql_query($sql_submen, $cn);
		$num_submen = mysql_num_rows($res_submen);
		if($num_submen>0){
			while($f=mysql_fetch_assoc($res_submen)){
    ?>
    		<li onclick="cargaSection('<?php echo $f["men_id"]; ?>','<?php echo $f["submen_id"]; ?>');"><a href="javascript:void(0);"><?php echo $f["submen_tit"]; ?></a></li>
    <?php
			}
		}
    ?>
</ul>
</div>

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
		$men    = $_REQUEST['men'];
		if($men=="8" || $men=="9"){ $men="1"; }
		$sql_ban = "select * from baner where men_id=$men and ban_est='1' order by rand()";
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
<style>#divPasivo img{ 
border-radius: 6px 6px 6px 6px;
-ms-border-radius: 6px 6px 6px 6px;
-moz-border-radius: 6px 6px 6px 6px;
-webkit-border-radius: 6px 6px 6px 6px;
-khtml-border-radius: 6px 6px 6px 6px;
 }</style>
<div id="divPasivo" style="width:204px; padding: 20px 0; float:right; height:auto; min-height:400px; background:#C47C89; margin:10px 10px 10px 0; text-align:center">
<?php
	$men    = $_REQUEST['men'];
	if($men=="8" || $men=="9"){
		$sql_con = "select * from contenido where men_id=$men and con_est='1'";
	}else{
		$sql_con = "select * from contenido where men_id=$men and submen_id=$submen and con_est='1'";
	}
	$res_con = mysql_query($sql_con, $cn);
	$num_con = mysql_num_rows($res_con);
	if($num_con>0){
		$fot = "";
		$nro = 0;
		while($f=mysql_fetch_assoc($res_con)){
			if($f["con_fot_1"]!=""){
				$fot = explode("|", $f["con_fot_1"]);
				$nro = count($fot);
				for($i=0; $i<=$nro-1; $i++){
?>
<img src="admin/inc/timthumb.php?src=admin/foto/contenido/<?php echo $fot[$i]; ?>&h=120&w=140&zc=0" title="<?php //echo $fot[$i]; ?>" /><br /><br />
<?php			}
			}
		}
	}
?>
</div>
<script>
var alto = $("#altoMatriz").height();
	   $("#divPasivo").height(alto);
</script>

<div id="altoMatriz" style="width:540px; padding: 20px; float:right; height:auto; min-height:400px; background:#BBD3E3; margin:10px 0">
<?php
	$men    = $_REQUEST['men'];
	if($men=="8"){
		$sql_con = "select * from contenido where men_id=$men and con_est='1'";
	}else{
		$sql_con = "select * from contenido where men_id=$men and submen_id=$submen and con_est='1'";
	}
	
	if($men=="9"){
		echo "<h3 style='margin:0; padding:0'>MAPA DEL SITIO</h3><br />";
		$sql_m = "select * from menu where men_est='1' order by men_id";
		$res_m = mysql_query($sql_m, $cn);
		$num_m = mysql_num_rows($res_m);
		if($num_m>0){
			while($f_m=mysql_fetch_assoc($res_m)){
				$id_men = $f_m["men_id"];
				$sql_s = "select * from submenu where men_id=$id_men and submen_est='1' order by submen_id";
				$res_s = mysql_query($sql_s, $cn);
				$num_s = mysql_num_rows($res_s);
				if($num_s>0){
					echo "<strong>".$f_m["men_tit"]."</strong><br />";
					echo "<ul id='mapaSitio' style='margin:0px;'>";
					while($f_s=mysql_fetch_assoc($res_s)){
?>
<li class='_li' style="margin:0px; cursor:pointer;" onclick="cargaSection('<?php echo $f_m["men_id"]; ?>','<?php echo $f_s["submen_id"]; ?>');"><?php echo $f_s["submen_tit"]; ?></li>
<?php
					}
					echo "</ul>";
				}else{
?>
<li style="margin:0px; cursor:pointer; list-style:none" 


<?php if($id_men=="7"){ ?>
onclick="cargaNoticia('<?php echo date("m-Y"); ?>','D')"
<?php }elseif($id_men=="6"){ ?>
onclick="cargaInicio()"       
<?php }else{ ?>
onclick="cargaSection('<?php echo $f_m["men_id"]; ?>','')"
<?php } ?>

>
<strong>
<?php echo $f_m["men_tit"]; ?>
</strong>
</li>

<?php
				}
			}
		}
	}else{
		$res_con = mysql_query($sql_con, $cn);
		$num_con = mysql_num_rows($res_con);
		if($num_con>0){
			echo "<h3>".mysql_result($res_con, 0, "con_tit")."</h3>";
			echo mysql_result($res_con, 0, "con_con");
		}
	}
?>
</div>
