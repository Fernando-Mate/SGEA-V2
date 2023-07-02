<?php

namespace App\Http\Controllers;

use App\Models\Escala;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EscalaController extends Controller
{

    private $objUtilizador;
    private $objEscala;
    public function __construct()
    {
        $this->objUtilizador = new User();
        $this->objEscala = new Escala();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$utilizadores = $this->objUtilizador->all()->where('nivelAcesso', '=', 'agente');
        $utilizadores = DB::select("select * from users where (nivelAcesso = 'agente') && (? - ano_ingresso  > 3) && (estado = 0)", [date('Y')]);

        $escalas = DB::table('escala')
            ->join('users', 'users.id', '=', 'escala.chefe_grupo')
            ->select('escala.*', 'users.name')
            ->get();

            // return dump($escalas);
        return view('Escalas', compact('utilizadores', 'escalas'));
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
    public function storeEscala(Request $request)
    {
        $escala = new Escala();
        $escala->data = $request->input('data');
        $escala->nr_agentes = $request->input('nr_agentes');
        $escala->local = $request->input('local');
        $escala->chefe_grupo = $request->input('chefe_grupo');
        if($escala->save()){
            DB::table('users')
                ->where('id', $request->input('chefe_grupo'))
                ->update(['estado' => 1]);
        }
        return redirect()->route('escala')->with('mensagem', 'Escala cadastrada com sucesso');
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
    public function update(Request $request)
    {
        $escala = Escala::find($request->input('id'));
        $escala->data = $request->input('data');
        $escala->nr_agentes = $request->input('nr_agentes');
        $escala->local = $request->input('local');
        $escala->chefe_grupo = $request->input('chefe_grupo');
        $escala->save();
        return redirect()->route('escala')->with('mensagem', 'Escala atuzlizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::delete('Delete from escala where id = ?', [$id]);
        return redirect()->route('escala')->with('mensagem', 'Escala eliminada com sucesso!');
    }
}
