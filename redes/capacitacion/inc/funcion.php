<?php
	function formato_fecha($fecha, $formato){ //formato => 1=numero, 2=texto
		if($formato=="1"){
			if($fecha=="0"){
				$fecha = "";
			}else{
				$fecha = substr($fecha, 6, 2)."/".substr($fecha, 4, 2)."/".substr($fecha, 0, 4);
			}
		}elseif($formato=="2"){
			if($fecha==""){
				$fecha = "0";
			}else{
				$fecha = substr($fecha, 6, 4).substr($fecha, 3, 2).substr($fecha, 0, 2);
			}
		}elseif($formato=="3"){
			if($fecha=="0000-00-00"){
				$fecha = "";
			}else{
				$fecha = substr($fecha, 8, 2)."/".substr($fecha, 5, 2)."/".substr($fecha, 0, 4);
			}
		}
		return $fecha;
	}

	function encriptar($string, $key){
		$result = '';
		for($i=0; $i<strlen($string); $i++){
			$char = substr($string, $i, 1);
			$keychar = substr($key, ($i % strlen($key))-1, 1);
			$char = chr(ord($char)+ord($keychar));
			$result.=$char;
		}
		return base64_encode($result);
	}

	function desencriptar($string, $key){
		$result = '';
    	$string = base64_decode($string);
    	for($i=0; $i<strlen($string); $i++){
        	$char = substr($string, $i, 1);
        	$keychar = substr($key, ($i % strlen($key))-1, 1);
        	$char = chr(ord($char)-ord($keychar));
        	$result.=$char;
		}
		return $result;
	}

	function mayuscula($cadena){
		return mb_convert_case(trim($cadena), MB_CASE_UPPER, "UTF-8");
	}

	function minuscula($cadena){
		return mb_convert_case(trim($cadena), MB_CASE_LOWER, "UTF-8");
	}

	

	function may_min($cadena){
		return mb_convert_case(trim($cadena), MB_CASE_TITLE, "UTF-8");
	}

	function upper_case($str){
		$banned_words = array("de","a","con","la","el","y","por","e","en","las","los","del","para","un","antes");
		$first = strtolower($str);
		$arr_first = explode(" ",$first);
		$aux = array();//Extrae los espacios en blanco innecesarios
		foreach($arr_first as $word){
			if(strlen($word)>0)
				$aux[] = $word;
		}
		$arr_first = $aux;
		$arr_second = array();	
		foreach($arr_first as $count=>$word){
			//$word=str_replace("Ñ","&ntilde;",$word);
			if(!in_array($word,$banned_words)){
				$arr_second[] = ucfirst($word);
			}else{
				if($count==0)
					$arr_second[] = ucfirst($word);
				else
					$arr_second[] = $word;
			}
		}
		$second = implode(" ", $arr_second);
		$second = str_replace(chr(209),"&ntilde;",$second);
		$second = str_replace(chr(193),"&aacute;",$second);
		$second = str_replace(chr(201),"&eacute;",$second);
		$second = str_replace(chr(205),"&iacute;",$second);
		$second = str_replace(chr(211),"&oacute;",$second);
		$second = str_replace(chr(218),"&uacute;",$second);
		return $second;
	}

	function fecha7d(){
		$fecha = date('Y-m-j');
		$nuevafecha = strtotime('+7 day', strtotime($fecha));
		$nuevafecha = date('Y-m-j', $nuevafecha);
		return substr($nuevafecha, 0, 4).substr($nuevafecha, 5, 2).substr($nuevafecha, 8, 2);
	}

	function urlDoc($ty){
		$arrd = array('docx', 'docm', 'dotx', 'dotm', 'xlsx', 'xlsm', 'xltx', 'xltm', 'xlsb', 'xlam', 'pptx', 'pptm', 'potx', 'potm', 'ppam', 'ppsx', 'ppsm', 'sldx', 'sldm', 'thmx', 'doc', 'xls', 'ppt');
		$arrl = array('pdf');
		$arra = array('mp3','mid','midi','wav','wma','cda','ogg','ogm','aac','ac3','flac','mp4');
	
		if(in_array($ty, $arrd)){
			return "img/doc.png";
		}elseif(in_array($ty, $arrl)){
			return "img/book.png";
		}elseif(in_array($ty, $arra)){
			return "img/audio.png";
		}
	}
?>