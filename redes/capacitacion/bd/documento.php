<?php
	class documento extends BD{
		var $id;
		var $tip;
		var $nom;
		var $des;
		var $tag;
		var $url;
		var $fec;
		var $est;
		function grabar($tip, $nom, $des, $tag, $url, $fec, $est){
			$this->proceso("insert into documento(doc_tip, doc_nom, doc_des, doc_tag, doc_url, doc_fec, doc_est) values('$tip', '$nom', '$des', '$tag', '$url', '$fec', '$est')");
			return mysql_insert_id();
		}

		function actualizar($id, $tip, $nom, $des, $tag, $url, $fec, $est){
			$this->proceso("update documento set doc_tip='$tip', doc_nom='$nom', doc_des='$des', doc_tag='$tag', doc_url='$url', doc_fec='$fec', doc_est='$est' where doc_id=$id");
		}

		function eliminar($id){
			$this->proceso("delete from documento where doc_id=$id");
		}

		function editar($where='1'){
			$res = $this->consulta("select * from documento where $where limit 1");
			$num = $this->num_rows($res);
			if($num>0){
				$this->id  = $this->result($res, 0);
				$this->tip = $this->result($res, 1);
				$this->nom = $this->result($res, 2);
				$this->des = $this->result($res, 3);
				$this->tag = $this->result($res, 4);
				$this->url = $this->result($res, 5);
				$this->fec = $this->result($res, 6);
				$this->est = $this->result($res, 7);
			}
			return $num;
		}

		function consultar($campo='*', $where='1', $order='1'){
			$res = $this->consulta("select $campo from documento where $where order by $order");
			return $res;
		}

		function e_id(){ return $this->id; }
		function e_tip(){ return $this->tip; }
		function e_nom(){ return $this->nom; }
		function e_des(){ return $this->des; }
		function e_tag(){ return $this->tag; }
		function e_url(){ return $this->url; }
		function e_fec(){ return $this->fec; }
		function e_est(){ return $this->est; }
	}
?>