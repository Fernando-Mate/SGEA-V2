<?php

namespace App\Http\Controllers;

use App\Models\Alocar;
use App\Models\Escala;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class RelatorioController extends Controller
{
    public function gerarRelatorio(){
        $escala = DB::table('escala_user')
        ->join('escala', 'escala.id', '=', 'escala_user.escala_id')
        ->join('users', 'users.id', '=', 'escala.chefe_grupo')
        ->select('escala.*', 'escala_user.*', 'users.name')
        ->get();

        $escalas = Escala::all();
        $escala_user = [];
        foreach ($escala as $key => $value) {
            $escala_user[$key] = DB::table('escala_user')
                ->join('users', 'escala_user.user_id', '=', 'users.id')
                ->join('escala','escala.id','=','escala_user.escala_id')
                ->where('escala_user.escala_id', $value->id)
                ->select(DB::raw("GROUP_CONCAT(users.name SEPARATOR ', ') as users"))
                ->first();
        }

        //return dump($escala_user, $escala);
        //return dump($escala_user->length);
        $pdf = pdf::loadView('Relatorio', compact('escala', 'escala_user'));
        return $pdf->download('relatorio.pdf');
    }
}
