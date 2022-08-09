@extends ('user')

@section('content')

	<div class="col-sm-12">

		<h3 class="d-flex justify-content-between text-secondary">Ingreso de Documentos</h3>
        @if($errors->any())
            @foreach($errors->getMessages() as $this_error)
                <div class="alert alert-danger mt-1 mb-1">{{ $this_error[0] }}</div>
            @endforeach
        @endif

		<form action="{{ route('inscripcion.store3') }}" method="POST" class="row g-3 mt-2" enctype="multipart/form-data">
			@csrf
            <div class="col-md-6">
                <input type="hidden" class="form-control"  name="id_inscripcion" value="{{$id_inscripcion}}">
            </div>
            <table class="table table-striped">
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
                            <input class="mt-2 mb-2 form-control form-control-sm btn btn-outline-primary text-secondary btn-sm colorsito" 
                                type="file" 
                                name="expediente{{ $item->cod_exp }}"
                            >
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
