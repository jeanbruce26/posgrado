@extends ('vista_inscripcion')

@section('content')

<div class="row">
     <div class="col-10 m-auto">
          <div class="card">
               <div class="card-body form-steps">
                    <div class="tab-content">
                         <div class="tab-pane fade show active">
     
                              @livewire('modulo_inscripcion.inscripcion.create', ['id' => $id])
                              
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