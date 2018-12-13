<?php include_once sidebar_p1; ?>
<div class="container mt-5">
	<div class="card shadow">
		<h5 class="card-header t-card">Novedades</h5>
		<div class="card-body">
		<div class="row">
                <!-- <div class="col-md-6">
                    <a href="" data-toggle="modal" data-target="#ModalDeser" class="btn btn-outline-dark">Registrar Deserción &nbsp;<i class="fas fa-plus"></i></a>
                </div> -->
                
                <div class="">
                    <div class="search-form">
                        <span>Buscar:</span>
                        <input type="text" placeholder="Buscar...">
                    </div>
                </div>
            </div>
			<table class="table table-bordered table-striped">
				<thead class="text-center">
					<tr>
						<th>Id</th>
						<th>Documento</th>
						<th>Nombre</th>
						<th>Apellido</th>
						<th>Ficha</th>
						<th>Tipo Novedad</th>
						<th>Opciones</th>
					</tr>
				</thead>
				<tbody class="text-center">
						<?php
						//var_dump($data2);
							foreach ($data2 as $d) {
								echo '<tr>
									<td>	'.$this->mostrar($d->id_novedad).'</td>
									<td>	'.$this->mostrar($d->documento).'</td>
									<td>	'.$this->mostrar($d->nombre).'</td>
									<td>	'.$this->mostrar($d->primer_apellido).'</td>
									<td>	'.$this->mostrar($d->fk_id_ficha).'</td>
									<td>	'.$this->mostrar($d->novedad).'</td>
									<td> <a href="'.URL_APP.'/admin/estado_Novedad/'.$d->id_novedad.'">Ver mas</a></td>
								</tr>';
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
			<!--modal ver novedad -->
			<div class="modal fade bd-example-modal-lg" id="Modalsen" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
									<div class="col divM" ><?php echo $this->mostrar($data3->tipo_documento); ?></div>
							</div> 
							<hr>
							<div class="row">
								<div class="col divM">Documento</div>
								<div class="col divM" ><?php echo $data3->documento; ?></div>
							</div>
							<hr>
							<div class="row">
								<div class="col divM">Nombre</div>
								<div class="col divM" ><?php echo $this->mostrar($data3->nombre); ?></div>
							</div>
							<hr>
							<div class="row">
								<div class="col divM">Apellido</div>
								<div class="col divM" ><?php echo $this->mostrar($data3->primer_apellido)." ".$this->mostrar($data3->segundo_apellido); ?></div>
							</div>
							<hr>
							<div class="row">
								<div class="col divM">Email</div>
								<div class="col divM" ><?php echo $this->mostrar($data3->email); ?></div>
							</div>
							<hr>
							<div class="row">
								<div class="col divM">Telefono</div>
								<div class="col divM" ><?php echo $this->mostrar($data3->telefono); ?></div>
							</div>
							<hr>
							<div class="row">
								<div class="col divM">Codigo Ficha</div>
								<div class="col divM" ><?php echo $this->mostrar($data3->fk_id_ficha); ?></div>
							</div>
							<hr>
							<div class="row">
								<div class="col divM">Novedad</div>
								<div class="col divM" ><?php echo $this->mostrar($data3->novedad); ?></div>
							</div>
							<hr>
							<div class="row">
								<div class="col divM">Acta Novedad</div>
								<div class="col divM" >
									<?php 
										if($data3->novedad == "APLAZAMIENTO"){
											echo "<a href='".URL_APP."/admin/PDFAplazamiento/".$data3->id_novedad."'>Generar Pdf</a>";
										}
										if($data3->novedad == "TRASLADO"){
											echo "<a href='".URL_APP."/admin/PDFTraslado/".$data3->id_novedad."'>Generar Pdf</a>";
										}
										if($data3->novedad == "RETIRO VOLUNTARIO"){
											echo "<a href='".URL_APP."/admin/PDFRetiroVoluntario/".$data3->id_novedad."'>Generar Pdf</a>";
										}
										if($data3->novedad == "CAMBIO DE JORNADA"){
											echo "<a href='".URL_APP."/admin/PDFcambioJ/".$data3->id_novedad."'>Generar Pdf</a>";
										}
										if($data3->novedad == "REINTEGRO"){
											echo "<a href='".URL_APP."/admin/PDFreintegro/".$data3->id_novedad."'>Generar Pdf</a>";
										}
										if($data3->novedad == "DESERCION"){
											echo "<a href='".URL_APP."/admin/PDFdesercion/".$data3->id_novedad."'>Generar Pdf</a>";
										}
									?> 
								</div>
							</div>
							<hr>
							<div class="row">
								<div class="col divM">Fecha Inicio</div>
								<div class="col divM" ><?php echo $data3->fecha_inicio ?></div>
							</div>
							<!-- <hr>
							<div class="row">
								<div class="col divM">Fecha Final</div>
								<div class="col divM" ><?php echo $data3->fecha_final; ?></div>
							</div> -->
							<hr>
							<div class="row">
								<div class="col divM">Estado Novedad</div>
								<div class="col divM">
									<?php if ($this->mostrar($data3->estado_novedad) == "En Tramite") {
										echo '<span  class="badge badge-info" >En tramite</span>';
									}
									?>
									<?php if ($this->mostrar($data3->estado_novedad) == "Aprobado") { echo '<span class="badge badge-success" >Aprobado</span>';}?>
									<?php if ($this->mostrar($data3->estado_novedad) == "No Aprobado") { echo '<span  class="badge badge-danger" >No Aprobado</span>';}?>
								<div class="btn-group dropright">
									<button type="button" class="btn btn-secondary " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<i class="fas fa-cog"></i>
									</button>
									<div class="dropdown dropdown-menu" id="" x-placement="right-start" style="position: absolute !important; transform: translate3d(112px, 0px, 0px) !important; top: 0px !important; left: 0px !important; will-change: transform !important;">
										<a data-toggle="modal" data-target="#modalActualizarNov" class="dropdown-item" href="#">Ver toda la novedad</a>
										<div class="dropdown-divider"></div>
										<a data-toggle="modal" data-target="#modalActualizarNov" class="dropdown-item" href="#">Actualizar Estado</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer justify-content-center">
						<button type="button" class="btn btn-outline-dark" data-dismiss="modal">Cerrar</button>
					</div>
				</div>
			</div>
			<!--fin modal-->
		
			<?php endif;?>




			<!-- Modal estado -->
			<div class="modal fade" id="modalActualizarNov" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLongTitle">Modificar Estado	</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="p-3">
							<div class="custom-control custom-radio custom-control-inline">
								<input value="1" v-model="estado.status" type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input">
								<label class="custom-control-label" for="customRadioInline1">En tramite</label>
							</div>
							<div class="custom-control custom-radio custom-control-inline">
								<input value="2" v-model="estado.status" type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input">
								<label class="custom-control-label" for="customRadioInline1">Aprobado</label>
							</div>
							<div class="custom-control custom-radio custom-control-inline">
								<input value="3" v-model="estado.status" type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input">
								<label class="custom-control-label" for="customRadioInline2">No Aprobado</label>
							</div>
						</div>
						<div>
							<p class="text-muted p-2">
								<b>Nota:</b> Por favor! Verifique toda la información de la novedad antes de cambiar su estado.
							</p>
						</div>
					</div>
				</div>
				<div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
						<button type="button" class="btn btn-primary" @click="actualizarEstado()">Actualizar</button>
					</div>
				</div>
			</div>
			<!--fin modal-->



		
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