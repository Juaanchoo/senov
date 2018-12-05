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
				<tr>
	    			<td>#</td>
	    			<td>csdf</td>
	    			<td>csdf</td>
	    			<td>csdf</td>
	    			<td>csdf</td>
	    			<td> <a href='#'>Ver mas</a></td>
	    		</tr>
				<?php
				foreach ($data2 as $d) {
					echo "<tr>
						<td>	$d->id_novedad</td>
						<td>	$d->documento</td>
						<td>	$d->nombre</td>
						<td>	$d->apellido</td>
						<td>	$d->novedad</td>
						<td> <a href='#'>Ver mas</a></td>
					</tr>";
				}
				?>
	    		
	    		<!-- <tr>
	    			<td>csdf</td>
	    			<td>csdf</td>
	    			<td>csdf</td>
	    			<td>csdf</td>
	    			<td>csdf</td>
	    		</tr>
	    		<tr>
	    			<td>csdf</td>
	    			<td>csdf</td>
	    			<td>csdf</td>
	    			<td>csdf</td>
	    			<td>csdf</td>
	    		</tr> -->
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
</style>