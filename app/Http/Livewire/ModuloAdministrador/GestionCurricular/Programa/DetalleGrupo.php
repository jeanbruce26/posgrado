<?php

namespace App\Http\Livewire\ModuloAdministrador\GestionCurricular\Programa;

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
use App\Models\GrupoPrograma;
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
use Livewire\Component;

class DetalleGrupo extends Component
{
  public $id_grupo_programa;
  public $id_mencion;
  public $grupo;
  public $grupo_antiguo;
  public $admitido;

  public function updated($propertyName)
  {
    $this->validateOnly($propertyName, [
      'grupo' => 'required|numeric'
    ]);
  }

  public function limpiar()
  {
    $this->grupo = null;
  }

  public function cargarEditar(Admitidos $admitido)
  {
    $matricula = MatriculaPago::where('admitidos_id', $admitido->admitidos_id)->first();
    $this->grupo = $matricula->id_grupo_programa;
    $this->grupo_antiguo = $matricula->id_grupo_programa;
    $this->admitido = $admitido;
  }

  public function guardar()
  {
      $admitido = $this->admitido;

      $this->validate([
        'grupo' => 'required|numeric'
      ]);
      
      $matricula = MatriculaPago::where('admitidos_id', $admitido->admitidos_id)->first();
      $matricula->id_grupo_programa = $this->grupo;
      $matricula->save();

      // actualizarcontadordedlos grupos
      $grupo = GrupoPrograma::find($this->grupo);
      $grupo->grupo_contador = $grupo->grupo_contador + 1;
      $grupo->save();

      // restar el contador del grupo anterior
      $grupo = GrupoPrograma::find($this->grupo_antiguo);
      $grupo->grupo_contador = $grupo->grupo_contador - 1;
      $grupo->save();

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
      $grupo = MatriculaPago::where('admitidos_id',$admitido->admitidos_id)->first();
      $grupo = $grupo->grupo_programa->grupo;
      $admision = Admision::where('cod_admi',$datos->admision_cod_admi)->first();
      $admision = $admision->admision;
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
          'cursos' => $cursos,
          'grupo' => $grupo,
          'admision' => $admision
      ];

      $nombre_pdf = Str::slug($nombre) . '-ficha-matricula-' . $ciclo . '.pdf';
      $path_pdf = $datos->admision.'/'.$datos->id_inscripcion.'/'.$nombre_pdf;
      $pdf = Pdf::loadView('modulo_inscripcion.usuario.matricula', $data)->save(public_path($datos->admision.'/'.$datos->id_inscripcion.'/'). $nombre_pdf);
      
      $matricula_pago_update = MatriculaPago::find($matricula_pago->matricula_pago_id);
      $matricula_pago_update->ficha_matricula = $path_pdf;
      $matricula_pago_update->save();

      $this->dispatchBrowserEvent('modalGrupo');
  }

  public function render()
  {
    $detalle_grupos = MatriculaPago::join('admitidos', 'matricula_pago.admitidos_id', '=', 'admitidos.admitidos_id')
                                ->join('persona', 'admitidos.persona_id', '=', 'persona.idpersona')
                                ->join('grupo_programa', 'matricula_pago.id_grupo_programa', '=', 'grupo_programa.id_grupo_programa')
                                ->where('matricula_pago.id_grupo_programa', $this->id_grupo_programa)
                                ->get();

    $grupos = GrupoPrograma::where('grupo_programa_estado', '1')
                            ->where('id_mencion', $this->id_mencion)
                            ->get();

    return view('livewire.modulo-administrador.gestion-curricular.programa.detalle-grupo', [
      'detalle_grupos' => $detalle_grupos,
      'grupos' => $grupos
    ]);
  }
}