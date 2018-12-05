<?php

class AdminModel extends DataBase{
    private $db;

    function __construct()
    {
        $this->db = new DataBase;
    }

    public function getNovedad()
    {
        $sql = "SELECT nov.id_novedad, nov.documento, nov.nombre, nov.apellido, tn.novedad 
        FROM novedades AS nov 
        INNER JOIN tipo_novedad AS tn 
        ON nov.fk_id_tipo_novedad=tn.id_novedad WHERE nov.estado = ?";
        // //SUPER HIPER MEGA CONSULTA XD :'v
        // $sql2 = "SELECT td.tipo_documento, nov.id_novedad, nov.documento, nov.nombre, nov.apellido, nov.email, 
        // nov.telefono, fi.codigo_ficha, tn.novedad, ta.formato, nov.fecha_inicio, nov.fecha_final,es.estado, rae.resultado_aprendizaje 
        // FROM novedades AS nov INNER JOIN tipo_documento AS td ON nov.fk_id_tipo_documento=td.id_tipo_documento 
        // INNER JOIN fichas AS fi ON nov.fk_id_ficha=fi.codigo_ficha 
        // INNER JOIN tipo_novedad AS tn ON nov.fk_id_tipo_novedad=tn.id_novedad 
        // INNER JOIN tipo_acta AS ta ON nov.fk_id_acta=ta.id_formato 
        // INNER JOIN estado_novedad AS es ON nov.fk_id_estado=es.id_estado 
        // INNER JOIN resultados_aprendizaje as rae ON nov.fk_id_resultado=rae.id_resultado_aprendizaje WHERE nov.estado=?";
        $this->db->query($sql);
        $this->db->bind(1,1);
        $datos = $this->db->getAll();
        return $datos;
    }
}


?>