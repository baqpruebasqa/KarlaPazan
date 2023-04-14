<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class UserReporteController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();

        $pdf = Pdf::loadView('reportes.reporte-user-pdf', [
            'users' => $users,
        ]);

        return $pdf->stream('usuarios');

    }
}
