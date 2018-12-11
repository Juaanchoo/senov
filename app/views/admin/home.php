<?php include_once sidebar_p1; ?>
<div class="container-fluid">

	<div class="row">
		<div class="col-12">
			<div class="mt-5 jumbotron jumbotron-fluid shadow-sm">
			  <div class="container-fluid">
			  	<div class="row justify-content-around">
		
						<div class="col-sm-6 col-md-3">
						<a href="<?php echo URL_APP?>/admin/nueva_novedad" style="text-decoration: none;">
							<div class="card text-white shadow mb-3" style="max-width: 28rem; background-color: #FF8400; border-bottom: 5px solid #333; height: 12rem;">
								<div class="card-body text-center">
									<h5 class="card-title">Registrar una nueva Novedad</h5>
									<h1 class="card-text"><i class="fas fa-plus-circle"></i></h1>
								</div>
							</div>
							</a>
						</div>
						<div class="col-sm-6 col-md-3">
						<a href="<?php echo URL_APP?>/admin/estado_novedad" style="text-decoration: none;">
							<div class="card text-white shadow mb-3" style="max-width: 28rem; background-color: #FF8400; border-bottom: 5px solid #333; height: 12rem;">
								<div class="card-body text-center">
									<h5 class="card-title">Novedades sin revisar</h5>
									<h1 class="card-text">
									<?php 
										if(isset($data2) && $data2!=null){
										echo $data2->counter;
										//  var_dump($data2);
										}
									?>
									</h1>
								</div>
							</div>
							</a>
						</div>
						<div class="col-sm-6 col-md-3">
							<a href="<?php echo URL_APP?>/admin/aprendiz" style="text-decoration: none;">
								<div class="card text-white shadow mb-3" style="max-width: 28rem; background-color: #FF8400; border-bottom: 5px solid #333; height: 12rem;">
									<div class="card-body text-center">
										<h5 class="card-title">Ir a Gestionar Aprendices</h5>
										<h1 class="card-text"><i class="fas fa-chalkboard-teacher"></i></h1>
									</div>
								</div>
							</a>
						</div>
						<div class="col-sm-6 col-md-3">
							<a href="<?php echo URL_APP?>/admin/usuarios_admin" style="text-decoration: none;">
								<div class="card text-white shadow mb-3" style="max-width: 28rem; background-color: #FF8400; border-bottom: 5px solid #333; height: 12rem;">
									<div class="card-body text-center">
										<h5 class="card-title">Ir a Gestionar Usuarios</h5>
										<h1 class="card-text"><i class="fas fa-user-plus"></i></h1>
									</div>
								</div>
							</a>
						</div>
					</div>
					<h1 class="display-4" align="center">Sena Novedades</h1>
			    <p class="lead" align="center">"Ninguna Novedad para por alto"</p>

				</div>
			</div>
		</div>
	</div>

	

	





</div>

<style>
	
</style>
<?php include_once sidebar_p2; ?>
