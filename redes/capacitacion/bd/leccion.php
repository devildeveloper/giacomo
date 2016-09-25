<?php
	class leccion extends BD{
		var $id;
		var $cur;
		var $tit;
		var $des;
		var $url;
		var $obj;
		var $mis;
		var $fil;
		var $fec;
		var $est;
		
		function grabar($cur, $tit, $des, $url, $obj, $mis, $fil, $fec, $est){
			$this->proceso("insert into leccion(cur_id, lec_tit, lec_des, lec_url, lec_obj, lec_mis, lec_fil, lec_fec, lec_est) values('$cur', '$tit', '$des', '$url', '$obj', '$mis', '$fil', '$fec', '$est')");
			return mysql_insert_id();
		}

		function actualizar($id, $cur, $tit, $des, $url, $obj, $mis, $fil, $fec, $est){
			$this->proceso("update leccion set cur_id='$cur', lec_tit='$tit', lec_des='$des', lec_url='$url', lec_obj='$obj', lec_mis='$mis', lec_fil='$fil', lec_fec='$fec', lec_est='$est' where lec_id=$id");
		}

		function eliminar($id){
			$this->proceso("delete from leccion where lec_id=$id");
		}

		function editar($where='1'){
			$res = $this->consulta("select * from leccion where $where limit 1");
			$num = $this->num_rows($res);
			if($num>0){
				$this->id     = $this->result($res, 0);
				$this->cur    = $this->result($res, 1);
				$this->tit    = $this->result($res, 2);
				$this->des 	  = $this->result($res, 3);
				$this->url    = $this->result($res, 4);
				$this->obj    = $this->result($res, 5);
				$this->mis    = $this->result($res, 6);
				$this->fil    = $this->result($res, 7);
				$this->fec    = $this->result($res, 8);
				$this->est    = $this->result($res, 9);
			}
			return $num;
		}

		function consultar($campo='*', $where='1', $order='1'){
			$res = $this->consulta("select $campo from leccion where $where order by $order");
			return $res;
		}

		function  e_id(){ return $this->id; }
		function e_cur(){ return $this->cur; }
		function e_tit(){ return $this->tit; }
		function e_des(){ return $this->des; }
		function e_url(){ return $this->url; }
		function e_obj(){ return $this->obj; }
		function e_mis(){ return $this->mis; }
		function e_fil(){ return $this->fil; }
		function e_fec(){ return $this->fec; }
		function e_est(){ return $this->est; }
	}

?>