<?php

namespace App\Http\Controllers;

use App\Models\Alocar;
use App\Models\Escala;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class AlocarController extends Controller
{

    private $objUtilizador;
    private $objEscala;
    private $objEscalaAgente;
    public function __construct()
    {
        $this->objUtilizador = new User();
        $this->objEscala = new Escala();
        $this->objEscalaAgente = new Alocar();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $utilizadores = $this->objUtilizador->all()->where('nivelAcesso', 'agente')->where('estado', 0);
        $escalas = $this->objEscala->all();
        //$escala_agente = $this->objEscalaAgente->all();
        $escala_agente = DB::table('escala_user')
            ->join('users', 'users.id', '=', 'escala_user.user_id')
            ->join('escala', 'escala.id', '=', 'escala_user.escala_id')
            ->select('escala.*', 'users.name', 'escala_user.*')
            ->get();

        if(Gate::allows('agente')){
            $userId = Auth::id();

        $query = DB::table('escala_user')
            ->select('escala_id')
            ->where('user_id', $userId)
            ->first();


        if ($query) {
            $users = DB::table('escala_user')
                ->join('users', 'escala_user.user_id', '=', 'users.id')
                ->select(DB::raw("GROUP_CONCAT(users.name SEPARATOR ', ') as users"))
                ->where('escala_id', $query->escala_id)
                ->where('user_id', '!=', $userId)
                ->first();

            $escala = DB::table('escala')
                    ->join('users', 'users.id', '=', 'escala.chefe_grupo')
                    ->select('escala.local', 'escala.data', 'users.name')
                    ->where('escala.id', $query->escala_id)->first();


            if ($users && is_object($users) && property_exists($users, 'users')) {
                $usersList = $users->users;
            } else {
                $usersList = 'Nenhum usuário encontrado';
            }
        } else {
            $usersList = 'Nenhum usuário encontrado';
        }



        //return dump($users, $escala);
        return view('Alocacao', compact('utilizadores', 'escalas', 'usersList', 'escala', 'escala_agente'));

        }
        return view('Alocacao', compact('utilizadores', 'escalas','escala_agente'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id, $escala_id)
    {
        DB::delete('Delete from escala_user where (user_id = ?) && (escala_id = ?)', [$user_id, $escala_id]);
        DB::table('users')
            ->where('id', $user_id)
            ->update(['estado' => 0]);
        return redirect()->route('alocacao')->with('mensagem', 'Alocacao eliminada com sucesso!');
    }
}
