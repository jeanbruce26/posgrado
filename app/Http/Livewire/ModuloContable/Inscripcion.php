<?php

namespace App\Http\Livewire\ModuloContable;

use App\Exports\ContableInscripcionExport;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Inscripcion as InscripcionModel;
use App\Models\InscripcionPago;
use App\Models\Mencion;
use Maatwebsite\Excel\Facades\Excel;

class Inscripcion extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $filtro_programa;

    public function export_excel() 
    {
        $fecha_actual = date("Ymd", strtotime(today()));
        $hora_actual = date("His", strtotime(now()));

        $this->dispatchBrowserEvent('notificacionExcel', ['message' =>'Excel exportado satisfactoriamente.', 'color' => '#2eb867']);

        return Excel::download(new ContableInscripcionExport, 'pago-inscripciones-'.$fecha_actual.'-'.$hora_actual.'.xlsx');
    }

    public function limpiar_filtro()
    {
        $this->reset('filtro_programa');
    }
    
    public function render()
    {
        if($this->filtro_programa)
        {
            $inscripcion_pago = InscripcionPago::join('inscripcion','inscripcion_pago.inscripcion_id','=','inscripcion.id_inscripcion')
                ->join('persona','inscripcion.persona_idpersona','=','persona.idpersona')
                ->join('mencion','inscripcion.id_mencion','=','mencion.id_mencion')
                ->join('subprograma','mencion.id_subprograma','=','subprograma.id_subprograma')
                ->join('programa','subprograma.id_programa','=','programa.id_programa')
                ->join('pago','inscripcion_pago.pago_id','=','pago.pago_id')
                ->where('mencion.id_mencion', $this->filtro_programa)
                ->where(function($query){
                    $query->where('persona.nombres','LIKE',"%{$this->search}%")
                    ->orWhere('persona.apell_pater','LIKE',"%{$this->search}%")
                    ->orWhere('persona.apell_mater','LIKE',"%{$this->search}%")
                    ->orWhere('persona.nombre_completo','LIKE',"%{$this->search}%")
                    ->orWhere('inscripcion.id_inscripcion','LIKE',"%{$this->search}%")
                    ->orWhere('subprograma.subprograma','LIKE',"%{$this->search}%")
                    ->orWhere('mencion.mencion','LIKE',"%{$this->search}%")
                    ->orWhere('programa.descripcion_programa','LIKE',"%{$this->search}%")
                    ->orWhere('persona.num_doc','LIKE',"%{$this->search}%");
                })
                ->orderBy('inscripcion.id_inscripcion','DESC')->paginate(100);
        }
        else
        {
            $inscripcion_pago = InscripcionPago::join('inscripcion','inscripcion_pago.inscripcion_id','=','inscripcion.id_inscripcion')
                    ->join('persona','inscripcion.persona_idpersona','=','persona.idpersona')
                    ->join('mencion','inscripcion.id_mencion','=','mencion.id_mencion')
                    ->join('subprograma','mencion.id_subprograma','=','subprograma.id_subprograma')
                    ->join('programa','subprograma.id_programa','=','programa.id_programa')
                    ->join('pago','inscripcion_pago.pago_id','=','pago.pago_id')
                    ->where('persona.nombres','LIKE',"%{$this->search}%")
                    ->orWhere('persona.apell_pater','LIKE',"%{$this->search}%")
                    ->orWhere('persona.apell_mater','LIKE',"%{$this->search}%")
                    ->orWhere('persona.nombre_completo','LIKE',"%{$this->search}%")
                    ->orWhere('inscripcion.id_inscripcion','LIKE',"%{$this->search}%")
                    ->orWhere('subprograma.subprograma','LIKE',"%{$this->search}%")
                    ->orWhere('mencion.mencion','LIKE',"%{$this->search}%")
                    ->orWhere('programa.descripcion_programa','LIKE',"%{$this->search}%")
                    ->orWhere('persona.num_doc','LIKE',"%{$this->search}%")
                    ->orderBy('inscripcion.id_inscripcion','DESC')->paginate(100);
        }

        $programas = Mencion::join('subprograma','mencion.id_subprograma','=','subprograma.id_subprograma')
                ->join('programa','subprograma.id_programa','=','programa.id_programa')
                ->where('mencion.mencion_estado', 1)
                ->orderBy('programa.descripcion_programa','ASC')
                ->orderBy('subprograma.subprograma','ASC')
                ->get();

        return view('livewire.modulo-contable.inscripcion', [
            'inscripcion' => $inscripcion_pago,
            'programas' => $programas
        ]);
    }
}
