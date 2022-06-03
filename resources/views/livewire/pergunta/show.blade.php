<div>
    <div class="card m-5 bg-base-100 shadow-xl">
        <div class="card-body">
            <div>
                <a href="/pergunta/incluir">
                    <button class="btn btn-success">
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
                            <td> {{ $pergunta->codigo }} </td>
                            <td> {{ $pergunta->descricao }} </td>
                            <td> {{ $pergunta->mensagem_tooltip }} </td>
                            <td>
                                <a href="/pergunta/alterar/{{ $pergunta->id }}">
                                    <button class="btn btn-warning">Alterar</button>
                                </a>
                                <a href="/pergunta/excluir/{{ $pergunta->id }}">
                                    <button class="btn btn-error">Excluir</button>
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