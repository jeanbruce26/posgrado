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

    public $expediente_update;
    public $expediente_add;
    public $cod_exp;
    public $cod_exp_ins;

    // public function updated($propertyName)
    // {
    //     $this->validateOnly($propertyName, [
    //         'expediente_add' => 'required|mimes:pdf|max:2024',
    //     ]);
    // }

    public function cargarCodExpIns($id)
    {
        $this->cod_exp_ins = $id;
    }

    public function guardar()
    {
        date_default_timezone_set("America/Lima");

        $this->resetErrorBag();
        $this->resetValidation();

        $this->validate([
            'expediente_update' => 'nullable|mimes:pdf',
        ]);

        $admision3 = Admision::where('estado',1)->first();
        $admi = $admision3->admision;

        $expe_ins = ExpedienteInscripcion::where('cod_ex_insc',$this->cod_exp_ins)->first();
        
        $nombreExpediente = $expe_ins->Expediente->tipo_doc;

        $data = $this->expediente_update;
    
        if($data != null){
            $path = $admi. '/' .auth('usuarios')->user()->id_inscripcion. '/';
            $filename = $nombreExpediente.".".$data->extension();
            $data = $this->expediente_update;
            $data->storeAs($path, $filename, 'files_publico');

            $expe_inscripcion = ExpedienteInscripcion::where('cod_ex_insc',$this->cod_exp_ins)->first();
            $expe_inscripcion->fecha_entre = today();
            $expe_inscripcion->save();

            $this->reset('expediente_add','expediente_update');
            $this->expediente_update = null;

            $this->dispatchBrowserEvent('notificacionExpe', ['message' =>'Documento actualizado satisfactoriamente.', 'color' => '#44bb76']);
        }else{
            $this->dispatchBrowserEvent('notificacionExpe', ['message' =>'Error al momento de subir su documento (documento vacio).', 'color' => '#ea4b43']);
        }

        $this->dispatchBrowserEvent('userStore', ['id' => $this->cod_exp_ins]);
    }   

    public function limpiar()
    {
        $this->resetValidation();
        $this->reset('expediente_add','expediente_update');
        $this->expediente_add = null;
        $this->expediente_update = null;
    }

    public function cargarCodExpeAdd($id)
    {
        $this->cod_exp = $id;
    }

    public function agregar()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        // dd($this->all());

        $this->validate([
            'expediente_add' => 'nullable|mimes:pdf|max:2024',
        ]);

        $estadoExpediente = "Enviado";

        $admision3 = Admision::where('estado',1)->first();
        $admi = $admision3->admision;

        $expe = Expediente::where('cod_exp',$this->cod_exp)->first();

        $nombreExpediente = $expe->tipo_doc;

        $data = $this->expediente_add;
    
        if($data != null){
            $path = $admi. '/' .auth('usuarios')->user()->id_inscripcion. '/';
            $filename = $nombreExpediente.".".$data->extension();
            $data = $this->expediente_add;
            $data->storeAs($path, $filename, 'files_publico');

            ExpedienteInscripcion::create([
                "nom_exped" => $filename,
                "estado" => $estadoExpediente,
                "expediente_cod_exp" => $this->cod_exp,
                "id_inscripcion" => auth('usuarios')->user()->id_inscripcion,
            ]);

            $this->reset(['expediente_add','expediente_update']);
            $this->expediente_add = null;

            $this->pdfUser(auth('usuarios')->user()->id_inscripcion);

            $this->dispatchBrowserEvent('notificacionExpe', ['message' =>'Documento ingresado satisfactoriamente.', 'color' => '#44bb76']);
        }else{
            $this->dispatchBrowserEvent('notificacionExpe', ['message' =>'Error al momento de subir su documento (documento vacio).', 'color' => '#ea4b43']);
        }

        $this->dispatchBrowserEvent('userStore', ['id' => $this->cod_exp]);
    }

    public function pdfUser($id)
    {
        date_default_timezone_set("America/Lima");
        
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
        $tiempo = 6;
        $valor = '+ '.intval($tiempo).' month';
        $final = date('j-m-Y',strtotime($fecha_actual2.$valor));
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
            'montoTotal' => $montoTotal,
            'final' => $final,
            'expedienteInscripcion' => $expedienteInscripcion,
            'expedi' => $expedi,
        ];

        $nombre_pdf = 'FICHA_INSCRIPCION.pdf';
        $pdf = Pdf::loadView('modulo_inscripcion.inscripcion.reporte-pdf', $data)->save(public_path($admi.'/'.$id.'/'). $nombre_pdf);

        $ins = Inscripcion::find($id);
        $ins->inscripcion = $nombre_pdf;
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
            'expediente' => Expediente::all(),
            'final' => $final,
            'fecha' => $fecha
        ]);
    }
}
