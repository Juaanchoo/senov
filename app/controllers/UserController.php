<?php 

class UserController extends Controller
{
	private $userModel;
	private $rolModel;
	private $rol;

	function __construct(){
		Security::auth('Usuario');
		$this->userModel = $this->model('user'); 
		$this->rolModel = $this->model('rol'); 
		$this->rol = $this->rolModel->get_Roles($_SESSION["documento"]);
    }

	public function index(){
		$this->view('user/home', $this->rol);
	}

	public function rolControl($documento)
	{
		// $rol = $this->rolModel->get_Roles($documento);
		// var_dump($rol);
		// $this->view('user/home', $rol);
	}

	public function logout(){
        unset($_SESSION['user']);
        session_destroy();
        header('location: '.URL_APP.'/');
    } 

		
}	