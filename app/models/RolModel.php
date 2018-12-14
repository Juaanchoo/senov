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
    public function get_Roles_Usuarios()
    {
        try {
            $sql="SELECT pc.id_permiso, pc.fk_id_cargo, tc.cargo, usu.documento, usu.nombre, usu.primer_apellido, 
            usu.estado AS estado_usuario FROM permiso_cargo AS pc 
            INNER JOIN usuarios_admin AS usu ON pc.fk_documento=usu.documento 
            INNER JOIN tipo_cargo AS tc ON tc.id_cargo = pc.fk_id_cargo WHERE usu.estado = ? 
            ORDER By usu.documento ASC";

            $this->db->query($sql);
            $this->db->bind(1,1);

            $get = $this->db->getAll();

            if(!empty($get)){
                return $get;
            }else{
                return "<script>swal({
                    type: 'error',
                    title: 'Opps..',
                    text: 'No se pudo obtener los roles',
                })</script>";
            }

        } catch (Exception $e) {
            return "Rol_get_Roles_Usuario_DATABASE ERROR";
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