<?php 

class UserController extends Controller
{
	private $userModel;
	private $rolModel;

	function __construct(){
		Security::auth('Usuario');
		$this->userModel = $this->model('user'); 
		$this->rolModel = $this->model('rol'); 
    }

	public function index(){
		$rol = $this->rolModel->get_Roles($_SESSION["documento"]);
		$this->view('user/home', $rol);
	}

	public function rolControl($documento)
	{
		$rol = $this->rolModel->get_Roles($documento);
		//var_dump($rol);
		$this->view('user/home', $rol);
	}

	public function logout(){
        unset($_SESSION['user']);
        session_destroy();
        header('location: '.URL_APP.'/');
    } 

		
}	