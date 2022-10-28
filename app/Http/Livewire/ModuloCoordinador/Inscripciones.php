<?php

namespace App\Http\Livewire\ModuloCoordinador;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Inscripcion;
use App\Models\Mencion;
use App\Models\Evaluacion;
use App\Models\Puntaje;

class Inscripciones extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $queryString = [
        'search' => ['except' => ''],
        'mostrar' => ['except' => '10']
    ];

    public $id_mencion;
    public $search = '';
    public $mostrar = 10;

    public function evaExpe($id)
    {
        // href="{{route('coordinador.expediente',$item->id_inscripcion)}}" 

        $evaluacion = Evaluacion::where('inscripcion_id',$id)->first();
        $puntaje = Puntaje::where('puntaje_estado',1)->first();
        
        // dd($id, $evaluacion, $puntaje->puntaje_id);

        if($evaluacion){
            return redirect()->route('coordinador.expediente',$evaluacion->evaluacion_id);
        }else{
            $eva = Evaluacion::create([
                "evaluacion_estado" => 1,
                "puntaje_id" => $puntaje->puntaje_id,
                "inscripcion_id" => $id,
            ]);
            
            return redirect()->route('coordinador.expediente',$eva->evaluacion_id);
        }


    }


    public function evaEntre($id)
    {
        $evaluacion = Evaluacion::where('inscripcion_id',$id)->first();
        
        if($evaluacion){
            if($evaluacion->nota_expediente){
                return redirect()->route('coordinador.entrevista',$evaluacion->evaluacion_id);
            }else{
                // session()->flash('message', 'Falta completar la Evaluacion de Expedientes.');
                $this->dispatchBrowserEvent('errorEntrevista');
            }
        }else{
            // session()->flash('message', 'Falta completar la Evaluacion de Expedientes.');
            $this->dispatchBrowserEvent('errorEntrevista');
        }
    }

    public function render()
    {
        $idmencion = $this->id_mencion;
        $buscar = $this->search;
        $inscripciones = Inscripcion::join('mencion','inscripcion.id_mencion','=','mencion.id_mencion')
            ->join('persona','inscripcion.persona_idpersona','=','persona.idpersona')
            ->join('subprograma','mencion.id_subprograma','=','subprograma.id_subprograma')
            ->join('programa','subprograma.id_programa','=','programa.id_programa')
            ->where(function($query) use ($idmencion){$query->where('mencion.id_mencion',$idmencion);})
            ->where(function($query) use ($buscar){
                $query->where('persona.nombres','LIKE',"%{$buscar}%")
                    ->orWhere('persona.apell_pater','LIKE',"%{$buscar}%")
                    ->orWhere('persona.apell_mater','LIKE',"%{$buscar}%")
                    ->orWhere('persona.num_doc','LIKE',"%{$buscar}%")
                    ->orWhere('inscripcion.id_inscripcion','LIKE',"%{$buscar}%");
                })
            ->paginate($this->mostrar);

        $mencion = Mencion::join('subprograma','mencion.id_subprograma','=','subprograma.id_subprograma')
            ->join('programa','subprograma.id_programa','=','programa.id_programa')
            ->where('mencion.id_mencion',$idmencion)
            ->first();
        // dd($inscripciones);

        return view('livewire.modulo-coordinador.inscripciones', [
            'inscripciones' => $inscripciones,
            'mencion' => $mencion,
        ]);
    }
}
