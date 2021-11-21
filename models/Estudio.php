<?php 

//modelo
require_once '../class_helper/seguridad.php';


class Estudio extends Model{

	public function getTodos(){
		$this->db->query("SELECT * from estudios");
		return $this->db->fetchAll();
	}
	
	public function getDatosEstudio($id){
		$s=new seguridad();
		$s->id_validacion($id);	
		$this->db->query("SELECT * FROM estudios WHERE estudio_id = " . $id . " LIMIT 1");
		if (($this->db->numRows()==0)) throw new ValidationException("Id invalido");
		return $this->db->fetch();
	}
	
	public function existeEstudio($id){
		$s=new seguridad();
		$s->id_validacion($id);	
		$this->db->query("SELECT * FROM estudios WHERE estudio_id = '$id'");
		if (($this->db->numRows()==1)) return true; //si lo encuentra entonces existe
		return false;
	}
	
	public function generarHorariosDeEstudios($id){
		$s=new seguridad();
		$s->id_validacion($id);
		$this->db->query("SELECT horario FROM estudios where estudio_id = " . $id . " limit 1");
		$h=$this->db->fetch();
		$hora="08:00";
		if ($h['horario']=="t") $hora="13:00";
		$retorno=[];
		for($i=0;$i<20;$i++){
			array_push($retorno,$hora);
			$hora=date("H:i",strtotime ($hora. '+15 minutes'));			
		}
		return $retorno;
	}
	
	public function verificarHora($id,$hora_a_verificar){
		$s=new seguridad();
		$s->id_validacion($id);
		$this->db->query("SELECT horario FROM estudios where estudio_id = " . $id . " limit 1");
		$h=$this->db->fetch();
		$hora="08:00";
		if ($h['horario']=="t") $hora="13:00";
		for($i=0;$i<20;$i++){
			if($hora==$hora_a_verificar) return true;
			$hora=date("H:i",strtotime ($hora. '+15 minutes'));	
		}
		return false;
	}
	
	public function DarDeAlta($nombre,$descripcion,$precio,$horario){
		$s=new seguridad();
		$s->nombre_validacion($nombre);
		if (strlen($descripcion)>100) throw new ValidationException("Descripcion inválida");
		if (!is_numeric($precio))throw new ValidationException("Precio inválido");
		if (($horario!='m') and ($horario!='t'))throw new ValidationException("Horario inválido");
		$this->db->query("INSERT INTO estudios (nom_estudio, desc_estudio, precio, horario) VALUES ('$nombre', '$descripcion', '$precio', '$horario')");
	}

}// FIN DE CLASE
 ?>