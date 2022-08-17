@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Expediente
            <a href="{{ route('Expediente.create') }}" class="btn btn-primary pull-right d-flex justify-content-center align-items-center text-center">Nuevo <i class="fas fa-plus-circle ms-1"></i></a>
        </h2>

		<table class="table table-hover table-striped">
			<thead>
				<tr class="col-sm-12">
					<th class="col-1">Código</th>
					<th>Tipo de documento</th>
					<th class="col-2">Estado</th>
					<th class="col-1">Acciones</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($exp as $expediente)

				<tr>
					<td>{{$expediente->cod_exp}}</td>
					<td>{{$expediente->tipo_doc}}</td>
					<td>
                        @if($expediente->estado == 1)
                            <div class="p-1 bg-info text-white rounded-pill d-flex justify-content-center align-items-center text-center w-75">Activo</div></td>
                        @else
                            <div class="p-1 bg-danger text-white rounded-pill d-flex justify-content-center align-items-center text-center w-75">Inactivo</div></td>
                        @endif
                    </td>
					<td class="d-flex justify-content-star">
                        <a href="{{ route('Expediente.edit', $expediente->cod_exp) }}" type="button" class="btn btn-success d-flex justify-content-center align-items-center text-center">Editar <i class="fas fa-edit ms-1"></i></a>
                    </td>
				</tr>

				@endforeach
			</tbody>
		</table>
		{!! $exp->render() !!}

	</div>

	<div class="col-sm-4">
		
	</div>

@endsection
