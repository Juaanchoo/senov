<?php 

class CompetenciaModel extends DataBase
{
	private $db;

	function __construct(){
		$this->db = new DataBase();
    }
    
    /**
     * @author senov
     * traer todos los programas de formación
     */

     public function get_competencia()
     {
         try {

            $sql="SELECT 
            com.id_competencia, 
            com.competencia, 
            com.fk_id_programa, 
            com.estado,
            pf.programa_formacion
            FROM competencias AS com 
            INNER JOIN programa_formacion AS pf 
            ON 
            com.fk_id_programa = pf.id_programa_formacion";

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

    public function get_One_competencia($id)
    {
        try {

           $sql="SELECT * FROM competencias WHERE id_competencia = ?";

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

    public function set_competencia($datos)
    {
        try {

           $sql="INSERT INTO competencias (competencia, fk_id_programa, trimestre_diurno, trimestre_especial) VALUES (?,?,?,?)"; 
           

           $this->db->query($sql);
           $this->db->bind(1, $datos['nombre']);
           $this->db->bind(2, $datos['programa']);
           $this->db->bind(3, 1);
           $this->db->bind(4, 1);

           if($this->db->execute()){
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

    public function update_competencia($datos)
    {
        try {

           $sql="UPDATE `competencias` SET competencia = ?, fk_id_programa=? WHERE id_competencia = ?"; 
           

           $this->db->query($sql);
           $this->db->bind(1, $datos['nombre']);
           $this->db->bind(2, $datos['programa']);
           $this->db->bind(3, $datos["id"]);

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

    public function deshabilitar_competencia($id,$estado)
    {
        try {

           $sql="UPDATE `competencias` SET `estado`= ? WHERE id_competencia = ?"; 
           

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