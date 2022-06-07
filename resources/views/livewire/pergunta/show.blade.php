<div>
    <!-- Flash Data -->
    @if(Session::has('redirect-pergunta'))
    <div class="flash-data">
        <div class="alert alert-success shadow-lg">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('redirect-pergunta') }}</span>
            </div>
        </div>
    </div>
    @endif

    <div class="card m-5 bg-base-100 shadow-xl">
        <div class="card-body">
            <div>
                <a href="/pergunta/incluir">
                    <button class="btn btn-outline btn-success">
                        <ion-icon name="add-outline"></ion-icon>
                        Incluir
                    </button>
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="table w-full">
                    <!-- head -->
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Descrição</th>
                            <th>Mensagem Referencial</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($perguntas as $pergunta)
                        <tr>
                            <td> 
                                <a class="link" href="/pergunta/visualizar/{{ $pergunta->id }}">
                                    {{ $pergunta->codigo }} 
                                </a>
                            </td>
                            <td> {{ $pergunta->descricao }} </td>
                            <td> {{ $pergunta->mensagem_tooltip }} </td>
                            <td>
                                <a href="/pergunta/alterar/{{ $pergunta->id }}">
                                    <button class="btn btn-outline btn-warning">Alterar</button>
                                </a>
                                <a href="/pergunta/excluir/{{ $pergunta->id }}">
                                    <button class="btn btn-outline btn-error">Excluir</button>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>