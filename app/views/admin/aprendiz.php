<?php include_once sidebar_p1; ?>
<div class="container mt-5 app-m">
	<div class="card shadow">
	    <h5 class="card-header t-card">Aprendices</h5>
	    <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <a href="" data-toggle="modal" data-target="#exampleModal" class="btn btn-outline-primary">Registrar aprendiz &nbsp;<i class="fas fa-plus"></i></a>
                </div>
                <div class="col-md-6">
                    <div class="search-form">
                        <span>Buscar:</span>
                        <input type="text" placeholder="Buscar...">
                    </div>
                </div>
            </div>
            <?php
            if(isset($_SESSION["re"]) && $_SESSION["re"]!=null){
                echo $_SESSION["re"];
                $_SESSION["re"] =null;
            } 
            if(isset($data2["respuesta"]) && $data2["respuesta"]!=null){
                $_SESSION["re"] = $data2["respuesta"];
                header("Location: ".URL_APP."/admin/aprendiz");
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
                        <th>Dirección</th>
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
                                    <td>	$d->direccion</td>
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

            <!--modal registrar nuevo aprendiz-->
            <!-- Modal -->
            <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <form action="<?php echo URL_APP;?>/admin/setAprendiz" class="form" method="POST">
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
                                        <label for="documentoA">Documento</label>
                                        <input type="number" class="form-control" name="documentoA">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="tipo_documentoA">Tipo de Documento</label>
                                        <select name="tipo_documentoA" id="" required>
                                            <option value="">Seleccione..</option>
                                            <?php
                                                foreach ($data2["tipo_documento"] as $td) {
                                                    echo "<option value='$td->id_tipo_documento'>$td->tipo_documento</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    
                                    <label for="nombreA">Nombres</label>
                                    <input type="text" class="form-control" name="nombreA" required>
                                    
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="primer_apellidoA">Primer Apellido</label>
                                        <input type="text" class="form-control" name="primer_apellidoA" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="segundo_apellidoA">Segundo Apellido</label>
                                        <input type="text" class="form-control" name="segundo_apellidoA" id="" required>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="emailA">Email</label>
                                        <input type="email" class="form-control" name="emailA" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="telefonoA">Telefono</label>
                                        <input type="number" class="form-control" name="telefonoA" id="" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="direccionA">Dirección</label>
                                        <input type="text" class="form-control" name="direccionA" required>
                                    </div>
                                
                                    <div class="form-group col-md-6">
                                        <label for="fichaA">Seleccionar Ficha</label><br>
                                        <select name="fichaA" id="" required>
                                            <option value="">Seleccione..</option>
                                            <?php
                                                foreach ($data2["fichas"] as $f) {
                                                    echo "<option value='$f->id_ficha'>$f->id_ficha</option>";
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
                            <button type="submit" class="btn btn-outline-primary">Registrar Aprendiz</button>
                        </center>
                    </div>
                    </div>
                </div>
            </form>
            </div>                
            <!--FIN MODAL REGISTRAR-->

			<?php if(isset($data3) && !empty($data3)): ?>
            <!--modal editar aprendiz -->
			<div class="modal fade bd-example-modal-lg" id="Modalsen" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <form method="POST" class="form" action="<?php echo URL_APP;?>/admin/updateAprendiz">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header mh t-card">
                                <p class="modal-title mt" id="exampleModalLabel">Actualizar información del aprendiz </p>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -5px;">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <hr>
                                <div class="form-row">
                                    <div class="form-group col-md-4  divM">Tipo Documento</div>
                                    <div class="form-group col-md-7  divM" ><?php echo $data3->tipo_documento; ?></div>
                                </div> 
                                <hr>
                                <div class="form-row">
                                    <div class="form-group col-md-4  divM">Documento</div>
                                    <div class="form-group col-md-7  divM" >
                                        <?php echo $data3->documento; ?>
                                        <input type="hidden" name="update" value="<?php echo $data3->documento; ?>">
                                    </div>
                                </div>
                                <hr>
                                <div class="form-row">
                                    <div class="form-group col-md-4  divM">Nombre</div>
                                    <div class="form-group col-md-7  divM" ><input type="text" class="form-control" name="nombre" value="<?php echo $data3->nombre; ?>"></div>
                                </div>
                                <hr>
                                <div class="form-row">
                                    <div class="form-group col-md-4  divM">Primer Apellido</div>
                                    <div class="form-group col-md-7  divM" ><input type="text" class="form-control" name="primer_apellido" value="<?php echo $data3->primer_apellido; ?>"></div>
                                </div>
                                <hr>
                                <div class="form-row">
                                    <div class="form-group col-md-4 divM">Segundo Apellido</div>
                                    <div class="form-group col-md-7  divM" ><input type="text" class="form-control" name="segundo_apellido" value="<?php echo $data3->segundo_apellido; ?>"></div>
                                </div>
                                <hr>
                                <div class="form-row">
                                    <div class="form-group col-md-4  divM">Email</div>
                                    <div class="form-group col-md-7  divM" ><input type="text" class="form-control" name="email" value="<?php echo $data3->email; ?>"></div>
                                </div>
                                <hr>
                                <div class="form-row">
                                    <div class="form-group col-md-4 divM">Telefono</div>
                                    <div class="form-group col-md-7 divM" ><input type="number" class="form-control" name="telefono" value="<?php echo $data3->telefono; ?>"></div>
                                </div>
                                <hr>
                                <div class="form-row">
                                    <div class="form-group col-md-4 divM">Dirección</div>
                                    <div class="form-group col-md-7 divM" ><input type="text" class="form-control" name="direccion" value="<?php echo $data3->direccion; ?>"></div>
                                </div>
                                <hr>
                                <div class="form-row">
                                    <div class="form-group col-md-4  divM">Codigo Ficha</div>
                                    <div class="form-group col-md-7  divM" ><?php echo $data3->fk_id_ficha; ?></div>
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
	border-bottom: 1px solid #333 !important;
	transition: 300ms ease; 
	outline: none !important;

}

.form .form-control:focus{
	/*outline:1px solid #333;*/
	border-bottom: 1px solid #F57408 !important;
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
	margin-top: 5px;
	text-shadow: 1px 1px 5px #000;
	}
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