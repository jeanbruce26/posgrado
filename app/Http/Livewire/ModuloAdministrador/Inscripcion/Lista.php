<?php

namespace App\Http\Livewire\ModuloAdministrador\Inscripcion;

use App\Models\Inscripcion;
use Livewire\Component;
use Livewire\WithPagination;

class Lista extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $queryString = [
        'search' => ['except' => '']
    ];

    public $search = '';

    public function render()
    {
        $inscripciones = Inscripcion::join('persona', 'persona.idpersona', '=', 'inscripcion.persona_idpersona')
                ->where('persona.nombres', 'like', '%' . $this->search . '%')
                ->orWhere('persona.apell_pater', 'like', '%' . $this->search . '%')
                ->orWhere('persona.apell_mater', 'like', '%' . $this->search . '%')
                ->orWhere('persona.num_doc', 'like', '%' . $this->search . '%')
                ->orWhere('inscripcion.inscripcion_codigo', 'like', '%' . $this->search . '%')
                ->paginate(50);

        return view('livewire.modulo-administrador.inscripcion.lista', [
            'inscripciones' => $inscripciones
        ]);
    }
}
