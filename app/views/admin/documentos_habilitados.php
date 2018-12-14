<?php include_once sidebar_p1; ?>
<div class="container mt-5 app-m">
	<div class="card shadow">
	    <h5 class="card-header t-card">Gestión de los Roles de Usuarios</h5>
	    <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <a href="<?php echo URL_APP;?>/admin/usuarios_admin" class="btn btn-outline-primary">Ver Usuarios &nbsp;<i class="fas fa-user-check"></i></a>
                </div>
                
                <div class="col-md-6">
                    <div class="search-form">
                        <span>Buscar:</span>
                        <input type="text" placeholder="Buscar...">
                    </div>
                </div>
            </div>
            <?php
                if(isset($_SESSION["res"]) && $_SESSION["res"] != null){
                    echo $_SESSION["res"];
                    $_SESSION["res"] =null;
                }
            ?>
            <?php 
                if(isset($data2["respuesta"]) && $data2["respuesta"] != null){
                    $_SESSION["res"] = $data2["respuesta"];
                    header("Location: ".URL_APP."/admin/roles"); 
                 }
            ?>
            
        <table class="table table-bordered table-striped">
                <thead class="text-center">
                    <tr>
                        <th>Tipo Documento</th>
                        <th>Documento</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                        <?php
                        // var_dump($data2);
                            foreach ($data2["habilitados"] as $h) {
                                echo '<tr>
                                    <td>	'.$this->mostrar($h->tipo_documento).'</td>
                                    <td>	'.$this->mostrar($h->documento).'</td>
                                    <td> <a href="'.URL_APP.'/admin/deshabilitar/'.$h->documento.'">deshabilitar</a> </td>
                                </tr>';
                            }
                        ?>
                </tbody>
            </table>

            <!--MODAL ASIGNAR ROL-->
            <?php //if(isset($data2["one_programa"]) && $data2["tipos_formacion"]): ?>
                <div class="modal fade" id="modalRol" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">

                            <div class="modal-header t-card">
                                <h5 class="modal-title" id="exampleModalLongTitle">Asignar Rol a un Usuario</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="POST" class="form" action="<?php echo URL_APP;?>/admin/">
                            <div class="modal-body">
                            <div class="col-12" style="margin-top:10px;">
                                <div class="form-group">
                                    <label for="rolDocumento">Documento</label>
                                    <input  type="text" name="rolDocumento" value="" required class="form-control">
                                    
                                </div>
                                
                                <div class="form-group">
                                    <label for="rolTipoRol">Tipo de Rol &nbsp;</label>
                                    <select name="rolTipoRol" required >
                                        <option value="" selected >Seleccione..</option>
                                        <?php
                                        
                                            // foreach ($data2["tipo_rol"] as $r) {
                                            //         echo '<option value="'.$r->id_cargo.'">'.$r->cargo.'</option>';
                                            // }
                                        ?>  
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="p-2">
                                        <small class="text-muted"><b>Nota:</b> Los cuadros de texto deben estar llenos</small>
                                    </div>
                                </div>
                            </div>                
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Asignar Rol</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>      
            <?php //endif; ?>
            <!--FIN MODAL ASIGNAR ROL-->
        </div>
    </div>
</div>
<link rel="stylesheet" href="<?php echo URL_APP?>/css/files.css">
<script src="<?php echo URL_APP; ?>/public/js/modal.js"></script>
<?php include_once sidebar_p2; ?>
