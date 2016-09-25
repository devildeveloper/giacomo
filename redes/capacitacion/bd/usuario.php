<?php
	class usuario extends BD{
		var $id;
		var $tip;
		var $apenom;
		var $cor;
		var $reg;
		var $dni;
		var $con;
		var $fec;
		var $est;
		
		function grabar($tip, $apenom, $cor, $reg, $dni, $con, $fec, $est){
			$this->proceso("insert into usuario(usu_tip, usu_apenom, usu_cor, usu_reg, usu_dni, usu_con, usu_fec, usu_est) values('$tip', '$apenom', '$cor', '$reg', '$dni', '$con', '$fec', '$est')");
			return mysql_insert_id();
		}

		function actualizar($id, $tip, $apenom, $cor, $reg, $dni, $con, $fec, $est){
			$this->proceso("update usuario set usu_tip='$tip', usu_apenom='$apenom', usu_cor='$cor', usu_reg='$reg', usu_dni='$dni', usu_con='$con', usu_fec='$fec', usu_est='$est' where usu_id=$id");
		}

		function eliminar($id){
			$this->proceso("delete from usuario where usu_id=$id");
		}

		function editar($where='1'){
			$res = $this->consulta("select * from usuario where $where limit 1");
			$num = $this->num_rows($res);
			if($num>0){
				$this->id     = $this->result($res, 0);
				$this->tip    = $this->result($res, 1);
				$this->apenom = $this->result($res, 2);
				$this->cor    = $this->result($res, 3);
				$this->reg    = $this->result($res, 4);
				$this->dni    = $this->result($res, 5);
				$this->con    = $this->result($res, 6);
				$this->fec    = $this->result($res, 7);
				$this->est    = $this->result($res, 8);
			}
			return $num;
		}

		function consultar($campo='*', $where='1', $order='1'){
			$res = $this->consulta("select $campo from usuario where $where order by $order");
			return $res;
		}

		function e_id(){ return $this->id; }
		function e_tip(){ return $this->tip; }
		function e_apenom(){ return $this->apenom; }
		function e_cor(){ return $this->cor; }
		function e_reg(){ return $this->reg; }
		function e_dni(){ return $this->dni; }
		function e_con(){ return $this->con; }
		function e_fec(){ return $this->fec; }
		function e_est(){ return $this->est; }
	}

?>