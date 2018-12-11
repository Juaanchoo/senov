<?php

class AdminModel extends DataBase{
    private $db;

    function __construct()
    {
        $this->db = new DataBase;
    }

    /**
     * @author senov
     * Obtener todas las novedades
     * @return respuesta de éxito o error
     */
    public function getNovedad()
    {
        try {
            $sql="SELECT nov.id_novedad, nov.documento, us.nombre, us.primer_apellido, 
            us.segundo_apellido, us.`fk_id_ficha`, tn.novedad, nov.`estado` 
            FROM `novedades` AS nov INNER JOIN usuarios_admin AS us on us.documento = nov.documento 
            INNER JOIN permiso_cargo as per ON us.documento=per.fk_documento 
            INNER JOIN tipo_cargo as tc ON per.fk_id_cargo=tc.id_cargo 
            INNER JOIN tipo_novedad AS tn ON nov.fk_id_tipo_novedad=tn.id_novedad 
            WHERE tc.id_cargo=5";

            $this->db->query($sql);
            $this->db->bind(1,1);
            $datos = $this->db->getAll();
            return $datos;
            
        } catch (Exception $e) {
            return "Admin_getNovedad_DATA BASE ERROR";
        }
    }

    /**
     * @author senov
     * Ingresar una novedad que contenga el dato de ficha nueva
     * @return respuesta de éxito o error
     */
    public function set_Novedad_ficha($data)
    {
        try {

            //var_dump($data);
            $sql="INSERT INTO novedades (`fk_id_tipo_documento`, `documento`,  `fk_id_tipo_novedad`, 
            `motivo`, `comentarios`, `recomendaciones`, `evidencias`,  `nueva_ficha`, `fecha_inicio`, 
            `fk_id_estado`) VALUES(?,?,?,?,?,?,?,?,?,?)";

            $this->db->query($sql);
            $this->db->bind(1, $data["tipo_documento"]);
            $this->db->bind(2, $data["documento"]);
            $this->db->bind(3, $data["tipo_novedad"]);
            $this->db->bind(4, $data["motivo"]);
            $this->db->bind(5, $data["comentarios"]);
            $this->db->bind(6, $data["recomendaciones"]);
            $this->db->bind(7, $data["evidencias"]);
            $this->db->bind(8, $data["nueva_ficha"]);
            $this->db->bind(9, $data["fecha_inicio"]);
            $this->db->bind(10, 1);
            if($this->db->execute()){
                return "<script>swal({
                    type: 'success',
                    title: 'Exito!',
                    text: 'Ha logrado registrar la novedad correctamente!',
                    showConfirmButton: false
                })</script>";
            }else{
                return "<script>swal({
                    type: 'error',
                    title: 'Opps..',
                    text: 'Error al Registrar, revise todos los datos',
                })</script>";
            }

        } catch (Exception $e) {
            return "Admin_set_Novedad_Ficha_DATA BASE ERROR";
        }
    }

    /**
     * @author senov
     * Ingresar una novedad que contenga el dato de jornada nueva
     * @return respuesta de éxito o error
     */
    public function set_Novedad_jornada($data)
    {
        try {

            $sql="INSERT INTO novedades (`fk_id_tipo_documento`, `documento`,  `fk_id_tipo_novedad`, 
            `motivo`, `comentarios`, `recomendaciones`, `evidencias`,  `nueva_jornada`, `fecha_inicio`, 
            `fk_id_estado`) VALUES(?,?,?,?,?,?,?,?,?,?)";

            $this->db->query($sql);
            $this->db->bind(1, $data["tipo_documento"]);
            $this->db->bind(2, $data["documento"]);
            $this->db->bind(3, $data["tipo_novedad"]);
            $this->db->bind(4, $data["motivo"]);
            $this->db->bind(5, $data["comentarios"]);
            $this->db->bind(6, $data["recomendaciones"]);
            $this->db->bind(7, $data["evidencias"]);
            $this->db->bind(8, $data["nueva_jornada"]);
            $this->db->bind(9, $data["fecha_inicio"]);
            $this->db->bind(10, 1);
            if($this->db->execute()){
                return "<script>swal({
                    type: 'success',
                    title: 'Exito!',
                    text: 'Ha logrado registrar la novedad correctamente!',
                    showConfirmButton: false
                })</script>";
            }else{
                return "<script>swal({
                    type: 'error',
                    title: 'Opps..',
                    text: 'Error al Registrar, revise todos los datos',
                })</script>";
            }
            
        } catch (Exception $e) {
            return "Admin_set_Novedad_Jornada_DATA BASE ERROR";
        }
    }

    /**
     * @author senov
     * Ingresar una novedad 
     * @return respuesta de éxito o error
     */
    public function set_Novedad($data)
    {
        

            $sql="INSERT INTO novedades (`fk_id_tipo_documento`, `documento`, `fk_id_tipo_novedad`, 
            `motivo`, `comentarios`, `recomendaciones`, `evidencias`, `fecha_inicio`, 
            `fk_id_estado`) VALUES(?,?,?,?,?,?,?,?,?)";

            $this->db->query($sql);
            $this->db->bind(1, $data["tipo_documento"]);
            $this->db->bind(2, $data["documento"]);
            $this->db->bind(3, $data["tipo_novedad"]);
            $this->db->bind(4, $data["motivo"]);
            $this->db->bind(5, $data["comentarios"]);
            $this->db->bind(6, $data["recomendaciones"]);
            $this->db->bind(7, $data["evidencias"]);
            $this->db->bind(8, $data["fecha_inicio"]);
            $this->db->bind(9, 1);
            if($this->db->execute()){
                return "<script>swal({
                    type: 'success',
                    title: 'Exito!',
                    text: 'Ha logrado registrar la novedad correctamente!',
                    showConfirmButton: false
                })</script>";
            }else{
                return "<script>swal({
                    type: 'error',
                    title: 'Opps..',
                    text: 'Error al Registrar, revise todos los datos',
                })</script>";
            }
            
        
    }

    /**
     * @author senov
     * Obtener los tipos de novedad 
     * @return respuesta de éxito o error
     */
    public function get_Tipo_Novedad()
    {
        try {
            $sql="SELECT * FROM tipo_novedad";
            $this->db->query($sql);
            return $this->db->getAll();
            
        } catch (Exception $e) {
            return "Admin_get_tipo_novedad_DATA BASE ERROR";
        }
    }

     /**
     * @author senov
     * Observar si en la base de datos hay una novedad existente con ese documento
     * @return respuesta de éxito o error
     */
    public function get_Novedad_Aprendiz($documento)
    {
        try {
            $sql="SELECT * FROM novedades WHERE documento=?";
            $this->db->query($sql);
            $get = $this->db->getOne();
            if(empty($get)){
                return true;
            }else{
                return false;
            }
            
        } catch (Exception $e) {
            return "Admin_get_Novedad_Aprendiz_DATA BASE ERROR";
        }
    }

    /**
     * @author senov
     * Obtener una novedad según id
     * @return respuesta de éxito o error
     */
    public function get_One_Novedad($id)
    {
        try{
            $sql="SELECT td.tipo_documento, nov.id_novedad, nov.documento, us.nombre, us.primer_apellido, 
            us.segundo_apellido, us.email, us.telefono, us.`fk_id_ficha`, tn.novedad,  nov.`motivo`, 
            nov.`comentarios`, nov.`recomendaciones`, 
            nov.`evidencias`, nov.`nueva_jornada`, nov.`nueva_ficha`, nov.`fecha_inicio`, 
            nov.`fecha_final`, en.estado_novedad, nov.`estado` 
            FROM `novedades` AS nov INNER JOIN usuarios_admin AS us on us.documento = nov.documento 
            INNER JOIN permiso_cargo as per ON us.documento=per.fk_documento 
            INNER JOIN tipo_cargo as tc ON per.fk_id_cargo=tc.id_cargo 
            INNER JOIN tipo_documento AS td ON nov.fk_id_tipo_documento=td.id_tipo_documento 
            INNER JOIN tipo_novedad AS tn ON nov.fk_id_tipo_novedad=tn.id_novedad 
            INNER JOIN estado_novedad as en ON nov.fk_id_estado=en.id_estado WHERE tc.id_cargo = ? AND nov.id_novedad = ?";

            $this->db->query($sql);
            $this->db->bind(1,5);
            $this->db->bind(2,$id);
            $datos = $this->db->getOne();
            return $datos;
        } catch(Exception $e){
            return "Admin_get_One_Novedad_DATA BASE ERRORr";
        }
    }

    public function PDF_Aplazamiento($id){
        try{
            $this->db->query(
            "SELECT * FROM novedades AS n INNER join usuarios_admin AS usu on n.documento=usu.documento 
            INNER JOIN fichas AS f on usu.fk_id_ficha=f.id_ficha 
            INNER JOIN programa_formacion As pf on f.fk_id_programa_formacion=pf.id_programa_formacion 
            INNER JOIN jornada AS j on f.fk_id_jornada=j.id_jornada 
            INNER JOIN sede AS s on f.fk_id_sede= s.id_sede 
            INNER join tipo_documento AS td on usu.fk_id_tipo_documento = td.id_tipo_documento 
            WHERE id_novedad=?");
            $this->db->bind(1,$id);
            $resultado=$this->db->getOne();
            return $resultado;
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }

    /**
     * @author senov
     * Cuenta las novedades en estado "En tramite"
     */
    public function contar_novedad()
    { 
        try{
            $s = "SELECT * FROM novedades AS n INNER join usuarios_admin AS usu on n.documento=usu.documento INNER JOIN fichas AS f on usu.fk_id_ficha=f.id_ficha INNER JOIN programa_formacion As pf on f.fk_id_programa_formacion=pf.id_programa_formacion INNER JOIN jornada AS j on f.fk_id_jornada=j.id_jornada INNER JOIN sede AS s on f.fk_id_sede= s.id_sede INNER join tipo_documento AS td on usu.fk_id_tipo_documento = td.id_tipo_documento WHERE id_novedad=18";
            $sql="SELECT COUNT(*) AS counter FROM novedades WHERE fk_id_estado = ?";
            $this->db->query($sql);
            $this->db->bind(1, 1);
            return $this->db->getOne();

        }catch(Exception $e){
            return "Admin_contar_Novedad_DATABASE ERROR";
        }
    }
}


?>