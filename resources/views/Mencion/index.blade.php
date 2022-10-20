@extends('admin')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
@endsection

@section('content')
    
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header align-items-center">
                    <div class=" d-flex justify-content-between">
                        <h4 class="card-title mb-0 flex-grow-1 fw-bold">MENCIÓN</h4>
                        <a href="#newModal" type="button" class="btn btn-lg btn-primary pull-right d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#newModal">Nuevo <i class="ri-add-circle-fill ms-1"></i></a>
                    </div>
                        {{-- Modal Nuevo --}}
                        <div class="modal fade" id="newModal" tabindex="-1" aria-labelledby="newModal" aria-hidden="true">
                            <div class="modal-dialog modal-x1 modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Crear Mención</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('Mencion.store') }}" method="POST">
                                            @csrf
                                            <div class="col-sm-12 row g-3">
                                                <div class="mb-3 col-md-12">
                                                    <label class="form-label">Código Mención</label>
                                                    <input type="text" class="form-control" name="cod_mencion" maxlength="10">
                                                </div>
                                                <div class="mb-3 col-md-12">
                                                    <label class="form-label">Mención</label>
                                                    <input type="text" class="form-control" name="mencion" onkeypress="return soloLetras(event)">
                                                </div>
                                                <div class="mb-3 col-md-12">
                                                    <label class="form-label">Sub Programa <span class="text-danger">*</span></label>
                                                    <select class="form-select" name="id_subprograma" required>
                                                        <option value="" selected>Seleccione</option>
                                                        @foreach ($sub as $item)
                                                        <option value="{{$item->id_subprograma}}">{{$item->programa->sede->sede}} - {{$item->programa->descripcion_programa}} - {{$item->subprograma}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer col-12 d-flex justify-content-between">
                                            <a type="button" class="btn btn-secondary d-flex justify-content-center align-items-center btn-lg" data-bs-dismiss="modal"><i class="bx bx-chevron-left me-1 bx-1x"></i>Cancelar</a>
                                            <button type="submit" class="btn btn-primary d-flex justify-content-center align-items-center btn-lg">Guardar <i class="bx bx-edit ms-1 ri-1x"></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{-- Modal Nuevo --}}
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="live-preview">
                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap table-bordered dt-responsive text-dark" id="tablaMencion">
                                <thead class="table-light">
                                    <tr>
                                        <th>Programa</th>
                                        <th>Sub Programa</th>
                                        <th>Código</th>
                                        <th>Mención</th>
                                        <th class="col-1">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mencion as $item)

                                        <tr>
                                            <td>{{$item->subprograma->programa->descripcion_programa}}</td>
                                            <td>{{$item->subprograma->subprograma}}</td>
                                                @if (is_null($item->cod_mencion) && is_null($item->mencion))
                                                    <td>Sin Mención</td>
                                                    <td>Sin Mención</td>
                                                @else
                                                    <td>{{$item->cod_mencion}}</td>
                                                    <td>{{$item->mencion}}</td>
                                                @endif
                                            <td class="d-flex justify-content-star">
                                                <a href="#editModal" type="button" class="link-success fs-15" data-bs-toggle="modal" data-bs-target="#editModal{{$item->id_mencion}}"><i class="bx bx-edit bx-sm bx-burst-hover"></i></a>

                                                {{-- Modal Editar --}}
                                                <div class="modal fade" id="editModal{{$item->id_mencion}}" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
                                                    <div class="modal-dialog modal-x1 modal-dialog-scrollable">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Editar Pago</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('Mencion.update',$item->id_mencion) }}" method="POST">
                                                                    @csrf @method('PUT')
                                                                    <div class="col-sm-12 row g-3">
                                                                        <div class="mb-3 col-md-12">
                                                                            <label class="form-label">Código Mención </label>
                                                                            <input type="text" class="form-control"  name="cod_mencion" maxlength="50" value="{{ $item->cod_mencion }}">
                                                                        </div>
                                                                        <div class="mb-3 col-md-12">
                                                                            <label class="form-label">Mención </label>
                                                                            <input type="text" class="form-control" name="mencion" maxlength="200" value="{{ $item->mencion }}" onkeypress="return soloLetras(event)">
                                                                        </div>
                                                                        <div class="mb-3 col-md-12">
                                                                            <label class="form-label">Sub Programa <span class="text-danger">*</span></label>
                                                                            <select class="form-select" name="id_subprograma" required>
                                                                                <option value="" selected>Seleccione</option>
                                                                                @foreach ($sub as $itemsu)
                                                                                    <option value="{{$itemsu->id_subprograma}}" {{ $itemsu->id_subprograma == $item->id_subprograma ? 'selected' : '' }}>{{$itemsu->subprograma}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer col-12 d-flex justify-content-between">
                                                                    <a type="button" class="btn btn-secondary d-flex justify-content-center align-items-center btn-lg" data-bs-dismiss="modal"><i class="bx bx-chevron-left me-1 bx-1x"></i>Cancelar</a>
                                                                    <button type="submit" class="btn btn-primary d-flex justify-content-center align-items-center btn-lg">Guardar <i class="bx bx-edit ms-1 ri-1x"></i></button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- Modal Editar --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="d-none code-view">
                        <pre class="language-markup" style="height: 275px;"><code>&lt;table class=&quot;table table-nowrap&quot;&gt;
                    </div>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
    </div>
    <!-- end row -->

@endsection

@section('javascript')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script>
    $('#tablaMencion').DataTable({
        autoWidth: true,
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por páginas",
            "zeroRecords": "Nada encontrado - disculpa",
            "info": "Mostrando la página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros",
            "infoFiltered": "(filtrado de _MAX_ registros totales)",
            "search": "Buscar:",
            "order": "desc",
            "paginate": {
                "next": "Siguiente",
                "previous": "Anterior",
            }
        }
    });
</script>
@endsection