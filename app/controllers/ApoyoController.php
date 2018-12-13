<?php

class ApoyoController extends Controller
{
    private $apoyoModel;
    function __construct(){
        Security::auth('2');
        $this->apoyoModel = $this->model("apoyo");
    }
    public function index(){
        
        $this->view('apoyo/home');
    }

    public function estado_novedad(){
        $get = $this->apoyoModel->getNovedad();
        $this->view('apoyo/estado_novedad', $get);
    }

    public function logout(){
        unset($_SESSION['user']);
        session_destroy();
        header('location: '.URL_APP.'/');
    } 
}