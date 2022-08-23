<div class="col-sm-12 row">
    <div class="col-md-4">
        <label class="form-label">Ciudad (*)</label>
        <select wire:model="selectedDepartamento" class="form-select departNaci" name="cod_depar2">
            <option value="" selected>Seleccione</option>
            @foreach ($ubi as $item)
            <option value="{{$item->id}}" {{ $item->id == old('cod_depar2') ? 'selected' : '' }}>{{$item->departamento}}</option>
            @endforeach
        </select>
        @error('cod_depar2')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
        @enderror
    </div>
    @if($selectedDepartamento)
    <div class="col-md-4">
        <label class="form-label">Provincia (*)</label>
        <select wire:model="selectedProvincia" class="form-select provinciaNaci" name="cod_provin2">
            <option value="" selected>Seleccione</option>
            @foreach ($prov as $item)
            <option value="{{$item->id}}" {{ $item->id == old('cod_provin2') ? 'selected' : '' }}>{{$item->provincia}}</option>
            @endforeach
        </select>
        @error('cod_provin2')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
        @enderror
    </div>
    @endif
    @if ($selectedProvincia)
    <div class="col-md-4">
        <label class="form-label">Distrito (*)</label>
        <select wire:model="selectedDistrito" class="form-select distritoNaci" name="id_distrito2">
            <option value="" selected>Seleccione</option>
            @foreach ($dist as $item)
            <option value="{{$item->id}}" {{ $item->id == old('id_distrito2') ? 'selected' : '' }}>{{$item->distrito}}</option>
            @endforeach
        </select>
        @error('id_distrito2')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
        @enderror
    </div>
    @endif
</div>
