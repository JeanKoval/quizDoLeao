<div>
    <div class="card m-5 bg-base-100 shadow-xl">
        <div class="card-body">
            <div>
                <a href="/base-juridica/incluir">
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
                            <th>Status</th>
                            <th>Revisão</th>
                            <th>Número</th>
                            <th>Ano</th>
                            <th>Tipo</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($basesJuridicas as $baseJuridica)
                        <tr>
                            <td> 
                                @if($baseJuridica->status==0)
                                <div class="badge badge-error">Inativo</div>
                                @else
                                <div class="badge badge-success">Ativo</div>
                                @endif
                            </td>
                            <td> {{ $baseJuridica->revisao  }} </td>
                            <td> {{ $baseJuridica->numero   }} </td>
                            <td> {{ $baseJuridica->ano      }} </td>
                            <td>
                                @if($baseJuridica->tipo==1)
                                    Real
                                @else
                                    Alteração
                                @endif
                            </td>
                            <td>
                                <div>
                                    @if ($baseJuridica->status==1)
                                        @livewire('buttons-crud', [ $baseJuridica->id, '/' . \App\Enums\RotinasAplicacaoEnum::BaseJuridica->value, ['visualizar','revisao', 'inativar']])
                                    @else    
                                        @livewire('buttons-crud', [ $baseJuridica->id, '/' . \App\Enums\RotinasAplicacaoEnum::BaseJuridica->value, ['visualizar','revisao']])
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <th colspan="6" class="text-center">Não encontrado Registros...</th>    
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>