<div class="col-sm-12 row">
    <div class="col-md-4">
        <label class="form-label">Ciudad (*)</label>
        <select wire:model="selectedDepartamento" class="form-select" name="cod_depar" id="depar">
            <option value="" selected>Seleccione</option>
            @foreach ($ubi as $item)
            <option value="{{$item->id}}" {{ $item->id == old('selectedDepartamento') ? 'selected' : '' }}>{{$item->departamento}}</option>
            @endforeach
        </select>
        @error('cod_depar')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
        @enderror
    </div>
    @if($selectedDepartamento)
    <div class="col-md-4">
        <label class="form-label">Provincia (*)</label>
        <select wire:model="selectedProvincia" class="form-select" name="cod_provin">
            <option value="" selected>Seleccione</option>
            @foreach ($prov as $item)
            <option value="{{$item->id}}" {{ $item->id == old('selectedProvincia') ? 'selected' : '' }}>{{$item->provincia}}</option>
            @endforeach
        </select>
        @error('cod_provin')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
        @enderror
    </div>
    @endif
    @if ($selectedProvincia)
    <div class="col-md-4">
        <label class="form-label">Distrito (*)</label>
        <select wire:model="selectedDistrito" class="form-select" name="id_distrito1">
            <option value="" selected>Seleccione</option>
            @foreach ($dist as $item)
            <option value="{{$item->id}}" {{ $item->id == old('selectedDistrito') ? 'selected' : '' }}>{{$item->distrito}}</option>
            @endforeach
        </select>
        @error('id_distrito1')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
        @enderror
    </div>
    @endif
</div>
