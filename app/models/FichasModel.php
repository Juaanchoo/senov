<?php 

class FichasModel extends DataBase
{
	private $db;

	function __construct(){
		$this->db = new DataBase();
    }
    
    /**
     * @author senov
     * Ingresar una nueva ficha
     */

     public function get_Fichas()
     {
         try {
             $sql="SELECT fi.id_ficha, fi.fk_id_sede, se.sede, jor.jornada, mo.modalidad, pf.programa_formacion, fi.trimestre_formacion 
             FROM fichas as fi INNER JOIN sede as se ON se.id_sede = fi.fk_id_sede 
             INNER JOIN jornada as jor ON jor.id_jornada=fi.fk_id_jornada 
             INNER JOIN modalidad AS mo ON mo.id_modalidad=fi.fk_id_modalidad 
             INNER JOIN programa_formacion AS pf ON pf.id_programa_formacion=fi.fk_id_programa_formacion 
             WHERE fi.estado=?";
             $this->db->query($sql);
             $this->db->bind(1,1);
             $get = $this->db->getAll();
             if(!empty($get)){
                return $get;
             }else{
                return false;
             }
         } catch (Exception $e) {
             return "Fichas_set_Fichas_DATABASE ERROR";
         }
     }
     /**
     * @author senov
     * Ingresar una nueva ficha
     */

    public function get_One_Fichas($id)
    {
        try{
        $sql="SELECT fi.id_ficha, fi.fk_id_sede, se.sede, fi.fk_id_jornada, jor.jornada, fi.fk_id_modalidad, mo.modalidad, fk_id_programa_formacion, pf.programa_formacion, fi.trimestre_formacion 
        FROM fichas as fi INNER JOIN sede as se ON se.id_sede = fi.fk_id_sede 
        INNER JOIN jornada as jor ON jor.id_jornada=fi.fk_id_jornada 
        INNER JOIN modalidad AS mo ON mo.id_modalidad=fi.fk_id_modalidad 
        INNER JOIN programa_formacion AS pf ON pf.id_programa_formacion=fi.fk_id_programa_formacion 
        WHERE id_ficha = ? AND fi.estado=?";
        $this->db->query($sql);
        $this->db->bind(1,$id);
        $this->db->bind(2,1);
        $get = $this->db->getOne();
        if(!empty($get)){
           return $get;
        }else{
           return false;
        }
    } catch (Exception $e) {
        return "Fichas_set_Fichas_DATABASE ERROR";
    }
    }
    /**
     * @author senov
     * Ingresar una nueva ficha
     */

    public function set_Fichas($datos)
    {
        try {
            $getone = $this->get_One_Fichas($datos["ficha"]);
            if(empty($getone)){
                $sql="INSERT INTO `fichas`(`id_ficha`, `fk_id_sede`, `fk_id_jornada`, `fk_id_modalidad`, 
                `fk_id_programa_formacion`, `trimestre_formacion`) VALUES (?,?,?,?,?,?)";
    
                $this->db->query($sql);
                $this->db->bind(1,$datos["ficha"]);
                $this->db->bind(2,$datos["sede"]);
                $this->db->bind(3,$datos["jornada"]);
                $this->db->bind(4,$datos["modalidad"]);
                $this->db->bind(5,$datos["programa"]);
                $this->db->bind(6,$datos["trimestre"]);
                $get = $this->db->execute();
    
                if($get==true){
                    return "<script>swal({
                        type: 'success',
                        title: 'Exito!',
                        text: 'Ha logrado registrar la ficha correctamente!',
                    })</script>";
                }else{
                    return "<script>swal({
                        type: 'error',
                        title: 'Opps..',
                        text: 'No se pudo registrar la ficha',
                    })</script>";
                }
            }else{
                return "<script>swal({
                    type: 'error',
                    title: 'Opps..',
                    text: 'Ya existe la ficha!',
                })</script>";
            }


        } catch (Exception $e) {
            return "Fichas_set_Fichas_DATABASE ERROR";
        }
    }
    /**
     * @author senov
     * Ingresar una nueva ficha
     */

    public function update_Fichas($datos)
    {
        try {
            
            $sql="UPDATE `fichas` SET `fk_id_sede`=?, `fk_id_jornada`=?, `fk_id_modalidad`=?, 
            `fk_id_programa_formacion`=?, `trimestre_formacion`=? WHERE id_ficha = ?";

            $this->db->query($sql);
            
            $this->db->bind(1,$datos["sede"]);
            $this->db->bind(2,$datos["jornada"]);
            $this->db->bind(3,$datos["modalidad"]);
            $this->db->bind(4,$datos["programa"]);
            $this->db->bind(5,$datos["trimestre"]);
            $this->db->bind(6,$datos["ficha"]);
            $get = $this->db->execute();

            if($get==true){
                return "<script>swal({
                    type: 'success',
                    title: 'Exito!',
                    text: 'Ha logrado actualizar la ficha correctamente!',
                })</script>";
            }else{
                return "<script>swal({
                    type: 'error',
                    title: 'Opps..',
                    text: 'No se pudo actualizar la ficha',
                })</script>";
            }

        } catch (Exception $e) {
            return "Fichas_set_Fichas_DATABASE ERROR";
        }
    }
    /**
     * @author senov
     * Ingresar una nueva ficha
     */

    public function delete_Fichas($id)
    {
        try {
            //code...
        } catch (Exception $e) {
            return "Fichas_set_Fichas_DATABASE ERROR";
        }
    }
    
	
}

?>