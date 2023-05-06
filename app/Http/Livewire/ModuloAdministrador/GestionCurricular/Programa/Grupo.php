<?php

namespace App\Http\Livewire\ModuloAdministrador\GestionCurricular\Programa;

use App\Exports\ModuloAdministrador\Admitidos\ExportAdmitidosMatriculados;
use App\Exports\ModuloAdministrador\Admitidos\ExportAdmitidosMatriculadosMultipleSheets;
use App\Models\Admision;
use App\Models\GrupoPrograma;
use App\Models\Mencion;
use App\Models\Programa;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;
use Livewire\Component;

class Grupo extends Component
{
  public $mencion_id;
  public $modo = 'crear';
  public $grupo_programa_id;
  public $grupo, $cantidad, $contador, $admision;
  public $titulo = 'Crear Grupos';

  protected $rules = [
    'grupo' => 'required',
    'cantidad' => 'required|numeric',
    'admision' => 'required|numeric',
  ];

  public function updated($propertyName)
  {
    $this->validateOnly($propertyName);
  }

  public function modo()
  {
    $this->modo = 'crear';
    $this->titulo = 'Crear Grupos';
    $this->grupo_programa_id = null;
    $this->grupo = null;
    $this->cantidad = null;
    $this->contador = null;
    $this->admision = null;
  }

  public function limpiar()
  {
    $this->reset([
      'grupo_programa_id',
      'grupo',
      'cantidad',
      'contador',
      'admision',
    ]);
    $this->resetErrorBag();
    $this->resetValidation();
  }

  public function cargarGrupo(GrupoPrograma $grupo)
  {
    $this->modo = 'editar';
    $this->titulo = 'Editar Grupos';
    $this->grupo_programa_id = $grupo->id_grupo_programa;
    $this->grupo = $grupo->grupo;
    $this->cantidad = $grupo->grupo_cantidad;
    $this->contador = $grupo->grupo_contador;
    $this->admision = $grupo->id_admision;
  }

  public function guardarGrupo()
  {
    $this->validate();
    if ($this->modo == 'crear') {
      $grupo = new GrupoPrograma();
      $grupo->grupo = $this->grupo;
      $grupo->grupo_contador = 0;
      $grupo->grupo_cantidad = $this->cantidad;
      $grupo->id_mencion = $this->mencion_id;
      $grupo->id_admision = $this->admision;
      $grupo->grupo_programa_estado = 1;
      $grupo->save();

      $this->dispatchBrowserEvent('notificacionGrupo', ['message' => 'Grupo creado con éxito']);
    } else {
      $grupo = GrupoPrograma::find($this->grupo_programa_id);
      $grupo->grupo = $this->grupo;
      $grupo->grupo_cantidad = $this->cantidad;
      $grupo->id_admision = $this->admision;
      $grupo->save();

      $this->dispatchBrowserEvent('notificacionGrupo', ['message' => 'Grupo actualizado con éxito']);
    }

    $this->dispatchBrowserEvent('modalGrupo');
    $this->limpiar();
  }

  public function export($id_mencion)
  {
    $programa = Programa::join('subprograma', 'programa.id_programa', '=', 'subprograma.id_programa')
      ->join('mencion', 'subprograma.id_subprograma', '=', 'mencion.id_subprograma')
      ->where('mencion.id_mencion', $id_mencion)
      ->first();
    $programa_nombre = '';
    if($programa->mencion){
      $programa_nombre = 'MENCION EN ' . $programa->mencion;
      $programa_nombre = Str::slug($programa_nombre, '-');
    }else{
      $programa_nombre = $programa->descripcion_programa . ' EN ' . $programa->subprograma;
      $programa_nombre = Str::slug($programa_nombre, '-');
    }
    $fecha_actual = date("Ymd", strtotime(today()));
    $hora_actual = date("His", strtotime(now()));
    $nombre_archivo = $programa_nombre . '-' . $fecha_actual . '-' . $hora_actual . '.xlsx';

    // $this->dispatchBrowserEvent('notificacionExcel', ['message' => 'Excel exportado satisfactoriamente.', 'color' => '#2eb867']);

    return (new ExportAdmitidosMatriculadosMultipleSheets($id_mencion))->download('matriculados-'.$nombre_archivo);
    // return Excel::download(new ExportAdmitidosMatriculadosMultipleSheets($id_mencion), $nombre_archivo);
  }

  public function render()
  {
    $grupos = GrupoPrograma::where('grupo_programa_estado', 1)->where('id_mencion', $this->mencion_id)->get();
    $admisiones = Admision::all();
    return view('livewire.modulo-administrador.gestion-curricular.programa.grupo', [
      'grupos' => $grupos,
      'admisiones' => $admisiones
    ]);
  }
}
