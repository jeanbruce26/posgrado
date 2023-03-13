<?php

namespace App\Http\Livewire\ModuloInscripcion\Usuario;

use Livewire\Component;
use App\Models\Admision;
use App\Models\Admitidos;
use App\Models\CanalPago;
use App\Models\Ciclo;
use App\Models\ConceptoPago;
use App\Models\ConstanciaIngresoPago;
use App\Models\Curso;
use App\Models\Encuesta;
use App\Models\EncuestaDetalle;
use App\Models\Evaluacion;
use App\Models\Expediente;
use App\Models\ExpedienteInscripcion;
use App\Models\ExpedienteInscripcionSeguimiento;
use App\Models\Inscripcion;
use App\Models\MatriculaPago;
use App\Models\Pago;
use App\Models\Persona;
use App\Models\Programa;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use SimpleSoftwareIO\QrCode\Generator;

class Usuario extends Component
{
    use WithFileUploads; // sirve para subir archivos al servidor (imagenes, pdf, etc)
    
    // variables del modal para registrar el pago
    public $titulo_modal = 'Registrar pago';
    public $documento;
    public $numero_operacion;
    public $fecha_operacion;
    public $monto_operacion;
    public $canal_pago;
    public $concepto_pago;
    public $ciclo;
    public $voucher;
    public $iteration = 0;
    public $modo;

    public $encuesta = []; // variable del formulario de encuestas
    public $mostra_otros = false; // variable para mostrar el campo de otros en la encuesta
    public $encuesta_otro = null; // variable para guardar el valor del campo otros en la encuesta

    protected $listeners = ['render', 'crearConstancia', 'crearFichaMatricula', 'registrar_pago'];

    public function mount()
    {
        $this->documento = auth('usuarios')->user()->Persona->num_doc;
    }

    public function updated($propertyName)
    {
        if($this->modo === 'registrar_pago'){
            if($this->concepto_pago){
                if($this->concepto_pago == 3 || $this->concepto_pago == 4){
                    $this->validateOnly($propertyName, [
                        'documento' => 'required|numeric|digits:8',
                        'numero_operacion' => 'required|numeric',
                        'fecha_operacion' => 'required|date',
                        'monto_operacion' => 'required|numeric',
                        'canal_pago' => 'required|numeric',
                        'concepto_pago' => 'required|numeric',
                        'ciclo' => 'required|numeric',
                        'voucher' => 'required|mimes:pdf,jpg,jpeg,png|max:5120',
                    ]);
                }else{
                    $this->validateOnly($propertyName, [
                        'documento' => 'required|numeric|digits:8',
                        'numero_operacion' => 'required|numeric',
                        'fecha_operacion' => 'required|date',
                        'monto_operacion' => 'required|numeric',
                        'canal_pago' => 'required|numeric',
                        'concepto_pago' => 'required|numeric',
                        'ciclo' => 'nullable|numeric',
                        'voucher' => 'required|mimes:pdf,jpg,jpeg,png|max:5120',
                    ]);
                }
            }else{
                $this->validateOnly($propertyName, [
                    'documento' => 'required|numeric|digits:8',
                    'numero_operacion' => 'required|numeric',
                    'fecha_operacion' => 'required|date',
                    'monto_operacion' => 'required|numeric',
                    'canal_pago' => 'required|numeric',
                    'concepto_pago' => 'required|numeric',
                    'ciclo' => 'nullable|numeric',
                    'voucher' => 'required|mimes:pdf,jpg,jpeg,png|max:5120',
                ]);
            }
        }
    }

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
        $fecha = Carbon::parse(today());
        $fecha->locale('es');
        $fecha = 'Pucallpa, ' . $fecha->isoFormat('LL');
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

    public function generarFichaMatricula($admitido_id)
    {
        $this->dispatchBrowserEvent('alertaFichaMatricula', ['mensaje' => 'Ficha de matrícula generada correctamente', 'id' => $admitido_id]);
    }

    public function crearFichaMatricula(Admitidos $admitido)
    {
        $datos = Evaluacion::join('inscripcion', 'inscripcion.id_inscripcion', '=', 'evaluacion.inscripcion_id')
                ->join('persona', 'persona.idpersona', '=', 'inscripcion.persona_idpersona')
                ->join('mencion','mencion.id_mencion','=','inscripcion.id_mencion')
                ->join('plan', 'plan.id_plan', '=', 'mencion.id_plan')
                ->join('subprograma','subprograma.id_subprograma','=','mencion.id_subprograma')
                ->join('programa','programa.id_programa','=','subprograma.id_programa')
                ->join('admision','admision.cod_admi','=','inscripcion.admision_cod_admi')
                ->where('evaluacion.evaluacion_id',$admitido->evaluacion_id)
                ->first();

        $matricula_pago = MatriculaPago::where('admitidos_id',$admitido->admitidos_id)->first();

        $cursos = Curso::where('mencion_id',$datos->id_mencion)
                        ->where('ciclo_id', $matricula_pago->ciclo_id)
                        ->get();

        $programa = null;
        $subprograma = null;
        $mencion = null;
        if($datos->mencion == null){
            $programa = $datos->descripcion_programa;
            $subprograma = $datos->subprograma;
            $mencion = null;
        }else{
            $programa = $datos->descripcion_programa;
            $subprograma = $datos->subprograma;
            $mencion = $datos->mencion;
        }
        $fecha = date('d/m/Y', strtotime(Carbon::parse(today())));
        $numero_operacion = $matricula_pago->pago->nro_operacion;
        $plan = $datos->plan;
        $ciclo = $matricula_pago->ciclo->ciclo;
        $codigo = $admitido->admitidos_codigo;
        $nombre = $datos->nombre_completo;
        $domicilio = $datos->direccion;
        $celular = $datos->celular1;
        $data = [ 
            'programa' => $programa,
            'subprograma' => $subprograma,
            'mencion' => $mencion,
            'fecha' => $fecha,
            'numero_operacion' => $numero_operacion,
            'plan' => $plan,
            'ciclo' => $ciclo,
            'codigo' => $codigo,
            'nombre' => $nombre,
            'domicilio' => $domicilio,
            'celular' => $celular,
            'cursos' => $cursos
        ];

        $nombre_pdf = Str::slug($nombre) . '-ficha-matricula-' . $ciclo . '.pdf';
        $path_pdf = $datos->admision.'/'.$datos->id_inscripcion.'/'.$nombre_pdf;
        $pdf = Pdf::loadView('modulo_inscripcion.usuario.matricula', $data)->save(public_path($datos->admision.'/'.$datos->id_inscripcion.'/'). $nombre_pdf);
        
        $matricula_pago_update = MatriculaPago::find($matricula_pago->matricula_pago_id);
        $matricula_pago_update->ficha_matricula = $path_pdf;
        $matricula_pago_update->save();
    }

    public function modal_registrar_pago()
    {
        $this->modo = 'registrar_pago';
        $this->documento = auth('usuarios')->user()->Persona->num_doc;
    }

    public function updatedDocumento($documento)
    {
        if($documento != auth('usuarios')->user()->Persona->num_doc){
            $this->dispatchBrowserEvent('alertaRegistroPago', ['mensaje' => 'El número de documento no coincide con el registrado en el sistema']);
            $this->validateOnly('documento', [
                'documento' => 'required|numeric|digits:8|exists:persona,num_doc',
            ]);
        }
    }

    public function updatedConceptoPago($concepto_id)
    {
        if($concepto_id == 1){
            $this->dispatchBrowserEvent('alertaRegistroPago', ['mensaje' => 'El concepto de pago ingresado no es el correcto.']);
            $this->concepto_pago = '';
            return back();
        }
    }

    public function limpiar_modal()
    {
        $this->reset(['documento', 'numero_operacion', 'fecha_operacion', 'monto_operacion', 'concepto_pago', 'ciclo', 'voucher']);
        $this->resetErrorBag();
        $this->resetValidation();
        $this->modo = '';
        $this->iteration++;
    }
    
    public function cargar_alerta_registrarPago()
    {
        // validacion de datos
        if($this->modo === 'registrar_pago'){
            if($this->concepto_pago){
                if($this->concepto_pago == 3 || $this->concepto_pago == 4){
                    $this->validate([
                        'documento' => 'required|numeric|digits:8',
                        'numero_operacion' => 'required|numeric',
                        'fecha_operacion' => 'required|date',
                        'monto_operacion' => 'required|numeric',
                        'canal_pago' => 'required|numeric',
                        'concepto_pago' => 'required|numeric',
                        'ciclo' => 'required|numeric',
                        'voucher' => 'required|mimes:pdf,jpg,jpeg,png|max:5120',
                    ]);
                }else{
                    $this->validate([
                        'documento' => 'required|numeric|digits:8',
                        'numero_operacion' => 'required|numeric',
                        'fecha_operacion' => 'required|date',
                        'monto_operacion' => 'required|numeric',
                        'canal_pago' => 'required|numeric',
                        'concepto_pago' => 'required|numeric',
                        'ciclo' => 'nullable|numeric',
                        'voucher' => 'required|mimes:pdf,jpg,jpeg,png|max:5120',
                    ]);
                }
            }else{
                $this->validate([
                    'documento' => 'required|numeric|digits:8',
                    'numero_operacion' => 'required|numeric',
                    'fecha_operacion' => 'required|date',
                    'monto_operacion' => 'required|numeric',
                    'canal_pago' => 'required|numeric',
                    'concepto_pago' => 'required|numeric',
                    'ciclo' => 'nullable|numeric',
                    'voucher' => 'required|mimes:pdf,jpg,jpeg,png|max:5120',
                ]);
            }
        }

        // validar si el documento es igual al registrado en el sistema
        if($this->documento != auth('usuarios')->user()->Persona->num_doc){
            $this->dispatchBrowserEvent('alertaRegistroPago', ['mensaje' => 'El número de documento no coincide con el registrado en el sistema']);
            return back();
        }

        // validar si el numero de operacion ya existe
        $pago = Pago::where('nro_operacion', $this->numero_operacion)->first();
        if ($pago) {
            if($pago->dni == $this->documento && $pago->fecha_pago == $this->fecha_operacion){
                $this->dispatchBrowserEvent('alertaRegistroPago', [
                    'mensaje' => 'El número de operación y el DNI ya se encuentran registrados en el sistema.'
                ]);
                return back();
            }else if ($pago->fecha_pago == $this->fecha_operacion) {
                $this->dispatchBrowserEvent('alertaRegistroPago', [
                    'mensaje' => 'El número de operación ya ha sido ingresado en la fecha seleccionada.'
                ]);
                return back();
            }else if($pago->dni == $this->documento){
                $this->dispatchBrowserEvent('alertaRegistroPago', [
                    'mensaje' => 'El número de operación y el DNI ya existen en el registro de pagos.'
                ]);
                return back();
            }
        }

        // validar si el concepto de pago es correcto
        if($this->concepto_pago == 1){
            $this->dispatchBrowserEvent('alertaRegistroPago', ['mensaje' => 'El concepto de pago ingresado no es el correcto.']);
            return back();
        }

        // validar si el monto de operacion ingresado es igual al monto del concepto de pago
        $concepto_pago = ConceptoPago::find($this->concepto_pago);
        if($concepto_pago->monto != $this->monto_operacion){
            $this->dispatchBrowserEvent('alertaRegistroPago', [
                'mensaje' => 'El monto de operación ingresado no es el correcto. El monto correcto es de S/ '.$concepto_pago->monto
            ]);
            return back();
        }

        // validar si ya cuenta con su constancia de pago
        $evaluacion_id = Evaluacion::where('inscripcion_id', auth('usuarios')->user()->id_inscripcion)->first()->evaluacion_id;
        $admitidos_id = Admitidos::where('evaluacion_id', $evaluacion_id)->first()->admitidos_id;
        $constancia_pago = ConstanciaIngresoPago::where('admitidos_id', $admitidos_id)->first();
        if($constancia_pago){
            if($this->concepto_pago == 2){
                if($constancia_pago){
                    $this->dispatchBrowserEvent('alertaRegistroPago', [
                        'mensaje' => 'Ya cuenta con su constancia de ingreso.'
                    ]);
                    return back();
                }
            }
        }

        // validar si ya cuenta con su constancia de pago para realizar su matricula
        $evaluacion_id = Evaluacion::where('inscripcion_id', auth('usuarios')->user()->id_inscripcion)->first()->evaluacion_id;
        $admitidos_id = Admitidos::where('evaluacion_id', $evaluacion_id)->first()->admitidos_id;
        $constancia_pago = ConstanciaIngresoPago::where('admitidos_id', $admitidos_id)->first();
        if(!$constancia_pago){
            if($this->concepto_pago == 3){
                $this->dispatchBrowserEvent('alertaRegistroPago', [
                    'mensaje' => 'Debe realizar su constancia de ingreso para realizar su matrícula.'
                ]);
                return back();
            }
        }

        // validar si ya cuenta con su matricula de pago y si el ciclo es correcto
        $evaluacion_id = Evaluacion::where('inscripcion_id', auth('usuarios')->user()->id_inscripcion)->first()->evaluacion_id;
        $admitidos_id = Admitidos::where('evaluacion_id', $evaluacion_id)->first()->admitidos_id;
        $matricula = MatriculaPago::where('admitidos_id', $admitidos_id)->first();
        if($matricula){
            if($this->concepto_pago == 3 || $this->concepto_pago == 4){
                if($matricula->ciclo_id == $this->ciclo){
                    $this->dispatchBrowserEvent('alertaRegistroPago', [
                        'mensaje' => 'Ya cuenta con su matrícula de pago en el ciclo '. $matricula->ciclo->ciclo
                    ]);
                    return back();
                }
            }
        }

        // redireccionar a la funcion para registrar el pago
        $this->dispatchBrowserEvent('confirmacion-registro_pago', ['mensaje' => 'Pago registrado correctamente']);
    }

    public function registrar_pago()
    {
        // registrar datos del formulario en la tabla pago
        $pago = new Pago();
        $pago->dni = $this->documento;
        $pago->nro_operacion = $this->numero_operacion;
        $pago->monto = $this->monto_operacion;
        $pago->fecha_pago = $this->fecha_operacion;
        $pago->estado = 1;
        $pago->canal_pago_id = $this->canal_pago;
        $pago->verificacion_pago = 1;
        if($this->voucher){
            $path = 'vouchers/';
            $filename = 'voucher-pago-'.auth('usuarios')->user()->id_inscripcion.'-'.time().'.'.$this->voucher->getClientOriginalExtension();
            $nombre_db = $path.$filename;
            $data = $this->voucher;
            $data->storeAs($path, $filename, 'files_publico');
            $pago->voucher = $nombre_db;
        }
        $pago->save();

        // registrar datos del formulario en la tabla constancia_pago y en la tabla matricula_pago 
        $evaluacion_id = Evaluacion::where('inscripcion_id',auth('usuarios')->user()->id_inscripcion)->first()->evaluacion_id;
        $admitido = Admitidos::where('evaluacion_id', $evaluacion_id)->first();

        if($this->concepto_pago == 2){ //pago por constancia de ingreso
            $pago_constancia = new ConstanciaIngresoPago(); //guardar pago por constancia de ingreso
            $pago_constancia->pago_id = $pago->pago_id;
            $pago_constancia->admitidos_id = $admitido->admitidos_id;
            $pago_constancia->concepto_id = $this->concepto_pago;
            $pago_constancia->save();

            $pago = Pago::find($pago->pago_id); //actualizar estado del pago
            $pago->estado = 4; // estado 4 = pago por constancia de ingreso
            $pago->save();
        }else if($this->concepto_pago == 3){ //pago por matricula
            $pago_matricula = new MatriculaPago(); //guardar pago por matricula
            $pago_matricula->pago_id = $pago->pago_id;
            $pago_matricula->admitidos_id = $admitido->admitidos_id;
            $pago_matricula->concepto_id = $this->concepto_pago;
            $pago_matricula->ciclo_id = $this->ciclo;
            $pago_matricula->save();

            $pago = Pago::find($pago->pago_id); //actualizar estado del pago
            $pago->estado = 5; // estado 5 = pago por matricula
            $pago->save();
        }else if($this->concepto_pago == 4){
            $pago_constancia = new ConstanciaIngresoPago(); //guardar pago por constancia de ingreso
            $pago_constancia->pago_id = $pago->pago_id;
            $pago_constancia->admitidos_id = $admitido->admitidos_id;
            $pago_constancia->concepto_id = $this->concepto_pago;
            $pago_constancia->save();

            $pago_matricula = new MatriculaPago(); //guardar pago por matricula
            $pago_matricula->pago_id = $pago->pago_id;
            $pago_matricula->admitidos_id = $admitido->admitidos_id;
            $pago_matricula->concepto_id = $this->concepto_pago;
            $pago_matricula->ciclo_id = $this->ciclo;
            $pago_matricula->save();

            $pago = Pago::find($pago->pago_id); //actualizar estado del pago
            $pago->estado = 5; // estado 5 = pago por matricula
            $pago->save();
        }

        // mostrar alerta de registro de pago con exito
        $this->dispatchBrowserEvent('alertaRegistroPagoSuccess', ['mensaje' => 'Pago registrado correctamente.']);

        // limpiar modal de registro de pago
        $this->limpiar_modal();

        // cerrar el modal de registro de pago
        $this->dispatchBrowserEvent('cerrarModalRegistroPago');
    }

    public function open_modal_encuesta()
    {
        $documento = auth('usuarios')->user()->Persona->num_doc; // documento del usuario logueado

        $encuesta = EncuestaDetalle::where('documento', $documento)->get(); // buscamos si el usuario ya realizo la encuesta
        if($encuesta->count() == 0){
            $this->dispatchBrowserEvent('modal_encuesta', [
                'modal' => 'show'
            ]);
        }
    }

    public function updatedEncuesta($value)
    {
        $contador = 0;
        foreach ($this->encuesta as $key => $value) {
            if($value == 8){
                $contador++;
            }
        }
        if($contador > 0){
            $this->mostra_otros = true;
        }else{
            $this->mostra_otros = false;
        }
    }

    public function guardar_encuesta()
    {
        // dd($this->encuesta);
        // validamos los campos del formulario
        if($this->encuesta == null){
            $this->dispatchBrowserEvent('alertaEncuestaError', ['mensaje' => 'Debe seleccionar una opción para continuar.']);
            return;
        }
        if($this->mostra_otros == true){
            if($this->encuesta_otro == null || $this->encuesta_otro == ''){
                $this->dispatchBrowserEvent('alertaEncuestaError', ['mensaje' => 'Debe especificar la opción seleccionada.']);
                return;
            }
        }

        // guardamos la encuesta
        foreach ($this->encuesta as $key => $value) {
            $encuesta = new EncuestaDetalle();
            $encuesta->documento = auth('usuarios')->user()->Persona->num_doc;
            $encuesta->encuesta_id = $value;
            if($value == 8){
                $encuesta->otros = $this->encuesta_otro;
            }else{
                $encuesta->otros = null;
            }
            $encuesta->created_at = now();
            $encuesta->save();
        }

        // mostrar alerta de registro de pago con exito
        $this->dispatchBrowserEvent('alertaRegistroPagoSuccess', ['mensaje' => 'Encuesta registrada correctamente.']);

        // resetear el formulario
        $this->reset('encuesta', 'encuesta_otro', 'mostra_otros');

        // aqui cerra el modal de encuesta
        $this->dispatchBrowserEvent('modal_encuesta', [
            'modal' => 'hide'
        ]);
    }

    public function render()
    {
        $nombre = ucfirst(strtolower(auth('usuarios')->user()->persona->apell_pater)) . ' ' . ucfirst(strtolower(auth('usuarios')->user()->persona->apell_mater)) . ', ' . ucwords(strtolower(auth('usuarios')->user()->persona->nombres));
        $contador = ExpedienteInscripcion::where('id_inscripcion',auth('usuarios')->user()->id_inscripcion)->count();
        $expediente_count = Expediente::where('estado', 1)
                                ->where(function($query) {
                                    $query->where('expediente_tipo', 0)
                                        ->orWhere('expediente_tipo', auth('usuarios')->user()->tipo_programa);
                                })
                                ->count();
        $fecha_admision = Carbon::parse(Admision::where('estado',1)->first()->fecha_fin);
        $fecha_admision->locale('es');
        $fecha_admision = $fecha_admision->isoFormat('LL');

        $fecha_admision_normal = Admision::where('estado',1)->first()->fecha_fin;

        $evaluacion = Evaluacion::where('inscripcion_id',auth('usuarios')->user()->id_inscripcion)->first();
        // dd($evaluacion);
        $admitido = null;
        $pago_constancia_ingreso = 0;
        $pago_matricula = 0;
        $matricula_pago = null;
        if($evaluacion){
            $admitido = Admitidos::where('evaluacion_id',$evaluacion->evaluacion_id)->first();
            // dd($admitido);
            if($admitido){
                $constanca_ingreso_pago = ConstanciaIngresoPago::where('admitidos_id',$admitido->admitidos_id)->first(); //verificar si ya pago
                $matricula_pago = MatriculaPago::where('admitidos_id',$admitido->admitidos_id)->first(); //verificar si ya pago
                if($constanca_ingreso_pago){
                    if($constanca_ingreso_pago->concepto_id == 2 || $constanca_ingreso_pago->concepto_id == 4){
                        $pago_constancia_ingreso = 1;
                    }
                } 
                if($matricula_pago){
                    if($matricula_pago->concepto_id == 3 || $matricula_pago->concepto_id == 4){
                        $pago_matricula = 1;
                    }
                }  
            }
        }

        $admision_fecha_admitidos = Carbon::parse(Admision::where('estado',1)->first()->fecha_admitidos); //fecha de admision de admitidos
        $admision_fecha_admitidos->locale('es');
        $admision_fecha_admitidos = $admision_fecha_admitidos->isoFormat('LL');

        $lista_admitidos = Admitidos::count();

        // verificar si tiene expediente en seguimiento
        $expediente_seguimiento_count = ExpedienteInscripcionSeguimiento::join('ex_insc', 'ex_insc.cod_ex_insc', 'expediente_inscripcion_seguimiento.cod_ex_insc')
                                                    ->where('ex_insc.id_inscripcion', auth('usuarios')->user()->id_inscripcion)
                                                    ->where('expediente_inscripcion_seguimiento.expediente_inscripcion_seguimiento_estado', 1)
                                                    ->where('expediente_inscripcion_seguimiento.tipo_seguimiento', 1)
                                                    ->count();
        $admision_fecha_constancia = Admision::where('estado',1)->first()->fecha_constancia;

        $concepto_pago_model = ConceptoPago::where('estado', 1)->get();
        $ciclo_model = Ciclo::where('ciclo_estado', 1)
                            ->where(function($query) {
                                $query->where('ciclo_programa', 0)
                                    ->orWhere('ciclo_programa', auth('usuarios')->user()->tipo_programa);
                            })
                            ->get();
        $canal_pago_model = CanalPago::where('canal_pago_estado', 1)->get();

        $encuestas = Encuesta::where('encuesta_estado', 1)->get(); // obtenemos las encuestas activas

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
            'pago_constancia_ingreso' => $pago_constancia_ingreso,
            'pago_matricula' => $pago_matricula,
            'matricula_pago' => $matricula_pago,
            'expediente_seguimiento_count' => $expediente_seguimiento_count,
            'admision_fecha_constancia' => $admision_fecha_constancia,
            'concepto_pago_model' => $concepto_pago_model,
            'ciclo_model' => $ciclo_model,
            'canal_pago_model' => $canal_pago_model,
            'encuestas' => $encuestas
        ]);
    }
}
