<?php 

class TipoformacionModel extends DataBase
{
	private $db;

	function __construct(){
		$this->db = new DataBase();
    }
    
    /**
     * @author senov
     * traer todos los programas de formación
     */

     public function get_Tipos_Formacion()
     {
         try {

            $sql="SELECT *FROM tipo_formacion WHERE estado = ?";

            $this->db->query($sql);
            $this->db->bind(1, 1);

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

    public function get_One_Tipo_Formacion($id)
    {
        try {

           $sql="SELECT pf.id_programa_formacion, pf.programa_formacion, pf.fk_id_tipo_formacion, 
           tf.tipo_formacion, pf.estado AS estado_programa FROM programa_formacion AS pf 
           INNER JOIN tipo_formacion AS tf ON pf.fk_id_tipo_formacion=tf.id_tipo_formacion WHERE pf.estado = ? AND pf.id_programa_formacion = ?";

           $this->db->query($sql);
           $this->db->bind(1, 1);
           $this->db->bind(2, $id);

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
     * ingresar nuevos programas de formación
     */

    public function set_Tipo_Formacion($datos)
    {
        try {

           $sql="INSERT INTO `programa_formacion`(`programa_formacion`, `fk_id_tipo_formacion`) VALUES (?,?)"; 
           

           $this->db->query($sql);
           $this->db->bind(1, $datos["programa_formacion"]);
           $this->db->bind(2, $datos["tipo_formacion"]);

           $get= $this->db->execute();
           if(!empty($get)){
                return "<script>swal({
                    type: 'success',
                    title: 'Exito!',
                    text: 'Ha logrado registrar el programa correctamente!',
                })</script>";
           }else{
                return "<script>swal({
                    type: 'error',
                    title: 'Opps..',
                    text: 'No se pudo registrar el programa indicado',
                })</script>";
           }
            
        } catch (Exception $e) {
            return "Programa_set_programas_DATABASE ERROR";
        }
    }
    
    
     /**
     * @author senov
     * Actualiza los datos de los programas de formación
     */

    public function update_Tipo_Formacion($datos)
    {
        try {

           $sql="UPDATE `programa_formacion` SET `programa_formacion` = ?, `fk_id_tipo_formacion` = ? WHERE id_programa_formacion = ?"; 
           

           $this->db->query($sql);
           $this->db->bind(1, $datos["programa_formacion"]);
           $this->db->bind(2, $datos["tipo_formacion"]);
           $this->db->bind(3, $datos["id_programa_formacion"]);

           $get= $this->db->execute();
           if(!empty($get)){
                return "<script>swal({
                    type: 'success',
                    title: 'Exito!',
                    text: 'Ha logrado actualizar el programa correctamente!',
                })</script>";
           }else{
                return "<script>swal({
                    type: 'error',
                    title: 'Opps..',
                    text: 'No se pudo actualizar el programa indicado',
                })</script>";
           }
            
        } catch (Exception $e) {
            return "Programa_update_programas_DATABASE ERROR";
        }
    }


     /**
     * @author senov
     * Actualiza el estado de un programa para que los usuario no lo puedan ver
     */

    public function deshabilitar_Tipo_Formacion($id)
    {
        try {

           $sql="UPDATE `programa_formacion` SET `estado` = ?"; 
           

           $this->db->query($sql);
           $this->db->bind(1, 0);

           $get= $this->db->execute();
           if(!empty($get)){
                return "<script>swal({
                    type: 'success',
                    title: 'Exito!',
                    text: 'Ha logrado deshabilitar el programa correctamente!',
                })</script>";
           }else{
                return "<script>swal({
                    type: 'error',
                    title: 'Opps..',
                    text: 'No se pudo deshabilitar el programa indicado',
                })</script>";
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