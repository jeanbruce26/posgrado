<?php

namespace App\Http\Livewire\ModuloAdministrador\Evaluacion\Admitidos;

use App\Exports\UsersExport;
use App\Models\Admision;
use App\Models\Admitidos;
use App\Models\Evaluacion;
use App\Models\Persona;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Index extends Component
{
    protected $paginationTheme = 'bootstrap';
    protected $queryString = [
        'search' => ['except' => '']
    ];

    public $search = '';
    public $mostrar_alerta = 0;

    protected $listeners = ['render', 'generar_codigo'];

    public function updating()
    {
        $evaluacion_admitidos_count = Evaluacion::where('evaluacion_estado', 3)->count();
        $admitidos_count = Admitidos::count();
        if($evaluacion_admitidos_count != $admitidos_count){
            $this->mostrar_alerta = 1;
        }else{
            $this->mostrar_alerta = 0;
        }
    }

    public function cargarAlertaCodigo()
    {
        $this->dispatchBrowserEvent('cargarAlertaCodigo');
    }

    public function generar_codigo()
    {
        DB::table('admitidos')->truncate();

        $evaluacion_admitidos = Evaluacion::join('inscripcion', 'evaluacion.inscripcion_id', '=', 'inscripcion.id_inscripcion')
                ->join('mencion', 'inscripcion.id_mencion', '=', 'mencion.id_mencion')
                ->join('subprograma', 'mencion.id_subprograma', '=', 'subprograma.id_subprograma')
                ->join('programa', 'subprograma.id_programa', '=', 'programa.id_programa')
                ->where('evaluacion.evaluacion_estado', 3)
                ->orderBy('mencion.id_mencion')
                ->get();

        $admision_year = Admision::where('estado', 1)->first()->admision_year;
        $codigo_doctorado = '0D0'.$admision_year;
        $codigo_maestria = '0M0'.$admision_year;

        foreach($evaluacion_admitidos as $admitido){    
            $maximo_codigo_admitidos = Admitidos::orderBy('admitidos_codigo', 'desc')->first();
            if($admitido->descripcion_programa == 'DOCTORADO'){
                if($maximo_codigo_admitidos){
                    $codigo_doctorado_inicio = substr($maximo_codigo_admitidos->admitidos_codigo, 0, 7);
                    if($codigo_doctorado_inicio == $codigo_doctorado){
                        $codigo = substr($maximo_codigo_admitidos->admitidos_codigo, 7, 10);
                        $codigo = intval($codigo) + 1;
                        if($codigo < 10){
                            $codigo = '00'.$codigo;
                        }else if($codigo < 100){
                            $codigo = '0'.$codigo;
                        }else if($codigo < 1000){
                            $codigo = $codigo;
                        }
                        $codigo = $codigo_doctorado.$codigo;
                    }else{
                        $codigo = $codigo_doctorado.'001';
                    }
                }else{
                    $codigo = $codigo_doctorado.'001';
                }
            }

            if($admitido->descripcion_programa == 'MAESTRIA'){
                if($maximo_codigo_admitidos){
                    $codigo_maestria_inicio = substr($maximo_codigo_admitidos->admitidos_codigo, 0, 7);
                    if($codigo_maestria_inicio == $codigo_maestria){
                        $codigo = substr($maximo_codigo_admitidos->admitidos_codigo, 7, 10);
                        $codigo = intval($codigo) + 1;
                        if($codigo < 10){
                            $codigo = '00'.$codigo;
                        }else if($codigo < 100){
                            $codigo = '0'.$codigo;
                        }else if($codigo < 1000){
                            $codigo = $codigo;
                        }
                        $codigo = $codigo_maestria.$codigo;
                    }else{
                        $codigo = $codigo_maestria.'001';
                    }
                }else{
                    $codigo = $codigo_maestria.'001';
                }
            }

            Admitidos::create([
                "admitidos_codigo" => $codigo,
                "evaluacion_id" => $admitido->evaluacion_id,
            ]);
        }
    }

    public function export() 
    {
        date_default_timezone_set("America/Lima");
        $fecha_actual = date("Ymd", strtotime(today()));
        $hora_actual = date("His", strtotime(now()));

        $this->dispatchBrowserEvent('notificacionExcel', ['message' =>'Excel exportado satisfactoriamente.', 'color' => '#2eb867']);

        return Excel::download(new UsersExport, 'admitidos-'.$fecha_actual.'-'.$hora_actual.'.xlsx');
    }

    public function render()
    {
        $evaluacion_admitidos_count = Evaluacion::where('evaluacion_estado', 3)->count();
        $admitidos_count = Admitidos::count();
        if($evaluacion_admitidos_count != $admitidos_count){
            $this->mostrar_alerta = 1;
        }else{
            $this->mostrar_alerta = 0;
        }
        $admitidos_model = Admitidos::join('evaluacion','admitidos.evaluacion_id','=','evaluacion.evaluacion_id')
                    ->join('inscripcion','evaluacion.inscripcion_id','=','inscripcion.id_inscripcion')
                    ->join('mencion', 'inscripcion.id_mencion', '=', 'mencion.id_mencion')
                    ->join('persona','inscripcion.persona_idpersona','=','persona.idpersona')
                    ->where('admitidos.admitidos_id','like','%'.$this->search.'%')
                    ->orWhere('admitidos.admitidos_codigo','like','%'.$this->search.'%')
                    ->orWhere('persona.apell_pater','like','%'.$this->search.'%')
                    ->orWhere('persona.apell_mater','like','%'.$this->search.'%')
                    ->orWhere('persona.nombres','like','%'.$this->search.'%')
                    ->orWhere('persona.num_doc','like','%'.$this->search.'%')
                    ->orderBy('admitidos.admitidos_codigo')
                    ->get();

        $admitidos = Admitidos::select('admitidos.admitidos_id','admitidos.admitidos_codigo',Admitidos::raw('CONCAT(CONCAT(CONCAT(CONCAT(persona.apell_pater," "), persona.apell_mater),", "), persona.nombres) as nombre_completo'),'persona.num_doc')
                    ->join('evaluacion','admitidos.evaluacion_id','=','evaluacion.evaluacion_id')
                    ->join('inscripcion','evaluacion.inscripcion_id','=','inscripcion.id_inscripcion')
                    ->join('persona','inscripcion.persona_idpersona','=','persona.idpersona')
                    ->get();

        return view('livewire.modulo-administrador.evaluacion.admitidos.index',[
            'admitidos_model' => $admitidos_model
        ]);
    }
}
