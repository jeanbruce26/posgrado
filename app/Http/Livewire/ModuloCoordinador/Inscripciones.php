<?php

namespace App\Http\Livewire\ModuloCoordinador;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Inscripcion;
use App\Models\Mencion;

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
