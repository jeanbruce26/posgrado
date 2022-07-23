<?php

namespace App\Http\Livewire;

use App\Models\Departamento;
use App\Models\Distrito;
use App\Models\Provincia;
use Livewire\Component;

class SelectUbigeo extends Component 
{

    public $selectedDepartamento=NULL;
    public $selectedProvincia=NULL;
    public $selectedDistrito=NULL;
    public $depar=NULL, $prov=NULL, $dist=NULL;

    public function mount(){
        $this->depar = Departamento::all();
        $this->prov = collect();
        $this->dist = collect();
    }

    public function updatedSelectedDepartamento($id_departamento){
        $this->prov = Provincia::where('id_departamento',$id_departamento)->get();
    }
    
    public function updatedSelectedProvincia($id_provincia){
        $this->dist = Distrito::where('id_provincia',$id_provincia)->get();
    }

    public function render()
    {
        return view('livewire.select-ubigeo', [
            'ubi' => Departamento::all()
        ]);
    }

}
