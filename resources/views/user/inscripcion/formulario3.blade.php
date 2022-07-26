@extends ('user')

@section('content')

	<div class="col-sm-12">
		
		<h3 class="d-flex justify-content-between text-secondary">Ingreso de Documentos</h3>

		<form action="" method="POST" class="row g-3 mt-2">
			@csrf

            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>Tipo de Documento</th>
                        <th>Acción</th>
                        <th>FORMATO</th>
                    </tr>
                </thead>
    
                <tbody>
                    @foreach ($expediente as $item)
                    <tr>
                        <td>
                            <label class="form-label mt-2 mb-2">{{ $item->tipo_doc }} (*)</label>
                        </td>
                        <td>
                            <input class="mt-2 mb-2" type="file" name="expediente" id="expediente">
                        </td>
                        <td>
                            <label class="form-label mt-2 mb-2">PDF</label>
                        </td> 
                    </tr>

                    @endforeach
                </tbody>
            </table>

			<div class="col-md-12" >
				<button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Guardar y continuar</button>
			</div>

		</form>

	</div>

@endsection
