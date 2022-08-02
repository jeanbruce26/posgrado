<div class="col-sm-12 row">
    <div class="col-md-12 mb-3">
        <label class="form-label">Sede (*)</label>
        <select wire:model="selectedSede" class="form-select" name="id_sede">
            <option selected>Seleccione</option>
            @foreach ($sed as $item)
            <option value="{{$item->cod_sede}}">{{$item->sede}}</option>
            @endforeach
        </select>
    </div>
    @if($selectedSede)
    <div class="col-md-4">
        <label class="form-label">Programa (*)</label>
        <select wire:model="selectedPrograma" class="form-select" name="id_detatte_programa">
            <option selected>Seleccione</option>
            @foreach ($pro as $item)
            <option value="{{$item->id_programa}}">{{$item->descripcion_programa}}</option>
            @endforeach
        </select>
    </div>
    @endif
    @if($selectedPrograma)
    <div class="col-md-4">
        @foreach ($pro2 as $item)
        <label class="form-label">{{ $item->descripcion_programa }} (*)</label>
        @endforeach
        <select wire:model="selectedSubPrograma" class="form-select" name="id_subprograma">
            <option selected>Seleccione</option>
            @foreach ($sub as $item)
            <option value="{{$item->id_subprograma}}">{{$item->subprograma}}</option>
            @endforeach
        </select>
    </div>
    @endif
    @if ($selectedSubPrograma)
    <div class="col-md-4">
        <label class="form-label">Mencion (*)</label>
        <select wire:model="selectedMencion" class="form-select" name="id_mencion">
            <option selected>Seleccione</option>
            @foreach ($men as $item)
            @if (is_null($item->mencion))
                <option value="{{$item->id_mencion}}">Sin mencion</option>
            @else
                <option value="{{$item->id_mencion}}">{{$item->mencion}}</option>
            @endif
            @endforeach
        </select>
    </div>
    @endif
</div>