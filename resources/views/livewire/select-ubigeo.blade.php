<div class="col-sm-12 row g-3">
    <h3 class="d-flex justify-content-between mt-3">Ubigeo</h3>
    <div class="col-md-4">
        <label class="form-label">Ciudad *</label>
        <select wire:model="selectedDepartamento" class="form-select" name="cod_depar" id="depar">
            <option selected>Seleccione</option>
            @foreach ($ubi as $item)
            <option value="{{$item->cod_depart}}">{{$item->departamento}} {{$item->cod_depart}}</option>
            @endforeach
        </select>
    </div>
    
    @if($selectedDepartamento)
    <div class="col-md-4">
        <label class="form-label">Provincia *</label>
        <select wire:model="selectedProvincia" class="form-select" name="cod_provin">
            <option selected>Seleccione</option>
            @foreach ($prov as $item)
            <option value="{{$item->cod_provin}}">{{$item->provincia}} {{$item->cod_provin}}</option>
            @endforeach
        </select>
    </div>
    @endif

    @if ($selectedProvincia)
    <div class="col-md-4">
        <label class="form-label">Distrito *</label>
        <select wire:model="selectedDistrito" class="form-select" name="cod_ubi">
            <option selected>Seleccione</option>
            @foreach ($dist as $item)
            <option value="{{$item->cod_ubi}}">{{$item->distrito}} {{$item->cod_ubi}}</option>
            @endforeach
        </select>
    </div>
    @endif

</div>
