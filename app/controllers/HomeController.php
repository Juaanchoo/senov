<?php

class HomeController extends Controller
{
    private $loginModel;
    private $rolModel;
    private $data;

	function __construct(){
        Security::auth('');
		$this->loginModel = $this->model('login'); 
        $this->rolModel = $this->model('rol'); 
        $this->data = $this->loginModel->all_tipo_documento();
    }

    public function index(){
    	
        $this->view('home/home');
    }

    public function registrar()
    {
        if(isset($_POST["dni"])){
            if(isset($_POST["tipo_documento"]) && isset($_POST["nombre"]) && isset($_POST["primer_apellido"]) && isset($_POST["segundo_apellido"]) && isset($_POST["email"]) && isset($_POST["telefono"])  && isset($_POST["direccion"]) && isset($_POST["password"]) && $_POST["password"] == $_POST["password2"]){
                $info_usuario = array(
                    'tipo_documento'=> $this->cleanData($_POST["tipo_documento"]),
                    'dni'=> $this->cleanData($_POST["dni"]),
                    'nombre'=> $this->cleanData($_POST["nombre"]),
                    'primer_apellido'=> $this->cleanData($_POST["primer_apellido"]),
                    'segundo_apellido'=> $this->cleanData($_POST["segundo_apellido"]),
                    'telefono'=> $this->cleanData($_POST["telefono"]),
                    'direccion'=> $this->cleanData($_POST["direccion"]),
                    'email'=> $this->cleanData($_POST["email"]), 
                    'password'=> $this->cleanData($_POST["password"])
                );
                $data2 =  $this->loginModel->registrar($info_usuario);
                $this->view('home/registro',$this->data,$data2);
            }else { 
            //devolver diferente respuesta
            $data2 = "<script>swal({
				type: 'error',
				title: 'Opps..',
				text: 'Error en lo datos del registro',
              })</script>";
              $this->view('home/registro',$this->data, $data2);
            }
        }else{
          
            $this->view('home/registro',$this->data);
        }
          
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
                header("Location: ".URL_APP."/admin");
            }
            if($id==2){
                header("Location: ".URL_APP."/apoyo");
            }
             if($id==3){
                header("Location: ".URL_APP."/user");    
            }
            if($id==4){
                header("Location: ".URL_APP."/instructor");    
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




