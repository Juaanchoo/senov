<?php 

class UsuariosModel extends DataBase
{
	private $db;

	function __construct(){
		$this->db = new DataBase();
    }


    /**
     * @author senov
     * Ésta consulta revisa si el documento está habilitado ..
     * @param $documento
     */
	public function habilitado($documento)
	{
        try{
            $sql="SELECT * FROM habilitado WHERE documento = ?";
            $this->db->query($sql);
            $this->db->bind(1,$documento);
            $hab = $this->db->getOne();
            if(!empty($hab)){
                return $hab;
            }else{
                return false;
            }

        }catch(Exception $e){
            return "Usuarios_habilitado_DATA BASE ERROR";
        }
    }
    
    /**
     * @author senov
     * Habilita un usuario para que se pueda registrar
     * @param $documento
     */
	public function habilitar_Usuario($documento, $tipo_documento)
	{
        try{
            $val = $this->habilitado($documento);
            if($val==false){
                //echo "si se puede";
                $sql="INSERT INTO habilitado (fk_id_tipo_documento, documento) VALUES (?,?)";
                $this->db->query($sql);
                $this->db->bind(1,$tipo_documento);
                $this->db->bind(2,$documento);
                $hab = $this->db->execute();
                if($hab){
                    return "<script>swal({
                        type: 'success',
                        title: 'Exito!',
                        text: 'Se ha logrado habilitar correctamente el usuario!',
                    })</script>";
                }else{
                    return "<script>swal({
                        type: 'error',
                        title: 'Opps..',
                        text: 'No se pudo habilitar...',
                    })</script>";
                }
            }else{
                //var_dump($val);
                return "<script>swal({
                    type: 'error',
                    title: 'Opps..',
                    text: 'Este documento ya está habilitado',
                })</script>";
            }

        }catch(Exception $e){
            return "Usuarios_habilitar_Usuario_DATA BASE ERROR";
        }
	}

	/**
     * @author senov
     * Esta consulta revisa en la base de datos si el documento ya está registrado
     * @param $documento
     */
	public function askRegistro($documento)
	{
        try{

            $sql="SELECT * FROM usuarios_admin WHERE documento = ?";
            $this->db->query($sql);
            $this->db->bind(1,$documento);
            $usu = $this->db->getOne();
            if (!empty($usu)) {
                return $usu;
            }else{
                return false;
            }

        }catch(Exception $e){
            return "Usuarios_askRegistro_DATA BASE ERROR";
        }
		
	}
    
    /**
     * @author senov
     * 
     */

    public function get_Usuarios()
    {
        try {
            $sql="SELECT td.`tipo_documento`, usu.`documento`, usu.`nombre`, usu.`primer_apellido`, 
            usu.`segundo_apellido`, usu.`email`, usu.`telefono`, usu.`direccion`, usu.`estado` FROM 
            `usuarios_admin` AS usu INNER JOIN tipo_documento AS td 
            ON usu.fk_id_tipo_documento=td.id_tipo_documento WHERE usu.fk_id_ficha is ? AND usu.documento!=?";

            $this->db->query($sql);
            $this->db->bind(1, null);
            $this->db->bind(2, $_SESSION["documento"]);
            $get = $this->db->getAll();
            if(!empty($get)){
                return $get;
            }else{
                return false;
            }
        } catch (Exception $e) {
            return "Usuarios_get_Usuarios_DATA BASE ERROR";
        }
    }

    /**
     * @author senov
     * Obtener un usuario según documento
     * @return respuesta de éxito o error
     */
    public function get_One_Usuario($documento)
    {
        try {

            //var_dump($documento);
            $sql="SELECT td.`tipo_documento`, usu.`documento`, usu.`nombre`, usu.`primer_apellido`, 
            usu.`segundo_apellido`, usu.`email`, usu.`telefono`, usu.`direccion`, usu.`estado` 
            FROM `usuarios_admin` AS usu INNER JOIN tipo_documento AS td ON usu.fk_id_tipo_documento=td.id_tipo_documento 
            WHERE  usu.fk_id_ficha is ? AND usu.documento = ? AND usu.documento != ?";

            $this->db->query($sql);
            //$this->db->bind(1, 5);
            $this->db->bind(1, null);
            $this->db->bind(2, $documento);
            $this->db->bind(3, $_SESSION["documento"]);
            $get = $this->db->getOne();
            if($get==true){
                return $get;
            }else{
                return false;
            }
            
        } catch (Exception $e) {
            return "Admin_get_One_Usuario_DATA BASE ERROR";
        }
    }

    public function set_Usuario($info_usuario)
    {
        try {
			
			$hab = $this->habilitado($info_usuario["documento"]);
			$usu = $this->askRegistro($info_usuario["documento"]);
			// if($usu == false){
			// 	echo "lo ves no hay nada ahí!";
			// 	var_dump($info_usuario);
			// 	var_dump($hab);
			// }else{
            //     var_dump($usu);
			// 	var_dump($hab);
                
			// }
			if(!empty($hab) && $hab->fk_id_tipo_documento == $info_usuario["tipo_documento"]){
				if(!empty($hab) && $hab->documento == $info_usuario["documento"] && $usu == false){
				$sql="INSERT INTO `usuarios_admin`(`fk_id_tipo_documento`, `documento`, `nombre`, `primer_apellido`,`segundo_apellido`, `email`, `telefono`, `direccion`, `password`) VALUES (?,?,?,?,?,?,?,?,?)";
				$this->db->query($sql);
				$this->db->bind(1,$info_usuario["tipo_documento"]);
				$this->db->bind(2,$info_usuario["documento"]);
				$this->db->bind(3,$info_usuario["nombre"]);
				$this->db->bind(4,$info_usuario["primer_apellido"]);
				$this->db->bind(5,$info_usuario["segundo_apellido"]);
				$this->db->bind(6,$info_usuario["email"]);
				$this->db->bind(7,$info_usuario["telefono"]);
				$this->db->bind(8,$info_usuario["direccion"]);
				$this->db->bind(9,$info_usuario["password"]);
				if($this->db->execute()){
					$sql2 = "INSERT INTO permiso_cargo (fk_id_cargo, fk_documento) VALUES (?,?)";
					$this->db->query($sql2);
					$this->db->bind(1,3);
					$this->db->bind(2,$info_usuario["documento"]);
					if($this->db->execute()){
						return "<script>swal({
							type: 'success',
							title: 'Exito!',
							text: 'Ha logrado registrar al Usuario correctamente!',
						})</script>";
					}else{
						return "<script>swal(
							'No se ha podido registrar!',
							'',
							'error'
						)</script>";
					}
					
				}else{
					return "<script>swal(
						'No se ha podido registrar!',
						'',
						'error'
					)</script>";
				}
				}else{
					return "<script>swal({
						type: 'error',
						title: 'Opps..',
						text: 'El documento no está habilitado o ya está registrado',
					})</script>";
				}
			}else{
				return "<script>swal({
					type: 'error',
					title: 'Opps..',
					text: 'El tipo documento no concuerda con el habilitado',
				})</script>";
			}
		} catch (Exception $e) {
			return "DATA BASE ERROR";
		}
    }

    public function update_Usuario($datos)
    {
        try {
            //var_dump($datos);
            $sql = "UPDATE usuarios_admin SET nombre=?, primer_apellido=?, segundo_apellido=?, email=?, 
                    telefono=?, direccion=? WHERE documento=?";
            $this->db->query($sql);
            $this->db->bind(1, $datos["nombre"]);
            $this->db->bind(2, $datos["primer_apellido"]);
            $this->db->bind(3, $datos["segundo_apellido"]);
            $this->db->bind(4, $datos["email"]);
            $this->db->bind(5, $datos["telefono"]);
            $this->db->bind(6, $datos["direccion"]);
            $this->db->bind(7, $datos["documento"]);
            if($this->db->execute()){
                return "<script>swal({
                    type: 'success',
                    title: 'Éxito',
                    text: 'Se han actualizado los datos correctamente',
                })</script>";
            }else{
                return "<script>swal({
                    type: 'error',
                    title: 'Opps..',
                    text: 'Ocurrió un error al intentar actualizar',
                })</script>";
            }

        } catch (Exception $e) {
            return "Aprendiz_get_Aprendices_DATA BASE ERROR";
        }
    }
	
}