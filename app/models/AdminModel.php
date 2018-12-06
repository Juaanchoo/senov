<?php

class AdminModel extends DataBase{
    private $db;

    function __construct()
    {
        $this->db = new DataBase;
    }

    public function getNovedad()
    {
        try {
            $sql="SELECT td.tipo_documento, nov.id_novedad, nov.documento, nov.nombre, nov.primer_apellido, nov.segundo_apellido, nov.email, 
            nov.telefono, fi.codigo_ficha, tn.novedad, nov.acta_novedad, nov.fecha_inicio, nov.fecha_final, es.estado 
            FROM novedades AS nov INNER JOIN tipo_documento AS td ON nov.fk_id_tipo_documento=td.id_tipo_documento 
            INNER JOIN fichas AS fi ON nov.fk_id_ficha=fi.codigo_ficha 
            INNER JOIN tipo_novedad AS tn ON nov.fk_id_tipo_novedad=tn.id_novedad  
            INNER JOIN estado_novedad AS es ON nov.fk_id_estado=es.id_estado 
            WHERE nov.estado=?";
            $this->db->query($sql);
            $this->db->bind(1,1);
            $datos = $this->db->getAll();
            return $datos;
            
        } catch (Exception $e) {
            return "error";
        }
    }

    public function get_One_Novedad($id)
    {
        try{
            $sql="SELECT td.tipo_documento, nov.id_novedad, nov.documento, nov.nombre, nov.primer_apellido, nov.segundo_apellido, nov.email, 
            nov.telefono, fi.codigo_ficha, tn.novedad, nov.acta_novedad, nov.fecha_inicio, nov.fecha_final, es.estado 
            FROM novedades AS nov INNER JOIN tipo_documento AS td ON nov.fk_id_tipo_documento=td.id_tipo_documento 
            INNER JOIN fichas AS fi ON nov.fk_id_ficha=fi.codigo_ficha 
            INNER JOIN tipo_novedad AS tn ON nov.fk_id_tipo_novedad=tn.id_novedad  
            INNER JOIN estado_novedad AS es ON nov.fk_id_estado=es.id_estado 
            WHERE nov.id_novedad=?";

            $this->db->query($sql);
            $this->db->bind(1,$id);
            $datos = $this->db->getOne();
            return $datos;
        } catch(Exception $e){
            return "error";
        }
    }
}


?>