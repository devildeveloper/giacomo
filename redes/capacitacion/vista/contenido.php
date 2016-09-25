<?php
  include("../bd/bd.php");
  include("../bd/leccion.php");
  include("../bd/curso.php");
  include("../bd/documento.php");
  include("../inc/funcion.php");
  include("../sesion.php");
  $o_bd  = new BD();
  $o_cur = new curso();
  $o_lec = new leccion();
  $o_doc = new documento();

  $cur_id = $_REQUEST["cur_id"];
  $ncur   = $o_cur->editar("cur_id=$cur_id");

  $res_lec = $o_bd->consulta( "select * from leccion where cur_id='$cur_id' and lec_est='1'" );

  $lec_id = $_REQUEST["lec_id"];

  if(isset($_REQUEST["lec_id"])){
    $num    = $o_lec->editar("lec_id=$lec_id");
    $tit    = $o_lec->e_tit();
    $des    = $o_lec->e_des();
    $url    = $o_lec->e_url();
    $obj    = $o_lec->e_obj();
    $mis    = $o_lec->e_mis();
    $fil    = $o_lec->e_fil();
  }else{
    $res_1lec = $o_bd->consulta("select lec_id from leccion where cur_id='$cur_id' and lec_est='1' limit 1");
    while($r=$o_bd->fetch_assoc($res_1lec)){
      $lec_id = $r['lec_id'];
      $num    = $o_lec->editar("lec_id=$lec_id");
      $tit    = $o_lec->e_tit();
      $des    = $o_lec->e_des();
      $url    = $o_lec->e_url();
      $obj    = $o_lec->e_obj();
      $mis    = $o_lec->e_mis();
      $fil    = $o_lec->e_fil();
    }
  }
  $arrURL = explode(",",$url);

?>
<div class='row'>
  <div class="form-group col-md-12">
    
    <blockquote>
      <h4>Lecciones</h4>
      <div class="btn-group" role="group" aria-label="Default button group">
         <?php
          while($f=$o_bd->fetch_assoc($res_lec)){
            $_lec_id = $f['lec_id'];
          ?>
            <button onclick="page('vista/contenido.php?cur_id=<?php echo $cur_id; ?>&lec_id=<?php echo $_lec_id; ?>');" type="button" class="btn btn-default <?php if($lec_id==$f['lec_id']){ echo "btn-primary"; } ?>"><?php echo $f["lec_tit"]; ?></button>
          <?php
          }
          ?>
        
       </div>
    </blockquote>
    
  </div>
</div>

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title"><?php echo mayuscula($o_cur->e_tit()); ?></h3>
  </div>
  <div class="panel-body">
    <div class="col-md-6">
      <div class="tit_cont">
        <span><?php echo mayuscula($tit) ?></span>
      </div>
      <p class="p_tit"><?php echo $des ?></p>
      <br><br>

      <div class="tit_cont">
        <span>OBJETIVOS</span>
      </div>
      <p class="p_tit"><?php echo $obj ?></p>
      <br><br>

      <div style="display:none" class="tit_cont">
        <span>MISIÓN</span>
      </div>
      <p style="display:none" class="p_tit"><?php echo $mis ?></p>
      
      <div class="tit_cont">
        <span>CAJA DE CONSULTAS</span>
      </div>
      <div id="com_box"></div>
            
    </div>

    <div class="col-md-6">
      
	<?php 
	    if(count($arrURL)>0){
        	for($i=0;$i<count($arrURL);$i++){
	?>

	<div class="embed-responsive embed-responsive-4by3">
		<iframe class="embed-responsive-item" src="
    		<?php
        		preg_match('/[\?\&]v=([^\?\&]+)/', $arrURL[$i], $cod);
        		echo "http://www.youtube.com/embed/".$cod[1]."?rel=0";
    		?>
    		"></iframe>
	</div>
	<br><br>
	<?php
       		 }
    	}
	?>

      <div class="tit_cont">
        <span>LECTURAS</span>
      </div>

        <?php
          $arr = explode(",", $fil);
          if($fil != ""){
          foreach ($arr as $key) {
            $o_doc->editar("doc_id='$key' and doc_est='2'");
          ?>
            <div class="col-md-6">
              <div class="thumbnail">
                <span class="glyphicon glyphicon-book" aria-hidden="true"></span>
                <div class="caption">
                  <h3><?php echo $o_doc->e_nom(); ?></h3>
                  <p><a href="<?php echo $o_doc->e_url(); ?>" download="<?php echo $o_doc->e_nom().'.'.$o_doc->e_tip(); ?>" target="_blank" class="btn btn-primary" role="button">Descargar</a></p>
                </div>
              </div>
            </div>
        <?php
            }    
          }
        ?>
 
        <br><br>

      <div class="col-md-12">
        <div class="tit_cont">
          <span>TAREA</span>
        </div>
        <div style="padding-bottom: 100px; " class="toCenter col-md-8 col-md-offset-2">
        <?php
			$res_tar = $o_bd->consulta( "select doc_id from documento where doc_nom='$c_id' and doc_des='$cur_id' and doc_tag='$lec_id' and doc_est='3'" );
			$numtar = $o_bd->num_rows($res_tar);
			if($numtar<=0){
		?>
		<form id="tform" onsubmit="return sendTarea();">
			<input name="est" type="hidden" value="3">
			<input name="modo" type="hidden" value="add">
			<input name="nom" type="hidden" value="<?php echo $c_id;?>">
			<input name="des" type="hidden" value="<?php echo $cur_id;?>">
			<input name="tag" type="hidden" value="<?php echo $lec_id;?>">
            <input id="ftarea" name="doc" type="file" class="filestyle">
            <div style="display:none" class="hideMsj">
				<p class="help-block">Estás completamente seguro de enviar este archivo como trabajo final de esta lección?</p>
				<button id="btn_send" type="submit" class="btn btn-default btn-primary">Enviar</button>
            </div>
            <div style="display:none" class="progress">
				<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
					<span class="nper">0% Completo</span>
                </div>
            </div>
		</form>
		<?php
			}else{
				echo '<p class="help-block">Tu archivo ha sido enviado, gracias por participar de esta actividad, muy pronto te responderemos.</p>';
			}
		?>
        </div>
      </div>
      
    </div>     
  </div>
</div>

<script>
$("#com_box").load("vista/comentario.php?cur_id=<?php echo $cur_id;?>&lec_id=<?php echo $lec_id;?>");                
$(":file").filestyle({placeholder: "Seleccionar Archivo", buttonText:"Adjuntar", buttonName: "btn-primary", size: "sm"});
$("#ftarea").change(function(){
     if($(this).val()!=""){ $(".hideMsj").slideToggle(); }
});

function sendTarea(){
    $("#btn_send").hide();
    $(".progress").show();
    var formData = new FormData($('#tform')[0]);
    $.ajax({
        type:'POST',
        url: 'control/documento.php',
        data:formData,
        xhr: function() {
			var myXhr = $.ajaxSettings.xhr();
			if(myXhr.upload){
				myXhr.upload.addEventListener('progress',progress, false);
			}
			return myXhr;
        },
        cache:false,
        contentType: false,
        processData: false,

        success:function(data){
            var msj = data.split("|");
            alert(msj[0]);
        },

        error: function(data){
            console.log(data);
        }
    });
    return false;
  }
function progress(e){

	if(e.lengthComputable){
        var max = e.total;
        var current = e.loaded;
        var Percentage = (current * 100)/max;
        console.log(Percentage);
        $(".progress .progress-bar").css("width",Math.round(Percentage)+"%");
        $(".nper").html(Math.round(Percentage)+"% Completo");

        if(Percentage >= 100)
        {
          $(".progress .progress-bar").css("width","0%");
          $(".help-block").html("Tu archivo ha sido enviado, gracias por participar de esta actividad, muy pronto te responderemos.");
          $(".progress").hide(); 
        }
	}  
}
</script>


