<div>
    <div class="p-2 m-auto mt-2 col-10">
        <form wire:submit.prevent='login' novalidate>

            <div class="mb-3">
                <label class="form-label">Correo *</label>
                <input type="email" wire:model="correo" class="form-control @error('correo') is-invalid  @enderror" placeholder="Ingrese su usuario de su ficha de inscripcion">
                @error('correo')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Contraseña *</label>
                <input type="password" wire:model="password" class="form-control @error('password') is-invalid @enderror" placeholder="Ingrese su codigo de su ficha de inscripcion">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            @if (session('mensaje'))
                <div class="alert alert-danger mt-1 mb-1">{{ session('mensaje') }}</div>
            @endif

            <div class="mt-4">
                <button class="btn  w-100" style="background: #2a2a50; color: white" type="submit">Ingresar</button>
            </div>
        </form>
    </div>
    
</div>
