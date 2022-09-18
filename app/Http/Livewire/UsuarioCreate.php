<?php

namespace App\Http\Livewire;

use App\Models\Admision;
use App\Models\Expediente;
use App\Models\ExpedienteInscripcion;
use Livewire\Component;
use Livewire\WithFileUploads;

class UsuarioCreate extends Component
{
    use WithFileUploads;
    
    public $expediente1;
    public $expediente2;
    public $expediente3;
    public $expediente4;
    public $expediente5;
    public $expediente6;

    public function guardarExpediente()
    {
        $expe = Expediente::where('estado',1)->get();
        $expe_insc = ExpedienteInscripcion::where('id_inscripcion', auth('usuarios')->user()->id_inscripcion)->get();
        $valor = 0;
        foreach($expe as $item){
            foreach($expe_insc as $item2){
                if($item->cod_exp == $item2->expediente_cod_exp){
                    $valor = 1;
                }
            }
            if($valor != 1){
                $nombre = 'expediente'.$item->cod_exp;
                // dump($nombre);
                $this->validate([
                    $nombre => 'required|mimes:pdf',
                ]);
            }
            $valor = 0;
        }

        $estadoExpediente = "Enviado";

        $count = Expediente::count();

        $admision3 = Admision::where('estado',1)->first();
        $admi = $admision3->admision;


        foreach($expe as $item){
            foreach($expe_insc as $item2){
                if($item->cod_exp == $item2->expediente_cod_exp){
                    $valor = 1;
                }
            }
            if($valor != 1){
                $nombre = 'expediente'.$item->cod_exp;
                $nombreExpediente = $item->tipo_doc;

                $data = $this->$nombre;
            
                if($data != null){
                    $path = $admi. '/' .auth('usuarios')->user()->id_inscripcion. '/';
                    $filename = $nombreExpediente.".".$data->extension();
                    $data = $this->$nombre;
                    $data->storeAs($path, $filename, 'files_publico');

                    ExpedienteInscripcion::create([
                        "nom_exped" => $filename,
                        "estado" => $estadoExpediente,
                        "expediente_cod_exp" => $item->cod_exp,
                        "id_inscripcion" => auth('usuarios')->user()->id_inscripcion,
                    ]);
                }

            }
            $valor = 0;
        }

        $this->dispatchBrowserEvent('confirmacion-actualizacion-documentos');

        sleep(1);

        return redirect()->route('usuario.pdf', auth('usuarios')->user()->id_inscripcion);
    }

    public function render()
    {
        $expediente = Expediente::where('estado',1)->get();
        return view('livewire.usuario-create', [
            'expediente' => $expediente,
        ]);
    }
}
