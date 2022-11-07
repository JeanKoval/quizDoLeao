<div>
    <!-- Flash Data -->
    @if(Session::has('redirect-pergunta'))
    <div class="flash-data px-5 pt-3">
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
            <div class="flex">
                <a href="{{ route('perguntaForm', \App\Enums\OptionCrudEnum::Incluir->value) }}">
                    <button class="btn btn-outline btn-success">
                        <ion-icon name="add-outline"></ion-icon>
                        Incluir
                    </button>
                </a>

                <div class="form-control">
                    <label class="cursor-pointer label">
                        <span class="label-text pr-2">Mostrar inativos? </span>
                        <input type="checkbox" checked="checked" class="checkbox checkbox-accent" wire:click="$emitSelf('render')" wire:model="mostraInativos"/>
                  </label>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="table w-full">
                    <!-- head -->
                    <thead>
                        <tr>
                            <th>Status</th>
                            <th>Revisão</th>
                            <th>Ordem</th>
                            <th>Descrição</th>
                            <th>Tipo Relação</th>
                            <th>Base Juridica / Ano</th>
                            <th>Capitulo</th>
                            <th>Artigo</th>
                            <th>Paragrafo</th>
                            <th>Inciso</th>
                            <th>Alinea</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($perguntas as $pergunta)
                        <tr>
                            <td>
                                @if($pergunta->status==0)
                                <div class="badge badge-error">Inativo</div>
                                @else
                                <div class="badge badge-success">Ativo</div>
                                @endif
                            </td>
                            <td> {{ $pergunta->revisao }} </td>
                            <td> {{ $pergunta->ordem }} </td>
                            <td> {{ substr($pergunta->descricao, 0, 50) }}... </td>
                            <td> {{ $pergunta->tipoRelacao->name }} </td>
                            <td> {{ $pergunta->baseJuridica }} </td>
                            <td> {{ $pergunta->capitulo }} </td>
                            <td> {{ $pergunta->artigo }} </td>
                            <td> {{ $pergunta->paragrafo ?? ''}} </td>
                            <td> {{ $pergunta->inciso ?? ''}} </td>
                            <td> {{ $pergunta->alinea ?? ''}} </td>
                            <td>
                                @if ($pergunta->status==1)
                                @livewire('admin.buttons-crud', [ $pergunta->id, '/' . \App\Enums\RotinasAplicacaoEnum::Pergunta->value ])
                                @else
                                @livewire('admin.buttons-crud', [ $pergunta->id, '/' . \App\Enums\RotinasAplicacaoEnum::Pergunta->value, ['visualizar']])
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <th colspan="12" class="text-center">Não encontrado Registros...</th>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>