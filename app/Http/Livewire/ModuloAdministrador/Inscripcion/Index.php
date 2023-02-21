<?php

namespace App\Http\Livewire\ModuloAdministrador\Inscripcion;

use App\Models\Admision;
use App\Models\Expediente;
use App\Models\ExpedienteInscripcion;
use App\Models\ExpedienteInscripcionSeguimiento;
use App\Models\Inscripcion;
use App\Models\InscripcionPago;
use App\Models\Mencion;
use App\Models\Persona;
use App\Models\SubPrograma;
use Barryvdh\DomPDF\Facade\Pdf;
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
    
    //variables
    public $inscripcion_id;
    public $programa;
    public $subprograma;
    public $subprograma_model = null;
    public $mencion;
    public $mencion_model = null;

    protected $listeners = [
        'render', 'cambiarPrograma',
    ];
    
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'programa' => 'required',
            'subprograma' => 'required|numeric',
            'mencion' => 'required|numeric',
        ]);
    }

    public function limpiar()
    {
        $this->reset(
            'programa',
            'subprograma',
            'mencion',
        );
    }

    public function cargarInscripcion(Inscripcion $inscripcion)
    {   
        $this->inscripcion_id = $inscripcion->id_inscripcion;
        $this->programa = ucfirst(strtolower($inscripcion->mencion->subprograma->programa->descripcion_programa));
        $this->subprograma_model = SubPrograma::where('id_programa',$inscripcion->mencion->subprograma->programa->id_programa)->get();
        $this->subprograma = $inscripcion->mencion->subprograma->id_subprograma;
        $this->updatedSubPrograma($this->subprograma);
    }

    public function updatedSubPrograma($subprograma){
        $this->mencion_model = Mencion::where('id_subprograma',$subprograma)->where('mencion_estado',1)->get();
        $this->mencion = null;
        $valor = null;
        foreach($this->mencion_model as $item){
            $valor = $item->mencion;
        }
        if($valor == null){
            $this->mencion = Mencion::where('id_subprograma',$subprograma)->first();
            if($this->mencion){
                $this->mencion = $this->mencion->id_mencion;
            }
        }
    }

    public function guardarCambioPrograma()
    {
        $this->validate([
            'programa' => 'required',
            'subprograma' => 'required|numeric',
            'mencion' => 'required|numeric',
        ]);

        $this->dispatchBrowserEvent('alertaCambioPrograma');
    }

    public function cambiarPrograma()
    {
        $inscripcion = Inscripcion::find($this->inscripcion_id);
        $inscripcion->id_mencion = $this->mencion;
        $inscripcion->save();
        
        $this->limpiar();
        $this->dispatchBrowserEvent('modalCambiarPrograma');
        $this->dispatchBrowserEvent('alertaSuccess', [
            'titulo' => '¡Éxito!',
            'mensaje' => 'El programa se ha cambiado correctamente.'
        ]);
        $this->generarPdf($this->inscripcion_id);
    }

    public function generarPdf($id)
    {
        $inscripcion = Inscripcion::where('id_inscripcion',$id)->first();

        $montoTotal=0;

        $inscripcion_pago = InscripcionPago::where('inscripcion_id',$id)->get();
        foreach($inscripcion_pago as $item){
            $montoTotal = $montoTotal + $item->pago->monto;
        }

        $admision3 = Admision::where('estado',1)->first();
        $admi = $admision3->admision;

        $fecha_actual = $inscripcion->fecha_inscripcion->format('h:i:s a d/m/Y');
        $fecha_actual2 = $inscripcion->fecha_inscripcion->format('d-m-Y');
        $mencion = Mencion::where('id_mencion',$inscripcion->id_mencion)->get();
        $admisionn = Admision::where('estado',1)->get();
        $inscrip = Inscripcion::where('id_inscripcion',$id)->get();
        $inscripcion_codigo = Inscripcion::where('id_inscripcion',$id)->first()->inscripcion_codigo;
        $tiempo = 6;
        $valor = '+ '.intval($tiempo).' month';
        setlocale( LC_ALL,"es_ES@euro","es_ES","esp" );
        $final = strftime('%d de %B del %Y', strtotime($fecha_actual2.$valor));
        $per = Persona::where('idpersona', $inscripcion->persona_idpersona)->get();
        $expedienteInscripcion = ExpedienteInscripcion::where('id_inscripcion',$id)->get();
        $expedi = $expedi = Expediente::where('estado', 1)
                    ->where(function($query) use ($inscripcion){
                        $query->where('expediente_tipo', 0)
                            ->orWhere('expediente_tipo', $inscripcion->tipo_programa);
                    })
                    ->get();

        // verificamos si tiene expediente en seguimientos
        $seguimiento_count = ExpedienteInscripcionSeguimiento::join('ex_insc', 'ex_insc.cod_ex_insc', '=', 'expediente_inscripcion_seguimiento.cod_ex_insc')
                                                        ->where('ex_insc.id_inscripcion', $id)
                                                        ->where('expediente_inscripcion_seguimiento.tipo_seguimiento', 1)
                                                        ->where('expediente_inscripcion_seguimiento.expediente_inscripcion_seguimiento_estado', 1)
                                                        ->count();

        $data = [ 
            'persona' => $per,
            'fecha_actual' => $fecha_actual,
            'mencion' => $mencion,
            'admisionn' => $admisionn,
            'inscripcion_pago' => $inscripcion_pago,
            'inscrip' => $inscrip,
            'inscripcion_codigo' => $inscripcion_codigo,
            'montoTotal' => $montoTotal,
            'final' => $final,
            'expedienteInscripcion' => $expedienteInscripcion,
            'expedi' => $expedi,
            'seguimiento_count' => $seguimiento_count
        ];

        $nombre_pdf = 'FICHA_INSCRIPCION.pdf';
        $path_pdf = $admi.'/'.$id.'/'.$nombre_pdf;
        $pdf = Pdf::loadView('modulo_inscripcion.inscripcion.reporte-pdf', $data)->save(public_path($admi.'/'.$id.'/'). $nombre_pdf);

        $ins = Inscripcion::find($id);
        $ins->inscripcion = $path_pdf;
        $ins->save();
    }

    public function render()
    {
        $inscripcion = Inscripcion::join('persona','inscripcion.persona_idpersona','=','persona.idpersona')
                ->join('mencion','inscripcion.id_mencion','=','mencion.id_mencion')
                ->join('subprograma','mencion.id_subprograma','=','subprograma.id_subprograma')
                ->join('programa','subprograma.id_programa','=','programa.id_programa')
                ->where('persona.nombres','LIKE',"%{$this->search}%")
                ->orWhere('persona.apell_pater','LIKE',"%{$this->search}%")
                ->orWhere('persona.apell_mater','LIKE',"%{$this->search}%")
                ->orWhere('persona.nombre_completo','LIKE',"%{$this->search}%")
                ->orWhere('inscripcion.id_inscripcion','LIKE',"%{$this->search}%")
                ->orWhere('persona.num_doc','LIKE',"%{$this->search}%")
                ->orderBy('inscripcion.id_inscripcion','DESC')->paginate(100);

        return view('livewire.modulo-administrador.inscripcion.index', [
            'inscripcion' => $inscripcion
        ]);
    }
}
