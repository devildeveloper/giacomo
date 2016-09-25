<link rel="stylesheet" href="css/bootstrap-tagsinput.css" />
<script>
  var _url = "js/bootstrap-tagsinput.min.js";
  $.getScript(_url);
  
  function save2(){
    $("#btn_send").hide();
    $(".progress").show();
    var formData = new FormData($('form')[0]);
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
            $('#tag').tagsinput('removeAll');
            $('form')[0].reset();
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
          $("#btn_send").show();
          $(".progress").hide(); 
        }
    }  
 }
  
  /*function save(){
    var formData = new FormData($('form')[0]);
        $.ajax({
          url: 'control/documento.php',
          type: 'POST',      
          data: formData,
          contentType: false,
          processData: false,
          
          success: function(data){
            var msj = data.split("|");
            alert(msj[0]);
            $('#tag').tagsinput('removeAll');
            $('form')[0].reset();
          }
        });
    return false;
  }*/
</script>

  <div class="panel panel-default">
    <div class="panel-heading">Registro de archivos</div>
    <div class="panel-body">
      <form onsubmit="return save2();">
              <input name="modo" type="hidden" value="add" />
              <input name="est" type="hidden" value="1" />
              <div class="form-group">
                <label>Nombre del Documento</label>
                <input type="text" class="form-control" name="nom" required placeholder="Nombre de Documento">
              </div>
              <div class="form-group">
                <label>Tags</label><br>
                <input type="text" class="form-control" name="tag" id="tag" placeholder="Separar con enter" data-role="tagsinput">
              </div>
              <div class="form-group">
                <label>Descripción</label>
                <textarea class="form-control" name="des" required rows="3" ></textarea>
              </div>
              <div class="form-group">
                <label for="exampleInputFile">Subir Archivo</label>
                <input type="file" required name="doc">
                <p class="help-block">Solo se aceptan archivos de tipo office, pdf, audio e imágenes.</p>
              </div>
              <button id="btn_send" type="submit" class="submit btn btn-primary">Guardar</button>
              <div style="display:none" class="progress">
                <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                  <span class="nper">0% Completo</span>
                </div>
              </div>
            </form>
    </div>
  </div>