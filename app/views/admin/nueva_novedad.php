<?php include_once sidebar_p1; ?>
<div class="container app-m">
	<div class="row justify-content-center">
		<div class="col-10">
        	<div class="col-12 row section-senov">
				<p style="margin-right:550px">Registrar Novedad</p>
				<button type="submit" class="btn btn-volver"><a href="<?php echo URL_APP?>"><i class="fas fa-undo-alt"></i> Volver</a></button>
        	</div>
			<div class="row border rounded bg-white shadow" style="height: 700px; width: 920px;">
				<div class="col-12 app-p">
					<form class="form" action="" method="post">
                     
					
                  	<div class="form-row">

					  	<div class="form-group col-md-6">
							<label for="tipo_novedad">Tipos de Novedad</label>
							<select name="tipo_novedad" id="tipo_novedad">
									<option disabled selected value="">Seleccione..</option>
									<?php 
										foreach ($data2["tipo_novedades"] as $n) {
											echo '<option value="'.$n->id_novedad.'">'.$n->novedad.'</option>';
										}
									?>
                      	      		
                      	  	</select>
					  	</div>
                      	<div class="form-group col-md-6">
						    <label for="tipo_documento">Tipo Documento</label><br>
                      	  		<select name="tipo_documento" id="tipo_documento">
									<option disabled selected value="">Seleccione..</option>
									<?php 
										foreach ($data2["tipos_documento"] as $d) {
											echo '<option value="'.$d->id_tipo_documento.'">'.$d->tipo_documento.'</option>';
										}
									?>
                      	      		
                      	  		</select>
					  	</div>

                  	</div>
					<div class="form-group">
						<label for="documento">Documento</label>
					    <input name="dni" type="text" class="form-control" id="documento" value="<?php echo isset($_REQUEST['dni']) ? $_REQUEST['dni'] : '';  ?>" placeholder="Documento..." required autocomplete="off">

					</div>
					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="documento">Motivo</label>
					    	<textarea name="motivo"  class="form-control" id="motivo" placeholder="Motivo..." required autocomplete="off"></textarea>
					  	</div>
						<div class="form-group col-md-6">
					    	<label for="documento">Comentarios del responsable</label>
					    	<textarea name="comentarios"  class="form-control" id="comentarios" placeholder="Comentarios del responsable..." required autocomplete="off"></textarea>
					  	</div>
						
					</div>
					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="documento">Recomendaciones</label>
					    	<textarea name="recomendaciones"  class="form-control" id="recomendaciones" placeholder="Recomendaciones.." required autocomplete="off"></textarea>
					  	</div>
						<div class="form-group col-md-6">
					    	<label for="documento">Evidencias</label>
					    	<textarea name="evidencias"  class="form-control" id="evidencias" placeholder="Evidencias..." required autocomplete="off"></textarea>
					  	</div>
						
					</div>
					<div class="form-group">
						<label for="documento">Nueva Jornada</label>
					    <textarea name="nueva_jornada"  class="form-control" id="nueva_jornada" placeholder="Nueva Jornada.." required autocomplete="off"></textarea>
					</div>
					<div class="form-group">
						<label for="documento">Nueva Ficha</label>
					    <textarea name="nueva_ficha"  class="form-control" id="nueva_ficha" placeholder="Nueva Ficha..." required autocomplete="off"></textarea>
					</div>
					<br>
					  	<button type="submit" class="btn btn-login col-4">Registrar Novedad</button>
					 	<button type="submit" class="btn btn-limpiar" style="float: right;"><a href="<?php echo URL_APP?>/home/registrar">Limpiar datos</a></button>
						
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<style>
.divM{
	margin-left: 20px;
	padding: -3px;
	font-size: 18px;
}
body{
	background-color: #e5e5e5;
}
.btn-login{
	border: none;
	background: #F57408; 
	color: #fff !important;
}

.btn-login:hover{
	background: #F57408;
	opacity: 0.8;
	transition: 0.5s;
	box-shadow: 1px 1px 5px #000;
}

.btn-volver {
	background: none;
}

.btn-volver a{
	color: #fff;
}

.btn-limpiar{
	border: none;
	background: #333;
}

.btn-limpiar a{
	color: #fff;
	text-decoration: none;
}

.btn-limpiar:hover{
	background: #333;
	opacity: 0.8;
	transition: 0.5s;
	box-shadow: 1px 1px 5px #000;
}

.app-p{
	
	padding: 1rem;
	padding-top: 55px;
}
.app-m{
	margin-top: 10%;
}

label{
	font-weight: bold;
}

select{
	width: 370px;
	height: 38px;
	border-left: none;
	border-right: none;
	border-top: none;
	border-bottom: 1px solid #333;
	border-radius: 5px;
	outline:none;

}

select:focus{
	/* border-left-style: none;
	border-right-style: none;
	border-top-style: none; */
	border-bottom: 1px solid #333;
}

.form{
	padding-left:  50px;
	padding-right:   50px;
}

.form .form-control{
	border-left: none;
	border-right: none;
	border-top: none;
	border-radius: 5px;
	border-bottom: 1px solid #333;
	transition: 300ms ease; 
	outline: none !important;

}

.form .form-control:focus{
	/*outline:1px solid #333;*/
	border-bottom: 1px solid #F57408;
}
.mt{
	color: #fff;
	font-size: 30px;
	text-shadow: 1px 1px 5px #000;
}
.mh{
	background: rgba(255,175,75,1);
	background: -moz-linear-gradient(top, rgba(255,175,75,1) 30%, rgba(255,159,40,1) 43%, rgba(255,140,0,1) 58%, rgba(255,140,0,1) 64%);
	background: -webkit-gradient(left top, left bottom, color-stop(30%, rgba(255,175,75,1)), color-stop(43%, rgba(255,159,40,1)), color-stop(58%, rgba(255,140,0,1)), color-stop(64%, rgba(255,140,0,1)));
	background: -webkit-linear-gradient(top, rgba(255,175,75,1) 30%, rgba(255,159,40,1) 43%, rgba(255,140,0,1) 58%, rgba(255,140,0,1) 64%);
	background: -o-linear-gradient(top, rgba(255,175,75,1) 30%, rgba(255,159,40,1) 43%, rgba(255,140,0,1) 58%, rgba(255,140,0,1) 64%);
	background: -ms-linear-gradient(top, rgba(255,175,75,1) 30%, rgba(255,159,40,1) 43%, rgba(255,140,0,1) 58%, rgba(255,140,0,1) 64%);
	background: linear-gradient(to bottom, rgba(255,175,75,1) 30%, rgba(255,159,40,1) 43%, rgba(255,140,0,1) 58%, rgba(255,140,0,1) 64%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffaf4b', endColorstr='#ff8c00', GradientType=0 );
}

.section-senov{
	/*background-color: #FF8400;*/
	background: rgba(255,175,75,1);
	background: -moz-linear-gradient(top, rgba(255,175,75,1) 30%, rgba(255,159,40,1) 43%, rgba(255,140,0,1) 58%, rgba(255,140,0,1) 64%);
	background: -webkit-gradient(left top, left bottom, color-stop(30%, rgba(255,175,75,1)), color-stop(43%, rgba(255,159,40,1)), color-stop(58%, rgba(255,140,0,1)), color-stop(64%, rgba(255,140,0,1)));
	background: -webkit-linear-gradient(top, rgba(255,175,75,1) 30%, rgba(255,159,40,1) 43%, rgba(255,140,0,1) 58%, rgba(255,140,0,1) 64%);
	background: -o-linear-gradient(top, rgba(255,175,75,1) 30%, rgba(255,159,40,1) 43%, rgba(255,140,0,1) 58%, rgba(255,140,0,1) 64%);
	background: -ms-linear-gradient(top, rgba(255,175,75,1) 30%, rgba(255,159,40,1) 43%, rgba(255,140,0,1) 58%, rgba(255,140,0,1) 64%);
	background: linear-gradient(to bottom, rgba(255,175,75,1) 30%, rgba(255,159,40,1) 43%, rgba(255,140,0,1) 58%, rgba(255,140,0,1) 64%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffaf4b', endColorstr='#ff8c00', GradientType=0 );
	color: #fff;
	justify-content: center;
	padding: 8px;
	font-size: 30px;
	height: 60px; 
	margin-top: -150px;
	text-shadow: 1px 1px 5px #000;
	}

	/* .smsDanger{
	background-color: #D75C41;
	position: absolute;
	padding: 12.5px 10px;
	left: 650px;
	right: -400px;
	border-radius: 5px;
	z-index: 1000;
	color: #fff;
	font-family: 'Roboto', sans-serif;
	font-size: 20px;
	width: auto; 
}

#status{
	position: absolute;
	height: 40px;
	width: 55px;
}


.dangerNovedad{
	border: 1px solid #FF2D00 !important; 
}

.successNovedad{
	border: 1px solid #5DEA56 !important; 
}

.checkIDanger{
	color: #FFF;
	font-weight: bold;
	background: #FE5151 !important;
}

.checkISuccess{
	color: #FFF;
	font-weight: bold;
	background: #5DEA56 !important;
} */
</style>
<script src="<?php echo URL_APP;?>/public/js/files.js"></script>
<?php include_once sidebar_p2; ?>