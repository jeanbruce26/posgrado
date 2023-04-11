<?php

namespace App\Http\Livewire\ModuloCoordinador\Matriculados;

use App\Models\Admitidos;
use App\Models\Coordinador;
use App\Models\Mencion;
use App\Models\SubPrograma;
use App\Models\Trabajador;
use App\Models\TrabajadorTipoTrabajador;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination; // sirve para paginar los resultados
    protected $queryString = [
        'filtro_programa' => ['except' => 0],
        'search' => ['except' => '']
    ]; // sirve para que el filtro se guarde en la url
    public $filtro_programa = 8; // variable para el filtro de programa
    public $search = ''; // variable para el buscador
    
    public function mount()
    {
        $this->filtro_programa = 0;
    }

    public function limpiar_filtro()
    {
        $this->filtro_programa = 0;
    }

    public function render()
    {
        $trabajador = Trabajador::find(TrabajadorTipoTrabajador::find(auth('admin')->user()->trabajador_tipo_trabajador_id)->trabajador_id);
        $coordinador = Coordinador::where('trabajador_id', $trabajador->trabajador_id)->first();
        $facultad_id = $coordinador->facultad_id;
        $subprograma = SubPrograma::where('facultad_id', $facultad_id)->get();
        $programas = collect([]);
        foreach ($subprograma as $sub) {
            $mencion = Mencion::where('id_subprograma', $sub->id_subprograma)->where('mencion_estado', 1)->get();
            foreach ($mencion as $men) {
                $programas->push($men);
            }
        }
        $admitidos = collect([]);
        if ($this->filtro_programa == 0) {
            foreach ($programas as $programa) {
                $admitidos = $admitidos->merge(Admitidos::join('persona', 'persona.idpersona', '=', 'admitidos.persona_id')->where('id_mencion', $programa->id_mencion)->orderBy('persona.nombre_completo', 'asc')->get());
            }
        } else {
            $admitidos = Admitidos::join('persona', 'persona.idpersona', '=', 'admitidos.persona_id')
                                    ->where(function ($query) {
                                        $query->where('persona.nombre_completo', 'like', '%' . $this->search . '%')
                                            ->orWhere('persona.num_doc', 'like', '%' . $this->search . '%')
                                            ->orWhere('admitidos.admitidos_codigo', 'like', '%' . $this->search . '%');
                                    })
                                    ->where('admitidos.id_mencion', $this->filtro_programa)
                                    ->orderBy('persona.nombre_completo', 'asc')
                                    ->get();
        }
        return view('livewire.modulo-coordinador.matriculados.index', [
            'programas' => $programas,
            'admitidos' => $admitidos
        ]);
    }
}
