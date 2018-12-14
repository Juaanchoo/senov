<?php include_once sidebar_p1; ?>
<div class="container mt-5 app-m">
	<div class="card shadow">
	    <h5 class="card-header t-card">Gestión de los Roles de Usuarios</h5>
	    <div class="card-body">
            <?php
                if(isset($_SESSION["res"]) && $_SESSION["res"] != null){
                    echo $_SESSION["res"];
                    $_SESSION["res"] =null;
                }
            ?>
            <?php 
                if(isset($data2["respuesta"]) && $data2["respuesta"] != null){
                    $_SESSION["res"] = $data2["respuesta"];
                    header("Location: ".URL_APP."/admin/programaFormacion"); 
                 }
            ?>
            
        <table class="table table-bordered table-striped">
                <thead class="text-center">
                    <tr>
                        <th>Rol</th>
                        <th>Documento</th>
                        <th>Nombre</th>
                        <th>Primer Apellido</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                        <?php
                        //var_dump($data2);
                            foreach ($data2["roles"] as $d) {
                                echo '<tr>
                                    <td>	'.$this->mostrar($d->cargo).'</td>
                                    <td>	'.$this->mostrar($d->documento).'</td>
                                    <td>	'.$this->mostrar($d->nombre).'</td>
                                    <td>	'.$this->mostrar($d->primer_apellido).'</td>
                                    <td> <a href="'.URL_APP.'/admin/roles/'.$d->id_permiso.'">editar</a>/<a href="'.URL_APP.'/admin/deleteRol/'.$d->id_permiso.'">eliminar</a>  </td>
                                </tr>';
                            }
                        ?>
                </tbody>
            </table>

            <!--MODAL EDITAR PROGRAMA-->
            <?php if(isset($data2["one_programa"]) && $data2["tipos_formacion"]): ?>
                <div class="modal fade" id="Modalsen" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">

                            <div class="modal-header t-card">
                                <h5 class="modal-title" id="exampleModalLongTitle">Habilitar Usuario</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="POST" class="form" action="<?php echo URL_APP;?>/admin/updatePrograma">
                            <div class="modal-body">
                            <div class="col-12" style="margin-top:10px;">
                                <div class="form-group">
                                    <label for="id_programaU">Id Programa de Formación</label>
                                    <input  type="text" disabled value="<?php echo $data2["one_programa"]->id_programa_formacion;?>" required class="form-control">
                                    <input  type="hidden" name="id_programaU" value="<?php echo $data2["one_programa"]->id_programa_formacion;?>" required class="form-control">
                                    
                                </div>
                                <div class="form-group">
                                    <label for="programa_formacionU">Programa de Formación</label>
                                    <?php //var_dump($data2["one_programa"]); var_dump($data2["tipos_formacion"]);?>
                                    <input  type="text" name="programa_formacionU" value="<?php echo $this->mostrar($data2["one_programa"]->programa_formacion);?>" required class="form-control">
                                    
                                </div>
                                <div class="form-group">
                                    <label for="tipo_formacionU">Tipo de Formación &nbsp;</label>
                                    <select name="tipo_formacionU" required >
                                        <option value="<?php echo $data2["one_programa"]->fk_id_tipo_formacion;?>" selected ><?php echo $data2["one_programa"]->tipo_formacion; ?></option>
                                        <?php
                                        
                                            foreach ($data2["tipos_formacion"] as $tf) {
                                                if($data2["one_programa"]->fk_id_tipo_formacion != $tf->id_tipo_formacion){
                                                    echo '<option value="'.$tf->id_tipo_formacion.'">'.$tf->tipo_formacion.'</option>';
                                                }
                                            }
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
                                <button type="submit" class="btn btn-primary">Actualizar Programa</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>      
            <?php endif; ?>
            <!--FIN MODAL EDITAR PROGRAMA-->
        </div>
    </div>
</div>
<link rel="stylesheet" href="<?php echo URL_APP?>/css/files.css">
<script src="<?php echo URL_APP; ?>/public/js/modal.js"></script>
<?php include_once sidebar_p2; ?>
