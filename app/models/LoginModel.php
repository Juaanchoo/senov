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

	public function all_Tipo_Documento()
	{
		$sql="SELECT * FROM tipo_documento";
		$this->db->query($sql);
		return $this->db->getAll();
	}

	//Ésta consulta revisa si el documento está habilitado ..
	public function habilitado($documento)
	{
		$sql="SELECT * FROM habilitado WHERE documento = ?";
		$this->db->query($sql);
		$this->db->bind(1,$documento);
		$hab = $this->db->getOne();
		return $hab;
	}

	//Esta consulta revisa en la base de datos si el documento ya está registrado
	public function askRegistro($documento)
	{
		$sql="SELECT * FROM usuarios_admin WHERE documento = ?";
		$this->db->query($sql);
		$this->db->bind(1,$documento);
		$usu = $this->db->getOne();
		return $usu;
		
	}

	public function registrar($info_usuario)
	{
		try {
			
			$hab = $this->habilitado($info_usuario["dni"]);
			$usu = $this->askRegistro($info_usuario["dni"]);
			// if($usu == false){
			// 	echo "lo ves no hay nada ahí!";
			// 	var_dump($info_usuario);
			// 	var_dump($hab);
			// }else{
			// 	var_dump($usu);
			// }
			if(!empty($hab) && $hab->fk_id_tipo_documento == $info_usuario["tipo_documento"]){
				if(!empty($hab) && $hab->documento == $info_usuario["dni"] && $usu == false){
				$sql="INSERT INTO `usuarios_admin`(`fk_id_tipo_documento`, `documento`, `nombre`, `primer_apellido`,`segundo_apellido`, `email`, `telefono`, `password`) VALUES (?,?,?,?,?,?,?,?)";
				$this->db->query($sql);
				$this->db->bind(1,$info_usuario["tipo_documento"]);
				$this->db->bind(2,$info_usuario["dni"]);
				$this->db->bind(3,$info_usuario["nombre"]);
				$this->db->bind(4,$info_usuario["primer_apellido"]);
				$this->db->bind(5,$info_usuario["segundo_apellido"]);
				$this->db->bind(6,$info_usuario["email"]);
				$this->db->bind(7,$info_usuario["telefono"]);
				$this->db->bind(8,$info_usuario["password"]);
				if($this->db->execute()){
					$sql2 = "INSERT INTO permiso_cargo (fk_id_cargo, fk_documento) VALUES (?,?)";
					$this->db->query($sql2);
					$this->db->bind(1,3);
					$this->db->bind(2,$info_usuario["dni"]);
					if($this->db->execute()){
						return "<script>swal({
							type: 'success',
							title: 'Exito!',
							text: 'Se ha logrado registrar correctamente!',
							footer: '<a href=\'".URL_APP."\'>Iniciar Sesion </a>',
							showConfirmButton: false
						})</script>";
					}else{
						return "<script>swal(
							'No se ha podido registrar!',
							'',
							'error'
						)</script>";
					}
					
				}else{
					return "<script>swal(
						'No se ha podido registrar!',
						'',
						'error'
					)</script>";
				}
				}else{
					return "<script>swal({
						type: 'error',
						title: 'Opps..',
						text: 'El documento no está habilitado o ya está registrado',
					})</script>";
				}
			}else{
				return "<script>swal({
					type: 'error',
					title: 'Opps..',
					text: 'El tipo documento no concuerda con el habilitado',
				})</script>";
			}
		} catch (Exception $e) {
			return "DATA BASE ERROR";
		}
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