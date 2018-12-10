<?php

class TablasModel extends DataBase{
    private $db;

    function __construct()
    {
        $this->db = new DataBase;
    }

    /**
     * @author senov
     * Saber si en la base de datos el documento cuenta con el cargo aprendiz
     * @return respuestas
     */
    public function get_Permiso_Aprendiz($documento, $tipo_documento)
    {
        try {
            if($this->get_One_Aprendiz($documento, $tipo_documento)==true){
    
                $sql="SELECT * FROM permiso_cargo WHERE fk_documento=? AND fk_id_cargo=?";
                $this->db->query($sql);
                $this->db->bind(1, $documento);
                $this->db->bind(2, 5);
                $per = $this->db->getOne();
                if($per==true){
                    return true;
                }else{
                    return "<script>swal({
                        type: 'error',
                        title: 'Opps..',
                        text: 'El documento no corresponde al de un aprendiz',
                    })</script>";
                }
            }else{
                return "<script>swal({
                    type: 'error',
                    title: 'Opps..',
                    text: 'El documento no está registrado',
                })</script>";
             }
            
        } catch (Exception $e) {
            return "Tablas_get_Permiso_Aprendiz_DATA BASE ERROR";
        }
    }

     /**
     * @author senov
     * Obtener el usuario que concuerde con el documento y el tipo
     * @return respuestas
     */
    public function get_One_Aprendiz($documento, $tipo_documento)
    {   
        try{

            $sql="SELECT * FROM usuarios_admin WHERE documento = ? AND fk_id_tipo_documento=?";
            $this->db->query($sql);
            $this->db->bind(1, $documento);
            $this->db->bind(2, $tipo_documento);
            $get = $this->db->getOne();
            if($get==true){
                return true;
            }else{
                return false;
            }
        }catch(Exception $e){
            return "Tablas_get_One_aprendiz_DATA BASE ERROR";
        }
        
        
    }

     /**
     * @author senov
     * Obtener todas las fichas
     * @return  las tuplas
     */
    public function get_Fichas()
    {
        try {
            
            $sql="SELECT * FROM fichas";
            $this->db->query($sql);
            return $this->db->getAll();    

        } catch (Exception $e) {
            return "Tablas_get_fichas_DATA BASE ERROR";
        }
    }

     /**
     * @author senov
     * Obtener las jornadas
     * @return las tuplas
     */
    public function get_Jornada()
    {
        try {
            
            $sql="SELECT * FROM jornada";
            $this->db->query($sql);
            return $this->db->getAll();    

        } catch (Exception $e) {
            return "Tablas_get_Jornada_DATA BASE ERROR";
        }
    }
}