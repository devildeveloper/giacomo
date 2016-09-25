qd.classes = new function(){};

qd.clases.entity = function(){
    this.properties = new Array();

    this.SetProperty = function(_key, _value){
        this.properties[_key] = _value;
    };
    this.DeleteProperty = function(_key){
        this.properties[_key] = undefined;
    };
    this.GetProperty = function(_key){
       return this.properties[_key];
    };
    this.GetProperties = function(){
        return this.properties;
    };
};

/*******************************************/

qd.clases.Posicion = function(_properties)
{
	this.posicion_id = -1;
	this.posicion_nombre = '';
	this.posicion_x = 0;
	this.posicion_y = 0;
	this.seleccionada = 0;
	if(_properties != null){		for (e in _properties) {			if(this[e] != null) this[e] = _properties[e];		}	}
};
