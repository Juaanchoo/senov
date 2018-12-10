<?php

class AdminController extends Controller
{
    private $adminModel;
    private $rolModel;
    private $loginModel;
    private $rol;
    private $tablasModel;

     /**
     * @author senov
     * método constructor
     * @return respuesta de éxito o error
     */
    function __construct(){
        Security::auth('Administrador');
        $this->adminModel = $this->model("admin");
        $this->rolModel = $this->model("rol");
        $this->loginModel = $this->model("login");
        $this->tablasModel = $this->model("tablas");
        $this->rol = $this->rolModel->get_Roles($_SESSION["documento"]);
    }

     /**
     * @author senov
     * ir a la vista
     * @return respuesta de éxito o error
     */
    public function index(){
        $this->view('admin/home', $this->rol);
    }

     /**
     * @author senov
     * Mostrar en la vista todas las novedades
     */
    public function estado_novedad($id = null){
        $get = $this->adminModel->getNovedad();
        if ($id==null) {
            $this->view('admin/estado_novedad', $this->rol, $get);
        }else{
            $getOne = $this->adminModel->get_One_Novedad($id);
            $this->view('admin/estado_novedad', $this->rol, $get, $getOne);
        }
    }

     /**
     * @author senov
     * Hacer una nueva novedad, válidar por medio de llamada
     * a otros métodos y por último cargar vistas
     * @return respuesta de éxito o error
     */
    public function nueva_Novedad()
    {
        $error="";
        $success="";
        $mensaje="";
        $per="";

        $td = $this->loginModel->all_Tipo_Documento();
        $ficha = $this->tablasModel->get_Fichas();
        $tn = $this->adminModel->get_Tipo_Novedad();
        $jor= $this->tablasModel->get_Jornada();
        $datos = array ("tipos_documento" => $td,
                        "fichas" => $ficha,
                        "tipo_novedades" => $tn,
                        "jornada" => $jor);


        if(isset($_POST["documento"])){
            if(isset($_POST["documento"]) && isset($_POST["tipo_documento"]) && isset($_POST["tipo_novedad"]) && isset($_POST["motivo"]) && isset($_POST["comentarios"]) && isset($_POST["recomendaciones"]) && isset($_POST["evidencias"])){
                /**
                 *Preguntar si hay una novedad existente para el documento
                 */
                if($this->adminModel->get_Novedad_Aprendiz($_POST["documento"])){
                    //cuando viene nueva ficha
                    if(isset($_POST["nueva_ficha"])){
                        $info_nov = array (
                            "tipo_documento" => $this->cleanData($_POST["tipo_documento"]),
                            "documento" => $this->cleanData($_POST["documento"]),
                            "tipo_novedad" => $this->cleanData($_POST["tipo_novedad"]),
                            "motivo" => $this->cleanData($_POST["motivo"]),
                            "comentarios" => $this->cleanData($_POST["comentarios"]),
                            "recomendaciones" => $this->cleanData($_POST["recomendaciones"]),
                            "evidencias" => $this->cleanData($_POST["evidencias"]),
                            "nueva_ficha" => $this->cleanData($_POST["nueva_ficha"]),
                            "fecha_inicio" => $this->fecha()
                        );
    
                        $per =$this->tablasModel->get_Permiso_Aprendiz($_POST["documento"], $_POST["tipo_documento"]);
                        if($per === true){
                            
                            $res = $this->adminModel->set_Novedad_Ficha($info_nov);
                            $this->view('admin/nueva_novedad', $this->rol, $datos, $res);
                        }else{
                            $this->view('admin/nueva_novedad', $this->rol, $datos, $per);
                        }
                    }
                    //cuando viene nueva jornada
                    if(isset($_POST["nueva_jornada"])){
                        $info_nov = array (
                            "tipo_documento" => $this->cleanData($_POST["tipo_documento"]),
                            "documento" => $this->cleanData($_POST["documento"]),
                            "tipo_novedad" => $this->cleanData($_POST["tipo_novedad"]),
                            "motivo" => $this->cleanData($_POST["motivo"]),
                            "comentarios" => $this->cleanData($_POST["comentarios"]),
                            "recomendaciones" => $this->cleanData($_POST["recomendaciones"]),
                            "evidencias" => $this->cleanData($_POST["evidencias"]),
                            "nueva_jornada" =>  $this->cleanData($_POST["nueva_jornada"]),
                            "fecha_inicio" => $this->fecha()
                        );
                        $per =$this->tablasModel->get_Permiso_Aprendiz($_POST["documento"], $_POST["tipo_documento"]);
                        if($per === true){
                            
                            $res = $this->adminModel->set_Novedad_Jornada($info_nov);
                            $this->view('admin/nueva_novedad', $this->rol, $datos, $res);
                        }else{
                            $this->view('admin/nueva_novedad', $this->rol, $datos, $per);
                        }
                    }

                    //cuando no viene ni nueva_jornada ni nueva_ficha
                    if(!isset($_POST["nueva_jornada"]) && !isset($_POST["nueva_ficha"]))
                    {
                        $info_nov = array (
                            "tipo_documento" => $this->cleanData($_POST["tipo_documento"]),
                            "documento" => $this->cleanData($_POST["documento"]),
                            "tipo_novedad" => $this->cleanData($_POST["tipo_novedad"]),
                            "motivo" => $this->cleanData($_POST["motivo"]),
                            "comentarios" => $this->cleanData($_POST["comentarios"]),
                            "recomendaciones" => $this->cleanData($_POST["recomendaciones"]),
                            "evidencias" => $this->cleanData($_POST["evidencias"]),
                            "fecha_inicio" => $this->fecha()
                        );
                        $per =$this->tablasModel->get_Permiso_Aprendiz($_POST["documento"], $_POST["tipo_documento"]);
                        //var_dump($per);
                        if($per === true){
                            
                            $res = $this->adminModel->set_Novedad($info_nov);
                            $this->view('admin/nueva_novedad', $this->rol, $datos, $res);
                        }else{
                            $this->view('admin/nueva_novedad', $this->rol, $datos, $per);
                        }
                    }
                }else{
                    $res = "<script>swal({
                        type: 'error',
                        title: 'Opps..',
                        text: 'Ya existe una novedad de este documento',
                        })</script>";
                $this->view('admin/nueva_novedad', $this->rol, $datos, $res);
                }
            }else{
                $res = "<script>swal({
                        type: 'error',
                        title: 'Opps..',
                        text: 'Falta ingresar información en los campos de texto',
                        })</script>";
                $this->view('admin/nueva_novedad', $this->rol, $datos, $res);
            }
        }else{
            if(!isset($_POST["documento"])){
                $this->view('admin/nueva_novedad', $this->rol, $datos);
            }
        }
    }
    
    /**
     * @author senov
     * Cerrar la sesión y lleva al inicio
     */
    public function logout(){
        unset($_SESSION['user']);
        session_destroy();
        header('location: '.URL_APP.'/');
    } 
}