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
	public function rolControl()
    {
            if($_GET["value"]==1){
                //$_SESSION["admin"]="";
                header("Location: ".URL_APP."/admin/home");
            }
            if($_GET["value"]==2){
                //$_SESSION["admin"]="1";
                header("Location: apoyo/home");
            }
             if($_GET["value"]==3){
                //$_SESSION["admin"]="";
                header("Location: user/home");    
            }
            if($_GET["value"]==4){
                //$_SESSION["admin"]="";
                header("Location: instructor/home");    
            }
    }

	
	public function logout(){
        unset($_SESSION['user']);
        session_destroy();
        header('location: '.URL_APP.'/');
    } 

		
}	