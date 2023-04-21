<div>
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
            @foreach ($men as $itemMencion)
            @php
            $cant = App\Models\Inscripcion::join('mencion','inscripcion.id_mencion','=','mencion.id_mencion')
                ->join('subprograma','mencion.id_subprograma','=','subprograma.id_subprograma')
                ->where('mencion.id_mencion',$itemMencion->id_mencion)->count(); 
            @endphp
                <div class="col-xl-6 col-md-6">
                    <div class="card card-animate">
                        <div class="p-4">
                            <div class="flex-grow-1 overflow-hidden" style="color: rgb(74, 74, 74)">
                                @if ($itemMencion->mencion == null)
                                    <p class="text-uppercase fw-medium text-truncate mb-0">
                                        <span class="fs-5 fw-bold">{{ $itemMencion->descripcion_programa }} EN {{ $itemMencion->subprograma }}</span> <br>
                                        <span class="text-white">.</span>
                                    </p>
                                @else
                                    <p class="text-uppercase fw-medium text-truncate mb-0">
                                        <span class="fs-5 fw-bold">MENCION EN {{$itemMencion->mencion}}</span> <br>
                                        <span class="text-white">.</span>
                                    </p>
                                @endif
                            </div>
                            <div class="d-flex align-items-end justify-content-between">
                                <div class="d-flex flex-column gap-2">
                                    <span class="fw-semibold ff-secondary mt-3 fs-2"><span class="counter-value" data-target="{{$cant}}">{{$cant}}</span></span> 
                                    @if ($cant != 0)
                                    <a href="{{route('coordinador.docente.programas.inscripciones.index', $itemMencion->id_mencion)}}" class="text-decoration-underline fw-bold">Ver Inscritos</a>
                                    @else
                                    <a type="button" wire:click="mostrarAlerta()" class="text-decoration-underline fw-bold">Ver Inscritos</a>
                                    @endif
                                </div>
                                <div class="">
                                    <span class="avatar-title bg-warning rounded fs-1 p-2">
                                        <i class="bx bx-user-circle"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
            @endforeach
            </div>
        </div>
    </div>
    <!-- end row -->
</div>