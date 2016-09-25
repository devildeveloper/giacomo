qd.app.initApp = function ()
{

}
qd.app.output = function (_data)
{
	var html = '';
	if(_data instanceof Object){
		for(p in _data)
		{
			html += "<strong>" + p + "</strong> : " + _data[p] + "\n";
			if(_data[p] instanceof Object){
				for(p2 in _data[p])
				{
					html += "\t<strong>" + p2 + "</strong> : " + _data[p][p2] + "\n";
					if(_data[p][p2] instanceof Object){
						for(p3 in _data[p][p2])
						{
							html += "\t\t<strong>" + p3 + "</strong> : " + _data[p][p2][p3] + "\n";
							if(_data[p][p2][p3] instanceof Object){
								for(p4 in _data[p][p2][p3])
								{
									html += "\t\t\t<strong>" + p4 + "</strong> : " + _data[p][p2][p3][p4] + "\n";
									if(_data[p][p2][p3][p4] instanceof Object){
										for(p5 in _data[p][p2][p3][p4])
										{
											html += "\t\t\t\t<strong>" + p5 + "</strong> : " + _data[p][p2][p3][p4][p5] + "\n";
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}
	return html;
}

qd.app.CheckBox = function(_identificador, _callback)
{
	$(_identificador).click(function(){
		if($(this).hasClass('selected')){
			$(this).removeClass('selected');
			if(_callback != null) _callback($(this), false);
		}else{
			$(this).addClass('selected');
			if(_callback != null) _callback($(this), true);
		}
	});
};

qd.app.Paginacion = function(_identificador, _paginacion, _callback)
{
	$(_identificador).html('');
	//23
	var actual = _paginacion.pagina_actual;
	var inicio = _paginacion.pagina_actual - 11;
	if(inicio < 1) inicio = 1;
	var fin = inicio + 22;
	if(fin > _paginacion.paginas_totales){
		fin = _paginacion.paginas_totales;
		if(_paginacion.paginas_totales > 22) inicio = _paginacion.paginas_totales - 22;
	}


	if(inicio > 1){
		$(_identificador).append('<a href="javascript:void(0);" title="1" class="button_gray">...</a>');
		inicio++;
	}
	if(fin < _paginacion.paginas_totales) fin--;

	for(i=inicio; i <= fin; i++){
		var clase = 'button_gray';
		if(_paginacion.pagina_actual == i) clase = 'button current';

		$(_identificador).append('<a href="javascript:void(0);" title="' + i + '" class="' + clase + '">' + i + '</a>');
	}

	if(fin < _paginacion.paginas_totales) $(_identificador).append('<a href="javascript:void(0);" title="' + _paginacion.paginas_totales + '" class="button_gray">...</a>');

	$(_identificador + ' a').click(function()
	{
		if($(this).hasClass('current')){
			//$(this).removeClass('selected');
			//if(_callback != null) _callback($(this), false);
		}else{
			$(this).addClass('current');
			if(_callback != null) _callback($(this).attr('title'));
		}
	});
};

qd.app.Acordeon = function(_identificador, _accionData, _options)
{
	var target = $(_identificador);
	var data = null;
	var lista = null;
	var updateList = function()
	{
		target.children('ul').html('');
		for(d in data){
			target.children('ul').html(data[d].jugador_nombre);
		}
	};

	target.find('a.item_header').click(function(){
		if($(this).hasClass('expanded')){
			$(this).parent().find('.item_content').slideUp('fast');
			$(this).removeClass('expanded');
		}else{
			$(this).parent().find('.item_content').slideDown('fast');
			$(this).addClass('expanded');
		}
	});
}


qd.app.SelectList = function(_identificador, _callback)
{
	var target = $(_identificador);
	var currentVal = target.attr('val');

	$(_identificador + ' li a').append('<span class="icon-chevron-right pull-right"></span>');


	$(_identificador + ' li a').click(function(){
		$(this).parent().parent().find('li').removeClass('active');
		$(this).parent().addClass('active');
		$(this).parent().parent().find('span').removeClass('icon-white');
		$(this).find('span').addClass('icon-white');
		if(_callback != null)
			_callback();
		/*$('.nombre_rol').text($(this).text());
		$('.info_rol').text($(this).attr('data-original-title'));*/
	});
};

qd.app.SelectListXX = function(_identificador, _accionData, _defaultVal, _options)
{
	var target = $(_identificador);
	var data = null;
	var lista = null;
	var valor = target.attr('val');
	var urlRequest = '';
	var updateList = function()
	{
		target.children('ul').html('');
		for(d in data){
			target.children('ul').html(data[d].jugador_nombre);
		}
	};


	if(!valor) valor = -1;
	target.append('<img class="icon" src="./system_images/d_arrow_red.png"/>');
	target.append('<input type="hidden" id="hidden_' + target.attr('id') + '" name="' + target.attr('id') + '" value="' + valor + '"/>');
	//if(_defaultVal)	target.find('.label').text(_defaultVal);
	if(target.find('.label').text() == '')	target.find('.label').text('Seleccione');

	target.click(function()
	{
		var p = target.offset();
		
		$('#main_content').append('<div id="lista_seleccionable"><ul></ul></div>');
		//if(data == null){
		$('#lista_seleccionable ul').html('<li>Cargando...</li>');
		$('#lista_seleccionable').css('top', p.top + 23);
		$('#lista_seleccionable').css('left', p.left-1);
		$('#lista_seleccionable').css('width', target.width() + 3);

		$(document).click(function(){
			$('#lista_seleccionable').slideUp('fast');
		});
		$('#lista_seleccionable').slideDown('fast');
		
		qd.core.LoadData.load(escout.app.URLs.REQUEST_DATA, _accionData + '_combo', null, function(_data){
			data = qd.core.LoadData.getData(_data.data);
			$('#lista_seleccionable ul').html('');
			if(data.length == 0)	$('#lista_seleccionable ul').html('<li><a href="javascript:void(0);" class="info" id="-1">Sin registros</a></li>');
			for(it in data)
			{
				$('#lista_seleccionable ul').append('<li><a href="javascript:void(0);" id="' + data[it][_options.id] + '">' + data[it][_options.label] + '</a></li>');
			}

			$('#lista_seleccionable ul a').click(function(){
				target.find('input').val($(this).attr('id'));
				target.find('.label').text($(this).text());
				$('#lista_seleccionable').slideUp('fast');
			});
		});


		//}
		return false;
	});
};

qd.app.Alert = new function()
{
	this.timerOutAlert;
	this.delay = 2000;

	this.show = function (msg, tipo, tiempo)
	{
		if(tipo == null) tipo = 'msg_info';
		if(msg == null) msg = 'Sin mensaje';
		clearTimeout(this.timerOutAlert);

		if(tipo != 'msg_error'){
			if(tiempo == null){
				this.timerOutAlert = setTimeout(this.hide, this.delay);
			}else{
				if(tiempo != 0)	this.timerOutAlert = setTimeout(this.hide, tiempo);
			}
		}
		$('#main_alert .texto').html(msg);
		$('#main_alert').removeClass();
		$('#main_alert').addClass(tipo);
		$('#main_alert').slideDown('fast');
	};

	this.confirm = function (msg, callback)
	{
		var tipo = 'msg_info';
		var parent = this;
		if(msg == null) msg = '¿Por favor confirme la acción?';

		msg = '<div  style="display: inline-block; padding-left: 100px;">' + msg + '</div>';
		msg += '<div style="float:right;"><a href="#" class="button btn_confirm" style="width: 70px; display: inline-block;">Aceptar</a> <a href="#" class="button_gray btn_cancelar" style="width: 70px; display: inline-block;">Cancelar</a></div>';

		$('#main_alert').html(msg);
		$('#main_alert').removeClass();
		$('#main_alert').addClass(tipo);
		if(callback) $('#main_alert .btn_confirm').click(callback);
		$('#main_alert .btn_cancelar').click(function(){parent.hide();});
		$('#main_alert').slideDown('fast');
	};

	this.hide = function ()
	{
		$('#main_alert').slideUp('fast');
	}
};



$(document).ready(qd.app.initApp);