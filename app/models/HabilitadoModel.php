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
			 $sql="SELECT * FROM habilitado AS ha INNER JOIN tipo_documento AS tc
			  ON ha.fk_id_tipo_documento=tc.id_tipo_documento WHERE ha.estado = ?";
			 
			 $this->db->query($sql);
			 $this->db->bind(1,1);
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
	
}