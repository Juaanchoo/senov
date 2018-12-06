<?php include_once sidebar_p1; ?>
<div class="container mt-5">
	<div class="card shadow">
	  <h5 class="card-header t-card">Novedades</h5>
	  <div class="card-body">
	  	<div class="search-form">
	  		<span>Buscar:</span>
	  		<input type="text" placeholder="Buscar...">
	  	</div>
	    <table class="table table-bordered table-striped">
	    	<thead class="text-center">
	    		<tr>
	    			<th>Id</th>
	    			<th>Documento</th>
	    			<th>Nombre</th>
	    			<th>Apellido</th>
	    			<th>Tipo novedad</th>
	    			<th>Opciones</th>
	    		</tr>
	    	</thead>
	    	<tbody class="text-center">
				
				<?php
				foreach ($data2 as $d) {
					echo "<tr>
						<td>	$d->id_novedad</td>
						<td>	$d->documento</td>
						<td>	$d->nombre</td>
						<td>	$d->primer_apellido</td>
						<td>	$d->novedad</td>
						<td> <a href='".URL_APP."/admin/estado_Novedad/$d->id_novedad'>Ver mas</a></td>
					</tr>";
				}
				?>
	    		
	    	</tbody>
	    </table>
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
      		<div class="col divM" ><?php echo $data3->tipo_documento; ?></div>
      </div> 
      <hr>
      	<div class="row">
      		<div class="col divM">Documento</div>
      		<div class="col divM" ><?php echo $data3->documento; ?></div>
      	</div>
      	<hr>
      	<div class="row">
      		<div class="col divM">Nombre</div>
      		<div class="col divM" ><?php echo $data3->nombre; ?></div>
      	</div>
      	<hr>
      	<div class="row">
      		<div class="col divM">Apellido</div>
      		<div class="col divM" ><?php echo $data3->primer_apellido." ".$data3->segundo_apellido; ?></div>
      	</div>
      	<hr>
      	<div class="row">
      		<div class="col divM">Email</div>
      		<div class="col divM" ><?php echo $data3->email; ?></div>
      	</div>
      	<hr>
      	<div class="row">
      		<div class="col divM">Telefono</div>
      		<div class="col divM" ><?php echo $data3->telefono; ?></div>
      	</div>
      	<hr>
      	<div class="row">
      		<div class="col divM">Codigo Ficha</div>
      		<div class="col divM" ><?php echo $data3->codigo_ficha; ?></div>
      	</div>
      	<hr>
      	<div class="row">
      		<div class="col divM">Novedad</div>
      		<div class="col divM" ><?php echo $data3->novedad; ?></div>
      	</div>
      	<hr>
      	<div class="row">
      		<div class="col divM">Acta Novedad</div>
      		<div class="col divM" ><?php echo $data3->acta_novedad; ?></div>
      	</div>
      	<hr>
      	<div class="row">
      		<div class="col divM">Fecha Inicio</div>
			<div class="col divM" ><?php echo $data3->fecha_inicio ?></div>
      	</div>
      	<hr>
      	<div class="row">
      		<div class="col divM">Fecha Final</div>
      		<div class="col divM" ><?php echo $data3->fecha_final; ?></div>
      	</div>
      	<hr>
      	<div class="row">
      		<div class="col divM">Estado</div>
      		<div class="col divM">
			  <?php if ($data3->estado == "En tramite") {
					echo '<span  class="badge badge-info" >En tramite</span>';
				}
				?>
			  <?php if ($data3->estado == "Aprobado") { echo '<span class="badge badge-success" >Aprobado</span>';}?>
			  <?php if ($data3->estado == "No Aprobado") { echo '<span  class="badge badge-danger" >No Aprobado</span>';}?>
			</div>
      	</div>
      </div>
	  <div class="modal-footer justify-content-center">
		<button type="button" class="btn btn-outline-dark" data-dismiss="modal">Cerrar</button>
	  </div>
    </div>
  </div>
</div>
			<?php endif;?>

<!--fin modal -->

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