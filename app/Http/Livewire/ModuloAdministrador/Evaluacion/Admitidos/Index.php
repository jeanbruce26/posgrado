<?php

namespace App\Http\Livewire\ModuloAdministrador\Evaluacion\Admitidos;

use App\Exports\UsersExport;
use App\Exports\UsersNoAdmitidosExport;
use App\Models\Admision;
use App\Models\Admitidos;
use App\Models\ConstanciaIngresoPago;
use App\Models\Evaluacion;
use App\Models\GrupoPrograma;
use App\Models\HistorialInscripcion;
use App\Models\MatriculaPago;
use App\Models\Mencion;
use App\Models\Pago;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\File;

class Index extends Component
{
    protected $paginationTheme = 'bootstrap';
    protected $queryString = [
        'search' => ['except' => ''],
        'filtro_programa' => ['except' => ''],
        'filtro_pago' => ['except' => ''],
    ];

    public $search = '';
    public $mostrar_alerta = 0;

    public $operacion, $fecha, $monto, $documento, $voucher, $concepto; // variables para el modal de constancia de ingreso y pago

    public $filtro_programa; // variable para el filtro de programa
    public $filtro_pago; // variable para el filtro de pago

    protected $listeners = ['render', 'generar_codigo', 'crearConstancia', 'delete_pago_constancia', 'delete_pago_matricula'];

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
        $admision = Admision::where('estado', 1)->first(); // 1 = activo 0 = inactivo

        $fecha_hoy = today();

        if($admision->fecha_admitidos > $fecha_hoy){
            $this->dispatchBrowserEvent('errorFechaAdmitidos', ['mensaje' => 'La fecha para generar los admitidos es el: '.  date('d/m/Y', strtotime($admision->fecha_admitidos))]);
        }else{
            $this->dispatchBrowserEvent('cargarAlertaCodigo');
        }
    }

    public function generar_codigo()
    {
        $evaluacion_admitidos = Evaluacion::join('inscripcion', 'evaluacion.inscripcion_id', '=', 'inscripcion.id_inscripcion')
                ->join('persona', 'inscripcion.persona_idpersona', '=', 'persona.idpersona')
                ->join('mencion', 'inscripcion.id_mencion', '=', 'mencion.id_mencion')
                ->join('subprograma', 'mencion.id_subprograma', '=', 'subprograma.id_subprograma')
                ->join('programa', 'subprograma.id_programa', '=', 'programa.id_programa')
                ->where('evaluacion.evaluacion_estado', 3)
                ->where('evaluacion.evaluacion_estado_admitido', 1)
                ->orderBy('mencion.id_mencion')
                ->orderBy('persona.nombre_completo')
                ->get();

        $admision_year = Admision::where('estado', 1)->first()->admision_year; // año de la admision activa
        $admision_year = substr($admision_year, 2, 2); // año de la admision activa
        $codigo_doctorado = '0D0D'.$admision_year; // inicio del codigo de doctorado
        $codigo_maestria = '0M0D'.$admision_year; // inicio del codigo de maestria

        foreach($evaluacion_admitidos as $admitido){ // recorremos los admitidos
            $maximo_codigo_admitidos = Admitidos::orderBy('admitidos_codigo', 'desc')->first(); // codigo maximo de admitidos
            if($admitido->descripcion_programa == 'DOCTORADO'){
                if($maximo_codigo_admitidos){
                    $codigo_doctorado_inicio = substr($maximo_codigo_admitidos->admitidos_codigo, 0, 7);
                    if($codigo_doctorado_inicio == $codigo_doctorado){
                        $codigo = substr($maximo_codigo_admitidos->admitidos_codigo, 7, 10);
                        $codigo = intval($codigo) + 1;
                        if($codigo < 10){
                            $codigo = '000'.$codigo;
                        }else if($codigo < 100 && $codigo > 9){
                            $codigo = '00'.$codigo;
                        }else if($codigo < 1000 && $codigo > 99){
                            $codigo = '0'.$codigo;
                        }else if($codigo < 10000 && $codigo > 999){
                            $codigo = $codigo;
                        }
                        $codigo = $codigo_doctorado.$codigo;
                    }else{
                        $maximo_codigo_admitidos = Admitidos::where('admitidos_codigo', 'like', $codigo_doctorado.'%')
                                                        ->orderBy('admitidos_codigo', 'desc')->first(); // codigo maximo de admitidos
                        if($maximo_codigo_admitidos){
                            $codigo = substr($maximo_codigo_admitidos->admitidos_codigo, 7, 10);
                            $codigo = intval($codigo) + 1;
                            if($codigo < 10){
                                $codigo = '000'.$codigo;
                            }else if($codigo < 100 && $codigo > 9){
                                $codigo = '00'.$codigo;
                            }else if($codigo < 1000 && $codigo > 99){
                                $codigo = '0'.$codigo;
                            }else if($codigo < 10000 && $codigo > 999){
                                $codigo = $codigo;
                            }
                            $codigo = $codigo_doctorado.$codigo;
                        }else{
                            $codigo = $codigo_doctorado.'0001';
                        }
                    }
                }else{
                    $codigo = $codigo_doctorado.'0001';
                }
            }

            if($admitido->descripcion_programa == 'MAESTRIA'){
                if($maximo_codigo_admitidos){
                    $codigo_maestria_inicio = substr($maximo_codigo_admitidos->admitidos_codigo, 0, 7);
                    if($codigo_maestria_inicio == $codigo_maestria){
                        $codigo = substr($maximo_codigo_admitidos->admitidos_codigo, 7, 10);
                        $codigo = intval($codigo) + 1;
                        if($codigo < 10){
                            $codigo = '000'.$codigo;
                        }else if($codigo < 100 && $codigo > 9){
                            $codigo = '00'.$codigo;
                        }else if($codigo < 1000 && $codigo > 99){
                            $codigo = '0'.$codigo;
                        }else if($codigo < 10000 && $codigo > 999){
                            $codigo = $codigo;
                        }
                        $codigo = $codigo_maestria.$codigo;
                    }else{
                        $maximo_codigo_admitidos = Admitidos::where('admitidos_codigo', 'like', $codigo_maestria.'%')
                                                        ->orderBy('admitidos_codigo', 'desc')->first(); // codigo maximo de admitidos
                        if($maximo_codigo_admitidos){
                            $codigo = substr($maximo_codigo_admitidos->admitidos_codigo, 7, 10);
                            $codigo = intval($codigo) + 1;
                            if($codigo < 10){
                                $codigo = '000'.$codigo;
                            }else if($codigo < 100 && $codigo > 9){
                                $codigo = '00'.$codigo;
                            }else if($codigo < 1000 && $codigo > 99){
                                $codigo = '0'.$codigo;
                            }else if($codigo < 10000 && $codigo > 999){
                                $codigo = $codigo;
                            }
                            $codigo = $codigo_maestria.$codigo;
                        }else{
                            $codigo = $codigo_maestria.'0001';
                        }
                    }
                }else{
                    $codigo = $codigo_maestria.'0001';
                }
            }

            $admitido_create = Admitidos::create([
                "admitidos_codigo" => $codigo,
                "persona_id" => $admitido->persona_idpersona,
                "evaluacion_id" => $admitido->evaluacion_id,
                "id_mencion" => $admitido->id_mencion,
                "tipo_programa" => $admitido->tipo_programa,
            ]);

            $evaluacion = Evaluacion::find($admitido->evaluacion_id);
            $evaluacion->evaluacion_estado_admitido = 0;
            $evaluacion->save();

            $this->actualizarEstadoAdmitidoHistorialInscripcion($admitido);
        }
    }

    public function cargarAlertaCrearConstancia($id)
    {
        $this->dispatchBrowserEvent('alertaCrearConstancia', ['id' => $id]);
    }

    public function crearConstancia(Admitidos $admitido)
    {
        $this->crearConstanciaPdf($admitido);
    }

    public function cargar_pago($tipo_pago, Admitidos $admitidos)
    {
        if($tipo_pago == '1'){
            $pago_constancia = ConstanciaIngresoPago::where('admitidos_id', $admitidos->admitidos_id)->first();
            if($pago_constancia){
                $this->operacion = $pago_constancia->pago->nro_operacion;
                $this->monto = 'S/. ' . number_format($pago_constancia->concepto->monto, 2, ',', '');
                $this->fecha = date('d/m/Y', strtotime($pago_constancia->pago->fecha_pago));
                $this->voucher = $pago_constancia->pago->voucher;
                $this->documento = $pago_constancia->pago->dni;
                $this->concepto = $pago_constancia->concepto->concepto . ' - S/. ' . number_format($pago_constancia->concepto->monto, 2, ',', '');
            }else{
                $this->dispatchBrowserEvent('alertaPagoConstancia');
            }
        }else if($tipo_pago == '2'){
            $pago_matricula = MatriculaPago::where('admitidos_id', $admitidos->admitidos_id)->first();
            if($pago_matricula){
                $this->operacion = $pago_matricula->pago->nro_operacion;
                $this->monto = 'S/. ' . number_format($pago_matricula->concepto->monto, 2, ',', '');
                $this->fecha = date('d/m/Y', strtotime($pago_matricula->pago->fecha_pago));
                $this->voucher = $pago_matricula->pago->voucher;
                $this->documento = $pago_matricula->pago->dni;
                $this->concepto = $pago_matricula->concepto->concepto . ' - S/. ' . number_format($pago_matricula->concepto->monto, 2, ',', '');
            }else{
                $this->dispatchBrowserEvent('alertaPagoMatricula');
            }
        }
    }

    public function limpiar()
    {
        $this->operacion = '';
        $this->monto = '';
        $this->fecha = '';
        $this->voucher = '';
        $this->documento = '';
    }

    public function crearConstanciaPdf($admitido)
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

        $codigo_constancia_qr = QrCode::size(100)->generate($codigo_constancia);
        
        $data = [ 
            'nombre' => $nombre,
            'codigo' => $codigo,
            'admision' => $admision,
            'programa' => $programa,
            'fecha' => $fecha,
            'codigo_constancia' => $codigo_constancia_qr
        ];

        $nombre_pdf = $nombre . ' - ' . $codigo_constancia . '.pdf';
        $path_pdf = $datos->admision.'/'.$datos->id_inscripcion.'/'.$nombre_pdf;
        $pdf = Pdf::loadView('modulo_administrador.Evaluacion.Admitidos.constancia', $data)->save(public_path($datos->admision.'/'.$datos->id_inscripcion.'/'). $nombre_pdf);
        
        $admitido_update = Admitidos::find($admitido->admitidos_id);
        $admitido_update->constancia_codigo = $codigo_constancia;
        $admitido_update->constancia = $path_pdf;
        $admitido_update->save();
    }

    public function actualizarEstadoAdmitidoHistorialInscripcion($admitido)
    {
        $inscripcion_id = Evaluacion::find($admitido->evaluacion_id)->inscripcion_id;
        $historial_inscripcion = HistorialInscripcion::where('id_inscripcion', $inscripcion_id)->first();
        $historial_inscripcion->admitido = 1;
        $historial_inscripcion->save();
    }

    public function export() 
    {
        $fecha_actual = date("Ymd", strtotime(today()));
        $hora_actual = date("His", strtotime(now()));

        $this->dispatchBrowserEvent('notificacionExcel', ['message' =>'Excel exportado satisfactoriamente.', 'color' => '#2eb867']);

        return Excel::download(new UsersExport, 'admitidos-'.$fecha_actual.'-'.$hora_actual.'.xlsx');
    }

    public function export_no_admitidos() 
    {
        $fecha_actual = date("Ymd", strtotime(today()));
        $hora_actual = date("His", strtotime(now()));

        $this->dispatchBrowserEvent('notificacionExcel', ['message' =>'Excel exportado satisfactoriamente.', 'color' => '#2eb867']);

        return Excel::download(new UsersNoAdmitidosExport, 'no-admitidos-'.$fecha_actual.'-'.$hora_actual.'.xlsx');
    }

    public function limpiar_filtro()
    {
        $this->reset([
            'filtro_programa',
            'filtro_pago',
        ]);
    }

    public function alerta_delete_pago_constancia($admitidos_id)
    {
        $this->dispatchBrowserEvent('alerta_delete_pago_constancia', ['admitidos_id' => $admitidos_id]);
    }

    public function delete_pago_constancia($admitidos_id)
    {
        $constancia = ConstanciaIngresoPago::where('admitidos_id', $admitidos_id)->first();
        if($constancia){
            $pago_id = $constancia->pago_id;
            $constancia->delete();
            $pago = Pago::find($pago_id);
            $pago->delete();
            $admitido = Admitidos::find($admitidos_id);
            File::delete($admitido->constancia);
            $admitido->constancia_codigo = null;
            $admitido->constancia = null;
            $admitido->save();
        }else{
            $this->dispatchBrowserEvent('notificacion_delete', [
                'message' =>'No existe pago de constancia de ingreso para este usuario admitido.',
                'icon' => 'error'
            ]);
        }
    }

    public function alerta_delete_pago_matricula($admitidos_id)
    {
        $this->dispatchBrowserEvent('alerta_delete_pago_matricula', ['admitidos_id' => $admitidos_id]);
    }

    public function delete_pago_matricula($admitidos_id)
    {
        $matricula = MatriculaPago::where('admitidos_id', $admitidos_id)->first();
        $grupo_antigui = $matricula->id_grupo_programa;
        if($matricula){
            $pago_id = $matricula->pago_id; 
            $matricula->delete();
            File::delete($matricula->ficha_matricula);
            $pago = Pago::find($pago_id);
            $pago->delete();
            $grupo = GrupoPrograma::find($grupo_antigui);
            $grupo->grupo_contador = $grupo->grupo_contador - 1;
            $grupo->save();
        }else{
            $this->dispatchBrowserEvent('notificacion_delete', [
                'message' =>'No existe pago de matricula para este usuario admitido.',
                'icon' => 'error'
            ]);
        }
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
        if($this->filtro_programa && $this->filtro_pago == '')
        {
            $admitidos_model = Admitidos::join('evaluacion','admitidos.evaluacion_id','=','evaluacion.evaluacion_id')
                    ->join('inscripcion','evaluacion.inscripcion_id','=','inscripcion.id_inscripcion')
                    ->join('mencion', 'inscripcion.id_mencion', '=', 'mencion.id_mencion')
                    ->join('subprograma', 'mencion.id_subprograma', '=', 'subprograma.id_subprograma')
                    ->join('programa', 'subprograma.id_programa', '=', 'programa.id_programa')
                    ->join('persona','inscripcion.persona_idpersona','=','persona.idpersona')
                    ->where(function($query){
                        $query->where('admitidos.admitidos_id','like','%'.$this->search.'%')
                        ->orWhere('admitidos.admitidos_codigo','like','%'.$this->search.'%')
                        ->orWhere('admitidos.constancia_codigo','like','%'.$this->search.'%')
                        ->orWhere('persona.apell_pater','like','%'.$this->search.'%')
                        ->orWhere('persona.apell_mater','like','%'.$this->search.'%')
                        ->orWhere('persona.nombres','like','%'.$this->search.'%')
                        ->orWhere('persona.num_doc','like','%'.$this->search.'%');
                    })
                    ->where('admitidos.id_mencion', $this->filtro_programa)
                    ->orderBy('admitidos.admitidos_codigo', 'ASC')
                    ->orderBy('persona.nombre_completo', 'ASC')
                    ->get();
        }else if($this->filtro_pago == ''){
            $admitidos_model = Admitidos::join('evaluacion','admitidos.evaluacion_id','=','evaluacion.evaluacion_id')
                    ->join('inscripcion','evaluacion.inscripcion_id','=','inscripcion.id_inscripcion')
                    ->join('mencion', 'inscripcion.id_mencion', '=', 'mencion.id_mencion')
                    ->join('subprograma', 'mencion.id_subprograma', '=', 'subprograma.id_subprograma')
                    ->join('programa', 'subprograma.id_programa', '=', 'programa.id_programa')
                    ->join('persona','inscripcion.persona_idpersona','=','persona.idpersona')
                    ->where('admitidos.admitidos_id','like','%'.$this->search.'%')
                    ->orWhere('admitidos.admitidos_codigo','like','%'.$this->search.'%')
                    ->orWhere('admitidos.constancia_codigo','like','%'.$this->search.'%')
                    ->orWhere('persona.apell_pater','like','%'.$this->search.'%')
                    ->orWhere('persona.apell_mater','like','%'.$this->search.'%')
                    ->orWhere('persona.nombres','like','%'.$this->search.'%')
                    ->orWhere('persona.num_doc','like','%'.$this->search.'%')
                    ->orderBy('admitidos.admitidos_codigo', 'ASC')
                    ->orderBy('persona.nombre_completo', 'ASC')
                    ->get();
        }else if($this->filtro_programa && $this->filtro_pago){
            if($this->filtro_pago == 'constancia'){
                $admitidos_model = ConstanciaIngresoPago::join('admitidos', 'constancia_ingreso_pago.admitidos_id', '=', 'admitidos.admitidos_id')
                    ->join('evaluacion','admitidos.evaluacion_id','=','evaluacion.evaluacion_id')
                    ->join('inscripcion','evaluacion.inscripcion_id','=','inscripcion.id_inscripcion')
                    ->join('mencion', 'inscripcion.id_mencion', '=', 'mencion.id_mencion')
                    ->join('subprograma', 'mencion.id_subprograma', '=', 'subprograma.id_subprograma')
                    ->join('programa', 'subprograma.id_programa', '=', 'programa.id_programa')
                    ->join('persona','inscripcion.persona_idpersona','=','persona.idpersona')
                    ->where(function($query){
                        $query->where('admitidos.admitidos_id','like','%'.$this->search.'%')
                        ->orWhere('admitidos.admitidos_codigo','like','%'.$this->search.'%')
                        ->orWhere('admitidos.constancia_codigo','like','%'.$this->search.'%')
                        ->orWhere('persona.apell_pater','like','%'.$this->search.'%')
                        ->orWhere('persona.apell_mater','like','%'.$this->search.'%')
                        ->orWhere('persona.nombres','like','%'.$this->search.'%')
                        ->orWhere('persona.num_doc','like','%'.$this->search.'%');
                    })
                    ->where('admitidos.id_mencion', $this->filtro_programa)
                    ->orderBy('admitidos.admitidos_codigo', 'ASC')
                    ->orderBy('persona.nombre_completo', 'ASC')
                    ->get();
            }else if($this->filtro_pago == 'matricula'){
                $admitidos_model = MatriculaPago::join('admitidos', 'matricula_pago.admitidos_id', '=', 'admitidos.admitidos_id')
                    ->join('evaluacion','admitidos.evaluacion_id','=','evaluacion.evaluacion_id')
                    ->join('inscripcion','evaluacion.inscripcion_id','=','inscripcion.id_inscripcion')
                    ->join('mencion', 'inscripcion.id_mencion', '=', 'mencion.id_mencion')
                    ->join('subprograma', 'mencion.id_subprograma', '=', 'subprograma.id_subprograma')
                    ->join('programa', 'subprograma.id_programa', '=', 'programa.id_programa')
                    ->join('persona','inscripcion.persona_idpersona','=','persona.idpersona')
                    ->where(function($query){
                        $query->where('admitidos.admitidos_id','like','%'.$this->search.'%')
                        ->orWhere('admitidos.admitidos_codigo','like','%'.$this->search.'%')
                        ->orWhere('admitidos.constancia_codigo','like','%'.$this->search.'%')
                        ->orWhere('persona.apell_pater','like','%'.$this->search.'%')
                        ->orWhere('persona.apell_mater','like','%'.$this->search.'%')
                        ->orWhere('persona.nombres','like','%'.$this->search.'%')
                        ->orWhere('persona.num_doc','like','%'.$this->search.'%');
                    })
                    ->where('admitidos.id_mencion', $this->filtro_programa)
                    ->orderBy('admitidos.admitidos_codigo', 'ASC')
                    ->orderBy('persona.nombre_completo', 'ASC')
                    ->get();
            }else if($this->filtro_pago == 'constancia_matricula'){
                $constancia = ConstanciaIngresoPago::join('admitidos', 'constancia_ingreso_pago.admitidos_id', '=', 'admitidos.admitidos_id')
                    ->join('evaluacion','admitidos.evaluacion_id','=','evaluacion.evaluacion_id')
                    ->join('inscripcion','evaluacion.inscripcion_id','=','inscripcion.id_inscripcion')
                    ->join('mencion', 'inscripcion.id_mencion', '=', 'mencion.id_mencion')
                    ->join('subprograma', 'mencion.id_subprograma', '=', 'subprograma.id_subprograma')
                    ->join('programa', 'subprograma.id_programa', '=', 'programa.id_programa')
                    ->join('persona','inscripcion.persona_idpersona','=','persona.idpersona')
                    ->where(function($query){
                        $query->where('admitidos.admitidos_id','like','%'.$this->search.'%')
                        ->orWhere('admitidos.admitidos_codigo','like','%'.$this->search.'%')
                        ->orWhere('admitidos.constancia_codigo','like','%'.$this->search.'%')
                        ->orWhere('persona.apell_pater','like','%'.$this->search.'%')
                        ->orWhere('persona.apell_mater','like','%'.$this->search.'%')
                        ->orWhere('persona.nombres','like','%'.$this->search.'%')
                        ->orWhere('persona.num_doc','like','%'.$this->search.'%');
                    })
                    ->where('admitidos.id_mencion', $this->filtro_programa)
                    ->orderBy('admitidos.admitidos_codigo', 'ASC')
                    ->orderBy('persona.nombre_completo', 'ASC')
                    ->get();
                $matricula = MatriculaPago::join('admitidos', 'matricula_pago.admitidos_id', '=', 'admitidos.admitidos_id')
                    ->join('evaluacion','admitidos.evaluacion_id','=','evaluacion.evaluacion_id')
                    ->join('inscripcion','evaluacion.inscripcion_id','=','inscripcion.id_inscripcion')
                    ->join('mencion', 'inscripcion.id_mencion', '=', 'mencion.id_mencion')
                    ->join('subprograma', 'mencion.id_subprograma', '=', 'subprograma.id_subprograma')
                    ->join('programa', 'subprograma.id_programa', '=', 'programa.id_programa')
                    ->join('persona','inscripcion.persona_idpersona','=','persona.idpersona')
                    ->where(function($query){
                        $query->where('admitidos.admitidos_id','like','%'.$this->search.'%')
                        ->orWhere('admitidos.admitidos_codigo','like','%'.$this->search.'%')
                        ->orWhere('admitidos.constancia_codigo','like','%'.$this->search.'%')
                        ->orWhere('persona.apell_pater','like','%'.$this->search.'%')
                        ->orWhere('persona.apell_mater','like','%'.$this->search.'%')
                        ->orWhere('persona.nombres','like','%'.$this->search.'%')
                        ->orWhere('persona.num_doc','like','%'.$this->search.'%');
                    })
                    ->where('admitidos.id_mencion', $this->filtro_programa)
                    ->orderBy('admitidos.admitidos_codigo', 'ASC')
                    ->orderBy('persona.nombre_completo', 'ASC')
                    ->get();
                $admitidos_model = collect();
                foreach($constancia as $cons){
                    foreach($matricula as $matri){
                        if($cons->admitidos_id == $matri->admitidos_id){
                            $admitidos_model->push($cons);
                        }
                    }
                }
            }else if($this->filtro_pago == 'sin_constancia'){
                $admitidos = Admitidos::join('evaluacion','admitidos.evaluacion_id','=','evaluacion.evaluacion_id')
                    ->join('inscripcion','evaluacion.inscripcion_id','=','inscripcion.id_inscripcion')
                    ->join('mencion', 'inscripcion.id_mencion', '=', 'mencion.id_mencion')
                    ->join('subprograma', 'mencion.id_subprograma', '=', 'subprograma.id_subprograma')
                    ->join('programa', 'subprograma.id_programa', '=', 'programa.id_programa')
                    ->join('persona','inscripcion.persona_idpersona','=','persona.idpersona')
                    ->where(function($query){
                        $query->where('admitidos.admitidos_id','like','%'.$this->search.'%')
                        ->orWhere('admitidos.admitidos_codigo','like','%'.$this->search.'%')
                        ->orWhere('admitidos.constancia_codigo','like','%'.$this->search.'%')
                        ->orWhere('persona.apell_pater','like','%'.$this->search.'%')
                        ->orWhere('persona.apell_mater','like','%'.$this->search.'%')
                        ->orWhere('persona.nombres','like','%'.$this->search.'%')
                        ->orWhere('persona.num_doc','like','%'.$this->search.'%');
                    })
                    ->where('admitidos.id_mencion', $this->filtro_programa)
                    ->orderBy('admitidos.admitidos_codigo', 'ASC')
                    ->orderBy('persona.nombre_completo', 'ASC')
                    ->get();
                $admitidos_model = collect();
                foreach($admitidos as $admi){
                    $constancia = ConstanciaIngresoPago::join('admitidos', 'constancia_ingreso_pago.admitidos_id', '=', 'admitidos.admitidos_id')
                        ->join('evaluacion','admitidos.evaluacion_id','=','evaluacion.evaluacion_id')
                        ->join('inscripcion','evaluacion.inscripcion_id','=','inscripcion.id_inscripcion')
                        ->join('mencion', 'inscripcion.id_mencion', '=', 'mencion.id_mencion')
                        ->join('subprograma', 'mencion.id_subprograma', '=', 'subprograma.id_subprograma')
                        ->join('programa', 'subprograma.id_programa', '=', 'programa.id_programa')
                        ->join('persona','inscripcion.persona_idpersona','=','persona.idpersona')
                        ->where('admitidos.id_mencion', $this->filtro_programa)
                        ->where('admitidos.admitidos_id', $admi->admitidos_id)
                        ->first();
                    if($constancia == null){
                        $admitidos_model->push($admi);
                    }
                }
            }else if($this->filtro_pago == 'sin_matricula'){
                $admitidos = Admitidos::join('evaluacion','admitidos.evaluacion_id','=','evaluacion.evaluacion_id')
                    ->join('inscripcion','evaluacion.inscripcion_id','=','inscripcion.id_inscripcion')
                    ->join('mencion', 'inscripcion.id_mencion', '=', 'mencion.id_mencion')
                    ->join('subprograma', 'mencion.id_subprograma', '=', 'subprograma.id_subprograma')
                    ->join('programa', 'subprograma.id_programa', '=', 'programa.id_programa')
                    ->join('persona','inscripcion.persona_idpersona','=','persona.idpersona')
                    ->where(function($query){
                        $query->where('admitidos.admitidos_id','like','%'.$this->search.'%')
                        ->orWhere('admitidos.admitidos_codigo','like','%'.$this->search.'%')
                        ->orWhere('admitidos.constancia_codigo','like','%'.$this->search.'%')
                        ->orWhere('persona.apell_pater','like','%'.$this->search.'%')
                        ->orWhere('persona.apell_mater','like','%'.$this->search.'%')
                        ->orWhere('persona.nombres','like','%'.$this->search.'%')
                        ->orWhere('persona.num_doc','like','%'.$this->search.'%');
                    })
                    ->where('admitidos.id_mencion', $this->filtro_programa)
                    ->orderBy('admitidos.admitidos_codigo', 'ASC')
                    ->orderBy('persona.nombre_completo', 'ASC')
                    ->get();
                $admitidos_model = collect();
                foreach($admitidos as $admi){
                    $matricula = MatriculaPago::join('admitidos', 'matricula_pago.admitidos_id', '=', 'admitidos.admitidos_id')
                        ->join('evaluacion','admitidos.evaluacion_id','=','evaluacion.evaluacion_id')
                        ->join('inscripcion','evaluacion.inscripcion_id','=','inscripcion.id_inscripcion')
                        ->join('mencion', 'inscripcion.id_mencion', '=', 'mencion.id_mencion')
                        ->join('subprograma', 'mencion.id_subprograma', '=', 'subprograma.id_subprograma')
                        ->join('programa', 'subprograma.id_programa', '=', 'programa.id_programa')
                        ->join('persona','inscripcion.persona_idpersona','=','persona.idpersona')
                        ->where('admitidos.id_mencion', $this->filtro_programa)
                        ->where('admitidos.admitidos_id', $admi->admitidos_id)
                        ->first();
                    if($matricula == null){
                        $admitidos_model->push($admi);
                    }
                }
            }
        }else if($this->filtro_pago){
            if($this->filtro_pago == 'constancia'){
                $admitidos_model = ConstanciaIngresoPago::join('admitidos', 'constancia_ingreso_pago.admitidos_id', '=', 'admitidos.admitidos_id')
                    ->join('evaluacion','admitidos.evaluacion_id','=','evaluacion.evaluacion_id')
                    ->join('inscripcion','evaluacion.inscripcion_id','=','inscripcion.id_inscripcion')
                    ->join('mencion', 'inscripcion.id_mencion', '=', 'mencion.id_mencion')
                    ->join('subprograma', 'mencion.id_subprograma', '=', 'subprograma.id_subprograma')
                    ->join('programa', 'subprograma.id_programa', '=', 'programa.id_programa')
                    ->join('persona','inscripcion.persona_idpersona','=','persona.idpersona')
                    ->where(function($query){
                        $query->where('admitidos.admitidos_id','like','%'.$this->search.'%')
                        ->orWhere('admitidos.admitidos_codigo','like','%'.$this->search.'%')
                        ->orWhere('admitidos.constancia_codigo','like','%'.$this->search.'%')
                        ->orWhere('persona.apell_pater','like','%'.$this->search.'%')
                        ->orWhere('persona.apell_mater','like','%'.$this->search.'%')
                        ->orWhere('persona.nombres','like','%'.$this->search.'%')
                        ->orWhere('persona.num_doc','like','%'.$this->search.'%');
                    })
                    ->orderBy('admitidos.admitidos_codigo', 'ASC')
                    ->orderBy('persona.nombre_completo', 'ASC')
                    ->get();
            }else if($this->filtro_pago == 'matricula'){
                $admitidos_model = MatriculaPago::join('admitidos', 'matricula_pago.admitidos_id', '=', 'admitidos.admitidos_id')
                    ->join('evaluacion','admitidos.evaluacion_id','=','evaluacion.evaluacion_id')
                    ->join('inscripcion','evaluacion.inscripcion_id','=','inscripcion.id_inscripcion')
                    ->join('mencion', 'inscripcion.id_mencion', '=', 'mencion.id_mencion')
                    ->join('subprograma', 'mencion.id_subprograma', '=', 'subprograma.id_subprograma')
                    ->join('programa', 'subprograma.id_programa', '=', 'programa.id_programa')
                    ->join('persona','inscripcion.persona_idpersona','=','persona.idpersona')
                    ->where(function($query){
                        $query->where('admitidos.admitidos_id','like','%'.$this->search.'%')
                        ->orWhere('admitidos.admitidos_codigo','like','%'.$this->search.'%')
                        ->orWhere('admitidos.constancia_codigo','like','%'.$this->search.'%')
                        ->orWhere('persona.apell_pater','like','%'.$this->search.'%')
                        ->orWhere('persona.apell_mater','like','%'.$this->search.'%')
                        ->orWhere('persona.nombres','like','%'.$this->search.'%')
                        ->orWhere('persona.num_doc','like','%'.$this->search.'%');
                    })
                    ->orderBy('admitidos.admitidos_codigo', 'ASC')
                    ->orderBy('persona.nombre_completo', 'ASC')
                    ->get();
            }else if($this->filtro_pago == 'constancia_matricula'){
                $constancia = ConstanciaIngresoPago::join('admitidos', 'constancia_ingreso_pago.admitidos_id', '=', 'admitidos.admitidos_id')
                    ->join('evaluacion','admitidos.evaluacion_id','=','evaluacion.evaluacion_id')
                    ->join('inscripcion','evaluacion.inscripcion_id','=','inscripcion.id_inscripcion')
                    ->join('mencion', 'inscripcion.id_mencion', '=', 'mencion.id_mencion')
                    ->join('subprograma', 'mencion.id_subprograma', '=', 'subprograma.id_subprograma')
                    ->join('programa', 'subprograma.id_programa', '=', 'programa.id_programa')
                    ->join('persona','inscripcion.persona_idpersona','=','persona.idpersona')
                    ->where(function($query){
                        $query->where('admitidos.admitidos_id','like','%'.$this->search.'%')
                        ->orWhere('admitidos.admitidos_codigo','like','%'.$this->search.'%')
                        ->orWhere('admitidos.constancia_codigo','like','%'.$this->search.'%')
                        ->orWhere('persona.apell_pater','like','%'.$this->search.'%')
                        ->orWhere('persona.apell_mater','like','%'.$this->search.'%')
                        ->orWhere('persona.nombres','like','%'.$this->search.'%')
                        ->orWhere('persona.num_doc','like','%'.$this->search.'%');
                    })
                    ->orderBy('admitidos.admitidos_codigo', 'ASC')
                    ->orderBy('persona.nombre_completo', 'ASC')
                    ->get();
                $matricula = MatriculaPago::join('admitidos', 'matricula_pago.admitidos_id', '=', 'admitidos.admitidos_id')
                    ->join('evaluacion','admitidos.evaluacion_id','=','evaluacion.evaluacion_id')
                    ->join('inscripcion','evaluacion.inscripcion_id','=','inscripcion.id_inscripcion')
                    ->join('mencion', 'inscripcion.id_mencion', '=', 'mencion.id_mencion')
                    ->join('subprograma', 'mencion.id_subprograma', '=', 'subprograma.id_subprograma')
                    ->join('programa', 'subprograma.id_programa', '=', 'programa.id_programa')
                    ->join('persona','inscripcion.persona_idpersona','=','persona.idpersona')
                    ->where(function($query){
                        $query->where('admitidos.admitidos_id','like','%'.$this->search.'%')
                        ->orWhere('admitidos.admitidos_codigo','like','%'.$this->search.'%')
                        ->orWhere('admitidos.constancia_codigo','like','%'.$this->search.'%')
                        ->orWhere('persona.apell_pater','like','%'.$this->search.'%')
                        ->orWhere('persona.apell_mater','like','%'.$this->search.'%')
                        ->orWhere('persona.nombres','like','%'.$this->search.'%')
                        ->orWhere('persona.num_doc','like','%'.$this->search.'%');
                    })
                    ->orderBy('admitidos.admitidos_codigo', 'ASC')
                    ->orderBy('persona.nombre_completo', 'ASC')
                    ->get();
                $admitidos_model = collect();
                foreach($constancia as $cons){
                    foreach($matricula as $matri){
                        if($cons->admitidos_id == $matri->admitidos_id){
                            $admitidos_model->push($cons);
                        }
                    }
                }
            }else if($this->filtro_pago == 'sin_constancia'){
                $admitidos = Admitidos::join('evaluacion','admitidos.evaluacion_id','=','evaluacion.evaluacion_id')
                    ->join('inscripcion','evaluacion.inscripcion_id','=','inscripcion.id_inscripcion')
                    ->join('mencion', 'inscripcion.id_mencion', '=', 'mencion.id_mencion')
                    ->join('subprograma', 'mencion.id_subprograma', '=', 'subprograma.id_subprograma')
                    ->join('programa', 'subprograma.id_programa', '=', 'programa.id_programa')
                    ->join('persona','inscripcion.persona_idpersona','=','persona.idpersona')
                    ->where(function($query){
                        $query->where('admitidos.admitidos_id','like','%'.$this->search.'%')
                        ->orWhere('admitidos.admitidos_codigo','like','%'.$this->search.'%')
                        ->orWhere('admitidos.constancia_codigo','like','%'.$this->search.'%')
                        ->orWhere('persona.apell_pater','like','%'.$this->search.'%')
                        ->orWhere('persona.apell_mater','like','%'.$this->search.'%')
                        ->orWhere('persona.nombres','like','%'.$this->search.'%')
                        ->orWhere('persona.num_doc','like','%'.$this->search.'%');
                    })
                    ->orderBy('admitidos.admitidos_codigo', 'ASC')
                    ->orderBy('persona.nombre_completo', 'ASC')
                    ->get();
                $admitidos_model = collect();
                foreach($admitidos as $admi){
                    $constancia = ConstanciaIngresoPago::join('admitidos', 'constancia_ingreso_pago.admitidos_id', '=', 'admitidos.admitidos_id')
                        ->join('evaluacion','admitidos.evaluacion_id','=','evaluacion.evaluacion_id')
                        ->join('inscripcion','evaluacion.inscripcion_id','=','inscripcion.id_inscripcion')
                        ->join('mencion', 'inscripcion.id_mencion', '=', 'mencion.id_mencion')
                        ->join('subprograma', 'mencion.id_subprograma', '=', 'subprograma.id_subprograma')
                        ->join('programa', 'subprograma.id_programa', '=', 'programa.id_programa')
                        ->join('persona','inscripcion.persona_idpersona','=','persona.idpersona')
                        ->where('admitidos.admitidos_id', $admi->admitidos_id)
                        ->first();
                    if($constancia == null){
                        $admitidos_model->push($admi);
                    }
                }
            }else if($this->filtro_pago == 'sin_matricula'){
                $admitidos = Admitidos::join('evaluacion','admitidos.evaluacion_id','=','evaluacion.evaluacion_id')
                    ->join('inscripcion','evaluacion.inscripcion_id','=','inscripcion.id_inscripcion')
                    ->join('mencion', 'inscripcion.id_mencion', '=', 'mencion.id_mencion')
                    ->join('subprograma', 'mencion.id_subprograma', '=', 'subprograma.id_subprograma')
                    ->join('programa', 'subprograma.id_programa', '=', 'programa.id_programa')
                    ->join('persona','inscripcion.persona_idpersona','=','persona.idpersona')
                    ->where(function($query){
                        $query->where('admitidos.admitidos_id','like','%'.$this->search.'%')
                        ->orWhere('admitidos.admitidos_codigo','like','%'.$this->search.'%')
                        ->orWhere('admitidos.constancia_codigo','like','%'.$this->search.'%')
                        ->orWhere('persona.apell_pater','like','%'.$this->search.'%')
                        ->orWhere('persona.apell_mater','like','%'.$this->search.'%')
                        ->orWhere('persona.nombres','like','%'.$this->search.'%')
                        ->orWhere('persona.num_doc','like','%'.$this->search.'%');
                    })
                    ->orderBy('admitidos.admitidos_codigo', 'ASC')
                    ->orderBy('persona.nombre_completo', 'ASC')
                    ->get();
                $admitidos_model = collect();
                foreach($admitidos as $admi){
                    $matricula = MatriculaPago::join('admitidos', 'matricula_pago.admitidos_id', '=', 'admitidos.admitidos_id')
                        ->join('evaluacion','admitidos.evaluacion_id','=','evaluacion.evaluacion_id')
                        ->join('inscripcion','evaluacion.inscripcion_id','=','inscripcion.id_inscripcion')
                        ->join('mencion', 'inscripcion.id_mencion', '=', 'mencion.id_mencion')
                        ->join('subprograma', 'mencion.id_subprograma', '=', 'subprograma.id_subprograma')
                        ->join('programa', 'subprograma.id_programa', '=', 'programa.id_programa')
                        ->join('persona','inscripcion.persona_idpersona','=','persona.idpersona')
                        ->where('admitidos.admitidos_id', $admi->admitidos_id)
                        ->first();
                    if($matricula == null){
                        $admitidos_model->push($admi);
                    }
                }
            }
        }
        $programas = Mencion::join('subprograma','mencion.id_subprograma','=','subprograma.id_subprograma')
                    ->join('programa','subprograma.id_programa','=','programa.id_programa')
                    ->where('mencion.mencion_estado', 1)
                    ->orderBy('programa.descripcion_programa','ASC')
                    ->orderBy('subprograma.subprograma','ASC')
                    ->get();

        return view('livewire.modulo-administrador.evaluacion.admitidos.index',[
            'admitidos_model' => $admitidos_model,
            'programas' => $programas
        ]);
    }
}
