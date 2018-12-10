<?php
class AprendizModel extends DataBase{
    private $db;

    function __construct()
    {
        $this->db = new DataBase;
    }

    /**
     * @author senov
     * Obtener el permiso de aprendiz
     * @return respuesta de éxito o error
     */

    public function get_Permiso_Aprendices()
    {
        try {
            //code...
        } catch (Exception $e) {
            return "Admin_get_Aprendices_DATA BASE ERROR";
        }
    }

    /**
     * @author senov
     * Obtener todos los aprendices
     * @return respuesta de éxito o error
     */

    public function get_Aprendices()
    {
        try {
            $sql="SELECT td.`tipo_documento`, usu.`documento`, usu.`nombre`, usu.`primer_apellido`, 
            usu.`segundo_apellido`, usu.`email`, usu.`telefono`, usu.`fk_id_ficha`, usu.`estado` 
            FROM `usuarios_admin` AS usu INNER JOIN permiso_cargo AS pc ON usu.documento=pc.fk_documento 
            INNER JOIN tipo_documento AS td ON usu.fk_id_tipo_documento=td.id_tipo_documento 
            WHERE pc.fk_id_cargo=?";

            $this->db->query($sql);
            $this->db->bind(1, 5);
            return $this->db->getAll();

        } catch (Exception $e) {
            return "Admin_get_Aprendices_DATA BASE ERROR";
        }
    }

    /**
     * @author senov
     * Obtener todos un aprendiz según documento
     * @return respuesta de éxito o error
     */
    public function get_One_Aprendiz($documento)
    {
        try {

            //var_dump($documento);
            $sql="SELECT td.`tipo_documento`, usu.`documento`, usu.`nombre`, usu.`primer_apellido`, 
            usu.`segundo_apellido`, usu.`email`, usu.`telefono`, usu.`fk_id_ficha`, usu.`estado` 
            FROM `usuarios_admin` AS usu INNER JOIN permiso_cargo AS pc ON usu.documento=pc.fk_documento 
            INNER JOIN tipo_documento AS td ON usu.fk_id_tipo_documento=td.id_tipo_documento 
            WHERE pc.fk_id_cargo=5 AND usu.documento= ?";

            $this->db->query($sql);
            $this->db->bind(1, $documento);
            $get = $this->db->getOne();
            if($get==true){
                return $get;
            }else{
                return false;
            }
            
        } catch (Exception $e) {
            return "Admin_get_Aprendices_DATA BASE ERROR";
        }
    }

    /**
     * @author senov
     * Insertar a la base de datos a un aprendiz
     * @return respuesta de éxito o error
     */
    public function set_Aprendiz($datos)
    {
        try {
            //code...
        } catch (Exception $e) {
            return "Admin_get_Aprendices_DATA BASE ERROR";
        }
    }

    /**
     * @author senov
     * Actualiza en la base de datos a un aprendiz
     * @return respuesta de éxito o error
     */
    public function update_Aprendiz($datos)
    {
        try {
            //var_dump($datos);
            $sql = "UPDATE usuarios_admin SET nombre=?, primer_apellido=?, segundo_apellido=?, email=?, 
                    telefono=? WHERE documento=?";
            $this->db->query($sql);
            $this->db->bind(1, $datos["nombre"]);
            $this->db->bind(2, $datos["primer_apellido"]);
            $this->db->bind(3, $datos["segundo_apellido"]);
            $this->db->bind(4, $datos["email"]);
            $this->db->bind(5, $datos["telefono"]);
            $this->db->bind(6, $datos["documento"]);
            if($this->db->execute()){
                return "<script>swal({
                    type: 'success',
                    title: 'Éxito',
                    text: 'Se han actualizado los datos correctamente',
                })</script>";
            }else{
                return "<script>swal({
                    type: 'error',
                    title: 'Opps..',
                    text: 'Ocurrió un error al intentar actualizar',
                })</script>";
            }

        } catch (Exception $e) {
            return "Admin_get_Aprendices_DATA BASE ERROR";
        }
    }
}
?>