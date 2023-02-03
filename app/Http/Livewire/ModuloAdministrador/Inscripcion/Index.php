<?php

namespace App\Http\Livewire\ModuloAdministrador\Inscripcion;

use App\Models\Expediente;
use App\Models\Inscripcion;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';
    protected $queryString = [
        'search' => ['except' => '']
    ];

    public $search = '';
    
    public function render()
    {
        $inscripcion = Inscripcion::join('persona','inscripcion.persona_idpersona','=','persona.idpersona')
                ->join('mencion','inscripcion.id_mencion','=','mencion.id_mencion')
                ->join('subprograma','mencion.id_subprograma','=','subprograma.id_subprograma')
                ->join('programa','subprograma.id_programa','=','programa.id_programa')
                ->where('persona.nombres','LIKE',"%{$this->search}%")
                ->orWhere('persona.apell_pater','LIKE',"%{$this->search}%")
                ->orWhere('persona.apell_mater','LIKE',"%{$this->search}%")
                ->orWhere('inscripcion.id_inscripcion','LIKE',"%{$this->search}%")
                ->orWhere('persona.num_doc','LIKE',"%{$this->search}%")
                ->orderBy('inscripcion.id_inscripcion','DESC')->paginate(100);

        return view('livewire.modulo-administrador.inscripcion.index', [
            'inscripcion' => $inscripcion
        ]);
    }
}
