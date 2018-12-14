<?php 

class HabilitadoModel extends DataBase
{
	private $db;

	function __construct(){
		$this->db = new DataBase();
	}

	/**
	 * @author senov
	 * Obtiene los datos de los documentos habilitados para registrarse
	 */
	 public function get_Habilitados()
	 {
		 try {
			 $sql="SELECT * FROM habilitado AS ha 
			 INNER JOIN tipo_documento AS tc ON ha.fk_id_tipo_documento=tc.id_tipo_documento 
			 LEFT JOIN permiso_cargo AS pc ON pc.fk_documento=ha.documento 
			 WHERE ha.estado = ? AND documento != ? AND (pc.fk_id_cargo!=? OR pc.fk_id_cargo is ?)";
			 
			 $this->db->query($sql);
			 $this->db->bind(1,1);
			 $this->db->bind(2,$_SESSION["documento"]);
			 $this->db->bind(3,5);
			 $this->db->bind(4,null);
			 $get = $this->db->getAll();
			 if(!empty($get)){

				 return $get;
			 }else{
				 return false;
			 }


		 } catch (Exception $e) {
			 return "Habilitado_get_Habilitados_DATABASE ERROR";
		 }
	 }

	 /**
	 * @author senov
	 * Obtiene los datos de los documentos habilitados para registrarse
	 */
	public function get_Deshabilitados()
	{
		try {
			$sql="SELECT * FROM habilitado AS ha INNER JOIN tipo_documento AS tc
			ON ha.fk_id_tipo_documento=tc.id_tipo_documento LEFT JOIN permiso_cargo AS pc 
			ON pc.fk_documento=ha.documento WHERE ha.estado = ? AND documento != ? AND (pc.fk_id_cargo!=? OR pc.fk_id_cargo is ?)";
			
			$this->db->query($sql);
			$this->db->bind(1,0);
			$this->db->bind(2,$_SESSION["documento"]);
			$this->db->bind(3,5);
			$this->db->bind(4,null);
			$get = $this->db->getAll();
			if(!empty($get)){
				return $get;
			}else{
				return false;
			}


		} catch (Exception $e) {
			return "Habilitado_get_Habilitados_DATABASE ERROR";
		}
	}

	 /**
	 * @author senov
	 * Obtiene los datos de los documentos habilitados para registrarse
	 */
	public function desactivarHabilitados($documento)
	{
		try {
			$sql="UPDATE `habilitado` SET `estado`= ? WHERE estado = ? AND documento = ? AND documento != ?";
			
			$this->db->query($sql);
			$this->db->bind(1,0);
			$this->db->bind(2,1);
			$this->db->bind(3,$documento);
			$this->db->bind(4,$_SESSION["documento"]);
			$get = $this->db->execute();
			if($get == true){
				$sql2="UPDATE `usuarios_admin` SET `estado`= ? WHERE estado = ? AND documento = ? AND documento != ?";
				$this->db->query($sql);
				$this->db->bind(1,0);
				$this->db->bind(2,1);
				$this->db->bind(3,$documento);
				$this->db->bind(4,$_SESSION["documento"]);
				$get2 = $this->db->execute();
				if($get2 == true){
					return "<script>swal({
						type: 'success',
						title: 'Exito!',
						text: 'Ha logrado deshabilitar el documento correctamente!',
					})</script>";
				}else{
					return "<script>swal({
						type: 'error',
						title: 'Opps..',
						text: 'No se pudo deshabilitar el registro',
					})</script>";
				}

			}else{
				return "<script>swal({
					type: 'error',
					title: 'Opps..',
					text: 'No se pudo deshabilitar',
				})</script>";
			}


		} catch (Exception $e) {
			return "Habilitado_desactivar_Habilitados_DATABASE ERROR";
		}
	}
	
	/**
	 * @author senov
	 * Obtiene los datos de los documentos habilitados para registrarse
	 */
	public function activarHabilitados($documento)
	{
		try {
			$sql="UPDATE `habilitado` SET `estado`= ? WHERE estado = ? AND documento = ? AND documento != ?";
			
			$this->db->query($sql);
			$this->db->bind(1,1);
			$this->db->bind(2,0);
			$this->db->bind(3,$documento);
			$this->db->bind(4,$_SESSION["documento"]);
			$get = $this->db->execute();
			if(!empty($get)){
				$sql2="UPDATE `usuarios_admin` SET `estado`= ? WHERE estado = ? AND documento = ? AND documento != ?";
				$this->db->query($sql);
				$this->db->bind(1,1);
				$this->db->bind(2,0);
				$this->db->bind(3,$documento);
				$this->db->bind(4,$_SESSION["documento"]);
				$get2 = $this->db->execute();
				if($get2 == true){
					return "<script>swal({
						type: 'success',
						title: 'Exito!',
						text: 'Ha logrado habilitar el documento correctamente!',
					})</script>";
				}else{
					return "<script>swal({
						type: 'error',
						title: 'Opps..',
						text: 'No se pudo habilitar el registro',
					})</script>";
				}

			}else{
				return "<script>swal({
					type: 'error',
					title: 'Opps..',
					text: 'No se pudo habilitar',
				})</script>";
			}


		} catch (Exception $e) {
			return "Habilitado_get_Habilitados_DATABASE ERROR";
		}
	}
}