<div class="container-fluid">

	<div class="row header-panel">

		<div class="col-12 col-sm-12 col-md-2 logo">
			<span>SENOV</span>
			<i id="open" class="fas fa-bars icon-sidebar"></i>
			<i id="close" class="fas fa-times icon-sidebar"></i>
		</div>
		
		<div class="col-9">
		 <button class="btn" style="color: white; float: right; margin-top: 13px; background-color: #000 !important;">
			 USUARIO: <?php echo $_SESSION["nombre"].' '. $_SESSION["documento"];?>
		 </button>
		</div>
		
	</div>

	<div class="row">

		
			<div class="col-2 barra-lateral p-1">
				
				<div class="form-group p-4">
				    <select class="form-control">
				      <!-- <option value="">Adminintrador</option> -->
					  <?php 
					  
					 	foreach ($data as $r) {
							 echo '<option value="'.$r->fk_id_cargo.'">'.$r->cargo.'</option>';
						 } 
					  ?>
				    </select>
				</div>
				

			<nav id ="" class="menu-lateral">
				<ul>
					<li>
						<a href="<?php echo URL_APP; ?>" title="Ir al Inicio">
							<div class="barra"></div>
							<span><i class="fas fa-link mr-2"></i>Inicio</span>
						</a>
					</li>
					<li>
						<a href="<?php echo URL_APP; ?>" title="Ir a Diligenciar">
							<div class="barra"></div>
							<span><i class="fas fa-link mr-2"></i>Cambiar mis datos</span>
						</a>
					</li>
					<li>
						<a href="<?php echo URL_APP; ?>" title="Ir a Estados">
							<div class="barra"></div>
							<span><i class="fas fa-link mr-2"></i>Cambiar contraseña</span>
						</a>
					</li>
					<li>
						<a href="<?php echo URL_APP; ?>/user/logout" title="Salir">
							<div class="barra"></div>
							<span><i class="fas fa-link mr-2"></i>Salir</span>
						</a>
					</li>
				</ul>
			</nav>
		</div>
		
		<main class="col main">