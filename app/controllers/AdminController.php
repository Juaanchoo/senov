<?php

class AdminController extends Controller
{
    private $adminModel;
    private $rolModel;
    private $loginModel;
    private $rol;
    private $tablasModel;
    private $aprenModel;
    private $usuariosModel;
    private $programaModel;
    private $tformacionModel;
    private $habilitadoModel;

     /**
     * @author senov
     * método constructor
     * @return respuesta de éxito o error
     */
    function __construct(){
        Security::auth('1');
        $this->adminModel = $this->model("admin");
        $this->usuariosModel = $this->model("usuarios");
        $this->rolModel = $this->model("rol");
        $this->loginModel = $this->model("login");
        $this->aprenModel = $this->model("Aprendiz");
        $this->tablasModel = $this->model("tablas");
        $this->programaModel = $this->model("Programa");
        $this->tformacionModel = $this->model("Tipoformacion");
        $this->habilitadoModel = $this->model("Habilitado");
        $this->rol = $this->rolModel->get_Roles($_SESSION["documento"]);
    }

     /**
     * @author senov
     * ir a la vista
     * @return respuesta de éxito o error
     */
    public function index(){
        $cont = $this->adminModel->contar_Novedad();
        $this->view('admin/home', $this->rol, $cont);
    }

     /**
     * @author senov
     * Mostrar en la vista todas las novedades
     */
    public function estado_novedad($id = null){
        $get = $this->adminModel->getNovedad();
        if ($id==null) {
            $this->view('admin/estado_novedad', $this->rol, $get);
        }else{
            $getOne = $this->adminModel->get_One_Novedad($id);
            $this->view('admin/estado_novedad', $this->rol, $get, $getOne);
        }
    }

     /**
     * @author senov
     * Hacer una nueva novedad, válidar por medio de llamada
     * a otros métodos y por último cargar vistas
     * @return respuesta de éxito o error
     */
    public function nueva_Novedad()
    {
        $error="";
        $success="";
        $mensaje="";
        $per="";

        $td = $this->loginModel->all_Tipo_Documento();
        $ficha = $this->tablasModel->get_Fichas();
        $tn = $this->adminModel->get_Tipo_Novedad();
        $jor= $this->tablasModel->get_Jornada();
        $datos = array ("tipos_documento" => $td,
                        "fichas" => $ficha,
                        "tipo_novedades" => $tn,
                        "jornada" => $jor);


        if(isset($_POST["documento"])){
            if(isset($_POST["documento"]) && isset($_POST["tipo_documento"]) && isset($_POST["tipo_novedad"]) && isset($_POST["motivo"]) && isset($_POST["comentarios"]) && isset($_POST["recomendaciones"]) && isset($_POST["evidencias"])){
                /**
                 *Preguntar si hay una novedad existente para el documento
                 */
                if($this->adminModel->get_Novedad_Aprendiz($_POST["documento"])){
                    //cuando viene nueva ficha
                    if(isset($_POST["nueva_ficha"])){
                        $info_nov = array (
                            "tipo_documento" => $this->cleanData($_POST["tipo_documento"]),
                            "documento" => $this->cleanData($_POST["documento"]),
                            "tipo_novedad" => $this->cleanData($_POST["tipo_novedad"]),
                            "motivo" => $this->cleanData($_POST["motivo"]),
                            "comentarios" => $this->cleanData($_POST["comentarios"]),
                            "recomendaciones" => $this->cleanData($_POST["recomendaciones"]),
                            "evidencias" => $this->cleanData($_POST["evidencias"]),
                            "nueva_ficha" => $this->cleanData($_POST["nueva_ficha"]),
                            "fecha_inicio" => $this->fecha()
                        );
    
                        $per =$this->tablasModel->get_Permiso_Aprendiz($_POST["documento"], $_POST["tipo_documento"]);
                        if($per === true){
                            
                            $res = $this->adminModel->set_Novedad_Ficha($info_nov);
                            $this->view('admin/nueva_novedad', $this->rol, $datos, $res);
                        }else{
                            $this->view('admin/nueva_novedad', $this->rol, $datos, $per);
                        }
                    }
                    //cuando viene nueva jornada
                    if(isset($_POST["nueva_jornada"])){
                        $info_nov = array (
                            "tipo_documento" => $this->cleanData($_POST["tipo_documento"]),
                            "documento" => $this->cleanData($_POST["documento"]),
                            "tipo_novedad" => $this->cleanData($_POST["tipo_novedad"]),
                            "motivo" => $this->cleanData($_POST["motivo"]),
                            "comentarios" => $this->cleanData($_POST["comentarios"]),
                            "recomendaciones" => $this->cleanData($_POST["recomendaciones"]),
                            "evidencias" => $this->cleanData($_POST["evidencias"]),
                            "nueva_jornada" =>  $this->cleanData($_POST["nueva_jornada"]),
                            "fecha_inicio" => $this->fecha()
                        );
                        $per =$this->tablasModel->get_Permiso_Aprendiz($_POST["documento"], $_POST["tipo_documento"]);
                        if($per === true){
                            
                            $res = $this->adminModel->set_Novedad_Jornada($info_nov);
                            $this->view('admin/nueva_novedad', $this->rol, $datos, $res);
                        }else{
                            $this->view('admin/nueva_novedad', $this->rol, $datos, $per);
                        }
                    }

                    //cuando no viene ni nueva_jornada ni nueva_ficha
                    if(!isset($_POST["nueva_jornada"]) && !isset($_POST["nueva_ficha"]))
                    {
                        $info_nov = array (
                            "tipo_documento" => $this->cleanData($_POST["tipo_documento"]),
                            "documento" => $this->cleanData($_POST["documento"]),
                            "tipo_novedad" => $this->cleanData($_POST["tipo_novedad"]),
                            "motivo" => $this->cleanData($_POST["motivo"]),
                            "comentarios" => $this->cleanData($_POST["comentarios"]),
                            "recomendaciones" => $this->cleanData($_POST["recomendaciones"]),
                            "evidencias" => $this->cleanData($_POST["evidencias"]),
                            "fecha_inicio" => $this->fecha()
                        );
                        $per =$this->tablasModel->get_Permiso_Aprendiz($_POST["documento"], $_POST["tipo_documento"]);
                        //var_dump($per);
                        if($per === true){
                            
                            $res = $this->adminModel->set_Novedad($info_nov);
                            $this->view('admin/nueva_novedad', $this->rol, $datos, $res);
                        }else{
                            $this->view('admin/nueva_novedad', $this->rol, $datos, $per);
                        }
                    }
                }else{
                    $res = "<script>swal({
                        type: 'error',
                        title: 'Opps..',
                        text: 'Ya existe una novedad de este documento',
                        })</script>";
                $this->view('admin/nueva_novedad', $this->rol, $datos, $res);
                }
            }else{
                $res = "<script>swal({
                        type: 'error',
                        title: 'Opps..',
                        text: 'Falta ingresar información en los campos de texto',
                        })</script>";
                $this->view('admin/nueva_novedad', $this->rol, $datos, $res);
            }
        }else{
            if(!isset($_POST["documento"])){
                $this->view('admin/nueva_novedad', $this->rol, $datos);
            }
        }
    }

    /**
     * @author senov
     * Mostrar la vista de aprendiz
    */
    public function aprendiz($documento = null, $res = null)
    {
        $td = $this->loginModel->all_Tipo_Documento();
        $ficha = $this->tablasModel->get_Fichas();
        $get = array(
            "aprendices" =>$this->aprenModel->get_Aprendices(),
            "tipo_documento" => $td,
            "fichas" => $ficha,
            "respuesta" => $res);
        if ($documento==null) {
            $this->view('admin/aprendiz', $this->rol, $get);
        }else{
            $getOne = $this->aprenModel->get_One_Aprendiz($documento);
            $this->view('admin/aprendiz', $this->rol, $get, $getOne);
        }

        
    }

    /**
     * @author senov
     * Registrar un aprendiz
     * @param $datos_aprendiz recibe los datos del formulario
     */
    public function setAprendiz()
    {
        $td = $this->loginModel->all_Tipo_Documento();
        $ficha = $this->tablasModel->get_Fichas();
        $get = $this->aprenModel->get_Aprendices();
        if(isset($_POST["documentoA"])){
            if(isset($_POST["documentoA"]) && isset($_POST["tipo_documentoA"]) && isset($_POST["nombreA"]) && isset($_POST["primer_apellidoA"]) && isset($_POST["segundo_apellidoA"]) && isset($_POST["emailA"]) && isset($_POST["telefonoA"]) && isset($_POST["direccionA"]) && isset($_POST["fichaA"])){
                $data_aprendiz = array(
                    "tipo_documento" => $this->cleanData($_POST["tipo_documentoA"]),
                    "documento" => $this->cleanData($_POST["documentoA"]),
                    "nombre" => $this->cleanData($_POST["nombreA"]),
                    "primer_apellido" => $this->cleanData($_POST["primer_apellidoA"]),
                    "segundo_apellido" => $this->cleanData($_POST["segundo_apellidoA"]),
                    "email" => $this->cleanData($_POST["emailA"]),
                    "telefono" => $this->cleanData($_POST["telefonoA"]),
                    "direccion" => $this->cleanData($_POST["direccionA"]),
                    "ficha" => $this->cleanData($_POST["fichaA"]),
                );

                 $respuesta = $this->aprenModel->set_Aprendiz($data_aprendiz);
                 $this->aprendiz(null, $respuesta);
                
                //var_dump($data_aprendiz);
            }else{
                $respuesta ="<script>swal({
                    type: 'error',
                    title: 'Opps..',
                    text: 'Porfavor! llene todos los datos del formulario',
                })</script>";
               
                $this->aprendiz(null, $respuesta);
            }

        }else{
            
            if(!isset($_POST["documentoA"])){
                $this->aprendiz();
            }
        }

    }

    /**
     * @author senov
     * Mostrar la vista de aprendiz
    */
    public function updateAprendiz()
    {
        $td = $this->loginModel->all_Tipo_Documento();
        $ficha = $this->tablasModel->get_Fichas();
        if(isset($_POST["update"])){
            if(isset($_POST["update"]) && isset($_POST["nombre"]) && isset($_POST["primer_apellido"]) && isset($_POST["segundo_apellido"]) && isset($_POST["email"]) && isset($_POST["telefono"]) && isset($_POST["direccion"])){
                
                $datos_update = array(
                    "nombre" => $this->cleanData($_POST["nombre"]),
                    "primer_apellido" => $this->cleanData($_POST["primer_apellido"]),
                    "segundo_apellido" => $this->cleanData($_POST["segundo_apellido"]),
                    "email" => $this->cleanData($_POST["email"]),
                    "telefono" => $this->cleanData($_POST["telefono"]),
                    "direccion" => $this->cleanData($_POST["direccion"]),
                    "documento" => $this->cleanData($_POST["update"])
                );
                //var_dump($datos_update);
                $res = $this->aprenModel->update_Aprendiz($datos_update);

                $get = $this->aprenModel->get_Aprendices();
                $data = array(
                        "aprendices" => $get,
                        "respuesta" => $res,
                        "tipo_documento" => $td,
                        "fichas" => $ficha 
                );
                $this->view('admin/aprendiz', $this->rol, $data);
            }
        }
        
    }

    /**
     * @author senov
     * Lleva a la vista de los usuarios
     * @param $documento, $respuesta
     */
    public function usuarios_admin($documento = null, $respuesta = null){
        $td = $this->loginModel->all_Tipo_Documento();
        $get_usu = $this->usuariosModel->get_Usuarios();
        $data = array(
            "usuarios" => $get_usu,
            "respuesta" => $respuesta,
            "tipo_documento" => $td,
        );
        if($documento == null){
            $this->view('admin/usuarios_admin', $this->rol, $data);
        }else{
            $getOne = $this->usuariosModel->get_One_Usuario($documento);
            $this->view('admin/usuarios_admin', $this->rol, $data, $getOne);
        }
    }

    public function setUsuario()
    {
        if(isset($_POST["documentoU"])){
            if(isset($_POST["tipo_documentoU"]) && isset($_POST["nombreU"]) && isset($_POST["primer_apellidoU"]) && isset($_POST["segundo_apellidoU"]) && isset($_POST["emailU"]) && isset($_POST["telefonoU"])  && isset($_POST["direccionU"]) && isset($_POST["password"]) && $_POST["password"] == $_POST["password2"]){
                $info_usuario = array(
                    'tipo_documento'=> $this->cleanData($_POST["tipo_documentoU"]),
                    'documento'=> $this->cleanData($_POST["documentoU"]),
                    'nombre'=> $this->cleanData($_POST["nombreU"]),
                    'primer_apellido'=> $this->cleanData($_POST["primer_apellidoU"]),
                    'segundo_apellido'=> $this->cleanData($_POST["segundo_apellidoU"]),
                    'telefono'=> $this->cleanData($_POST["telefonoU"]),
                    'direccion'=> $this->cleanData($_POST["direccionU"]),
                    'email'=> $this->cleanData($_POST["emailU"]), 
                    'password'=> md5($_POST["password"]),
                );
                $res =  $this->usuariosModel->set_Usuario($info_usuario);
                $this->usuarios_admin(null,$res);
            }else { 
            //devolver diferente respuesta
            $res = "<script>swal({
				type: 'error',
				title: 'Opps..',
				text: 'Error en lo datos del registro',
              })</script>";
              $this->usuarios_admin(null,$res);
            }
        }else{
            $res = "<script>swal({
				type: 'error',
				title: 'Opps..',
				text: 'Debe ingresar documento',
              })</script>";
            $this->usuarios_admin(null, $res);
        }
    }

     /**
     * @author senov
     * Actualizar la informacion de un usuario
    */
    public function updateUsuario()
    {
        $td = $this->loginModel->all_Tipo_Documento();
        $ficha = $this->tablasModel->get_Fichas();
        if(isset($_POST["update"])){
            if(isset($_POST["update"]) && isset($_POST["nombre"]) && isset($_POST["primer_apellido"]) && isset($_POST["segundo_apellido"]) && isset($_POST["email"]) && isset($_POST["telefono"]) && isset($_POST["direccion"])){
                
                $datos_update = array(
                    "nombre" => $this->cleanData($_POST["nombre"]),
                    "primer_apellido" => $this->cleanData($_POST["primer_apellido"]),
                    "segundo_apellido" => $this->cleanData($_POST["segundo_apellido"]),
                    "email" => $this->cleanData($_POST["email"]),
                    "telefono" => $this->cleanData($_POST["telefono"]),
                    "direccion" => $this->cleanData($_POST["direccion"]),
                    "documento" => $this->cleanData($_POST["update"])
                );
                //var_dump($datos_update);
                $res = $this->usuariosModel->update_Usuario($datos_update);
                $this->usuarios_admin(null, $res);
            }else{
                $res="<script>swal({
                    type: 'error',
                    title: 'Opps..',
                    text: 'Porfavor! llene todos los datos del formulario',
                })</script>";
                $this->usuarios_admin(null, $res);
            }
        }
        
    }
    
    /**
     * @author senov
     * habilita a un nuevo usuario para que se pueda registrar
     * 
     */
    public function habilitarUsuario(){
        if(isset($_POST["habDoc"]) && isset($_POST["tipo_documentoHab"])){
            $res = $this->usuariosModel->habilitar_Usuario($_POST["habDoc"], $_POST["tipo_documentoHab"]);
            $this->usuarios_admin(null, $res);
        }else{
            $res="<script>swal({
                type: 'error',
                title: 'Opps..',
                text: 'Porfavor! Ingrese los todos datos',
            })</script>";
            $this->usuarios_admin(null, $res);
        }
    } 

    /**
     * @author senov
     * habilita a un nuevo usuario para que se pueda registrar
     * 
     */
    public function documentosHabilitados($respuesta = null){
        $getHabil = $this->habilitadoModel->get_Habilitados();
        $getDeshabil = $this->habilitadoModel->get_Deshabilitados();
        //var_dump($getHabil);
        $data2 = array(
            "habilitados" => $getHabil,
            "deshabilitados" => $getDeshabil,
            "respuesta" => $respuesta);
            //var_dump($data2);
        $this->view('admin/documentos_habilitados',$this->rol, $data2);
    }
    
    
    /**
     * @author senov
     * habilita a un nuevo usuario para que se pueda registrar
     * 
     */
    public function deshabilitar($documento){
        //var_dump($documento);
        $getRes = $this->habilitadoModel->desactivarHabilitados($documento);
        $this->documentosHabilitados($getRes);
    }
    
    /**
     * @author senov
     * habilita a un nuevo usuario para que se pueda registrar
     * 
     */
    public function habilitar($documento){
        //var_dump($documento);
        $getRes = $this->habilitadoModel->activarHabilitados($documento);
        $this->documentosHabilitados($getRes);
    } 

    /**
     * @author senov
     * Mostrar vista de opciones
     */
    public function roles($respuesta = null)
    {
        $getRol = $this->rolModel->get_Roles_Usuarios();
        $getCargos = $this->rolModel->get_Cargos();
        $data2 = array(
            "roles" => $getRol,
            "respuesta" => $respuesta,
            "tipo_rol" => $getCargos);
        $this->view('admin/roles', $this->rol, $data2);
    }

     /**
     * @author senov
     * Mostrar vista de opciones
     */
    public function setRoles()
    {
        $getRoles = $this->rolModel->get_Roles_Usuarios();
        $cont =0;
        if(isset($_POST["rolDocumento"]) && isset($_POST["rolTipoRol"])){
            
            foreach ($getRoles as $r) {
                if($_POST["rolDocumento"] == $r->documento && $_POST["rolTipoRol"] == $r->fk_id_cargo){
                    $respuesta = "<script>swal({
                        type: 'error',
                        title: 'Opps..',
                        text: 'Lo sentimos! Este documento ya tiene el rol',
                    })</script>";
                    $cont = $cont +1;
                    $this->roles($respuesta);
                }
            }
            if($cont == 0){

                $datos = array(
                    "documento" => $this->cleanData($_POST["rolDocumento"]),
                    "rol" => $this->cleanData($_POST["rolTipoRol"])
                );
                $respuesta = $this->rolModel->set_Roles($datos);
                $this->roles($respuesta);
            }

        }else{
            $respuesta = "<script>swal({
                type: 'error',
                title: 'Opps..',
                text: 'Por favor! Llene los datos requeridos',
            })</script>";
            $this->roles($respuesta);
        }
    }

    /**
     * @author senov
     * Mostrar vista de opciones
     */
    public function quitarRoles($id)
    {
        $respuesta = $this->rolModel->delete_Roles($id);
        $this->roles($respuesta);
    }

    /**
     * @author senov
     * Mostrar vista de opciones
     */
    public function mostrarOpciones()
    {
        $data = array();
        $this->view('admin/opciones', $this->rol);
    }

    /**
     * @author senov
     * Mostrar vista de gestion de programa de formacion
     */
    public function programaFormacion($id_programa = null, $respuesta = null)
    {
        $getProgramas = $this->programaModel->get_Programas();
        $data2 = array(
            "programas_formacion" => $getProgramas,
            "respuesta" => $respuesta);
        if($id_programa!=null){
            $getOne = $this->programaModel->get_One_Programa($id_programa);
            $tfor = $this->tformacionModel->get_Tipos_Formacion();
            $data2 = array(
                "programas_formacion" => $getProgramas,
                "tipos_formacion" => $tfor,
                "one_programa" => $getOne,
                "respuesta" => $respuesta);
            $this->view('admin/programa_formacion', $this->rol, $data2);
            
        }else{
            $this->view('admin/programa_formacion', $this->rol, $data2);
        }
    }

    /**
     * @author senov
     * Mostrar vista de opciones
     */
    public function updatePrograma()
    {
        if($_POST["id_programaU"] && $_POST["programa_formacionU"] && $_POST["tipo_formacionU"]){

            $datos = array(
                "id_programa_formacion" => $this->cleanData($_POST["id_programaU"]),
                "programa_formacion" => $this->cleanData($_POST["programa_formacionU"]),
                "tipo_formacion" => $this->cleanData($_POST["tipo_formacionU"])
            );
            $get = $this->programaModel->update_Programa($datos);
            if($get!=false){
                //var_dump($get);
                $this->programaFormacion(null,$get);
            }else{
                $respuesta = "<script>swal({
                    type: 'error',
                    title: 'Opps..',
                    text: 'Lo sentimos! No se pudo actualizar',
                })</script>";
                $this->programaFormacion(null, $respuesta);
            }

        }else{
            $respuesta = "<script>swal({
                type: 'error',
                title: 'Opps..',
                text: 'Por favor! Llene todos los datos para poder actualizar',
            })</script>";
            $this->programaFormacion(null, $respuesta);

        }
    }

    /**
     * @author senov
     * hacer PDF de aplazamiento
     */
    public function PDFAplazamiento($idnovedad)
    {
        ob_clean(); 
        require 'PdfController.php';
        $novedad=$this->adminModel->PDF_Aplazamiento($idnovedad);
        $pdf= new PdfController;
        $pdf->novedad($novedad);
    }

    /**
     * @author senov
     * hacer PDF de Retiro Voluntario
     */
    public function PDFRetiroVoluntario($idnovedad)
    {
        ob_clean(); 
        require 'PdfController.php';
        $novedad=$this->adminModel->PDF_Aplazamiento($idnovedad);
        $pdf= new PdfController;
        $pdf->novedad($novedad);
    }

    /**
     * @author senov
     * hacer PDF de Cambio de Jornada
     */
    public function PDFcambioJ($idnovedad)
    {
        ob_clean(); 
        require 'PdfController.php';
        $novedad=$this->adminModel->PDF_Aplazamiento($idnovedad);
        $pdf= new PdfController;
        $pdf->PDFCambioJ($novedad);
    }

    /**
     * @author senov
     * hacer PDF de Reintegro
     */
    public function PDFreintegro($idnovedad)
    {
        ob_clean(); 
        require 'PdfController.php';
        $novedad=$this->adminModel->PDF_Aplazamiento($idnovedad);
        $pdf= new PdfController;
        $pdf->novedades($novedad);
    }
    
    /**
     * @author senov
     * hacer PDF de traslado
     */
    public function PDFTraslado($idnovedad)
    {
        ob_clean(); 
        require 'PdfController.php';
        $novedad=$this->adminModel->PDF_Aplazamiento($idnovedad);
        $pdf= new PdfController;
        $pdf->novedades($novedad);
    }

    /**
     * @author senov
     * hacer PDF de Deserción
     */
    public function PDFdesercion($idnovedad)
    {
        ob_clean(); 
        require 'PdfController.php';
        $novedad=$this->adminModel->PDF_desercion($idnovedad);
        // var_dump($novedad  );
        $pdf= new PdfController;
        $pdf->desercion($novedad);
    }

    /**
     * @author senov
     * Cerrar la sesión y lleva al inicio
     */
    public function logout(){
        unset($_SESSION['user']);
        session_destroy();
        header('location: '.URL_APP.'/');
    } 
}