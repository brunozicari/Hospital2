<?php

//modelo

class Usuario extends Model {
	
	public function intentarLoguear($dni,$contrasenia){
		if (!ctype_digit($dni)) return false; //no deberia tirar una excepcion. Si puso el dni mal no va a poder entrar al sistema pero puede seguir intentando
		$this->db->query("SELECT * from usuarios where dni = " . $dni . " limit 1");
		if (($this->db->numRows()!=1)) return false;
		$c = $this->db->fetch();
		$hashcontra=password_hash($contrasenia, PASSWORD_DEFAULT);
		if (password_verify($contrasenia, $c['contrasenia'])) return true;
		return false;
	}
	
	public function tipoDeUsuario($dni){
		$s=new seguridad();
		$s->dni_validacion($dni);
		$this->db->query("SELECT tipo from usuarios where dni =" . $dni . " limit 1");
		if (($this->db->numRows()==0)) throw new ValidationException("Dni invalido"); //si no lo encuentra que tire una excepcion
		$t = $this->db->fetch();
		return $t['tipo'];
	}
	
	public function usuarioExistente($dni){
		$s=new seguridad();
		$s->dni_validacion($dni);//si llego hasta este punto y el dni no es valido que tire una excepcion
		$this->db->query("SELECT * from usuarios where dni = " . $dni);
		if (($this->db->numRows()!=0)) return true;
		return false;
	}
	
	public function darDeAlta($dni,$nombre,$apellido,$contra,$mail,$tipo){
		$s=new seguridad();
		$s->dni_validacion($dni);
		//Estas validaciones no me dejan poner acentos. Nada mas deberian validar la longitud del string -mas de 1- de todas formas despues usamos el escape
		$s->nombre_validacion($nombre);
		$s->nombre_validacion($apellido);
		$s->email_validacion($mail);
		if (($tipo!=1) and ($tipo!=2)) throw new ValidationException('Tipo de usuario inválido');
		$hashcontra=$s->hash_contra($contra);		
		$nombre=$this->db->escape($nombre);
		$apellido=$this->db->escape($apellido);
		$mail=$this->db->escape($mail);
		$this->db->query("INSERT INTO usuarios (dni, nombre, apellido, contrasenia, tipo, mail) VALUES ('$dni', '$nombre', '$apellido', '$hashcontra', $tipo , '$mail')");
	}
		
	public function getDatos($dni){
		$s=new seguridad();
		$s->dni_validacion($dni);
		$this->db->query("SELECT * from usuarios where dni = " . $dni . " LIMIT 1");
		if (($this->db->numRows()==0)) throw new ValidationException("Dni invalido"); //si no lo encuentra que tire una excepcion
		return $this->db->fetch();
	}
	
	public function nombreYApellido($dni){
		$s=new seguridad();
		$s->dni_validacion($dni);
		$this->db->query("SELECT * from usuarios where dni = " . $dni . " LIMIT 1");
		$datos= $this->db->fetch();
		if (($this->db->numRows()==0)) throw new ValidationException("Dni invalido"); //si no lo encuentra que tire una excepcion
		$string= $datos['nombre'] ." ". $datos['apellido'];
		return $string;
	}
	
	public function buscarPorNombreApellido($texto){
		$texto=$this->db->escape($texto);
		$texto=$this->db->escapeWildcards($texto);
		$this->db->query("SELECT * from usuarios where nombre like '%" . $texto . "%' or apellido like '%" . $texto . "%'");
		return $this->db->fetchAll();
	}

	public function cambiar_contraseña($dni,$contra,$s){

		$s->dni_validacion($dni);
		$s->contra_validacion($contra);
		$hashcontra=$s->hash_contra($contra);
	
		$this->db->query("UPDATE usuarios SET contrasenia  = '$hashcontra' where dni = $dni");
	}
}

