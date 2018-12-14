<?php include_once sidebar_p1; ?>
<div class="container mt-5 app-m">
	<div class="card shadow">
	    <h5 class="card-header t-card">Gestion de Competencia</h5>
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

            <table class="table table-bordered table-striped">
                <thead class="text-center">
                    <tr>
                        <th>#</th>
                        <th>Nombre de Competencia</th>
                        <th>Programa</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                        <?php foreach ($data as $item): ?>
                        <tr>
                            <td><?php echo $item->id_competencia ?></td>
                            <td><?php echo $item->competencia ?></td>
                            <td><?php echo $item->programa_formacion ?></td>
                            <td>

                                <button type="button" class="btn btn-warning" onclick="traercompetencia(<?php echo $item->id_competencia ?>)">
                                    <i class="far fa-edit"></i>
                                </button>

                            <?php if ($item->estado == 1): ?>
                            
                                <button type="button" class="btn btn-danger" onclick="eliminar(<?php echo $item->id_competencia ?>,0)">
                                    <i class="far fa-trash-alt"></i>
                                </button>

                            <?php else: ?>
                                <button type="button" class="btn btn-success" onclick="eliminar(<?php echo $item->id_competencia ?>,1)">
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
                                    <label for="nombrecompetencia">Nombre competencia</label>
                                    <input id="nombrecompetencia" type="text" class="form-control" name="nombrecompetencia">
                                    <input id="id_competencia" type="hidden">
                                </div>

                                <div class="form-group">
                                    <label for="">Programa</label>
                                    <select class="form-control" id="programa">
                                        <option value="">Select....</option>
                                    </select>
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

        </div>
    </div>
</div>


<script>

$(window).ready(function(){
    function select_programa(){

        

        $.ajax({
            url: "http://localhost/senov/admin/select_programa",
            type: 'GET',
            success: function(res){
                res = JSON.parse(res).data;
                console.log(res);  

                $.each( res, function( key, value ) {                    
                    $('#programa').append('<option id="programa_'+value.id_programa_formacion+'" value="'+ value.id_programa_formacion +'">'+ value.programa_formacion +'</option>'); 
                });
                
                // $('#programa_0').attr('selected', 'selected');
            },
        }); 
    }
    select_programa();
});


function limpiarModal() {
    $('#nombrecompetencia').val('');
    $('#id_competencia').val('');
    $('#btn-registrar').show();         
    $('#btn-actualizar').hide();
    $('#programa').children().removeAttr('selected');         

}

function traercompetencia(id){
    $.ajax({
        url: "http://localhost/senov/admin/ver_competencia?id="+id,
        type: 'GET',
        success: function(res){
            res = JSON.parse(res).data;
            console.log(res);
            
            $('#nombrecompetencia').val(res.competencia);
            $('#id_competencia').val(res.id_competencia);
            $('#exampleModal').modal('show'); 
            $('#programa_'+res.fk_id_programa).attr('selected', 'selected');   

            $('#btn-registrar').hide(); 
            $('#btn-actualizar').show();         
        },
        data: id,
    });    
}

function eliminar(id, estado) {
    $.ajax({
        url: "http://localhost/senov/admin/competencia?estado="+estado+"&id="+id,
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
  var nombrecompetencia = $('#nombrecompetencia').val();
  var programa = $('#programa').val();

    $.post( "http://localhost/senov/admin/competencia", {nombre: nombrecompetencia, programa: programa})
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
  var nombrecompetencia = $('#nombrecompetencia').val();
  var programa = $('#programa').val();
  var id = $('#id_competencia').val();

    // $.post( "http://localhost/senov/admin/tipo_formacion", function( data ) {
    //     console.log(data);
    //     alert('El registro a sido un exito')
    // });
    
    $.ajax({
        url: "http://localhost/senov/admin/competencia?nombre="+nombrecompetencia+"&programa="+programa+"&id="+id,
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
            nombre: nombrecompetencia,
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