<?php

namespace App\Http\Controllers;

use App\Models\Alocar;
use App\Models\Escala;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private $objUtilizador;
    public function __construct()
    {
        $this->objUtilizador = new User();

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $utilizadores = $this->objUtilizador->all()->where('nivelAcesso', '=', 'agente');
        //return dump($utilizadores);
        return view('Agentes', compact('utilizadores'));

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
    public function storeFuncionario(Request $request)
    {
        $utilizador = new User();
        $utilizador->name = $request->input('nome');
        $utilizador->categoria = $request->input('categoria');
        $utilizador->anos_xp = $request->input('anos_xp');
        $utilizador->ano_ingresso = $request->input('ano_ingresso');
        $utilizador->dataNascimento = $request->input('dataNascimento');
        $utilizador->telefone = $request->input('telefone');
        $utilizador->email = $request->input('email');
        $utilizador->funcao = $request->input('funcao');
        $utilizador->sexo = $request->input('sexo');
        $utilizador->password = Hash::make('1234'. $request->input('nome'));
        $utilizador->nivelAcesso = 'agente';
        $utilizador->save();
        return redirect()->route('funcionario')->with('mensagem', 'Agente cadastrado com sucesso');

    }
    public function storeAdmin(Request $request)
    {
        $utilizador = new User();
        $utilizador->name = $request->input('nome');
        $utilizador->funcao = $request->input('funcao');
        $utilizador->telefone = $request->input('telefone');
        $utilizador->inicio_funcoes = $request->input('inicio_funcoes');
        $utilizador->password = Hash::make();
        $utilizador->nivelAcesso = 'admin';
        $utilizador->save();
        return redirect()->route('home')->with('mensagem', 'Administrador cadastrado com sucesso');

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
        $utilizador = User::find($request->id);
        $utilizador->name = $request->input('nome');
        $utilizador->categoria = $request->input('categoria');
        $utilizador->anos_xp = $request->input('anos_xp');
        $utilizador->ano_ingresso = $request->input('ano_ingresso');
        $utilizador->dataNascimento = $request->input('dataNascimento');
        $utilizador->telefone = $request->input('telefone');
        $utilizador->funcao = $request->input('funcao');
        $utilizador->sexo = $request->input('sexo');
        $utilizador->nivelAcesso = 'agente';
        $utilizador->save();
        return redirect()->route('funcionario')->with('mensagem', 'Agente atuzlizado com sucesso!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::delete('Delete from users where id = ?', [$id]);
        return redirect()->route('funcionario')->with('mensagem', 'Agente eliminado com sucesso!');

    }


    public function addToEscala(Request $request)
    {
        $escalaId = $request->input('escala');
        $agenteId = $request->input('agente');

        $agente = User::all()->where('id', '=', $agenteId)->first();

        $agentesAssociados = DB::table('escala_user')
        ->where('escala_id', $escalaId)
        ->count();
        if ($agente->estado == 0) {

            $alocacao = new Alocar();
            $alocacao->escala_id = $escalaId;
            $alocacao->user_id = $agenteId;
            if($agentesAssociados >= 3){
                return redirect()->route('alocacao')->with('mensagem', 'ja tem 3 agentes nessa escala.');

            }else{
                if($alocacao->save()){
                    DB::table('users')
                    ->where('id', $agenteId)
                    ->update(['estado' => 1]);
                }

                return redirect()->route('alocacao')->with('mensagem', 'O agente alocado com sucesso.');

            }
             } else {
            return redirect()->route('alocacao')->with('mensagem', 'O agente encontra-se indisponivel.');
        }
    }

    public function removeFromEscala(Request $request, User $usuario)
    {
        $escalaId = $request->input('escala_id');

        $escala = Escala::find($escalaId);

        if ($escala) {
            $usuario->Escala()->detach($escala);
        }

        return redirect()->back();
    }

    public function show(User $usuario)
    {
        $escalasDisponiveis = Escala::whereNotIn('id', $usuario->Escala()->pluck('id'))->get();

        return view('usuario.show', compact('usuario', 'escalasDisponiveis'));
    }

    public function admin(){
        $utilizador = new User();
        $utilizador->name = 'administrador';
        $utilizador->email = 'admin@gmail.com';
        $utilizador->nivelAcesso = 'admin';
        $utilizador->password = Hash::make('1234');
        $utilizador->save();
        return redirect()->route('login');
    }


}
