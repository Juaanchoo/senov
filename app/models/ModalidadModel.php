<?php 

class ModalidadModel extends DataBase
{
	private $db;

	function __construct(){
		$this->db = new DataBase();
    }
    
    /**
     * @author senov
     * traer todos los programas de formación
     */

     public function get_modalidad()
     {
         try {

            $sql="SELECT * FROM `modalidad`";

            $this->db->query($sql);
            // $this->db->bind(1, 1);

            $get= $this->db->getAll();
            if(!empty($get)){
                return $get;
            }else{
                return false;
            }
             
         } catch (Exception $e) {
             return "Programa_get_programas_DATABASE ERROR";
         }
     }

     /**
     * @author senov
     * traer todos los programas de formación
     */

    public function get_One_modalidad($id)
    {
        try {

           $sql="SELECT * FROM modalidad WHERE id_modalidad = ?";

           $this->db->query($sql);
           $this->db->bind(1, $id);

           $get= $this->db->getOne();
           if(!empty($get)){
               return $get;
           }else{
               return false;
           }
            
        } catch (Exception $e) {
            return "Programa_get_programas_DATABASE ERROR";
        }
    }

     /**
     * @author senov
     * ingresar nuevos programas de formación
     */

    public function set_modalidad($datos)
    {
        try {

           $sql="INSERT INTO modalidad(modalidad, estado) VALUES (?,?)"; 
           

           $this->db->query($sql);
           $this->db->bind(1, $datos);
           $this->db->bind(2, 1);

           $get= $this->db->execute();
           if(!empty($get)){
                return true;
           }else{
                return false;
           }
            
        } catch (Exception $e) {
            return "Programa_set_programas_DATABASE ERROR";
        }
    }
    
    
     /**
     * @author senov
     * Actualiza los datos de los programas de formación
     */

    public function update_modalidad($datos)
    {
        try {

           $sql="UPDATE `modalidad` SET modalidad = ? WHERE id_modalidad = ?"; 
           

           $this->db->query($sql);
           $this->db->bind(1, $datos["nombre"]);
           $this->db->bind(2, $datos["id"]);

           if($this->db->execute()){
                return true;
           }else{
                return false;
           }
            
        } catch (Exception $e) {
            return "Programa_update_programas_DATABASE ERROR";
        }
    }


     /**
     * @author senov
     * Actualiza el estado de un programa para que los usuario no lo puedan ver
     */

    public function deshabilitar_modalidad($id,$estado)
    {
        try {

           $sql="UPDATE `modalidad` SET `estado`= ? WHERE id_modalidad = ?"; 
           

           $this->db->query($sql);
           $this->db->bind(1, $estado);
           $this->db->bind(2, $id);

           $get= $this->db->execute();
           if(!empty($get)){
                return true;
           }else{
                return false;
           }
            
        } catch (Exception $e) {
            return "Programa_deshabilitar_programas_DATABASE ERROR";
        }
    }

    /**
     * @author senov
     * Actualiza el estado de un programa para que los usuario lo puedan ver
     */

    public function habilitar_Tipo_Formacion($id)
    {
        try {

           $sql="UPDATE `programa_formacion` SET `estado` = ?"; 
           

           $this->db->query($sql);
           $this->db->bind(1, 1);

           $get= $this->db->execute();
           if(!empty($get)){
            return "<script>swal({
                type: 'success',
                title: 'Exito!',
                text: 'Ha logrado habilitar el programa correctamente!',
            })</script>";
           }else{
            return "<script>swal({
                type: 'error',
                title: 'Opps..',
                text: 'No se pudo habilitar el programa indicado',
            })</script>";
           }
            
        } catch (Exception $e) {
            return "Programa_set_programas_DATABASE ERROR";
        }
    }
    
}