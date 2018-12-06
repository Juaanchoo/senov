<?php

class HomeController extends Controller
{
    private $loginModel;
    private $rolModel;

	function __construct(){
        Security::auth('');
		$this->loginModel = $this->model('login'); 
		$this->rolModel = $this->model('rol'); 
    }

    public function index(){
    	
        $this->view('home/home');
    }
    
    public function login(){
        if (isset($_POST['dni'],$_POST['password'])) {
            
            $documento = $this->cleanData($_POST['dni']);
            $password = $this->cleanData($_POST['password']);
            
            $user = $this->loginModel->show($documento);
            if (!empty($user)) {
                if ($password === $user->password) {
                    
                    if ($this->loginModel->resetIntentos($user->documento)) {
                        Security::create_auth($user);
                    } else {
                        echo '<b>Error 500: </b> se produjo un error en el lado del servidor';
                    }
                                      
                }else{
                    $this->addIntento($user->documento);
                }
            }else{
                $error = [
                    'error' => 'El usuario no existe en el sitio.'
                ];
                $this->view('home/home',$error);
            }
        }else{
            header('Location:'.URL_APP.'/');
        }
		
    }

    //trae los roles
    public function rolControl($id)
    {
            if($id==1){
                //$_SESSION["admin"]="";
                header("Location: ".URL_APP."/admin/home");
            }
            if($id==2){
                //$_SESSION["admin"]="1";
                header("Location: apoyo/home");
            }
             if($id==3){
                //$_SESSION["admin"]="";
                header("Location: ".URL_APP."/user/home");    
            }
            if($id==4){
                //$_SESSION["admin"]="";
                header("Location: instructor/home");    
            }
    }
    
    private function addIntento($id){
        $user = $this->loginModel->sumarIntento($id);
        if ($user) {
            if ($user->intentos < 3) {
                $error = [
                    'error' => 'La contraseña es incorrecta. Intentelo de nuevo.'
                ];
                $this->view('home/home',$error);
            } else {
                echo 'Olvido su contraseña? trate de restablecerla.';
            }
            
        }else{
            echo 'Error de la Database';
        }
    }

}




