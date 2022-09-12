<div>
    <div class="p-2 m-auto mt-2 col-10">
        <form method="POST" wire:submit.prevent='login' novalidate>
            
            @csrf

            <div class="mb-3">
                <table>
                    <thead>
                        <tr>
                            <th class="d-flex me-1"><i class="uil uil-usd-circle"></i></th>
                            <th class="text-justify"><label class="form-label"> Recuerda que, puedes realizar tu inscripción al día siguiente de haber hecho tu pago.</label></th>
                        </tr>
                    </thead>
                    </tbody>
                </table>
            </div>

            <div class="mb-3">
                <label class="form-label">Tipo de Documento *</label>
                <select class="form-select @error('tipo_documento') is-invalid @enderror" wire:model="tipo_documento" aria-label="Default select example">
                    <option value="" selected>Seleccione</option>
                    <option value="1" {{ old('tipo_documento') == '1' ? 'selected' : '' }}>DNI</option>
                    <option value="2" {{ old('tipo_documento') == '2' ? 'selected' : '' }}>CARNET DE EXTRANJERIA</option>
                </select>
                @error('tipo_documento')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Documento *</label>
                <input type="text" id="documento" wire:model="documento" class="form-control @error('documento') is-invalid  @enderror" placeholder="Ingrese su documento" {{ !is_null($tipo_documento) ? '' : 'disabled' }}>
                @error('documento')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Número de Operación *</label>
                <input type="text" wire:model="numero_operacion" class="form-control @error('numero_operacion') is-invalid @enderror" placeholder="Ingrese su documento">
                @error('numero_operacion')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            @if (session('mensaje'))
                <div class="alert alert-danger mt-1 mb-1">{{ session('mensaje') }}</div>
            @endif

            <div class="mt-4">
                <button class="btn btn-primary w-100" type="submit">Ingresar</button>
            </div>

            <div class="mt-4">
                <table>
                    <thead>
                        <tr>
                            <th class="d-flex me-1"><i class="uil uil-info-circle"></i></th>
                            <th class="text-justify"><label class="form-label text-justify"> Por favor, revisa bien las guias antes de realizar tu matricula.</label></th>
                        </tr>
                    </thead>
                    </tbody>
                </table>
            </div>

            <div class="mt-2">
                - <a class="guia text-dark cursor-pointer " data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Guia de Inscripción
                </a>
            </div>
        </form>
    </div>

    
</div>
