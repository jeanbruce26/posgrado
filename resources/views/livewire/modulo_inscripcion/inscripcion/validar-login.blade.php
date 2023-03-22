<div>
    <div class="p-2 m-auto mt-2 col-10">
        <form method="POST" wire:submit.prevent='login' novalidate autocomplete="off">
            
            @csrf
            
            <div class="alert alert-info alert-top-border alert-dismissible shadow fade show" role="alert">
                <i class="uil uil-info-circle me-3 align-middle fs-16 text-info"></i><strong>Nota</strong> <br>Una vez realizado el pago, deberá mandar su número de DNI y Voucher al siguiente correo: <strong>admision_posgrado@unu.edu.pe</strong> para validar su pago y proceder con su inscripción.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <div class="mb-3 mt-2">
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
                <input type="text" wire:model="numero_operacion" class="form-control @error('numero_operacion') is-invalid @enderror" placeholder="Ingrese su numero de operación">
                <div class="mt-1 text-muted" style="font-size: .77rem">
                    <strong>Nota: </strong>Omitir los ceros iniciales, por ejemplo: 00000023456 debe ingresar 23456.
                </div>
                @error('numero_operacion')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            @if (session('mensaje'))
                <div class="alert alert-danger mt-1 mb-1 fw-bold">{{ session('mensaje') }}</div>
            @endif

            <div class="mt-4">
                <table>
                    <thead>
                        <tr>
                            <th class="d-flex me-1"><i class="uil uil-info-circle"></i></th>
                            <th class="text-justify"><label class="form-label text-justify"> Por favor, revisa bien las guías antes de realizar tu inscripción.</label></th>
                        </tr>
                    </thead>
                    </tbody>
                </table>
            </div>

            <div class="mt-2">
                - <a class="link-guia" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    ¿Dónde encontrar el número de operación?
                </a>
            </div>

            <div class="mt-2">
                - <a class="link-guia" href="{{ asset('Manual/manual-de-usuario.pdf') }}" target="_blank">
                    Manual de usuario - Inscripción 2023
                </a>
            </div>

            

            <div class="mt-4">
                <button class="btn btn-primary w-100" type="submit">Ingresar</button>
            </div>

            

            
        </form>
    </div>

    
</div>
