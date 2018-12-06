<?php 
/**
 * 
 */
class LoginModel extends DataBase
{
	private $db;

	function __construct(){
		$this->db = new DataBase();
	}
	
	public function show($id){
		$sql = 'SELECT nombre, primer_apellido, segundo_apellido, documento, password FROM usuarios_admin WHERE documento = ?';
		$sql2 = 'SELECT tipc.cargo
		FROM `permiso_cargo` as perc 
		INNER JOIN tipo_cargo as tipc 
		ON perc.fk_id_cargo = tipc.id_cargo WHERE perc.fk_documento = ?';

		$this->db->query($sql);
		$this->db->bind(1,$id);
		$user = $this->db->getOne();
		$_SESSION['nombre'] = $user->nombre." ".$user->primer_apellido;
		$_SESSION['documento'] = $user->documento;
		
		$this->db->query($sql2);
		$this->db->bind(1,$user->documento);
		$a = $this->db->getAll();
		for ($i=0; $i < count($a); $i++) { 
			$p[] = $a[$i]->cargo;
		}		
		$user->permisos = $p;
		return $user;
	}

	public function sumarIntento($id){
		$sql = 'UPDATE usuarios_admin SET intentos = intentos + 1 WHERE documento = ?';
		$this->db->query($sql);
		$this->db->bind(1,$id);
		if($this->db->execute()){
			$sql2 = 'SELECT intentos FROM usuarios_admin WHERE documento = ?';
			$this->db->query($sql2);
			$this->db->bind(1,$id);
			return $this->db->getOne();
		}else{
			return false;
		}

	}

	public function resetIntentos($id){
		$sql = 'UPDATE usuarios_admin SET intentos = 0 WHERE documento = ?';
		$this->db->query($sql);
		$this->db->bind(1,$id);
		if($this->db->execute()){
			return true;
		}else{
			return false;
		}
	} 
}