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
                <div class="col-xl-4 col-md-6">
                    <!-- card -->
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    @if ($itemMencion->mencion == null)
                                        @if ($itemMencion->descripcion_programa == 'DOCTORADO')
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                            <span class="fs-5 fw-bold">DOCTORADO EN {{$itemMencion->subprograma}}</span> <br>
                                            <span class="text-white">.</span>
                                        </p>
                                        @else
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                            <span class="fs-5 fw-bold">MAESTRIA EN {{$itemMencion->subprograma}}</span> <br>
                                            <span class="text-white">.</span>
                                        </p>
                                        @endif
                                    @else
                                        @if ($itemMencion->descripcion_programa == 'DOCTORADO')
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                            <span class="fs-5 fw-bold">DOCTORADO EN {{$itemMencion->subprograma}}</span> <br>
                                        </p>
                                        @else
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                            <span class="fs-5 fw-bold">MAESTRIA EN {{$itemMencion->subprograma}}</span> <br>
                                            MENCION EN {{$itemMencion->mencion}}
                                        </p>
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mt-3"><span class="counter-value" data-target="{{$cant}}">{{$cant}}</span></h4> 
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

            <div class="card">
                <div class="card-header align-items-center">
                    <div class=" d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0 flex-grow-1 fw-bold">COORDINADOR DE LA {{$facultad->Facultad->facultad}} </h4>
                        {{-- <a href="#newModal" type="button" class="btn btn-x1 btn-primary pull-right d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#newModal">Nuevo <i class="ri-add-circle-fill ms-1"></i></a> --}}
                    </div>
                </div><!-- end card header -->
    
                <div class="card-body">
                    <div class="live-preview">
                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap table-bordered dt-responsive text-dark">
                                <thead class="table-light">
                                    <tr>
                                        <th class="col-1">ID</th>
                                        <th>Inscripcion</th>
                                        <th>Programa</th>
                                        <th>Fecha</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mostrarInscripcion as $item)
                                        <tr>
                                            <td>{{$item->id_inscripcion}}</td>
                                            <td>{{$item->Persona->apell_pater}} {{$item->Persona->apell_mater}}, {{$item->Persona->nombres}}</td>
                                            @if ($item->mencion == null)
                                            <td>- MAESTRIA: {{$item->subprograma}}</td>
                                            @else
                                            <td>- MAESTRIA: {{$item->subprograma}} <br> - MENCION: {{$item->mencion}}</td>
                                            @endif
                                            <td>
                                                {{date('h:i A - d/m/Y', strtotime($item->fecha_inscripcion))}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
    </div>
    <!-- end row -->
</div>