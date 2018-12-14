<?php include_once sidebar_p1; ?>
<div class="container mt-5 app-m">
	<div class="card shadow">
	    <h5 class="card-header t-card">Gestión de documentos habilitados</h5>
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
                    header("Location: ".URL_APP."/admin/documentosHabilitados"); 
                 }
            ?>

            <div class="form-row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <thead class="text-center">
                            <tr>    
                                <th colspan="100" class="t-table">Documentos Activados</th>
                            </tr>
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
                                            <td> <a onclick="alerta('.$h->documento.');" href="#">desactivar</a> </td>
                                        </tr>';
                                    }
                                ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <thead class="text-center">
                            <tr>    
                                <th colspan="100" class="t-table">Documentos Desactivados</th>
                            </tr>
                            <tr>
                                <th>Tipo Documento</th>
                                <th>Documento</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                                <?php
                                // var_dump($data2);
                                if($data2["deshabilitados"]!= false){

                                    foreach ($data2["deshabilitados"] as $dh) {
                                        echo '<tr>
                                            <td>	'.$this->mostrar($dh->tipo_documento).'</td>
                                            <td>	'.$this->mostrar($dh->documento).'</td>
                                            <td> <a onclick="alerta1('.$dh->documento.');" href="#">activar</a> </td>
                                        </tr>';
                                    }
                                }
                                ?>
                        </tbody>
                    </table>
                </div>
            </div>

            
        </div>
    </div>
</div>
<script>
function alerta(documento) {
     var r = confirm("Si el usuario esta registrado, tambien lo deshabilitará");
    if (r == true) {
        var url = '<?php echo URL_APP;?>/admin';
        window.location = url+"/deshabilitar/"+documento;
        console.log(url);
        
    } else {
        txt = "You pressed Cancel!";
    }   
}

function alerta1(documento) {
     var r = confirm("Si el usuario esta registrado, tambien lo habilitará");
    if (r == true) {
        var url = '<?php echo URL_APP;?>/admin';
        window.location = url+"/habilitar/"+documento;
        console.log(url);
        
    } else {
        txt = "You pressed Cancel!";
    }   
}
</script>
<link rel="stylesheet" href="<?php echo URL_APP?>/css/files.css">
<script src="<?php echo URL_APP; ?>/public/js/modal.js"></script>
<?php include_once sidebar_p2; ?>
