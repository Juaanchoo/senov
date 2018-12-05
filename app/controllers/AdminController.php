<?php

class AdminController extends Controller
{
    private $adminModel;
    private $rolModel;

    function __construct(){
        Security::auth('Administrador');
        $this->adminModel = $this->model("admin");
        $this->rolModel = $this->model("rol");
    }
    public function index(){
        $rol = $this->rolModel->get_Roles($_SESSION["documento"]);
        $this->view('admin/home', $rol);
    }

    public function estado_novedad(){
        $get = $this->adminModel->getNovedad();
        $this->view('admin/estado_novedad', $get);
    }

    public function logout(){
        unset($_SESSION['user']);
        session_destroy();
        header('location: '.URL_APP.'/');
    } 
}