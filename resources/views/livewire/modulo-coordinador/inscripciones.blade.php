<div>
    <div class="card">
        <div class="p-2 d-flex justify-content-between align-items-center">
            <!-- Buttons with Label -->
            <a href="{{route('coordinador.index')}}" type="button" class="btn btn-label w-md waves-effect waves-light fw-bold" style="background: rgb(151, 151, 151); color: white"><i class="ri-arrow-left-s-line label-icon align-middle fs-16 me-2"></i> Regresar</a>
            <div class="d-flex align-items-center text-center mt-2 fw-bold">
                @if ($mencion->mencion == null)
                <h5>
                    {{$mencion->descripcion_programa}} EN {{$mencion->subprograma}}
                </h5>
                @else
                <h5>
                    {{$mencion->descripcion_programa}} EN {{$mencion->subprograma}} <br>
                    CON MENCION EN {{$mencion->mencion}}
                </h5>
                @endif
            </div>
            <div class="w-md"></div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="text-muted d-flex align-items-center mb-1">
                    <label class="col-form-label me-2">Mostrar</label>
                    <select class="form-select text-muted" wire:model="mostrar" aria-label="Default select example">
                        <option value="10" selected>10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
                <div class="w-25 mb-1">
                    <input class="form-control text-muted" type="search" wire:model="search" placeholder="Buscar...">
                </div>
            </div>
            <div class="table-responsive table-card">
                <table class="table align-middle mb-0 table-hover table-striped table-nowrap table-bordered">
                    <thead style="background: rgb(199, 208, 219)">
                        <tr align="center">
                            <th scope="col" class="col-md-1">ID</th>
                            <th scope="col">INSCRITO</th>
                            <th scope="col" class="col-md-1">DOCUMENTO</th>
                            <th scope="col" class="col-md-1">CELULAR</th>
                            <th scope="col" class="col-md-2">EVA. EXPEDIENTE</th>
                            <th scope="col" class="col-md-2">EVA. ENTREVISTA</th>
                            <th scope="col" class="col-md-1">ESTADO</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($inscripciones as $item)
                        @php
                            $evalu = App\Models\Evaluacion::where('inscripcion_id', $item->id_inscripcion)->first();
                        @endphp
                        <tr>
                            <td scope="row" class="fw-bold" align="center">{{$item->id_inscripcion}}</td>
                            <td>{{$item->apell_pater}} {{$item->apell_mater}}, {{$item->nombres}}</td>
                            {{-- <td class="text-success"><i class="ri-checkbox-circle-line fs-17 align-middle"></i> Paid</td> --}}
                            <td>{{$item->num_doc}}</td>
                            <td>+51 {{$item->celular1}}</td>
                            <td align="center">
                                <button wire:click="evaExpe({{$item->id_inscripcion}})" type="button" class="btn btn-sm btn-info btn-label waves-effect rounded-pill w-md waves-light"><i class="ri-file-text-line label-icon align-middle fs-16"></i> Evaluar</button>
                                @if ($evalu)
                                    @if ($evalu->nota_expediente != null)
                                    <span class="badge badge-soft-info ms-2"><i class="ri-check-double-line label-icon align-middle fs-12"></i></span>
                                    @endif
                                @endif
                            </td>
                            <td align="center">
                                <button wire:click="evaEntre({{$item->id_inscripcion}})" type="button" class="btn btn-sm btn-success btn-label waves-effect rounded-pill w-md waves-light"@if ($evalu) @if ($evalu->evaluacion_estado == 2) disabled @endif @endif><i class="ri-file-text-line label-icon align-middle fs-16"></i> Evaluar</button>
                                @if ($evalu)
                                    @if ($evalu->nota_entrevista != null)
                                    <span class="badge badge-soft-info ms-2"><i class="ri-check-double-line label-icon align-middle fs-12"></i></span>
                                    @endif
                                @endif
                            </td>
                            <td align="center">
                                @if ($evalu)
                                    @if ($evalu->evaluacion_estado == 1)
                                    <span class="badge badge-soft-warning"><i class="ri-error-warning-line label-icon align-middle fs-12 me-1"></i>Por Evaluar</span>
                                    @endif
                                    @if ($evalu->evaluacion_estado == 2)
                                    <span class="badge badge-soft-danger"><i class="ri-error-warning-line label-icon align-middle fs-12 me-1"></i>Evaluacion Observada</span>
                                    @endif
                                    @if ($evalu->evaluacion_estado == 3)
                                    <span class="badge badge-soft-success"><i class="ri-check-double-line label-icon align-middle fs-12 me-1"></i>Evaluado</span>
                                    @endif
                                @else
                                <span class="badge badge-soft-warning"><i class="ri-error-warning-line label-icon align-middle fs-12 me-1"></i>Por Evaluar</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- end table -->
                @if ($inscripciones->count())
                <div class="mt-3 mx-3">
                    <div class="d-flex justify-content-end text-muted">
                        <div>
                            {{$inscripciones->links()}}
                        </div>
                    </div>
                </div>
                @else
                <div class="text-center p-3 text-muted">
                    <span>No hay resultados para la busqueda "<strong>{{$search}}</strong>" en la pagina <strong>{{$page}}</strong> al mostrar <strong>{{$mostrar}}</strong> por pagina</span>
                </div>
                @endif
            </div>
            <!-- end table responsive -->
        </div>
    </div>
</div>
