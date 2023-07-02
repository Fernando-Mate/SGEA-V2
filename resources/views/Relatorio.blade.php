<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Alocacao</title>

    <style>
        .d-none{
            display: none;
        }
    </style>
</head>

<body>
    <div class="d-none">{{ $id = 0 }}</div>
    @foreach ($escala as $key => $dados)
        @if ($dados->id != $id)
            <div class="card mt-2">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title">{{$dados->local}}</h5>
                </div>
                <div class="card-body">
                    <p class="card-text"></p>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Chefe do Grupo:</span>
                            <span>{{ $dados->name }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Membros:</span>
                            <span>{{ $escala_user[$key]->users }}</span>
                        </li>
                        {{-- <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Local:</span>
                            <span>{{ $dados->local }}</span>
                        </li> --}}
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Data:</span>
                            <span>{{ $dados->data }}</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="d-none">{{ $id = $dados->id }}</div>
        @endif
    @endforeach
</body>

</html>
