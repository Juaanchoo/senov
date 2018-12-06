<?php

class FichaModel extends DataBase{
    private $db;

    function __construct()
    {
        $this->db = new DataBase;
    }

    public function get_Fichas()
    {
        try {
            
            $sql="SELECT * FROM fichas";
            $this->db->query($sql);
            return $this->db->getAll();    

        } catch (Exception $e) {
            return "DATA BASE ERROR";
        }
    }
}