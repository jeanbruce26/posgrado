@extends('admin')

@section('css')

@endsection

@section('content')
<div class="page-title-box d-sm-flex align-items-center justify-content-between">
    <h4 class="mb-sm-0">Dashboard</h4>
    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-xxl-3 col-xl-6 col-lg-6 col-md-6 col-sm-12">
        <div class="card card-body">
            <h4 class="fw-bold mt-2 mb-4 text-center">Gestion Curricular</h4>
            <a href="{{ route('admin.plan.index') }}" class="btn btn-warning text-dark fw-bold">Ingresar</a>
        </div>
    </div>
    <div class="col-xxl-3 col-xl-6 col-lg-6 col-md-6 col-sm-12">
        <div class="card card-body">
            <h4 class="fw-bold mt-2 mb-4 text-center">Modulo de Inscripcion</h4>
            <a href="{{ route('admin.inscripcion.index') }}" class="btn btn-warning text-dark fw-bold">Ingresar</a>
        </div>
    </div>
    <div class="col-xxl-3 col-xl-6 col-lg-6 col-md-6 col-sm-12">
        <div class="card card-body">
            <h4 class="fw-bold mt-2 mb-4 text-center">Modulo de Pagos</h4>
            <a href="{{ route('admin.pago.index') }}" class="btn btn-warning text-dark fw-bold">Ingresar</a>
        </div>
    </div>
    <div class="col-xxl-3 col-xl-6 col-lg-6 col-md-6 col-sm-12">
        <div class="card card-body">
            <h4 class="fw-bold mt-2 mb-4 text-center">Modulo de Admitidos</h4>
            <a href="{{ route('admin.admitidos.index') }}" class="btn btn-warning text-dark fw-bold">Ingresar</a>
        </div>
    </div>

</div>

<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0 text-uppercase font-bold">Reporte de Inscritos por Programa</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive table-card">
            <table class="table table-nowrap mb-0">
                <thead class="table-light">
                    <tr align="center">
                        <th scope="col" class="col-md-1">NRO</th>
                        <th scope="col" class="col-md-9">PROGRAMA</th>
                        <th scope="col" class="col-md-2">CANTIDAD</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($programas as $item)
                    <tr>
                        <td align="center" class="fw-bold">{{ $loop->iteration }}</td>
                        <td style="white-space: initial">
                            @if ($item->mencion === null)
                                {{ ucwords(strtolower($item->descripcion_programa))  }} en {{ ucwords(strtolower($item->subprograma)) }}
                            @else
                                Mención en {{ ucwords(strtolower($item->mencion)) }}
                            @endif
                        </td>
                        <td align="center" class="fs-5">{{ $item->cantidad_mencion }}</td>
                    </tr>
                    @endforeach
                    @if ($programas->count() === 0)
                        <tr>
                            <td colspan="3" class="text-center text-muted">No hay inscritos</td>
                        </tr>
                    @endif
                </tbody>
                <tfoot>
                    <tr class="table-light" align="center">
                        <td colspan="2" class="text-end fw-bold fs-6">TOTAL</td>
                        <td class="fw-bold fs-5">{{ $programas->sum('cantidad_mencion') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection

@section('javascript')

@endsection