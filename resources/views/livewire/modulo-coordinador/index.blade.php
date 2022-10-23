<div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header align-items-center">
                    <div class=" d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0 flex-grow-1 fw-bold">Coordinador De La {{ucwords(strtolower($facultad->Facultad->facultad))}} </h4>
                        {{-- <a href="#newModal" type="button" class="btn btn-x1 btn-primary pull-right d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#newModal">Nuevo <i class="ri-add-circle-fill ms-1"></i></a> --}}
                    </div>
                </div><!-- end card header -->
    
                <div class="card-body">
                    <div class="live-preview">
                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap table-bordered dt-responsive text-dark" id="tablaCoor">
                                <thead class="table-light">
                                    <tr>
                                        <th class="col-1">ID</th>
                                        <th>Inscripcion</th>
                                        <th>Programa</th>
                                        <th class="col-1">Acciones</th>
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
                                                {{-- <a href="#editModal" type="button" class="link-success fs-15" data-bs-toggle="modal" data-bs-target="#editModal{{$item->cod_sede}}"><i class="bx bx-edit bx-sm bx-burst-hover"></i></a> --}}
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