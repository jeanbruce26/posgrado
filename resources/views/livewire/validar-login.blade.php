<div>
    <form action="{{ route('login.store') }}" method="POST" class="formulario needs-validation" novalidate>
        @csrf
        <div class="mb-3">
            <label class="form-label">Tipo de Documento *</label>
            <select wire:model="tipo_documento" class="form-select @error('tipo_documento') is-invalid @enderror" name="tipo_documento" onchange="documento.disabled  = this.value == 0">
                <option value="" selected>Seleccione</option>
                @foreach ($tipo_doc as $item)
                <option value="{{$item->id_tipo_doc}}" {{ old('tipo_documento') == $item->id_tipo_doc ? 'selected' : '' }}>{{$item->doc}}</option>
                @endforeach
            </select>
            {{-- @error('tipo_documento')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror --}}
            @error('tipo_documento') <span class="error mt-1">{{ $message }}</span> @enderror
        </div>
    
        <div class="mb-3">
            <label class="form-label">Numero de documento *</label>
            <input type="text" wire:model="dni" name="documento" value="{{ old('documento') }}" class="form-control @error('documento') is-invalid @enderror" placeholder="Ingrese su número de documento" disabled>
            {{-- @error('dni')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror --}}
            @error('documento') <span class="error mt-1">{{ $message }}</span> @enderror
        </div>
    
        <div class="mb-3">
            <label class="form-label">Número de operación *</label>
            <input type="text" wire:model="nro_operacion" name="nro_operacion" value="{{ old('nro_operacion') }}" class="form-control @error('nro_operacion') is-invalid @enderror" placeholder="Ingrese su número de operación">
            {{-- @error('nro_operacion')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror --}}
            @error('nro_operacion') <span class="error mt-1">{{ $message }}</span> @enderror
        </div>
    
        @if (session('mensaje'))
            <div class="alert alert-danger mt-1 mb-1">{{ session('mensaje') }}</div>
        @endif
        
        <div class="mt-4">
            <button class="btn btn-primary w-100 w-sm waves-effect waves-light" type="submit">Ingresar</button>
        </div>
    </form>
</div>
