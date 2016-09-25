<?php
	include("../../bd/bd.php");
	include("../../bd/leccion.php");
	include("../../inc/funcion.php");
	include("../../sesion.php");
	$o_bd  = new BD();
	$o_lec = new leccion();

	$modo = "add";
	$_idl  = $_REQUEST['id'];
	
	if(isset($_idl)){
		$num		= $o_lec->editar("lec_id=$_idl");
		$cur		= $o_lec->e_cur();
		$tit 		= $o_lec->e_tit();
		$des		= $o_lec->e_des();
		$url 		= $o_lec->e_url();
		$obj 		= $o_lec->e_obj();
		$mis 		= $o_lec->e_mis();
		$fil 		= $o_lec->e_fil();
		$modo		= "upd";

		$arrURL = explode(",", $url);
	}
	
	$res_cur = $o_bd->consulta( "select cur_id, cur_tit from curso where cur_est='1'" );
?>
<script>
	function saveFile2(){

    $("#btn_send, #btn_close").hide();
    $(".progress").show();
    var formData = new FormData($('#f_file')[0]);
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

        success: function(data){
			var msj = data.split("|");
			alert(msj[0]);
			var arr = $("#f_ids").val();
			if(arr==""){
				$("#f_ids").val(msj[1]);
			}else{
				$("#f_ids").val($("#f_ids").val()+","+msj[1]);
			}
			$('#f_file')[0].reset();
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
          $("#btn_send, #btn_close").show();
          $(".progress").hide(); 
        }
    }  
 }
	function save(){
		var map = [];
		$(".arr1").each(function() {
		    if($(this).val() != ""){ map.push($(this).val()); }
		});
		$("#aurl").val(map);

		var formData = new FormData($('#f_leccion')[0]);
        $.ajax({
            url: 'control/leccion.php',
            type: 'POST',      
            data: formData,
            contentType: false,
            processData: false,
			success: function(data){
				if(data==1){
					alert("La leccion fue registrada correctamente.");
					page('vista/leccion/nuevo.php');
				}else{
					alert("No se pudo registrar la leccion.");
				}
			}
        });
		return false;
	}
	function saveFile(){
		var formData = new FormData($('#f_file')[0]);
        $.ajax({
            url: 'control/documento.php',
            type: 'POST',      
            data: formData,
            contentType: false,
            processData: false,
			success: function(data){
				var msj = data.split("|");
				alert(msj[0]);
				var arr = $("#f_ids").val();
				if(arr==""){
					$("#f_ids").val(msj[1]);
				}else{
					$("#f_ids").val($("#f_ids").val()+","+msj[1]);
				}
				$('#f_file')[0].reset();
			}
        });
		return false;
	}
	function addUrl(){
		$('<input/>').attr({ type: 'text', 'class':'arr1 form-control', name: 'uris', placeholder:'URL Youtube'}).appendTo('.yurl');
	}
</script>
	<div class="panel panel-default">
		<div class="panel-heading">Registrar Lección</div>
		<div class="panel-body">
			
			<form id="f_leccion" onsubmit="return save();">
			<div class="col-md-6">
				
	            <input name="modo" type="hidden" value="<?php echo $modo; ?>" />
	            <input name="id" type="hidden" value="<?php echo $_idl; ?>" />
				
		            <div class="form-group">
		                <label>Seleccione el curso</label>
		                <select required class="form-control" name="cur">
		                	<option value="">Seleccione un curso</option>
						<?php
						while($f=$o_bd->fetch_assoc($res_cur)){
						?>
							<option value="<?php echo $f["cur_id"]; ?>" <?php if($f["cur_id"]==$cur){ echo "selected"; } ?>><?php echo $f["cur_tit"]; ?></option>
						<?php
						}
						?>
						</select>
            		</div>
		            <div class="form-group">
		        	    <label>Nombre de la lección</label>
		                <input required type="text" name="tit" class="form-control" value="<?php echo $tit; ?>" placeholder="Nombres de la lección">
		            </div>
		            <div class="form-group">
		                <label>Descripción</label>
		                <textarea class="form-control" name="des" rows="3" placeholder="Ingrese la descripción del curso"><?php echo $des; ?></textarea>
		            </div>
		            
			        <div class="yurl form-group">
			        	<label>URL Youtube</label>
			        	<div class="input-group">
			        		<input type="hidden" id="aurl" name="url" value="<?php echo $url; ?>">
				            <input required type="text" class="arr1 form-control" value="<?php if ($url!=""){ echo $arrURL[0]; } ?>" placeholder="URL Youtube">
				        	<span class="input-group-btn">
		        				<button onclick="addUrl();" class="btn btn-primary" type="button">MAS</button>
		   					</span>
		   				</div>
		   				<?php if (count($arrURL)>1) {
		   					for($i = 1; $i<count($arrURL); $i++){
		   						echo '<input type="text" class="arr1 form-control" value="'.$arrURL[$i].'" placeholder="URL Youtube">';
		   					}
		   				} ?>
		            </div>

		            <div class="form-group">
		              	<button type="submit" class="btn btn-primary">Registrar</button>
		            </div>
		        
            </div>
            <div class="col-md-6">
            	
            	<div class="form-group">
		            <label>Objetivos</label>
		            <textarea class="form-control" name="obj" rows="3" placeholder="Ingrese los objetivos de esta lección"><?php echo $obj; ?></textarea>
		        </div>
		        <div class="form-group">
		            <label>Misión</label>
		            <textarea class="form-control" name="mis" rows="3" placeholder="Ingrese la misión de esta lección"><?php echo $mis; ?></textarea>
		        </div>
		        <div class="form-group">
		            <label>Documentos</label>
		            <br>
					<button type="button" class="btn btn-success" data-toggle="modal" data-target="#fileModal">
					Adjuntar Documentos
					</button>
		        	<input type="hidden" id="f_ids" name="fil" value="<?php echo $fil; ?>">
		        </div>
            </div>
            </form>
		</div>
	</div>



<!-- Modal -->
<div class="modal fade" id="fileModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Adjuntar Documentos</h4>
      </div>
      <form id="f_file" onsubmit="return saveFile2();">
	      <div class="modal-body">
	      	<input name="modo" type="hidden" value="add" />
	      	<input name="est" type="hidden" value="2" />
		    <div class="form-group">
		        <label>Nombre del Documento</label>
		        <input type="text" class="form-control" name="nom" required placeholder="Nombre de Documento">
		    </div>
		    <div class="form-group">
		        <label for="exampleInputFile">Subir Archivo</label>
		        <input type="file" required name="doc">
		        <p class="help-block">Solo se aceptan archivos de tipo office y PDF.</p>
		    </div>
	        
	      </div>
	      <div class="modal-footer">
	        <button id="btn_close" type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	        <button  id="btn_send" type="submit" class="btn btn-primary">Guardar</button>
	        <div style="display:none" class="progress">
                <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                  <span class="nper">0% Completo</span>
                </div>
              </div>
	      </div>
      </form>
    </div>
  </div>
</div>