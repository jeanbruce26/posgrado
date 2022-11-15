@extends ('vista_inscripcion')

@section('content')

<div class="row">
     <div class="col-xxl-10 col-xl-12 col-lg-12 col-md-12 col-sm-12 m-auto">
          <div class="card">
               <div class="card-body form-steps">
                    <div class="tab-content">
                         <div class="tab-pane fade show active">
     
                              @livewire('modulo_inscripcion.inscripcion.create', ['id' => $id])
                              
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>
     
@endsection

@section('javascript')
     
@endsection