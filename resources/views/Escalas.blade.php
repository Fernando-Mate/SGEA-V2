@extends('home')

@section('conteudo')
    <div>
        <!-- Botão Adicionar Escala -->
        @if (Gate::allows('agente'))
        <button type="button" hidden class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addEscalaModal">
            <i class="bi bi-plus"></i> Adicionar Escala
        </button>
        @elseif (Gate::allows('admin'))
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addEscalaModal">
            <i class="bi bi-plus"></i> Adicionar Escala
        </button>
        @endif
        {{ csrf_field() }}
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Código da Escala</th>
                    <th>Local de Patrulha</th>
                    <th>Data de Patrulha</th>
                    <th>Chefe do Grupo</th>
                    <th>Numero de agentes</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($escalas as $escala)
                    <tr>
                        <td scope="row">{{ $escala->id }}</td>
                        <td>{{ $escala->local }}</td>
                        <td>{{ $escala->data }}</td>
                        <td>{{ $escala->name }}</td>
                        <td>{{ $escala->nr_agentes }}</td>
                        <td>
                            <button data-bs-toggle="modal" data-bs-target="#addEscalaModal{{$escala->id}}" class="btn btn-primary btnEditar"><i class="bi bi-pencil-square"></i></button>
                            <a href="{{route('deleteEscala', ['id' => $escala->id])}}" class="btn btn-danger btnEliminar"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                    <div class="modal fade" id="addEscalaModal{{$escala->id}}" tabindex="-1" aria-labelledby="addEscalaModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="POST" action="{{route('updateEscala')}}">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addEscalaModalLabel">Adicionar Escala</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                    </div>
                                    <div class="modal-body">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="local" class="form-label">Local</label>
                                            <input value="{{$escala->local}}" type="text" class="form-control" id="local" name="local">
                                        </div>
                                        <div class="mb-3">
                                            <label for="data" class="form-label">Data</label>
                                            <input value="{{$escala->data}}" type="date" class="form-control" id="data" name="data">
                                        </div>
                                        <div class="mb-3">
                                            <label for="chefe_grupo" class="form-label">Chefe do Grupo</label>
                                            <select value="{{$escala->chefe_grupo}}" name="chefe_grupo" class="form-select" id="chefe_grupo">
                                                @foreach ($utilizadores as $user)
                                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="numAgentes" class="form-label">Numero de agentes</label>
                                            <input value="{{$escala->nr_agentes}}" type="number" class="form-control" id="numAgentes" name="nr_agentes">
                                        </div>

                                        <input type="hidden" name="id" value="{{$escala->id}}">

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Adicionar Escala -->
    <div class="modal fade" id="addEscalaModal" tabindex="-1" aria-labelledby="addEscalaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('addEscala') }}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addEscalaModalLabel">Adicionar Escala</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="mb-3">
                            <label for="local" class="form-label">Local</label>
                            <input type="text" class="form-control" id="local" name="local">
                        </div>
                        <div class="mb-3">
                            <label for="data" class="form-label">Data</label>
                            <input type="date" class="form-control" id="data" name="data">
                        </div>
                        <div class="mb-3">
                            <label for="chefe_grupo" class="form-label">Chefe do Grupo</label>
                            <select name="chefe_grupo" class="form-select" id="chefe_grupo">
                                @foreach ($utilizadores as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="numAgentes" class="form-label">Numero de agentes</label>
                            <input type="number" class="form-control" id="numAgentes" name="nr_agentes">
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
    <!-- Fim do Modal Adicionar Escala -->
@endsection
