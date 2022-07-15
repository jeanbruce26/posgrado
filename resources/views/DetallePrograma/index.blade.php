@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Detalle Programa
		<a href="" class="btn btn-primary pull-right">Nuevo</a>
		</h2>

		<table class="table table-hover table-striped">
			<thead>
				<tr>
                         <th>Id</th>
					<th>Programa</th>
                         <th>Codigo Detalle Programa</th>
                         <th>Descripcion</th>
                         <th>Plan</th>
                         <th>Sede</th>
                         <th>Acciones</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($detpro as $detalle)

				<tr>
					<td>{{$detalle->id_detalle_programa}}</td>
					<td>{{$detalle->programa->descripcion_programa}}</td>
                         <td>{{$detalle->cod_detalle_programa}}</td>
					<td>{{$detalle->des_detalle_programa}}</td>
                         <td>{{$detalle->plan->plan}}</td>
					<td>{{$detalle->sede->sede}}</td> 
					<td>
                              <button type="button" class="btn btn-success">Editar</button>
                              <button type="button" class="btn btn-danger">Eliminar</button>
                         </td>
				</tr>

				@endforeach
			</tbody>
		</table>
		{!! $detpro->render() !!}

	</div>

	<div class="col-sm-4">
		
	</div>

@endsection
