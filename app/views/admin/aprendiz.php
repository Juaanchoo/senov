<?php include_once sidebar_p1; ?>
<div class="container mt-5">
	<div class="card shadow">
	    <h5 class="card-header t-card">Aprendices</h5>
	    <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <a href="" class="btn btn-outline-primary">Registrar aprendiz &nbsp;<i class="fas fa-plus"></i></a>
                </div>
                <div class="col-md-6">
                    <div class="search-form">
                        <span>Buscar:</span>
                        <input type="text" placeholder="Buscar...">
                    </div>
                </div>
            </div>
            <?php 
            if(isset($data2["respuesta"])){
                echo $data2["respuesta"];
            }
                
                ?>
            <table class="table table-bordered table-striped">
                <thead class="text-center">
                    <tr>
                        <th>T. documento</th>
                        <th>Documento</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Ficha</th>
                        <th>Telefono</th>
                        <th>Email</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                        <?php
                        //var_dump($data2);
                            foreach ($data2["aprendices"] as $d) {
                                echo "<tr>
                                    <td>	$d->tipo_documento</td>
                                    <td>	$d->documento</td>
                                    <td>	$d->nombre</td>
                                    <td>	$d->primer_apellido"." ".$d->segundo_apellido."</td>
                                    <td>	$d->fk_id_ficha</td>
                                    <td>	$d->telefono</td>
                                    <td>	$d->email</td>
                                    <td> <a href='".URL_APP."/admin/aprendiz/$d->documento'>editar</a></td>
                                </tr>";
                            }
                        ?>
                </tbody>
            </table>
            <nav aria-label="...">
                <ul class="pagination">
                    <li class="page-item disabled">
                        <span class="page-link">Previous</span>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item active">
                        <span class="page-link">
                            2
                            <span class="sr-only">(current)</span>
                        </span>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>

			<?php if(isset($data3) && !empty($data3)): ?>
            <!--modal editar aprendiz -->
			<div class="modal fade bd-example-modal-lg" id="Modalsen" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <form method="POST" action="<?php echo URL_APP;?>/admin/updateAprendiz">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header mh t-card">
                                <p class="modal-title mt" id="exampleModalLabel">Información Novedad </p>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -5px;">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <hr>
                                <div class="row">
                                    <div class="col divM">Tipo Documento</div>
                                        <div class="col divM" ><?php echo $data3->tipo_documento; ?></div>
                                </div> 
                                <hr>
                                <div class="row">
                                    <div class="col divM">Documento</div>
                                    <div class="col divM" >
                                        <?php echo $data3->documento; ?>
                                        <input type="hidden" name="update" value="<?php echo $data3->documento; ?>">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col divM">Nombre</div>
                                    <div class="col divM" ><input type="text" name="nombre" value="<?php echo $data3->nombre; ?>"></div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col divM">Primer Apellido</div>
                                    <div class="col divM" ><input type="text" name="primer_apellido" value="<?php echo $data3->primer_apellido; ?>"></div>
                                </div>
                                <hr>
                                <hr>
                                <div class="row">
                                    <div class="col divM">segundo Apellido</div>
                                    <div class="col divM" ><input type="text" name="segundo_apellido" value="<?php echo $data3->segundo_apellido; ?>"></div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col divM">Email</div>
                                    <div class="col divM" ><input type="text" name="email" value="<?php echo $data3->email; ?>"></div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col divM">Telefono</div>
                                    <div class="col divM" ><input type="text" name="telefono" value="<?php echo $data3->telefono; ?>"></div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col divM">Codigo Ficha</div>
                                    <div class="col divM" ><?php echo $data3->fk_id_ficha; ?></div>
                                </div>
                            </div>
                        <div class="modal-footer justify-content-center">
                            <div class="row">
                                <div class="col divM" >
                                    <button type="submit" class="btn btn-outline-primary">Actualizar</button>
                                </div>
                                <div class="col divM"> 
                                    <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Cerrar</button>
                                </div>
                                    
                            </div>
                        </div>
                        </div>
                    </div>
                </form>
            </div>
            <?php endif;?>                       

        </div>
    </div>
</div>
<style>
	

	.search-form{
		margin: 10px;
		text-align: right;
	}
	.search-form input{
		width: 120px;
	}
	.search-form button{
		border-radius: 0px;
	}

	/* 
		modal
	*/

	.modal-body:not(.two-col) { padding:0px }
	.glyphicon { margin-right:5px; }
	.glyphicon-new-window { margin-left:5px; }
	.modal-body .radio,.modal-body .checkbox {margin-top: 0px;margin-bottom: 0px;}
	.modal-body .list-group {margin-bottom: 0;}
	.margin-bottom-none { margin-bottom: 0; }
	.modal-body .radio label,.modal-body .checkbox label { display:block; }
	.modal-footer {margin-top: 0px;}
	@media screen and (max-width: 325px){
			.btn-close {
					margin-top: 5px;
					width: 100%;
			}
			.btn-results {
					margin-top: 5px;
					width: 100%;
			}
			.btn-vote{
					margin-top: 5px;
					width: 100%;
			}
			
	}
	.modal-footer .btn+.btn {
			margin-left: 0px;
	}
	.progress {
			margin-right: 10px;
	}
</style>
<script src="<?php echo URL_APP; ?>/public/js/modal.js"></script>
<?php include_once sidebar_p2; ?>