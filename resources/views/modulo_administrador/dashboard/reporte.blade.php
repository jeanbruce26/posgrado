<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Reporte</title>
  <style>
    body {
      font-family: 'Nunito', sans-serif;
    }
  </style>
</head>
<body>
  <div style="margin-bottom: 1.5rem">
    <span style="font-size: 2rem; font-weight: 700;">
      Reporte
    </span>
  </div>
  <table width="100%" style="border-collapse: collapse; margin-bottom: 1.5rem">
    <tbody>
      <tr>
        <td>
          <div style="border: 1px solid #cecece; padding: 1rem; border-radius: 0.5rem;">
            <span style="font-size: 1rem; font-weight: 700;">
              Ingreso Total
            </span>
            <br>
            <span style="font-size: 1.5rem; font-weight: 700; margin-top: 1rem">
              S/. {{ number_format($ingreso_total, 2, ',', ' ') }}
            </span>
          </div>
        </td>
        <td>
          <div style="border: 1px solid #cecece; padding: 1rem; border-radius: 0.5rem;">
            <span style="font-size: 1rem; font-weight: 700;">
              Ingreso por Inscripción
            </span>
            <br>
            <span style="font-size: 1.5rem; font-weight: 700; margin-top: 1rem">
              S/. {{ number_format($ingreso_inscripcion, 2, ',', ' ') }}
            </span>
          </div>
        </td>
        <td>
          <div style="border: 1px solid #cecece; padding: 1rem; border-radius: 0.5rem;">
            <span style="font-size: 1rem; font-weight: 700;">
              Pagos Registrados
            </span>
            <br>
            <span style="font-size: 1.5rem; font-weight: 700; margin-top: 1rem">
              {{ $pagos->count() }}
            </span>
          </div>
        </td>
      </tr>
    </tbody>
  </table>
  <div style="margin-bottom: 0.5rem">
    <span style="font-size: 1rem; font-weight: 700;">
      REPORTE DE INSCRITOS POR PROGRAMA EN MASTRÍA
    </span>
  </div>
  <table width="100%" style="border-collapse: collapse; border: 1px solid #cecece;">
    <thead style="border: 1px solid #cecece;">
      <tr>
        <th style="background-color: #d9ffe3; padding: 0.2rem; text-align: center; font-size: 0.9rem; font-weight: 700;">
          NRO
        </th>
        <th style="background-color: #d9ffe3; padding: 0.2rem; text-align: center; font-size: 0.9rem; font-weight: 700;" width="70%">
          PROGRAMA
        </th>
        <th style="background-color: #d9ffe3; padding: 0.2rem; text-align: center; font-size: 0.9rem; font-weight: 700;">
          CANTIDAD
        </th>
      </tr>
    </thead>
    <tbody style="border: 1px solid #cecece;">
      @foreach ($programas_maestria as $item)
      <tr style="border: 1px solid #cecece;">
        <td style="padding: 0.2rem; text-align: center; font-size: 0.8rem; font-weight: 700;">
          {{ $loop->iteration }}
        </td>
        <td style="padding: 0.2rem; font-size: 0.8rem; font-weight: 400;">
          @if ($item->mencion === null)
            {{ ucwords(strtolower($item->descripcion_programa))  }} en {{ ucwords(strtolower($item->subprograma)) }}
          @else
            Mención en {{ ucwords(strtolower($item->mencion)) }}
          @endif
        </td>
        <td style="padding: 0.2rem; text-align: center; font-size: 0.8rem; font-weight: 400;">
          {{ $item->cantidad_mencion }}
        </td>
      </tr>
      @endforeach
      @if ($programas_maestria->count() === 0)
      <tr style="border: 1px solid #cecece;">
        <td colspan="3" style="padding: 0.2rem; text-align: center; font-size: 0.8rem; font-weight: 400;">
          No hay inscritos en los programas de maestría
        </td>
      </tr>
      @endif
    </tbody>
    @if ($programas_maestria->count() > 0)
    <tfoot style="border: 1px solid #cecece;">
      <tr>
        <td colspan="2" style="padding: 0.2rem; text-align: right; font-size: 0.8rem; font-weight: 700;">
          Total
        </td>
        <td style="padding: 0.2rem; text-align: center; font-size: 0.8rem; font-weight: 700;">
          {{ $programas_maestria->sum('cantidad_mencion') }}
        </td>
      </tr>
    </tfoot>
    @endif
  </table>
  <div style="margin-bottom: 0.5rem; margin-top: 1.5rem;">
    <span style="font-size: 1rem; font-weight: 700;">
      REPORTE DE INSCRITOS POR PROGRAMA EN DOCTORADOS
    </span>
  </div>
  <table width="100%" style="border-collapse: collapse; border: 1px solid #cecece;">
    <thead style="border: 1px solid #cecece;">
      <tr>
        <th style="background-color: #d9eeff; padding: 0.2rem; text-align: center; font-size: 0.9rem; font-weight: 700;">
          NRO
        </th>
        <th style="background-color: #d9eeff; padding: 0.2rem; text-align: center; font-size: 0.9rem; font-weight: 700;" width="70%">
          PROGRAMA
        </th>
        <th style="background-color: #d9eeff; padding: 0.2rem; text-align: center; font-size: 0.9rem; font-weight: 700;">
          CANTIDAD
        </th>
      </tr>
    </thead>
    <tbody style="border: 1px solid #cecece;">
      @foreach ($programas_doctorado as $item)
      <tr style="border: 1px solid #cecece;">
        <td style="padding: 0.2rem; text-align: center; font-size: 0.8rem; font-weight: 700;">
          {{ $loop->iteration }}
        </td>
        <td style="padding: 0.2rem; font-size: 0.8rem; font-weight: 400;">
          @if ($item->mencion === null)
            {{ ucwords(strtolower($item->descripcion_programa))  }} en {{ ucwords(strtolower($item->subprograma)) }}
          @else
            Mención en {{ ucwords(strtolower($item->mencion)) }}
          @endif
        </td>
        <td style="padding: 0.2rem; text-align: center; font-size: 0.8rem; font-weight: 400;">
          {{ $item->cantidad_mencion }}
        </td>
      </tr>
      @endforeach
      @if ($programas_doctorado->count() === 0)
      <tr>
        <td colspan="3" style="padding: 0.2rem; text-align: center; font-size: 0.8rem; font-weight: 400;">
          No hay inscritos en los programas de doctorados
        </td>
      </tr>
      @endif
    </tbody>
    @if ($programas_doctorado->count() > 0)
    <tfoot style="border: 1px solid #cecece;">
      <tr>
        <td colspan="2" style="padding: 0.2rem; text-align: right; font-size: 0.8rem; font-weight: 700;">
          Total
        </td>
        <td style="padding: 0.2rem; text-align: center; font-size: 0.8rem; font-weight: 700;">
          {{ $programas_doctorado->sum('cantidad_mencion') }}
        </td>
      </tr>
    </tfoot>
    @endif
  </table>
</body>
</html>