@extends ('admin')

@section('content')

	<div class="col-sm-12">
		
		<h2 class="d-flex justify-content-between">Editar Admisión</h2>

		<form action="{{ route('Admision.update',$admi->cod_admi) }}" method="POST" class="row g-3">
			{{ method_field('PUT') }}
            @csrf
            
			<div class="col-md-6">
                <label for="inputAdmision" class="form-label">Admisión *</label>
				<input type="text" class="form-control" id="inputAdmision" name="admision"  value="{{ $admi->admision }}">
                    @error('admision')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
            </div>


			<div class="col-12">
				<button type="submit" class="btn btn-primary">Actualizar</button>
			</div>
		</form>




	</div> 

@endsection
