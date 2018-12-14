<?php include_once sidebar_p1; ?>
<div class="container mt-5 app-m">
	<div class="card shadow">
	    <h5 class="card-header t-card">Gestión de Fichas</h5>
	    <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <a href="<?php echo URL_APP;?>/admin/aprendiz" class="btn btn-outline-primary">Ver Aprendices &nbsp;<i class="fas fa-user-check"></i></a>
                    <a href="" data-toggle="modal" data-target="#insertFicha" class="btn btn-outline-primary">Registrar Ficha &nbsp;<i class="fas fa-user-check"></i></a>
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
                    header("Location: ".URL_APP."/admin/fichas"); 
                 }
            ?>

           
                    <table class="table table-bordered table-striped">
                        <thead class="text-center">
                            
                            <tr>
                                <th>Codigo de Ficha</th>
                                <th>Sede</th>
                                <th>Jornada</th>
                                <th>Modalidad</th>
                                <th>Programa de Formación</th>
                                <th>Trimerstre Cursando</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                                <?php
                                // var_dump($data2);
                                    foreach ($data2["fichas"] as $fi) {
                                        echo '<tr>
                                            <td>	'.$this->mostrar($fi->id_ficha).'</td>
                                            <td>	'.$this->mostrar($fi->sede).'</td>
                                            <td>	'.$this->mostrar($fi->jornada).'</td>
                                            <td>	'.$this->mostrar($fi->modalidad).'</td>
                                            <td>	'.$this->mostrar($fi->programa_formacion).'</td>
                                            <td>	'.$this->mostrar($fi->trimestre_formacion).'</td>
                                            <td> <a href="'.URL_APP.'/admin/fichas/'.$fi->id_ficha.'">editar</a> </td>
                                        </tr>';
                                    }
                                ?>
                        </tbody>
                    </table>
                
           <!-- Modal REGISTRAR FICHAS -->
           <div class="modal fade bd-example-modal-lg" id="insertFicha" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <form action="<?php echo URL_APP;?>/admin/insertFichas" class="form" method="POST">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                            <div class="col-12 section-senov">
                                <p class="modal-title" style="margin-right:4%;">Registrar Aprendiz
                                    <button type="button" style="margin-top: 0.1px;" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </p>
                                
                            </div>
                    </div>
                    <div class="modal-body ">
                        <div class="row border rounded bg-white shadow" style="height: 50%; width:95%; margin-left:2.5%;">
                            
                            <div class="col-12 app-p">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="fichaI">Ficha</label>
                                        <input type="text" required class="form-control" name="fichaI">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="jornadaI">Jornadas</label>
                                        <select name="jornadaI" id="" required>
                                            <option value="" selected disabled>Seleccione..</option>
                                            <?php
                                                foreach ($data2["jornadas"] as $j) {
                                                    echo "<option value='$j->id_jornada'>$j->jornada</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-row">
                                <div class="form-group col-md-6">
                                        <label for="trimestreI">Trimestre</label>
                                        <input type="text" required class="form-control" name="trimestreI">
                                    </div>
                                <div class="form-group col-md-6">
                                        <label for="modalidadI">Modalidades</label>
                                        <select name="modalidadI" id="" required>
                                            <option value="" selected disabled>Seleccione..</option>
                                            <?php
                                                foreach ($data2["modalidades"] as $m) {
                                                    echo "<option value='$m->id_modalidad'>$m->modalidad</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="programaI">Programas de Formacion</label>
                                        <select name="programaI" id="" required>
                                            <option value="" selected disabled>Seleccione..</option>
                                            <?php
                                                foreach ($data2["programas"] as $p) {
                                                    echo "<option value='$p->id_programa_formacion'>$p->programa_formacion</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="sedeI">Sede</label>
                                        <select name="sedeI" id="" required>
                                            <option value="" selected disabled>Seleccione..</option>
                                            <?php
                                                foreach ($data2["sedes"] as $p) {
                                                    echo "<option value='$p->id_sede'>$p->sede</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <center>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-outline-primary">Registrar Ficha</button>
                        </center>
                    </div>
                    </div>
                </div>
            </form>
            </div> 
             <!-- FIN REGISTRAR FICHAS  -->

             <!-- Modal ACTUALIZAR FICHAS -->
             <?php if(isset($data2["one_ficha"]) && !empty($data2["one_ficha"])): ?>
           <div class="modal fade bd-example-modal-lg" id="Modalsen" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <form action="<?php echo URL_APP;?>/admin/updateFichas" class="form" method="POST">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                            <div class="col-12 section-senov">
                                <p class="modal-title" style="margin-right:4%;">Registrar Aprendiz
                                    <button type="button" style="margin-top: 0.1px;" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </p>
                                
                            </div>
                    </div>
                    <div class="modal-body ">
                        <div class="row border rounded bg-white shadow" style="height: 50%; width:95%; margin-left:2.5%;">
                            
                            <div class="col-12 app-p">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="fichaU">Ficha</label>
                                        <input type="text" disabled required class="form-control" value="<?php echo $data2["one_ficha"]->id_ficha;?>">
                                        <input type="hidden" class="form-control" value="<?php echo $data2["one_ficha"]->id_ficha;?>" name="fichaU">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="jornadaU">Jornadas</label>
                                        <select name="jornadaU" id="" required>
                                            <?php
                                                foreach ($data2["jornadas"] as $j) {
                                                    if($data2["one_ficha"]->fk_id_jornada == $j->id_jornada){

                                                        echo "<option value='$j->id_jornada' selected>$j->jornada</option>";
                                                    }else{
                                                        echo "<option value='$j->id_jornada'>$j->jornada</option>";

                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-row">
                                <div class="form-group col-md-6">
                                        <label for="trimestreU">Trimestre</label>
                                        <input type="text" required class="form-control" value="<?php echo $data2["one_ficha"]->trimestre_formacion; ?>">
                                        <input type="hidden" required class="form-control" value="<?php echo $data2["one_ficha"]->trimestre_formacion; ?>" name="trimestreU">
                                    </div>
                                <div class="form-group col-md-6">
                                        <label for="modalidadU">Modalidades</label>
                                        <select name="modalidadU" id="" required>
                                            <?php
                                                foreach ($data2["modalidades"] as $m) {
                                                    if($data2["one_ficha"]->fk_id_modalidad == $j->id_modalidad){
                                                        echo "<option value='$m->id_modalidad' selected>$m->modalidad</option>";
                                                    }else{
                                                        echo "<option value='$m->id_modalidad' >$m->modalidad</option>";

                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="programaU">Programas de Formacion</label>
                                        <select name="programaU" id="" required>
                                            <?php
                                                foreach ($data2["programas"] as $p) {
                                                    if($data2["one_ficha"]->fk_id_programa_formacion == $j->id_programa_formacion){
                                                        echo "<option value='$p->id_programa_formacion' selected>$p->programa_formacion</option>";
                                                    }else{
                                                        echo "<option value='$p->id_programa_formacion' >$p->programa_formacion</option>";

                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="sedeU">Sede</label>
                                        <select name="sedeU" id="" required>
                                            <option value="<?php echo $data2["one_ficha"]->fk_id_sede;?>" selected> <?php echo $data2["one_ficha"]->sede;?></option>
                                            <?php
                                                foreach ($data2["sedes"] as $p) {
                                                    if($data2["one_ficha"]->fk_id_sede == $j->id_sede){
                                                        echo "<option value='$p->id_sede' selected>$p->sede</option>";
                                                    }else{
                                                        echo "<option value='$p->id_sede'>$p->sede</option>";

                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <center>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-outline-primary">Actualizar Ficha</button>
                        </center>
                    </div>
                    </div>
                </div>
            </form>
            </div> 
            <?php endif; ?>
             <!-- FIN ACTUALIZAR FICHAS  -->
            
        </div>
    </div>
</div>


<link rel="stylesheet" href="<?php echo URL_APP?>/css/files.css">
<script src="<?php echo URL_APP; ?>/public/js/modal.js"></script>
<?php include_once sidebar_p2; ?>