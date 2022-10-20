<?php

namespace App\Http\Livewire\modulo_inscripcion\usuario;

use App\Models\Admision;
use App\Models\Expediente;
use App\Models\ExpedienteInscripcion;
use Livewire\Component;
use Livewire\WithFileUploads;

class UsuarioUpdate extends Component
{
    use WithFileUploads;

    public $expediente_update;
    public $expediente_add;

    // public function updated($propertyName)
    // {
    //     $this->validateOnly($propertyName, [
    //         'expediente_add' => 'required|mimes:pdf|max:2024',
    //     ]);
    // }

    public function guardar($id)
    {
        date_default_timezone_set("America/Lima");

        $this->resetErrorBag();
        $this->resetValidation();

        $this->validate([
            'expediente_update' => 'nullable|mimes:pdf',
        ]);

        $admision3 = Admision::where('estado',1)->first();
        $admi = $admision3->admision;

        $expe_ins = ExpedienteInscripcion::where('cod_ex_insc',$id)->first();
        
        // dd($this->all(), $expe_ins, $expe_ins->Expediente->tipo_doc);
        
        $nombreExpediente = $expe_ins->Expediente->tipo_doc;

        $data = $this->expediente_update;
    
        if($data != null){
            $path = $admi. '/' .auth('usuarios')->user()->id_inscripcion. '/';
            $filename = $nombreExpediente.".".$data->extension();
            $data = $this->expediente_update;
            $data->storeAs($path, $filename, 'files_publico');

            $expe_inscripcion = ExpedienteInscripcion::where('cod_ex_insc',$id)->first();
            $expe_inscripcion->fecha_entre = today();
            $expe_inscripcion->save();

            $this->reset(['expediente_add','expediente_update']);
            $this->expediente_update = null;

            session()->flash('message', 'Documento actualizado correctamente.');

            $this->dispatchBrowserEvent('userStore', ['id' => $id]);
            
        }else{
            session()->flash('error', 'Error al momento de subir su documento (documento vacio).');
        }

        $this->dispatchBrowserEvent('userStore', ['id' => $id]);

        return redirect()->route('usuarios.edit');
    }   

    public function limpiar()
    {
        $this->resetValidation();
        $this->reset(['expediente_add','expediente_update']);
        $this->expediente_add = null;
        $this->expediente_update = null;
    }

    public function agregar($id)
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

        $expe = Expediente::where('cod_exp',$id)->first();

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
                "expediente_cod_exp" => $id,
                "id_inscripcion" => auth('usuarios')->user()->id_inscripcion,
            ]);

            $this->reset(['expediente_add','expediente_update']);
            $this->expediente_add = null;

            $this->dispatchBrowserEvent('userStore', ['id' => $id]);
            
            return redirect()->route('usuario.pdf', auth('usuarios')->user()->id_inscripcion);
        }else{
            session()->flash('error', 'Error al momento de subir su documento (documento vacio).');
        }

        $this->dispatchBrowserEvent('userStore', ['id' => $id]);

        return redirect()->route('usuarios.edit');

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
