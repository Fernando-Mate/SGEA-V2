@extends('home')

@section('conteudo')





    @if (Gate::allows('agente'))

        <div class="card mt-2">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title">Alocacao</h5>
            </div>
            <div class="card-body">
                <p class="card-text"></p>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>Chefe do Grupo:</span>
                        <span>{{$escala->name}}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>Colegas de posto:</span>
                        <span>{{ $usersList }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>Local:</span>
                        <span>{{$escala->local}}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>Data:</span>
                        <span>{{$escala->data}}</span>
                    </li>
                </ul>
            </div>
        </div>
    @endif


    @if (Gate::allows('admin'))
        <div>
            <!-- Botão Adicionar Escala -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addEscalaModal">
                <i class="bi bi-plus"></i> Alocar
            </button>
            <a href="{{ route('pdf')}}" class="btn btn-primary"><i class="bi bi-printer"></i></a>
            {{ csrf_field() }}
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Código da Alocacao</th>
                        <th>Escala</th>
                        <th>Agente</th>
                        <th>Data</th>
                        <th>Chefe do grupo</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($escala_agente as $alocacao)
                        <tr>
                            <td scope="row">1</td>
                            <td>{{ $alocacao->local }}</td>
                            <td>{{ $alocacao->name }}</td>
                            <td>{{ $alocacao->data }}</td>
                            <td>{{ $alocacao->chefe_grupo }}</td>
                            <td>
                                <button data-bs-toggle="modal" data-bs-target="#addEscalaModal"
                                    class="btn btn-primary btnEditar"><i class="bi bi-pencil-square"></i></button>
                                <a href="{{route('deleteAlocacao', ['escala_id' => $alocacao->escala_id, 'user_id' => $alocacao->user_id])}}" class="btn btn-danger btnEliminar"><i class="bi bi-trash"></i></a>

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif


    <!-- Modal Adicionar Escala -->
    <div class="modal fade" id="addEscalaModal" tabindex="-1" aria-labelledby="addEscalaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('alocar') }}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addEscalaModalLabel">Alocar</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="mb-3">
                            <label for="escala" class="form-label">Escala</label>
                            <select name="escala" class="form-select" id="escala">
                                @foreach ($escalas as $escala)
                                    <option value="{{ $escala->id }}">{{ $escala->local }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="agente" class="form-label">Agente</label>
                            <select name="agente" class="form-select" id="agente">
                                @foreach ($utilizadores as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Alocar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Fim do Modal Adicionar Escala -->
@endsection
