<?php

namespace App\Http\Livewire;

use App\Models\DetallePrograma;
use App\Models\Mencion;
use App\Models\Programa;
use App\Models\Sede;
use App\Models\SubPrograma;
use Livewire\Component;

class SelectPrograma extends Component
{
    public $selectedSede=NULL;
    public $selectedPrograma=NULL;
    public $selectedSubPrograma=NULL;
    public $selectedMencion=NULL;
    public $sed=NULL, $pro=NULL, $pro2=NULL, $sub=NULL, $men=NULL;

    public function mount(){
        $this->sed = Sede::all();
        $this->pro = collect();
        $this->sub = collect();
        $this->men = collect();
    }

    public function updatedSelectedSede($id_sede){
        $this->pro = Programa::where('id_sede',$id_sede)->get();
        $this->sub = collect();
        $this->men = collect();
    }

    public function updatedSelectedPrograma($id_programa){
        $this->sub = SubPrograma::where('id_programa',$id_programa)->get();
        $this->pro2 = Programa::where('id_programa',$id_programa)->get();
        $this->men = collect();
    }
    
    public function updatedSelectedSubPrograma($id_subprograma){
        $this->men = Mencion::where('id_subprograma',$id_subprograma)->get();
    }

    public function render()
    {
        return view('livewire.select-programa', [
            'sed' => Sede::all()
        ]);
    }
}
