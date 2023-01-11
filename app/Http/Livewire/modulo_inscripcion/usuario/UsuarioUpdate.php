<?php

namespace App\Http\Livewire\modulo_inscripcion\usuario;

use App\Models\Admision;
use App\Models\Expediente;
use App\Models\ExpedienteInscripcion;
use App\Models\Inscripcion;
use App\Models\InscripcionPago;
use App\Models\Mencion;
use App\Models\Persona;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;
use Livewire\WithFileUploads;

class UsuarioUpdate extends Component
{
    use WithFileUploads;

    public $expediente;
    public $expediente_inscripcion_model;
    public $expediente_model_2;
    public $expediente_nombre;
    public $cod_exp;
    public $cod_exp_ins;
    public $iteration;
    public $titulo = 'Ingresar Documento';
    public $modo = 1;

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'expediente' => 'nullable|mimes:pdf|max:10024',
        ]);
    }

    public function cargarCodExpIns(ExpedienteInscripcion $id)
    {
        $this->expediente_inscripcion_model = $id;
        $this->cod_exp_ins = $id->cod_ex_insc;
        $this->modo = 2;
        $this->titulo = 'Actualizar Documento';
        $this->expediente_nombre = $id->Expediente->tipo_doc;
    }

    public function limpiar()
    {
        $this->resetValidation();
        $this->reset('expediente');
        $this->expediente = null;
        $this->iteration++;
    }

    public function cargarCodExpeAdd(Expediente $id)
    {
        $this->expediente_model_2 = $id;
        $this->cod_exp = $id->cod_exp;
        $this->modo = 1;
        $this->expediente_nombre = $id->tipo_doc;
        $this->titulo = 'Ingresar Documento';
    }

    public function guardarExpediente()
    {
        if($this->modo == 1){
            $this->resetErrorBag();
            $this->resetValidation();

            $this->validate([
                'expediente' => 'nullable|mimes:pdf|max:10024',
            ]);

            $estado_expediente = "Enviado";

            $admision = Admision::where('estado',1)->first()->admision;

            $data = $this->expediente;
        
            if($data != null){
                $path = $admision. '/' .auth('usuarios')->user()->id_inscripcion. '/';
                $filename = $this->expediente_nombre.".".$data->extension();
                $nombreDB = $path.$filename;
                $data = $this->expediente;
                $data->storeAs($path, $filename, 'files_publico');

                ExpedienteInscripcion::create([
                    "nom_exped" => $nombreDB,
                    "estado" => $estado_expediente,
                    "expediente_cod_exp" => $this->cod_exp,
                    "id_inscripcion" => auth('usuarios')->user()->id_inscripcion,
                ]);

                $this->limpiar();

                $this->pdfUser(auth('usuarios')->user()->id_inscripcion);

                $this->dispatchBrowserEvent('notificacionExpe', ['message' =>'Documento ingresado satisfactoriamente.', 'color' => '#44bb76']);
            }else{
                $this->dispatchBrowserEvent('notificacionExpe', ['message' =>'Error al momento de subir su documento (documento vacio).', 'color' => '#ea4b43']);
            }
        }else{
            date_default_timezone_set("America/Lima");

            $this->resetErrorBag();
            $this->resetValidation();

            $this->validate([
                'expediente' => 'nullable|mimes:pdf|max:10024',
            ]);

            $admision = Admision::where('estado',1)->first()->admision;

            $data = $this->expediente;
        
            if($data != null){
                $path = $admision. '/' .auth('usuarios')->user()->id_inscripcion. '/';
                $filename = $this->expediente_nombre.".".$data->extension();
                $data = $this->expediente;
                $data->storeAs($path, $filename, 'files_publico');

                $expe_inscripcion = ExpedienteInscripcion::find($this->cod_exp_ins);
                $expe_inscripcion->fecha_entre = now();
                $expe_inscripcion->save();

                $this->limpiar();
                
                $this->pdfUser(auth('usuarios')->user()->id_inscripcion);

                $this->dispatchBrowserEvent('notificacionExpe', ['message' =>'Documento actualizado satisfactoriamente.', 'color' => '#44bb76']);
            }else{
                $this->dispatchBrowserEvent('notificacionExpe', ['message' =>'Error al momento de subir su documento (documento vacio).', 'color' => '#ea4b43']);
            }
        }

        $this->dispatchBrowserEvent('modalExpediente');
    }

    public function pdfUser($id)
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
        $expedi = Expediente::all();

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
        $nombre = ucfirst(strtolower(auth('usuarios')->user()->persona->apell_pater)) . ' ' . ucfirst(strtolower(auth('usuarios')->user()->persona->apell_mater)) . ', ' . ucwords(strtolower(auth('usuarios')->user()->persona->nombres));

        $admision = Admision::where('estado',1)->first();
        $valor = '+ 2 day';
        $final = date('Y/m/d',strtotime($admision->fecha_fin.$valor));
        $fecha = date('Y/m/d', strtotime(today()));

        return view('livewire.modulo_inscripcion.usuario.usuario-update', [
            'nombre' => $nombre,
            'expediente_model' => Expediente::all(),
            'final' => $final,
            'fecha' => $fecha
        ]);
    }
}
