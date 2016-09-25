<?php
	class curso extends BD{
		var $id;
		var $tit;
		var $des;
		var $fec;
		var $est;
		function grabar($tit, $des, $fec, $est){
			$this->proceso("insert into curso(cur_tit, cur_des, cur_fec, cur_est) values('$tit', '$des', '$fec', '$est')");
			return mysql_insert_id();
		}

		function actualizar($id, $tit, $des, $fec, $est){
			$this->proceso("update curso set cur_tit='$tit', cur_des='$des', cur_fec='$fec', cur_est='$est' where cur_id=$id");
		}

		function eliminar($id){
			$this->proceso("delete from curso where cur_id=$id");
		}

		function editar($where='1'){
			$res = $this->consulta("select * from curso where $where limit 1");
			$num = $this->num_rows($res);
			if($num>0){
				$this->id  = $this->result($res, 0);
				$this->tit = $this->result($res, 1);
				$this->des = $this->result($res, 2);
				$this->fec = $this->result($res, 3);
				$this->est = $this->result($res, 4);
			}
			return $num;
		}

		function consultar($campo='*', $where='1', $order='1'){
			$res = $this->consulta("select $campo from curso where $where order by $order");
			return $res;
		}

		function e_id(){  return $this->id; }
		function e_tit(){ return $this->tit; }
		function e_des(){ return $this->des; }
		function e_fec(){ return $this->fec; }
		function e_est(){ return $this->est; }
	}
?>