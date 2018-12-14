<?php include_once sidebar_p1; ?>
<div class="container mt-5 app-m">
	<div class="card shadow">
	    <h5 class="card-header t-card">Gestion de Tipo de Formación</h5>
	    <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <a href="" onclick="limpiarModal()" data-toggle="modal" data-target="#exampleModal" class="btn btn-outline-dark">Registrar Tipo de Fomación &nbsp;<i class="fas fa-plus"></i></a>
                </div>
                
                <div class="col-md-6">
                    <div class="search-form">
                        <span>Buscar:</span>
                        <input type="text" placeholder="Buscar...">
                    </div>
                </div>
            </div>
            <?php
            // if(isset($_SESSION["re"]) && $_SESSION["re"]!=null){
            //     echo $_SESSION["re"];
            //     $_SESSION["re"] =null;
            // } 
            // if(isset($data2["respuesta"]) && $data2["respuesta"]!=null){
            //     $_SESSION["re"] = $data2["respuesta"];
            //     header("Location: ".URL_APP."/admin/usuarios_admin");
            // }
                
                ?>
            <table class="table table-bordered table-striped">
                <thead class="text-center">
                    <tr>
                        <th>#</th>
                        <th>Nombre de Formacion</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                        <?php foreach ($data as $item): ?>
                        <tr>
                            <td><?php echo $item->id_tipo_documento ?></td>
                            <td><?php echo $item->tipo_documento ?></td>
                            <td>

                                <button type="button" class="btn btn-warning" onclick="traerTipoDocumento(<?php echo $item->id_tipo_documento ?>)">
                                    <i class="far fa-edit"></i>
                                </button>

                            <?php if ($item->estado == 1): ?>
                            
                                <button type="button" class="btn btn-danger" onclick="eliminarTipoFormacion(<?php echo $item->id_tipo_documento ?>,0)">
                                    <i class="far fa-trash-alt"></i>
                                </button>

                            <?php else: ?>
                                <button type="button" class="btn btn-success" onclick="eliminarTipoFormacion(<?php echo $item->id_tipo_documento ?>,1)">
                                    <i class="far fa-check-circle"></i>
                                </button>
                            <?php endif ?>
                            
                            </td>
                        </tr>
                        <?php endforeach ?>

                </tbody>
            </table>

            <!--modal registrar nuevo Usuario-->
            <!-- Modal -->
            <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <!-- <form action="<?php echo URL_APP;?>/admin/setUsuario" class="form" method="POST"> -->
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                            <div class="col-12 section-senov">
                                <p class="modal-title" style="margin-right:4%;">Registrar Usuario
                                    <button type="button" style="margin-top: 0.1px;" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </p>
                                
                            </div>
                    </div>
                    <div class="modal-body ">
                        <div class="row border rounded bg-white shadow" style="height: 50%; width:95%; margin-left:2.5%;">
                            
                            <div class="col-12 app-p">
                                <div class="form-group">
                                    <label for="nombreTD">Nombre Tipo de Documento</label>
                                    <input id="nombreTD" type="text" class="form-control" name="nombreTD">
                                    <input id="id_tipo_documento" type="hidden">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <center>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-outline-primary" id="btn-registrar">Registrar</button>
                            <button type="button" class="btn btn-outline-primary" id="btn-actualizar">Actualizar</button>
                        </center>
                    </div>
                    </div>
                </div>
            <!-- </form> -->
            </div>                
            <!--FIN MODAL REGISTRAR-->

            <!-- MODAL HABILITAR USUARIO -->
            <div class="modal fade" id="modalHab" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">

                        <div class="modal-header t-card">
                            <h5 class="modal-title" id="exampleModalLongTitle">Habilitar Usuario</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <!-- <form method="POST" class="form" action="<?php echo URL_APP;?>/admin/habilitarUsuario"> -->
                        <div class="modal-body">
                        <div class="col-12" style="margin-top:10px;">
                            <div class="form-group">
                                <label for="tipo_documentoHab">Tipo de documento</label>
                                <select name="tipo_documentoHab" required >
                                    <option value="" selected disabled>Seleccione..</option>
                                    <?php
                                       
                                        foreach ($data2["tipo_documento"] as $td) {
                                        echo '<option value="'.$td->id_tipo_documento.'">'.$td->tipo_documento.'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="habDoc">Numero de Documento: &nbsp;</label>
                                <input placeholder="documento..." type="number" name="habDoc" required class="form-control">
                                
                            </div>
                            <div class="form-group">
                                <div class="p-2">
                                    <small class="text-muted"><b>Nota:</b> El documento ingresado tendrá acceso a registrarse (verifique bien la información)</small>
                                </div>
                            </div>
                        </div>                
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Habilitar Usuario</button>
                        </div>
                        <!-- </form> -->
                    </div>
                </div>
            </div>                                       
            <!-- FIN MODAL HABILITAR -->

			<?php if(isset($data3) && !empty($data3)): ?>
            <!--modal editar Usuarios -->
			<div class="modal fade bd-example-modal-lg" id="Modalsen" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <form method="POST" class="form" action="<?php echo URL_APP;?>/admin/updateUsuario">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header mh t-card">
                                <p class="modal-title mt" id="exampleModalLabel">Actualizar información del Usuario </p>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -5px;">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <hr>
                                <div class="form-row">
                                    <div class="form-group col-md-4  divM">Tipo Documento</div>
                                    <div class="form-group col-md-7  divM" ><?php echo $this->mostrar($data3->tipo_documento); ?></div>
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
                                    <div class="form-group col-md-7  divM" ><input type="text" class="form-control" name="nombre" value="<?php echo $this->mostrar($data3->nombre); ?>"></div>
                                </div>
                                <hr>
                                <div class="form-row">
                                    <div class="form-group col-md-4  divM">Primer Apellido</div>
                                    <div class="form-group col-md-7  divM" ><input type="text" class="form-control" name="primer_apellido" value="<?php echo $this->mostrar($data3->primer_apellido); ?>"></div>
                                </div>
                                <hr>
                                <div class="form-row">
                                    <div class="form-group col-md-4 divM">Segundo Apellido</div>
                                    <div class="form-group col-md-7  divM" ><input type="text" class="form-control" name="segundo_apellido" value="<?php echo $this->mostrar($data3->segundo_apellido); ?>"></div>
                                </div>
                                <hr>
                                <div class="form-row">
                                    <div class="form-group col-md-4  divM">Email</div>
                                    <div class="form-group col-md-7  divM" ><input type="text" class="form-control" name="email" value="<?php echo $this->mostrar($data3->email); ?>"></div>
                                </div>
                                <hr>
                                <div class="form-row">
                                    <div class="form-group col-md-4 divM">Telefono</div>
                                    <div class="form-group col-md-7 divM" ><input type="number" class="form-control" name="telefono" value="<?php echo $data3->telefono; ?>"></div>
                                </div>
                                <hr>
                                <div class="form-row">
                                    <div class="form-group col-md-4 divM">Dirección</div>
                                    <div class="form-group col-md-7 divM" ><input type="text" class="form-control" name="direccion" value="<?php echo $this->mostrar($data3->direccion); ?>"></div>
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
            <!-- END MODAL EDITAR -->
            <?php endif;?>                       

        </div>
    </div>
</div>

<script>

function limpiarModal() {
    $('#nombreTD').val('');
    $('#id_tipo_documento').val('');
    $('#btn-registrar').show();         
    $('#btn-actualizar').hide();         

}

function traerTipoDocumento(id){
    $.ajax({
        url: "http://localhost/senov/admin/ver_tipo_documento?id="+id,
        type: 'GET',
        success: function(res){
            res = JSON.parse(res).data;
            $('#nombreTD').val(res.tipo_documento);
            $('#id_tipo_documento').val(res.id_tipo_documento);
            $('#exampleModal').modal('show');    

            $('#btn-registrar').hide();         
        },
        data: id,
    });    
}

function eliminarTipoFormacion(id, estado) {
    $.ajax({
        url: "http://localhost/senov/admin/tipo_documento?estado="+estado+"&id="+id,
        type: 'DELETE',
        success: function(res){
            res = JSON.parse(res).data;
            
            if(res){
                swal({
                    type: 'success',
                    title: 'Exito!',
                    text: 'Ha logrado registrar el programa correctamente!',
                });
            }else{
                swal({
                    type: 'error',
                    title: 'Opps..',
                    text: 'No se pudo registrar el programa indicado',
                });
            }
            
            window.setInterval(function() { location.reload(true); }, 1000);
        },
        data: id,
    });
  
}


$("#btn-registrar").click(function(){
  var nombreTD = $('#nombreTD').val();

    // $.post( "http://localhost/senov/admin/tipo_formacion", function( data ) {
    //     console.log(data);
    //     alert('El registro a sido un exito')
    // });

    $.post( "http://localhost/senov/admin/tipo_documento", {nombre: nombreTD})
        .done(function( data ) {
            
            res = JSON.parse(data).data;
            
            if(res){
                swal({
                    type: 'success',
                    title: 'Exito!',
                    text: 'Ha logrado registrar el programa correctamente!',
                });
            }else{
                swal({
                    type: 'error',
                    title: 'Opps..',
                    text: 'No se pudo registrar el programa indicado',
                });
            }
            
            window.setInterval(function() { location.reload(true); }, 1000);
            
    });
  
});

$("#btn-actualizar").click(function(){
  var nombreTD = $('#nombreTD').val();
  var id = $('#id_tipo_documento').val();

    // $.post( "http://localhost/senov/admin/tipo_formacion", function( data ) {
    //     console.log(data);
    //     alert('El registro a sido un exito')
    // });

    $.ajax({
        url: "http://localhost/senov/admin/tipo_documento?nombre="+nombreTD+"&id="+id,
        type: 'PUT',
        success: function(res){
            res = JSON.parse(res).data;
            console.log(res);

            if(res){
                swal({
                    type: 'success',
                    title: 'Exito!',
                    text: 'Ha logrado registrar el programa correctamente!',
                });
            }else{
                swal({
                    type: 'error',
                    title: 'Opps..',
                    text: 'No se pudo registrar el programa indicado',
                });
            }
            
            window.setInterval(function() { location.reload(true); }, 1000);
   

        },
        data: {
            nombre: nombreTD,
            id: id
        },
    }); 
  
});
</script>

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