<?php

class Controller 
{
    protected function view($v,$data = [], $data2 = [], $data3 = []){
        $title = explode('/',$v);
        $title = ucwords($title[0]);

        if(file_exists('../app/views/'.strtolower($v).'.php')){
            include_once '../app/views/all/header.php';
            #--
                //if (isset($_SESSION['user'])) { require_once sidebar_p1;}
            #--
            include_once '../app/views/'.strtolower($v).'.php';
            #--
                //if (isset($_SESSION['user'])) { require_once sidebar_p2;}
            #--
            include_once '../app/views/all/footer.php';
        }else{
            die('<b>Message:</b> 404 - View not found.');
        }
    }
//ya weee porfavoooo >:v

    protected function model($m){
        $m = ucwords($m).'Model';
        if(file_exists('../app/models/'.$m.'.php')){
            include_once '../app/models/'.$m.'.php';
            return new $m;
        }else{
            die('<b>Message:</b> 404 - Model not found.');
        }
    }

    protected function cleanData($data){
        $data = trim($data);
        $data = filter_var($data,FILTER_SANITIZE_STRING);
        $data = strip_tags($data);
        $data = htmlspecialchars($data);
        $data = strtoupper($data);
       
        return $data;
    }


    function fecha_utc() {
        date_default_timezone_set("UTC");
        return date("Y-m-d H:i:s", time());
        }
        //ejemplo
         //fecha_utc(); //retorna la fecha UTC
        
    function fecha_local( $string, $format = 'Y-m-d H:i:s' ) {
        $tz = 'UTC';
        $datetime = date_create( $string, new DateTimeZone( $tz ) );
        if ( ! $datetime ) {
        return gmdate( $format, 0 );
        }
        //Cambiar America/Mexico_City por la zona horaria (local)
        $datetime->setTimezone( new DateTimeZone( 'America/Bogota' ) );
        $string_gmt = '|'.$datetime->format( $format );
        
        return $string_gmt;
    }
    public function fecha(){
        //ejemplo
        $this->fecha_local($this->fecha_utc()); //convierte la fecha UTC a local
        //Si queremos sólo la fecha, sin hora, cambiamos un poco el formato…
        $this->fecha_local($this->fecha_utc(), '/Y/m/d'); //Retorna año,mes y día 2016/07/0  4  
        $fecha=explode('|',$this->fecha_local($this->fecha_utc()));
        //var_dump($fecha);
        $fechal= $fecha["1"];
        return$fechal;

    }


}
