<?php

namespace App\Http\Livewire\ModuloInscripcion\Usuario;

use Livewire\Component;
use App\Models\Admision;
use App\Models\Admitidos;
use App\Models\ConstanciaIngresoPago;
use App\Models\Evaluacion;
use App\Models\Expediente;
use App\Models\ExpedienteInscripcion;
use App\Models\Inscripcion;
use App\Models\Persona;
use Barryvdh\DomPDF\Facade\Pdf;

class Usuario extends Component
{
    protected $listeners = ['render', 'crearConstancia'];

    public function generarConstancia($admitido_id)
    {
        $this->dispatchBrowserEvent('alertaConstancia', ['mensaje' => 'Constancia generada correctamente', 'id' => $admitido_id]);
    }

    public function crearConstancia(Admitidos $admitido)
    {
        $datos = Evaluacion::join('inscripcion', 'inscripcion.id_inscripcion', '=', 'evaluacion.inscripcion_id')
                ->join('persona', 'persona.idpersona', '=', 'inscripcion.persona_idpersona')
                ->join('mencion','mencion.id_mencion','=','inscripcion.id_mencion')
                ->join('subprograma','subprograma.id_subprograma','=','mencion.id_subprograma')
                ->join('programa','programa.id_programa','=','subprograma.id_programa')
                ->join('admision','admision.cod_admi','=','inscripcion.admision_cod_admi')
                ->where('evaluacion.evaluacion_id',$admitido->evaluacion_id)
                ->first();

        $nombre = $datos->apell_pater . ' ' . $datos->apell_mater . ', ' . $datos->nombres;
        $codigo = 'N° ' . $admitido->admitidos_codigo;
        $admision = ucwords(strtolower($datos->admision));
        if($datos->descripcion_programa == 'DOCTORADO'){
            $programa = 'DOCTORADO EN ' . $datos->subprograma;
        }else{
            if($datos->mencion == null){
                $programa = 'MAESTRIA EN ' . $datos->subprograma;
            }else{
                $programa = 'MAESTRIA EN ' . $datos->subprograma . ' CON MENCIÓN EN ' . $datos->mencion;
            }
        }
        setlocale( LC_ALL,"es_ES@euro","es_ES","esp" );
        $fecha = 'Pucallpa, ' . strftime('%d de %B del %Y', strtotime(today()));
        if($admitido->admitidos_id < 10){
            $codigo_constancia = substr($admitido->admitidos_codigo, 1, 1) . substr($admitido->admitidos_codigo, 5, 9) . '00' . $admitido->admitidos_id;
        }else if($admitido->admitidos_id < 100){
            $codigo_constancia = substr($admitido->admitidos_codigo, 1, 1) . substr($admitido->admitidos_codigo, 5, 9) . '0' . $admitido->admitidos_id;
        }else if($admitido->admitidos_id < 1000){
            $codigo_constancia = substr($admitido->admitidos_codigo, 1, 1) . substr($admitido->admitidos_codigo, 5, 9) . $admitido->admitidos_id;
        }
        
        $data = [ 
            'nombre' => $nombre,
            'codigo' => $codigo,
            'admision' => $admision,
            'programa' => $programa,
            'fecha' => $fecha,
            'codigo_constancia' => $codigo_constancia
        ];

        $nombre_pdf = $nombre . ' - ' . $codigo_constancia . '.pdf';
        $path_pdf = $datos->admision.'/'.$datos->id_inscripcion.'/'.$nombre_pdf;
        $pdf = Pdf::loadView('modulo_administrador.Evaluacion.Admitidos.constancia', $data)->save(public_path($datos->admision.'/'.$datos->id_inscripcion.'/'). $nombre_pdf);
        
        $admitido_update = Admitidos::find($admitido->admitidos_id);
        $admitido_update->constancia_codigo = $codigo_constancia;
        $admitido_update->constancia = $path_pdf;
        $admitido_update->save();
    }

    public function render()
    {
        $nombre = ucfirst(strtolower(auth('usuarios')->user()->persona->apell_pater)) . ' ' . ucfirst(strtolower(auth('usuarios')->user()->persona->apell_mater)) . ', ' . ucwords(strtolower(auth('usuarios')->user()->persona->nombres));
        $contador = ExpedienteInscripcion::where('id_inscripcion',auth('usuarios')->user()->id_inscripcion)->count();
        $expediente_count = Expediente::count();
        setlocale( LC_ALL,"es_ES@euro","es_ES","esp" );
        $fecha_admision = strftime('%d de %B del %Y', strtotime(Admision::where('estado',1)->first()->fecha_fin));
        $fecha_admision_normal = Admision::where('estado',1)->first()->fecha_fin;

        $evaluacion = Evaluacion::where('inscripcion_id',auth('usuarios')->user()->id_inscripcion)->first();
        $admitido = null;
        $pago = null;
        if($evaluacion){
            $admitido = Admitidos::where('evaluacion_id',$evaluacion->inscripcion_id)->first();
            if($admitido){
                $constanca_ingreso_pago = ConstanciaIngresoPago::where('admitidos_id',$admitido->admitidos_id)->first(); //verificar si ya pago
                
                if($constanca_ingreso_pago){
                    if($constanca_ingreso_pago->concepto_id == 2 || $constanca_ingreso_pago->concepto_id == 4){
                        $pago = 1;
                    }
                }
            }
        }

        $admision_fecha_admitidos =strftime('%d de %B del %Y', strtotime(Admision::where('estado',1)->first()->fecha_admitidos)); //fecha de admision de admitidos

        $lista_admitidos = Admitidos::count();

        return view('livewire.modulo-inscripcion.usuario.usuario', [
            'nombre' => $nombre,
            'expediente' => Expediente::all(),
            'contador' => $contador,
            'expediente_count' => $expediente_count,
            'fecha_admision' => $fecha_admision,
            'fecha_admision_normal' => $fecha_admision_normal,
            'lista_admitidos' => $lista_admitidos,
            'admitido' => $admitido,
            'admision_fecha_admitidos' => $admision_fecha_admitidos,
            'pago' => $pago
        ]);
    }
}
