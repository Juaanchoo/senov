<?php

class RolModel extends DataBase{
    private $db;

    function __construct()
    {
        $this->db = new DataBase;
    }


    /**
     * @author Juan
     * Obtiene todos los roles de la base de datos
     * @return objetos
     */
    public function get_Roles($documento)
    {
        try {
            $sql="SELECT tc.cargo, pc.fk_id_cargo, pc.fk_documento FROM permiso_cargo AS pc 
            INNER JOIN tipo_cargo AS tc 
            ON tc.id_cargo=pc.fk_id_cargo WHERE pc.fk_documento = ?";
    
            $this->db->query($sql);
            $this->db->bind(1, $documento);
            $datos = $this->db->getAll();
            return $datos;
            
        } catch (Exception $e) {
            return "Error";
        }
    }

    
    /**
     * @author Juan
     * asigna nuevos roles a los usuarios
     * @return objetos
     */    
    public function set_Roles($documento)
    {

    }

    
    /**
     * @author Juan
     * elimina o deshabilita un rol de un usuario
     * @return objetos
     */
    public function delete_Roles(Type $var = null)
    {
        # code...
    }
}

?>