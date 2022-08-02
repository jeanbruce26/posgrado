<?php

namespace App\Http\Livewire;

use App\Models\Mencion;
use App\Models\Programa;
use App\Models\SubPrograma;
use Livewire\Component;

class SelectPrograma extends Component
{
    public $selectedPrograma=NULL;
    public $selectedSubPrograma=NULL;
    public $selectedMencion=NULL;
    public $pro=NULL, $sub=NULL, $men=NULL;

    public function mount(){
        $this->pro = Programa::all();
        $this->sub = collect();
        $this->men = collect();
    }

    public function updatedSelectedPrograma($id_programa){
        $this->sub = SubPrograma::where('id_programa',$id_programa)->get();
    }
    
    public function updatedSelectedSubPrograma($id_subprograma){
        $this->men = Mencion::where('id_subprograma',$id_subprograma)->get();
    }

    public function render()
    {
        return view('livewire.select-programa', [
            'pro' => Programa::all()
        ]);
    }
}
