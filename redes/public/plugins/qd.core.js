var qd = new Object();

qd.core = new Object();
qd.clases = new Object();
qd.app = new Object();
qd.control = new Object();

qd.core.Path = new function()
{
	this.params = new Array();
	this.getValue = function()
	{
		return SWFAddress.getValue();
	};
	this.setValue = function (_key, _value)
	{

		this.params[_key] = _value;
		this.update();
	};

	this.update = function()
	{
		var params = '?';
		for(p in this.params)
		{
			if(this.params[p] != '')	params += p  + '=' + this.params[p] + '&';
		}
		SWFAddress.setValue(params);
	}
};

qd.core.GlobalData = new function()
{
	this.values = new Array();

	this.Get = function(_key)
	{
		return this.values[_key];
	};

	this.Set = function(_key, _value)
	{
		this.values[_key] = _value;
	};

	this.Delete = function(_key)
	{
		this.values[_key] = undefined;
	};

    this.Keys = new function()
    {
	    this.CURRENT_SECTION = 'CURRENT_SECTION';
	    this.SELECTED_PLAYER_ID = 'SELECTED_PLAYER_ID';
	    this.SELECTED_AGENT_ID = 'SELECTED_PLAYER_ID';
	    this.SELECTED_CLUB_ID = 'SELECTED_CLUB_ID';
	    this.SELECTED_SCOUT_ID = 'SELECTED_SCOUT_ID';
	    this.REFERER_SECTION = 'REFERER_SECTION';
	    this.LOGGED_USER = 'LOGGED_USER';
    };
};


/**
 * LoadData
 * @param _url
 * @param _accion
 * @param _params nom
 * @param _onLoad
 * @param _onError
 */
qd.core.LoadData = new function()
{
	this.status = function(_data)
	{
		this.codigo = 1;
		this.mensaje = 1;
		if(_data != null){for (e in _data) {if(this[e] != null) this[e] = _data[e].Valor;}}
	}
	this.getData = function(_data, _tipo)
	{
		var data = this.Json2Entities(_data, _tipo);
        return data;
	}

    this.Json2Entities = function(_json, _tipo){
        var _entities = new Array();
        if(_json != null){
            for (e in _json) {
                var _entity = new qd.clases.entity();
                for(p in _json[e].Propiedades){
                    _entity.SetProperty(p, _json[e].Propiedades[p].Valor);
                }
                if(_tipo)	_entities.push(new _tipo(_entity.properties));
                else		_entities.push(_entity.properties);
            }
        }
        return _entities;
    }

	this.data;
	this.permisos;
	this.generales;
	

	this.load = function(_url, _params, _onLoad, _onError)
	{
		if (_params == null) _params = new Object();
		if(!_params.page)		_params.page = 1;
		if(!_params.num_items)	_params.num_items = 20;

		if($.isArray(_params)){
			_params.push({name:"page", value:_params.page});
			_params.push({name:"num_items", value:_params.num_items});
		}

		$.post(Config.Path + _url + '?m_id=' + Math.random() , _params, function(_result){
			if(_result == ''){qd.app.Alert.show('Respuesta vacía desde <pre style="display:inline;">(' + Config.Path + _url + ' | ' + _accion + ')</pre>, se esperaba JSON','msg_error');	return false;	}
			var result = JSON.parse(_result);

			if(result.status == null) qd.app.Alert.show('Llega a null', 'msg_error');
			switch (result.status.codigo) {
				case 'WRONG_ACTION':
					if(_onError != null) _onError(result, _params);
					else qd.app.Alert.show(result.status.codigo, 'msg_error');
					break;
				case 'FAULT':
					if(_onError != null) _onError(result, _params);
					else qd.app.Alert.show(result.status.descripcion, 'msg_error');
					break;
				case 'NO_SESION':
					qd.app.Alert.show(result.status.descripcion);
					window.location = escout.app.URLs.LOGIN_URL;
					break;
				case 'ERROR_VISIBLE':
					if(_onError != null) _onError(result, _params);
					else qd.app.Alert.show(result.status.descripcion, 'msg_error');
					break;
				default: //Para RESULT y todos los otros códgos
					if(result.data == null){
						qd.app.Alert.show('No se recibio nada en data <pre style="display:inline;">(' + _url + ' | ' + _accion + ')</pre>','msg_error');
						return false;
					}
					//this.data = this.getData(result.data);
					_onLoad(result, _params);
					break;
			}
		});
	}
};

qd.core.LoadControl = function(_url, _target)
{
	this.html;
	this.url; 
	this.target;

	$.post('plugins/assets/' + _url + '.aspx', function(data){
		$(document).append(data);
		_target();
		///return data;
	});
};

qd.core.LoadView = function(_url, _target)
{
	this.html;
	this.url;
	this.target;
	var main_content = '#main_content';

	switch(_target)
	{
		case null:
		case undefined:
		case 'MAIN_CONTENT':
			$.post('views/' + _url + '.aspx?m_id=' + Math.random(), function(data){
				this.html = data;
				$(main_content).html(data);
				return this.html;
			});
			break;
		case 'POPUP':
			$.colorbox({href:'views/' + _url + '.aspx?m_id=' + Math.random()});
			break;
		default:
			$.post('views/' + _url + '.aspx?m_id=' + Math.random(), function(data){
				this.html = data;
				this.target = _target;
				$(_target).html(data);
				return this.html;
			});
			break;
	}
};


/* Manejo de errores */
$(document).ajaxError(qd.core.onLoadError);

qd.core.onLoadError = function(event, request, settings){
    qd.app.Alert.show('<h4>'+request.statusText+'</h4>Ocurrio un error al intentar conectar con el servidor, por favor intentalo nuevamente.', 'msg_error');
};