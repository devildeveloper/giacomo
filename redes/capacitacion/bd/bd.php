<?php
	class BD{
		var $cn;

		function __construct($servidor="localhost", $usuario="root", $clave="Amazon_2016", $base="debander_centro"){
			$this->cn = mysql_connect($servidor, $usuario, $clave);
			mysql_select_db($base, $this->cn);
			mysql_query("set names 'utf8'");
			ini_set('display_errors','On');
			date_default_timezone_set("America/Lima");
		}
		
		function proceso($sql){
			mysql_query($sql, $this->cn);
		}
		
		function consulta($sql){
			$res = mysql_query($sql, $this->cn);
			return $res;
		}
		
		function num_rows($resultado){
			return mysql_num_rows($resultado);
		}
		
		function fetch_array($resultado){
			return mysql_fetch_array($resultado);
		}
		
		function fetch_assoc($resultado){
			return mysql_fetch_assoc($resultado);
		}
		
		function fetch_row($resultado){
			return mysql_fetch_row($resultado);
		}
		
		function result($resultado, $item){
			return mysql_result($resultado, 0, $item);
		}
		
		function num_fields($resultado){
			return mysql_num_fields($resultado);
		}

		function field_name($resultado, $item){
			return mysql_field_name($resultado, $item);
		}
	}
?>
