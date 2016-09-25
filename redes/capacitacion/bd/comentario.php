<?php
	class comentario extends BD{
		var $id;
		var $cur;
		var $lec;
		var $usu;
		var $msj;
		var $fec;
		var $est;
		function grabar($cur, $lec, $usu, $msj, $fec, $est){
			$this->proceso("insert into comentario(cur_id, lec_id, usu_id, com_msj, com_fec, com_est) values('$cur', '$lec', '$usu', '$msj', '$fec', '$est')");
			return mysql_insert_id();
		}

		function actualizar($id, $cur, $lec, $usu, $msj, $fec, $est){
			$this->proceso("update comentario set cur_id='$cir', lec_id='$lec', usu_id='$usu', com_msj='$msj', com_fec='$fec', com_est='$est' where com_id=$id");
		}

		function eliminar($id){
			$this->proceso("delete from comentario where com_id=$id");
		}

		function editar($where='1'){
			$res = $this->consulta("select * from comentario where $where limit 1");
			$num = $this->num_rows($res);
			if($num>0){
				$this->id  = $this->result($res, 0);
				$this->cur = $this->result($res, 1);
				$this->lec = $this->result($res, 2);
				$this->usu = $this->result($res, 3);
				$this->msj = $this->result($res, 4);
				$this->fec = $this->result($res, 5);
				$this->est = $this->result($res, 6);
			}
			return $num;
		}

		function consultar($campo='*', $where='1', $order='1'){
			$res = $this->consulta("select $campo from comentario where $where order by $order");
			return $res;
		}

		function  e_id(){ return $this->id; }
		function e_cur(){ return $this->cur; }
		function e_lec(){ return $this->lec; }
		function e_usu(){ return $this->usu; }
		function e_msj(){ return $this->msj; }
		function e_fec(){ return $this->fec; }
		function e_est(){ return $this->est; }
	}
?>