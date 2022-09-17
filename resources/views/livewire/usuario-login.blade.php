<div>
    <div class="p-2 m-auto mt-2 col-10">
        <form method="POST" wire:submit.prevent='login' novalidate>
            
            @csrf

            <div class="mb-3">
                <table>
                    <thead>
                        <tr>
                            <th class="d-flex me-1"><i class="uil uil-book"></i></th>
                            <th class="text-justify"><label class="form-label"> Recuerda que, solo podras subir sus expedientes pendientes de su ficha de inscripcion.</label></th>
                        </tr>
                    </thead>
                    </tbody>
                </table>
            </div>

            <div class="mb-3">
                <label class="form-label">Usuario *</label>
                <input type="text" wire:model="usuario" class="form-control @error('usuario') is-invalid  @enderror" placeholder="Ingrese su usuario de su ficha de inscripcion">
                @error('usuario')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Codigo *</label>
                <input type="password" wire:model="codigo" class="form-control @error('codigo') is-invalid @enderror" placeholder="Ingrese su codigo de su ficha de inscripcion">
                @error('codigo')
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
        </form>
    </div>
    
</div>
