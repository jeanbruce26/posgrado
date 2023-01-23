<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ficha de Matricula</title>
    <style>
        * {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 0;
            border: 0;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
</head>

<body>
    <table class="table"
        style="width:100%; padding-right: 3.5rem; padding-left: 3.5rem; padding-bottom: 1rem; padding-top: 2.5rem;">
        <thead>
            <tr>
                <th>
                    <div style="display: flex; align-items: center; margin-left: 35px;">
                        <img src="{{ storage_path('app/public/asset-pdf/unu.png') }}" width="80px" height="90px"
                            alt="logo unu">
                    </div>
                </th>
                <th>
                    <div style="text-align: center">
                        <div class="" style="font-weight: 700; font-size: 1.3rem;">
                            UNIVERSIDAD NACIONAL DE UCAYALI
                        </div>
                        <div style="margin: 0.2rem"></div>
                        <div class="" style="font-weight: 700; font-size: 1.3rem;">
                            ESCUELA DE POSGRADO
                        </div>
                    </div>
                </th>
                <th>
                    <div style="display: flex; align-items: center; margin-right: 35px;">
                        <img src="{{ storage_path('app/public/asset-pdf/posgrado.png') }}" width="80px" height="90px"
                            alt="logo posgrado">
                    </div>
                </th>
            </tr>
        </thead>
    </table>

    <div style="padding-left: 1rem; padding-right: 1rem; text-align: center; font-size: 1.4rem; font-weight: bold;">
        FICHA DE MATRICULA
    </div>

    <table style="padding-right: 6rem; padding-left: 6rem; padding-top: 2rem; font-weight: bold; font-size: 0.9rem;">
        <tbody>
            <tr>
                <td align="left">
                    MAESTRIA*: <span style="font-weight: regular;">INGENIERIA DE SISTEMAS* - 2021*</span>
                </td>
            </tr>
        </tbody>
    </table>

    <table style="padding-right: 6rem; padding-left: 6rem; padding-top: 1rem; font-weight: bold; font-size: 0.9rem;">
        <tbody>
            <tr>
                <td align="left">
                    MENCION*: <span style="font-weight: regular;">TEGNOLOGIAS DE LA INFORMACION*</span>
                </td>
            </tr>
        </tbody>
    </table>

    <table
        style="padding-right: 6rem; padding-left: 6rem; padding-top: 1rem; font-weight: bold; font-size: 0.9rem; width: 100%">
        <tbody>
            <tr>
                <td align="left">
                    ALUMNO: <span style="font-weight: regular;">JAMT AMERICO MENDOZA FLORES*</span>
                </td>
                <td align="right">
                    CODIGO: <span style="font-weight: regular;">0M02023999*</span>
                </td>
            </tr>
        </tbody>
    </table>

    <table
        style="padding-right: 6rem; padding-left: 6rem; padding-top: 1rem; font-weight: bold; font-size: 0.9rem; width: 100%">
        <tbody>
            <tr>
                <td align="left">
                    PLAN DE ESTUDIOS: <span style="font-weight: regular;">2021*</span>
                </td>
                <td align="center">
                    FECHA: <span style="font-weight: regular;">24/10/2000*</span>
                </td>
                <td align="right">
                    RECIBO: <span style="font-weight: regular;">00001244*</span>
                </td>
            </tr>
        </tbody>
    </table>

    <table style="padding-right: 6rem; padding-left: 6rem; padding-top: 1rem; font-weight: bold; font-size: 0.9rem;">
        <tbody>
            <tr>
                <td align="left">
                    DOMICILIO: <span style="font-weight: regular;">JR LOS CEDROS 240*</span>
                </td>
            </tr>
        </tbody>
    </table>

    <table
        style="padding-right: 6rem; padding-left: 6rem; padding-top: 1rem; font-weight: bold; font-size: 0.9rem; width: 100%">
        <tbody>
            <tr>
                <td align="left">
                    FECHA DE NACIMIENTO: <span style="font-weight: regular;">24/10/2000*</span>
                </td>
                <td align="center">
                    DNI: <span style="font-weight: regular;">72155069*</span>
                </td>
                <td align="center">
                    EDAD: <span style="font-weight: regular;">22*</span>
                </td>
                <td align="right">
                    SEXO: <span style="font-weight: regular;">MASCULINO*</span>
                </td>
            </tr>
        </tbody>
    </table>

    <table
        style="padding-right: 6rem; padding-left: 6rem; padding-top: 1rem; font-weight: bold; font-size: 0.9rem; width: 100%">
        <tbody>
            <tr>
                <td align="left">
                    CORREO ELECTRONICO: <span style="font-weight: regular;">jamt.mendozaf@gmail.com*</span>
                </td>
                <td align="right">
                    TELF: <span style="font-weight: regular;">+51 955270500*</span>
                </td>
            </tr>
        </tbody>
    </table>

    <table
        style="padding-right: 6rem; padding-left: 6rem; padding-top: 2rem; font-size: 0.9rem; width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="font-weight: bold;">
                <th style="border: 1px solid; padding: 0.3rem; width: 10%"><em>Ciclo</em></th>
                <th style="border: 1px solid; padding: 0.3rem; width: 15%"><em>Código</em></th>
                <th style="border: 1px solid; padding: 0.3rem; width: 60%"><em>Curso</em></th>
                <th style="border: 1px solid; padding: 0.3rem; width: 15%"><em>Créditos</em></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="border: 1px solid; padding: 0.3rem; font-size: 0.8rem;" align="center">III</td>
                <td style="border: 1px solid; padding: 0.3rem; font-size: 0.8rem;" align="center">JAMT001</td>
                <td style="border: 1px solid; padding: 0.3rem; font-size: 0.8rem;">Curso 1</td>
                <td style="border: 1px solid; padding: 0.3rem; font-size: 0.8rem;" align="center">4</td>
            </tr>
            <tr>
                <td style="border: 1px solid; padding: 0.3rem; font-size: 0.8rem;" align="center">III</td>
                <td style="border: 1px solid; padding: 0.3rem; font-size: 0.8rem;" align="center">JAMT001</td>
                <td style="border: 1px solid; padding: 0.3rem; font-size: 0.8rem;">Curso 2</td>
                <td style="border: 1px solid; padding: 0.3rem; font-size: 0.8rem;" align="center">4</td>
            </tr>
            <tr>
                <td style="border: 1px solid; padding: 0.3rem; font-size: 0.8rem;" align="center">III</td>
                <td style="border: 1px solid; padding: 0.3rem; font-size: 0.8rem;" align="center">JAMT001</td>
                <td style="border: 1px solid; padding: 0.3rem; font-size: 0.8rem;">Curso 3</td>
                <td style="border: 1px solid; padding: 0.3rem; font-size: 0.8rem;" align="center">4</td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" align="right" style="border: 1px solid; padding: 0.3rem; font-weight: bold"><em>TOTAL</em></td>
                <td style="border: 1px solid; padding: 0.3rem; font-size: 0.8rem;" align="center">12</td>
            </tr>
        </tfoot>
    </table>

    <table
        style="padding-right: 6rem; padding-left: 6rem; padding-top: 7rem; font-weight: bold; font-size: 0.9rem; width: 100%">
        <tbody>
            <tr>
                <td align="left">
                    ..............................................
                </td>
                <td align="center"></td>
                <td align="right">
                    ..............................................
                </td>
            </tr>
            <tr>
                <td align="left" style="padding-left: 0.9rem">
                    Firma del Coordinador
                </td>
                <td align="center"></td>
                <td align="right" style="padding-right: 1.95rem">
                    Firma del Alumno
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>
