<?php

namespace App\Http\Livewire\ModuloCoordinador\VistaDocente\Evaluacion;

use App\Models\Mencion;
use App\Models\UsuarioEvaluacionPrograma;
use Livewire\Component;

class Index extends Component
{
    public function mostrarAlerta()
    {
        $this->dispatchBrowserEvent('errorInscripcion');
    }
    
    public function render()
    {
        $usuario = auth('evaluacion')->user();
        $men = collect();

        $usuario_evaluacion_programa = UsuarioEvaluacionPrograma::where('usuario_evaluacion_id',$usuario->usuario_evaluacion_id)->get();

        foreach($usuario_evaluacion_programa as $item){
            $mencion = Mencion::join('subprograma','mencion.id_subprograma','=','subprograma.id_subprograma')
                        ->join('programa','subprograma.id_programa','=','programa.id_programa')
                        ->where('mencion.id_mencion', $item->id_mencion)
                        ->where('mencion.mencion_estado',1)
                        ->first();
            
            $men->push($mencion);
        }

        return view('livewire.modulo-coordinador.vista-docente.evaluacion.index', [
            'men' => $men,
        ]);
    }
}
