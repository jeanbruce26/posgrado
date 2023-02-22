<div>
    <div class="row">
        <div class="col-sm-12">
            <div class="row">

            @foreach ($men as $itemMencion)
            @php
            $cant = App\Models\Inscripcion::join('mencion','inscripcion.id_mencion','=','mencion.id_mencion')
                ->join('subprograma','mencion.id_subprograma','=','subprograma.id_subprograma')
                ->where('subprograma.facultad_id',$facultad->Facultad->facultad_id)->where('mencion.id_mencion',$itemMencion->id_mencion)->count(); 
            // dump($cant);
            @endphp
                <div class="col-xl-6 col-md-6">
                    <!-- card -->
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    @if ($itemMencion->mencion == null)
                                        @if ($itemMencion->descripcion_programa == 'DOCTORADO')
                                        <p class="text-uppercase fw-medium text-truncate mb-0">
                                            <span class="fs-4 fw-bold">DOCTORADO EN {{$itemMencion->subprograma}}</span> <br>
                                            <span class="text-white">.</span>
                                        </p>
                                        @else
                                        <p class="text-uppercase fw-medium text-truncate mb-0">
                                            <span class="fs-4 fw-bold">MAESTRIA EN {{$itemMencion->subprograma}}</span> <br>
                                            <span class="text-white">.</span>
                                        </p>
                                        @endif
                                    @else
                                        @if ($itemMencion->descripcion_programa == 'DOCTORADO')
                                        <p class="text-uppercase fw-medium text-truncate mb-0">
                                            <span class="fs-4 fw-bold">DOCTORADO EN {{$itemMencion->subprograma}}</span> <br>
                                            <span class="text-white">.</span>
                                        </p>
                                        @else
                                        <p class="text-uppercase fw-medium text-truncate mb-0">
                                            <span class="fs-4 fw-bold">MENCION EN {{$itemMencion->mencion}}</span> <br>
                                            <span class="text-white">.</span>
                                        </p>
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between">
                                <div>
                                    <h3 class="fw-semibold ff-secondary mt-3"><span class="counter-value" data-target="{{$cant}}">{{$cant}}</span></h3> 
                                    @if ($cant != 0)
                                    <a href="{{route('coordinador.inscripciones', $itemMencion->id_mencion)}}" class="text-decoration-underline fw-bold">Ver Inscritos</a>
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