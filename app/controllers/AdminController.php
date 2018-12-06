<?php

class AdminController extends Controller
{
    private $adminModel;
    private $rolModel;
    private $rol;

    function __construct(){
        Security::auth('Administrador');
        $this->adminModel = $this->model("admin");
        $this->rolModel = $this->model("rol");
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
        $this->view('admin/nueva_novedad', $this->rol);
    }

    public function logout(){
        unset($_SESSION['user']);
        session_destroy();
        header('location: '.URL_APP.'/');
    } 
}