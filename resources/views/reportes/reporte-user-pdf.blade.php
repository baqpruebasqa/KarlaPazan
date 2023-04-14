<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USUARIOS_REPORTE</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        h1 {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        td {
            padding: 8px;
        }

        tr:not(:last-child) {
            margin-bottom: 20px;
        }

        td.title {
            font-weight: bold;
            width: 50px;

        }

        td.border {
            border: 1px solid black;
        }

        th {
            border: 1px solid black;
            font-size: 10px;
        }

        tr.border {
            border: 1px solid black;
        }

        .space-vertical {
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .linea-horizontal {
            border-bottom: 1px solid black;
            margin-bottom: 10px;
        }

        .opcion-celda {
            padding: 2px 5px;
            margin: 0;
        }
    </style>
</head>

<body>
    <h1>FORMULARIO REPORTE USUARIOS</h1>

    <div>
        <h3>USUARIOS</h3>
        <table>
            <tr class="border">
                <th>NOMBRE</th>
                <th>EMAIL</th>
                <th>ROL</th>
            </tr>
            @foreach($users as $user)
            <tr>
                <td class="border">{{ $user->name }}</td>
                <td class="border">{{ $user->email }}</td>
                @foreach($user->roles as $rol)
                <td class="border">{{ $rol->name }}</td>
                @endforeach
            </tr>
            @endforeach
        </table>

    </div>
</body>

</html>
