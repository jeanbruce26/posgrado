@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Editar Universidad</h2>

		<form action="{{ route('Universidad.update',$uni->cod_uni) }}" method="POST" class="row g-3">
               {{ method_field('PUT') }}
               @csrf
               <div class="col-md-12">
                    <label class="form-label">Universidad *</label>
                    <input type="text" class="form-control" name="universidad"  value="{{ $uni->universidad }}">
                    @error('universidad')
                         <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
               </div>
			<div class="col-md-6">
				<label class="form-label">Departamento *</label>
				<input type="text" class="form-control" name="depart"  value="{{ $uni->depart }}">
                    @error('depart')
                         <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
               </div>
               <div class="col-md-6">
				<label class="form-label">Tipo de Gestion *</label>
				<input type="text" class="form-control" name="tipo_gesti"  value="{{ $uni->tipo_gesti }}">
                    @error('tipo_gesti')
                         <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
               </div>
			<div class="col-12">
				<button type="submit" class="btn btn-primary">Actualizar</button>
			</div>
		</form>

	</div>

@endsection
