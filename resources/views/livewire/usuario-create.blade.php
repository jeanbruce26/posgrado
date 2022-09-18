<div class="p-2">

    <form class="row" method="POST" wire:submit.prevent='guardarExpediente' enctype="multipart/form-data">
        @csrf
        <div class="">
            <h4 class="text-center text-white p-2 rounded-pill" style="background: #142e52;">Actualización de Documentos</h4>
            <div class="card-body w-100">
                <div class="row g-3 col-12 m-auto">

                    @php
                        $expediente_inscripcion = App\Models\ExpedienteInscripcion::where('id_inscripcion', auth('usuarios')->user()->id_inscripcion)->get();
                        // dd($expediente_inscripcion);
                        $value=0;
                    @endphp

                    @if ($errors->any())
                    <div class="alert alert-danger mt-2 mb-2 text-center">Ingrese sus documentos.</div>
                    @endif

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>DOCUMENTOS</th>
                                <th>SELECCIONAR</th>
                                <th></th>
                                <th class="col-1">FORMATO</th>
                            </tr>
                        </thead>
                            
                        <tbody>
                            @foreach ($expediente as $item)
                                @foreach ($expediente_inscripcion as $item2)
                                    @if($item->cod_exp == $item2->expediente_cod_exp)
                                    <input type="hidden" wire:model="expediente{{$item->cod_exp}}">
                                        @php
                                            $value=1;
                                        @endphp
                                    @endif
                                @endforeach
                                @if($value != 1)
                                <tr>
                                    <td>
                                        <label class="form-label mt-3">{{ $item->tipo_doc }} @if ($item->requerido == 1) (*) @endif</label>
                                    </td>
                                    <td class="col-md-4">
                                        <input type="file" class="mt-2 mb-2 form-control form-control-sm btn btn-primary @error('expediente{{$item->cod_exp}}') is-invalid  @enderror" style="color:azure" wire:model="expediente{{$item->cod_exp}}" accept=".pdf">
                                        @error('expediente{{$item->cod_exp}}')
                                                <div class="alert alert-danger mt-2 mb-2">{{ $message }}</div>
                                        @enderror
                                    </td>
                                    <td class="col-md-1">
                                    </td> 
                                    <td align="center">
                                        <label class="form-label mt-3">PDF</label>
                                    </td> 
                                </tr>
                                @endif
                                @php
                                    $value=0;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="d-flex align-items-start justify-content-between gap-3 mt-4">
                <a href="{{route('usuarios.index')}}" class="btn btn-secondary text-decoration-none btn-label"><i class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i>Regresar</a>
                <button type="submit" class="btn btn-primary btn-label right"><i class="ri-arrow-up-line label-icon align-middle fs-16 ms-2"></i>Guardar</button> 
            </div>
        </div>
    </form>
</div>