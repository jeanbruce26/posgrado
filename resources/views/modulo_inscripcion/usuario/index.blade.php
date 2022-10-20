@extends ('vista_usuario')

@section('content')

<div class="row">
    <div class="col-10 m-auto">
        <div class="card">
            <div class="card-body form-steps">
                <div class="tab-content">
                        <div class="tab-pane fade show active">

                            @if (session('success'))
                                <div class="alert alert-success m-3 alert-dismissible fade show" role="alert">
                                    <strong>{{ session('success') }}.</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <livewire:modulo_inscripcion.usuario.usuario/>
    
                        </div>
                        <!-- end tab pane -->
                </div>
                <!-- end tab content -->
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
</div>

@endsection