<?php 

class Security
{
    public function __construct()
    {
        
    }

    public static function auth($permiso){
        try{
            if (isset($_SESSION['user'])) {
                $autorizado = false;
    
                if (in_array($permiso,$_SESSION['user']->permisos)) {
                    $autorizado = true;
                }
    
                if(!$autorizado){
                    switch ($_SESSION['user']->permisos[0]) {
                        case '3':
                            header('location: '.URL_APP.'/user');
                        break;
                        case '1':
                            header('location: '.URL_APP.'/admin');
                        break;
                        case '2':
                            header('location: '.URL_APP.'/apoyo');
                        break;
                        case '4':
                            header('location: '.URL_APP.'/instructor');
                        break;
                        
                        default:
                            header('location: '.URL_APP.'/');
                        break;
                    }
                }
    
    
    
            }else{
    
                $url = isset($_REQUEST['url']) ? explode('/',$_REQUEST['url']) : null;
                if (!empty($url)) {
                    if ($url[0] != 'home') {
                        header('location: '.URL_APP.'/');   
                    }
                    
                }
            }
        }catch(Exception $e){
            die($e->getMessage());
        }
        
      
    }

    public static function create_auth($user = null){
    	if (!empty($user)) {
    		unset($user->password);
    		$_SESSION['user'] = $user;
            $cargo = $_SESSION['user']->permisos[0];

            switch ($cargo) {
                case '3':
                header('location: '.URL_APP.'/user');
                break;
                case '1':
                    header('location: '.URL_APP.'/admin');
                break;
                case '2':
                    header('location: '.URL_APP.'/apoyo');
                break;
                
                case '4':
                    header('location: '.URL_APP.'/instructor');
                break;
                default:
                    header('location: '.URL_APP.'/');
                break;
            }   

    	}
    }


}