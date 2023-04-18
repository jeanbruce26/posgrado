<?php

namespace App\Http\Livewire\ModuloAdministrador\Evaluacion;

use App\Models\Inscripcion;
use App\Models\Mencion;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';
    protected $queryString = [
        'search' => ['except' => ''],
        'filtro_programa' => ['except' => '']
    ];

    public $search = '';

    // variables de filtros
    public $filtro_programa;
    
    public function limpiar_filtro()
    {
        $this->reset('filtro_programa');
    }
    
    public function render()
    {
        if($this->filtro_programa)
        {
            $inscripcion = Inscripcion::join('persona','inscripcion.persona_idpersona','=','persona.idpersona')
                ->join('mencion','inscripcion.id_mencion','=','mencion.id_mencion')
                ->join('subprograma','mencion.id_subprograma','=','subprograma.id_subprograma')
                ->join('programa','subprograma.id_programa','=','programa.id_programa')
                ->where('mencion.id_mencion',$this->filtro_programa)
                ->where(function($query){
                    $query->where('persona.nombres','LIKE',"%{$this->search}%")
                        ->orWhere('persona.apell_pater','LIKE',"%{$this->search}%")
                        ->orWhere('persona.apell_mater','LIKE',"%{$this->search}%")
                        ->orWhere('persona.nombre_completo','LIKE',"%{$this->search}%")
                        ->orWhere('persona.num_doc','LIKE',"%{$this->search}%")
                        ->orWhere('inscripcion.id_inscripcion','LIKE',"%{$this->search}%");
                })
                ->orderBy('inscripcion.id_inscripcion','desc')
                ->paginate(100);
        }else{
            $inscripcion = Inscripcion::join('persona','inscripcion.persona_idpersona','=','persona.idpersona')
                ->join('mencion','inscripcion.id_mencion','=','mencion.id_mencion')
                ->join('subprograma','mencion.id_subprograma','=','subprograma.id_subprograma')
                ->join('programa','subprograma.id_programa','=','programa.id_programa')
                ->where(function($query){
                    $query->where('persona.nombres','LIKE',"%{$this->search}%")
                        ->orWhere('persona.apell_pater','LIKE',"%{$this->search}%")
                        ->orWhere('persona.apell_mater','LIKE',"%{$this->search}%")
                        ->orWhere('persona.nombre_completo','LIKE',"%{$this->search}%")
                        ->orWhere('persona.num_doc','LIKE',"%{$this->search}%")
                        ->orWhere('inscripcion.id_inscripcion','LIKE',"%{$this->search}%");
                })
                ->orderBy('inscripcion.id_inscripcion','desc')
                ->paginate(100);
        }
        
        $programas = Mencion::join('subprograma','mencion.id_subprograma','=','subprograma.id_subprograma')
                ->join('programa','subprograma.id_programa','=','programa.id_programa')
                ->where('mencion.mencion_estado', 1)
                ->orderBy('programa.descripcion_programa','ASC')
                ->orderBy('subprograma.subprograma','ASC')
                ->get();
        return view('livewire.modulo-administrador.evaluacion.index', [
            'inscripcion' => $inscripcion,
            'programas' => $programas
        ]);
    }
}
