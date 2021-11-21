<?php

//modelo


class Especialidad extends Model {	
	
	public function getTodos(){
		$this->db->query("SELECT * FROM especialidades");
		return $this->db->fetchAll();
	}
	
	public function existeEspecialidad($id){
		$s=new seguridad();
		$s->id_validacion($id);
		$this->db->query("SELECT * FROM especialidades WHERE especialidad_id = '$id'");
		if (($this->db->numRows()==1)) return true; //si encuentra la especialidad entonces existe
		return false;
	}
	
}

