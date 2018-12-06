<?php

class AdminController extends Controller
{
    private $adminModel;
    private $rolModel;
    private $loginModel;
    private $rol;
    private $fichaModel;

    function __construct(){
        Security::auth('Administrador');
        $this->adminModel = $this->model("admin");
        $this->rolModel = $this->model("rol");
        $this->loginModel = $this->model("login");
        $this->fichaModel = $this->model("ficha");
        $this->rol = $this->rolModel->get_Roles($_SESSION["documento"]);
    }
    public function index(){
        $this->view('admin/home', $this->rol);
    }

    public function estado_novedad($id = null){
        $get = $this->adminModel->getNovedad();
        if ($id==null) {
            $this->view('admin/estado_novedad', $this->rol, $get);
        }else{
            $getOne = $this->adminModel->get_One_Novedad($id);
            $this->view('admin/estado_novedad', $this->rol, $get, $getOne);
        }
    }


    public function nueva_Novedad()
    {
        $td = $this->loginModel->all_Tipo_Documento();
        $ficha = $this->fichaModel->get_Fichas();
        $tn = $this->adminModel->get_Tipo_Novedad();

        $datos = array ("tipos_documento" => $td,
                        "fichas" => $ficha,
                        "tipo_novedades" => $tn);
        $this->view('admin/nueva_novedad', $this->rol, $datos);
    }

    public function logout(){
        unset($_SESSION['user']);
        session_destroy();
        header('location: '.URL_APP.'/');
    } 
}