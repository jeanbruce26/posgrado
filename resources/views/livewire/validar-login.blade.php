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
            <input type="text" wire:model="dni" name="documento" value="{{ old('documento') }}" class="form-control @error('documento') is-invalid @enderror" placeholder="Ingrese su número de documento" onkeypress="return soloNumeros(event)" id="miInput" onblur="limpiaNum()" disabled>
            {{-- @error('dni')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror --}}
            @error('documento') <span class="error mt-1">{{ $message }}</span> @enderror
        </div>
    
        <div class="mb-3">
            <label class="form-label">Número de operación *</label>
            <input type="text" wire:model="nro_operacion" name="nro_operacion" value="{{ old('nro_operacion') }}" class="form-control @error('nro_operacion') is-invalid @enderror" placeholder="Ingrese su número de operación" onkeypress="return soloNumeros(event)" id="miInput2" onblur="limpiaNum2()">
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

<script>
    function soloNumeros(e) {
        key = e.keyCode || e.which;
        tecla = String.fromCharCode(key).toLowerCase();
        letras = "1234567890";
        especiales = [8, 37, 39, 46];

        tecla_especial = false
        for(var i in especiales) {
            if(key == especiales[i]) {
                tecla_especial = true;
                break;
            }
        }
    
        if(letras.indexOf(tecla) == -1 && !tecla_especial)
            return false;
    }

    function limpiaNum() {
        var val = document.getElementById("miInput").value;
        var tam = val.length;
        for(i = 0; i < tam; i++) {
            if(isNaN(val[i]))
                document.getElementById("miInput").value = '';
        }
    }

    function limpiaNum2() {
        var val = document.getElementById("miInput2").value;
        var tam = val.length;
        for(i = 0; i < tam; i++) {
            if(isNaN(val[i]))
                document.getElementById("miInput2").value = '';
        }
    }
</script>
