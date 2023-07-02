@extends('home')

@section('conteudo')
    <div>
        <!-- Botão Adicionar Agente -->
        <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#addAgenteModal">
            <i class="bi bi-plus"></i> Adicionar Agente
        </button>

        {{ csrf_field() }}
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Nome</th>
                    <th>Categoria</th>
                    <th>Ano de Ingresso</th>
                    <th>Idade</th>
                    <th>Sexo</th>
                    <th>Nível de Acesso</th>
                    <th>Função</th>
                    <th>Telefone</th>
                    <th>Email</th>
                    <th>Estado</th>
                    @if (Gate::allows('admin'))
                        <th>Ações</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($utilizadores as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->categoria}}</td>
                        <td>{{$user->ano_ingresso}}</td>
                        <td>{{$user->dataNascimento}}</td>
                        <td>{{$user->sexo}}</td>
                        <td>{{$user->nivelAcesso}}</td>
                        <td>{{$user->funcao}}</td>
                        <td>{{$user->telefone}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->estado}}</td>
                        @if(Gate::allows('admin'))
                        <td>
                            <button class="btn btn-primary btnEditar" data-bs-toggle="modal" data-bs-target="#addAgenteModal{{$user->id}}"><i class="bi bi-pencil-square"></i></button>
                            <a href="{{route('deleteAgente', ['id' => $user->id])}}" class="btn btn-danger btnEliminar"><i class="bi bi-trash"></i></a>
                        </td>
                        @endif
                    </tr>

                    <div class="modal fade" id="addAgenteModal{{$user->id}}" tabindex="-1" aria-labelledby="addAgenteModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="POST" action="{{ route('updateUser') }}">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addAgenteModalLabel">Actualizar Agente</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                    </div>
                                    <div class="modal-body">

                                        @csrf
                                        <div class="mb-3">
                                            <label for="nome" class="form-label">Nome</label>
                                            <input name="nome" value="{{$user->name}}" type="text" class="form-control" id="nome">
                                        </div>
                                        <div class="mb-3">
                                            <label for="categoria" class="form-label">Categoria</label>
                                            <input name="categoria" value="{{$user->categoria}}" type="text" class="form-control" id="categoria">
                                        </div>
                                        <div class="mb-3">
                                            <label for="anoIngresso" class="form-label">Ano de Ingresso</label>
                                            <input name="ano_ingresso" value="{{$user->ano_ingresso}}" type="number" min="1000" max="{{ date('Y') }}" class="form-control"
                                                id="anoIngresso">
                                        </div>
                                        <div class="mb-3">
                                            <label for="dataNascimento" class="form-label">Data de nascimento</label>
                                            <input name="dataNascimento" value="{{$user->dataNascimento}}" type="date" class="form-control" id="dataNascimento">
                                        </div>
                                        <div class="mb-3">
                                            <label for="sexo" class="form-label">Sexo</label>
                                            <select value="{{$user->sexo}}" name="sexo" class="form-select" id="sexo">
                                                <option value="M">Masculino</option>
                                                <option value="F">Feminino</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="funcao" class="form-label">Função</label>
                                            <input value="{{$user->funcao}}" name="funcao" type="text" class="form-control" id="funcao">
                                        </div>
                                        <div class="mb-3">
                                            <label for="telefone" class="form-label">Telefone</label>
                                            <input value="{{$user->telefone}}" name="telefone" type="text" class="form-control" id="telefone">
                                        </div>

                                        <input value="{{$user->email}}" name="email" type="hidden" id="email">
                                        <input type="hidden" name="id" value="{{$user->id}}">

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                        <button type="submit" class="btn btn-primary">Actualizar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Adicionar Agente -->
    <div class="modal fade" id="addAgenteModal" tabindex="-1" aria-labelledby="addAgenteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('addFuncionario') }}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addAgenteModalLabel">Adicionar Agente</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>
                    <div class="modal-body">

                        @csrf
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome</label>
                            <input name="nome" type="text" class="form-control" id="nome">
                        </div>
                        <div class="mb-3">
                            <label for="categoria" class="form-label">Categoria</label>
                            <input name="categoria" type="text" class="form-control" id="categoria">
                        </div>
                        <div class="mb-3">
                            <label for="anoIngresso" class="form-label">Ano de Ingresso</label>
                            <input name="ano_ingresso" type="number" min="1000" max="{{ date('Y') }}" class="form-control"
                                id="anoIngresso">
                        </div>
                        <div class="mb-3">
                            <label for="dataNascimento" class="form-label">Data de nascimento</label>
                            <input name="dataNascimento" type="date" class="form-control" id="dataNascimento">
                        </div>
                        <div class="mb-3">
                            <label for="sexo" class="form-label">Sexo</label>
                            <select name="sexo" class="form-select" id="sexo">
                                <option value="M">Masculino</option>
                                <option value="F">Feminino</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="funcao" class="form-label">Função</label>
                            <input name="funcao" type="text" class="form-control" id="funcao">
                        </div>
                        <div class="mb-3">
                            <label for="telefone" class="form-label">Telefone</label>
                            <input name="telefone" type="text" class="form-control" id="telefone">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input name="email" type="email" class="form-control" id="email">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Fim do Modal Adicionar Agente -->
@endsection
