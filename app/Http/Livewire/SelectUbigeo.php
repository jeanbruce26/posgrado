<?php

namespace App\Http\Livewire;

use App\Models\Ubigeo;
use Livewire\Component;

class SelectUbigeo extends Component 
{

    public $selectedDepartamento=NULL;
    public $selectedProvincia=NULL;
    public $selectedDistrito=NULL;
    public $depar=NULL, $prov=NULL, $dist=NULL;

    public function mount(){
        $this->depar = Ubigeo::select('cod_depart','departamento')->distinct()->get();
        $this->prov = collect();
        $this->dist = collect();
    }

    public function updatedSelectedDepartamento($cod_depart){
        $this->prov = Ubigeo::where('cod_depart',$cod_depart)->get();
    }
    
    public function updatedSelectedProvincia($cod_provin){
        $this->dist = Ubigeo::where('cod_provin',$cod_provin)->get();
    }

    public function render()
    {
        return view('livewire.select-ubigeo', [
            'ubi' => Ubigeo::select('cod_depart','departamento')->distinct()->get(['cod_depart'])
        ]);
    }

}
