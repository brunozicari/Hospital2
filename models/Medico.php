<?php

//modelo

require_once '../models/Usuario.php';
require_once '../class_helper/seguridad.php';

class Medico extends Usuario {
	
	public function getTodosPorEspecialidad($id){
		$s=new seguridad();
		$s->id_validacion($id);
		$this->db->query("SELECT * FROM medicos LEFT JOIN especialidades ON medicos.especialidad=especialidades.especialidad_id where especialidad = " . $id);
		return $this->db->fetchAll();
	}
	
	public function getTodos(){
		$this->db->query("SELECT * FROM `medicos` LEFT JOIN especialidades ON medicos.especialidad=especialidades.especialidad_id");
		return $this->db->fetchAll();
	}
	
	public function informacion($dni){//veer
		$s=new seguridad();
		$s->dni_validacion($dni);
		$this->db->query("SELECT * from medicos where dni='$dni'");
		return $this->db->fetchAll();
	}
	
	public function existeMedico($dni){
		$s=new seguridad();
		$s->dni_validacion($dni);
		$this->db->query("SELECT * FROM medicos WHERE dni = '$dni'");
		if (($this->db->numRows()==1)) return true; //si lo encuentra entonces existe
		return false;
	}
	
	public function generarHorariosDeAtencion($dni){
		$s=new seguridad();
		$s->dni_validacion($dni);
		$this->db->query("SELECT horario FROM medicos where dni = " . $dni . " limit 1");
		if (($this->db->numRows()==0)) throw new ValidationException("Dni no corresponde a ningún medico");
		$h=$this->db->fetch();
		$hora="08:00";
		if ($h['horario']=="t") $hora="13:00";
		$retorno=[];
		for($i=0;$i<10;$i++){
			array_push($retorno,$hora);
			$hora=date("H:i",strtotime ($hora. '+30 minutes'));			
		}
		return $retorno;
	}
	
	public function verificarHora($dni_medico,$hora_a_verificar){
		$s=new seguridad();
		$s->dni_validacion($dni_medico);
		$this->db->query("SELECT horario FROM medicos where dni = " . $dni_medico . " limit 1");
		if (($this->db->numRows()==0)) throw new ValidationException("Dni no corresponde a ningún medico");
		$h=$this->db->fetch();
		$hora="08:00";
		if ($h['horario']=="t") $hora="13:00";
		for($i=0;$i<10;$i++){
			if($hora==$hora_a_verificar) return true;
			$hora=date("H:i",strtotime ($hora. '+30 minutes'));
		}
		return false;
	}
	
	public function darDeAltaMedico($dni,$nombre,$apellido,$especialidad,$horario,$consultorio){
		$s=new seguridad();
		$s->dni_validacion($dni);
		$s->nombre_validacion($nombre);
		$s->nombre_validacion($apellido);
		$s->id_validacion($especialidad);
		$s->id_validacion($consultorio);
		if (($horario!='m') and ($horario!='t'))throw new ValidationException("Horario inválido");
		$nombre=$this->db->escape($nombre);
		$apellido=$this->db->escape($apellido);
		$this->db->query("INSERT INTO medicos (dni, nom_medico, ape_medico, especialidad, horario, consultorio) VALUES ('$dni', '$nombre', '$apellido', '$especialidad', '$horario', '$consultorio')");
	}
	
	public function cambiarConsultorio($dni,$consultorio){
		$s=new seguridad();
		$s->dni_validacion($dni);
		$s->id_validacion($consultorio);
		$this->db->query("UPDATE medicos SET consultorio = '$consultorio' where dni='$dni'");
	}
	
	public function getConsultorio($dni){
		$s=new seguridad();
		$s->dni_validacion($dni);
		$this->db->query("SELECT consultorio FROM medicos WHERE dni = '$dni' limit 1");
		if (($this->db->numRows()==0)) throw new ValidationException("Dni invalido");
		$t = $this->db->fetch();
		return $t['consultorio'];
	}


}// fin de la clase


