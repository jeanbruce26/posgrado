<div>
    <div class="card">
        <div class="p-2 d-flex justify-content-between align-items-center">
            <a href="{{route('coordinador.inscripciones',$inscripcion->id_mencion)}}" type="button" class="btn btn-label w-md waves-effect waves-light fw-bold" style="background: rgb(151, 151, 151); color: white"><i class="ri-arrow-left-s-line label-icon align-middle fs-16 me-2"></i> Regresar</a>
            <h4 class="mt-2 text-center fw-bold">
                EVALUACIÓN DE LA ENTREVISTA PERSONAL
            </h4>
            <div class="w-md"></div>
        </div>
    </div>
    <div class="card">
        <div class="p-2 d-flex justify-content-between align-items-center mx-3">
            <span class="fs-5">NOMBRE: <strong>{{$inscripcion->Persona->apell_pater}} {{$inscripcion->Persona->apell_mater}}, {{$inscripcion->Persona->nombres}}</strong></span>
            <span class="fs-5">
                FECHA: 
                <strong>
                    @if ($evaluacion_data->fecha_entrevista)
                        {{date('d/m/Y', strtotime($evaluacion_data->fecha_entrevista))}}
                    @else
                        {{date('d/m/Y', strtotime($fecha))}}
                    @endif
                </strong>
            </span>
        </div>
    </div>
</div>
