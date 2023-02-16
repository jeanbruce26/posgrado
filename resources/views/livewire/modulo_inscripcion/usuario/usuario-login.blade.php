<div>
    <div class="p-2 m-auto mt-2 col-10">
        <form method="POST" wire:submit.prevent='login' novalidate autocomplete="off">
            @csrf

            <div class="alert alert-success alert-top-border alert-dismissible shadow fade show" role="alert">
                <i class="uil uil-info-circle me-3 align-middle fs-16 text-success"></i><strong>Nota</strong> <br>Los datos de su usuario y contraseña se encuentran en su ficha de matrícula.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <div class="mb-3 mt-2">
                <label class="form-label">Usuario *</label>
                <input type="text" wire:model="usuario" class="form-control @error('usuario') is-invalid  @enderror" placeholder="Ingrese su usuario de su ficha de inscripcion">
                @error('usuario')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Contraseña *</label>
                <input type="password" wire:model="codigo" class="form-control @error('codigo') is-invalid @enderror" placeholder="Ingrese su codigo de su ficha de inscripcion">
                @error('codigo')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            @if (session('mensaje'))
                <div class="alert alert-danger mt-1 mb-1 fw-bold">{{ session('mensaje') }}</div>
            @endif

            <div class="mt-4">
                - <a class="link-guia" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Guia para encontrar su usuario y contraseña
                </a>
            </div>

            <div class="mt-4">
                <button class="btn w-100" style="background-color: #006b52; color: white" type="submit">Ingresar</button>
            </div>
        </form>
    </div>
    
</div>
