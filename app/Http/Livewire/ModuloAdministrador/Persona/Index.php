<?php

namespace App\Http\Livewire\ModuloAdministrador\Persona;

use App\Models\Persona;
use App\Models\Discapacidad;
use App\Models\EstadoCivil;
use App\Models\Universidad;
use App\Models\GradoAcademico;
use Livewire\Component;

class Index extends Component
{
    protected $queryString = [
        'search' => ['except' => '']
    ];
    
    public $search = '';
    public $titulo = 'Mostrar Datos del Estudiante';
    public $modo = 1; 
    //1=view / 2=update

    public $documento;
    public $nombres;
    public $apellidoPate;
    public $apellidoMate;
    public $fechaNacimineto;
    public $sexo;
    public $estadoCivil;
    public $direccion;
    public $discapacidad;
    public $celular1;
    public $celular2;
    public $email1;
    public $email2;
    public $centroTrabajo;
    public $universidad;
    public $anioEgreso;
    public $gradoAcademico;
    public $especialidad;
    public $tipoDocumento;
    public $pais;

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'documento' => 'required|digits_between:8,9|numeric',
            'nombres' => 'required|string',
            'apellidoPate' => 'required|string',
            'apellidoMate' => 'required|string',
            'fechaNacimineto' => 'required|date',
            'sexo' => 'required|string',
            'estadoCivil' => 'required|numeric',
            'direccion' => 'required',
            'discapacidad' => 'nullable|numeric',
            'celular1' => 'required|numeric',
            'celular2' => 'nullable|numeric',
            'email1' => 'required',
            'email2' => 'nullable',
            'centroTrabajo' => 'required',
            'universidad' => 'required|numeric',
            'anioEgreso' => 'required|numeric',
            'gradoAcademico' => 'required|numeric',
            'especialidad' => 'nullable|string',
            'tipoDocumento' => 'nullable|numeric',
            'pais' => 'nullable|string',
        ]);
    }

    public function cargarPersona(Persona $persona){
        $this->modo = 1;
        $this->titulo = 'Mostrar Datos del Estudiante - '.$persona->nombres.' '.$persona->apell_pater.' '.$persona->apell_mater;

        $this->documento = $persona->num_doc;
        $this->nombres = $persona->nombres;
        $this->apellidoPate = $persona->apell_pater;
        $this->apellidoMate = $persona->apell_mater;
        $this->fechaNacimineto = date('d/m/Y', strtotime($persona->fecha_naci));
        $this->sexo = $persona->sexo;
        $this->estadoCivil = $persona->EstadoCivil->est_civil;
        $this->direccion = $persona->direccion;
        $this->discapacidad = $persona->discapacidad_cod_disc;
        $this->celular1 = $persona->celular1;
        $this->celular2 = $persona->celular2;
        $this->email1 = $persona->email;
        $this->email2 = $persona->email2;
        $this->centroTrabajo = $persona->centro_trab;
        $this->universidad = $persona->Universidad->universidad;
        $this->anioEgreso = $persona->año_egreso;
        $this->gradoAcademico = $persona->GradoAcademico->nom_grado;
        $this->especialidad = $persona->especialidad;
    }
    
    public function cargarPersonaUpdate(Persona $persona){
        $this->modo = 2;
        $this->titulo = 'Actualizar Datos del Estudiante - '.$persona->nombres.' '.$persona->apell_pater.' '.$persona->apell_mater;

        $this->documento = $persona->num_doc;
        $this->nombres = $persona->nombres;
        $this->apellidoPate = $persona->apell_pater;
        $this->apellidoMate = $persona->apell_mater;
        $this->fechaNacimineto = $persona->fecha_naci;
        $this->sexo = $persona->sexo;
        $this->estadoCivil = $persona->est_civil_cod_est;
        $this->direccion = $persona->direccion;
        $this->discapacidad = $persona->discapacidad_cod_disc;
        $this->celular1 = $persona->celular1;
        $this->celular2 = $persona->celular2;
        $this->email1 = $persona->email;
        $this->email2 = $persona->email2;
        $this->centroTrabajo = $persona->centro_trab;
        $this->universidad = $persona->univer_cod_uni;
        $this->anioEgreso = $persona->año_egreso;
        $this->gradoAcademico = $persona->id_grado_academico;
        $this->especialidad = $persona->especialidad;
    }
    

    public function render()
    {
        $buscar = $this->search;
        $personaModel = Persona::where('idpersona','LIKE',"%{$buscar}%")
                        ->orWhere('num_doc','LIKE',"%{$buscar}%")
                        ->orWhere('nombres','LIKE',"%{$buscar}%")
                        ->orWhere('apell_pater','LIKE',"%{$buscar}%")
                        ->orWhere('apell_mater','LIKE',"%{$buscar}%")
                        ->orWhere('fecha_naci','LIKE',"%{$buscar}%")
                        ->orWhere('sexo','LIKE',"%{$buscar}%")
                        ->orWhere('celular1','LIKE',"%{$buscar}%")
                        ->orderBy('idpersona','DESC')->get();
        $discapacidadModel = Discapacidad::all();
        $estadoCivilModel = EstadoCivil::all();
        $universidadModel = Universidad::all();
        $gradoAcademicoModel = GradoAcademico::all();
        return view('livewire.modulo-administrador.persona.index', [
            'personaModel' => $personaModel,
            'discapacidadModel' => $discapacidadModel,
            'estadoCivilModel' => $estadoCivilModel,
            'universidadModel' => $universidadModel,
            'gradoAcademicoModel' => $gradoAcademicoModel,
        ]);
    }
}
