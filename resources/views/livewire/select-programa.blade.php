<div class="col-sm-12 row">
    <div class="col-md-12 mb-3">
        <label class="form-label">Sede (*)</label>
        <select wire:model="selectedSede" class="form-select" name="id_sede">
            <option selected>Seleccione</option>
            @foreach ($sed as $item)
            <option value="{{$item->cod_sede}}">{{$item->sede}}</option>
            @endforeach
        </select>
        @error('id_sede')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
        @enderror
    </div>
    @if($selectedSede)
    <div class="col-md-4">
        <label class="form-label">Programa (*)</label>
        <select wire:model="selectedPrograma" class="form-select" name="id_detatte_programa">
            <option value="" selected>Seleccione</option>
            @foreach ($pro as $item)
            <option value="{{$item->id_programa}}">{{$item->descripcion_programa}}</option>
            @endforeach
        </select> 
        @error('id_detatte_programa')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
        @enderror
    </div>
    @endif
    @if($selectedPrograma)
    @php
        $valor = null;
    @endphp
    <div class="col-md-4">
        @foreach ($pro2 as $item)
        <label class="form-label">{{ $item->descripcion_programa }} (*)</label>
        @endforeach
        <select wire:model="selectedSubPrograma" class="form-select" name="id_subprograma">
            <option value="" selected>Seleccione</option>
            @foreach ($sub as $item)
            <option value="{{$item->id_subprograma}}">{{$item->subprograma}}</option>
            @endforeach
        </select>
        @error('id_subprograma')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
        @enderror
    </div>
    @endif
    @if ($selectedSubPrograma)
    @php
        foreach ($men as $item){
            $valor = $item->mencion;
        }
    @endphp
    @if (!is_null($valor))
    <div class="col-md-4">
        <label class="form-label">Mencion (*)</label>
        <select wire:model="selectedMencion" class="form-select" name="id_mencion">
            <option value="" selected>Seleccione</option>
            @foreach ($men as $item)
                <option value="{{$item->id_mencion}}">{{$item->mencion}}</option>
            @endforeach
        </select>
        @error('id_mencion')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
        @enderror
    </div>
    @else
    <div class="col-md-4">
        <input type="hidden" class="form-control" name="id_mencion" value="{{$item->id_mencion}}">
    </div>
    @endif
    
    @endif
</div>