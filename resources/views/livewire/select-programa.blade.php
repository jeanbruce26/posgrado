<div class="col-sm-12 row">
    <div class="col-md-4">
        <label class="form-label">Programa (*)</label>
        <select wire:model="selectedPrograma" class="form-select" name="id_programa">
            <option selected>Seleccione</option>
            @foreach ($pro as $item)
            <option value="{{$item->id_programa}}">{{$item->descripcion_programa}}</option>
            @endforeach
        </select>
    </div>
    @if($selectedPrograma)
    <div class="col-md-4">
        <label class="form-label">Sub Programa (*)</label>
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
            <option value="{{$item->id_mencion}}">{{$item->mencion}}</option>
            @endforeach
        </select>
    </div>
    @endif
</div>