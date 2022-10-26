<div>
<div class="card m-5 bg-base-100 shadow-xl">
        <div class="card-body">
            <div>
                <a href="/leads/export" target="_blank">
                    <button class="btn btn-outline btn-success">
                        <ion-icon name="download-outline"></ion-icon>
                        Exportar
                    </button>
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="table w-full">
                    <!-- head -->
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>Telefone</th>
                            <th>Renda Tributavel</th>
                            <th>Renda Não Tributavel</th>
                            <th>Ano Nascimento</th>
                            <th>Profissão</th>
                            <th>Cidade</th>
                            <th>Estado</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($leads as $lead)
                        <tr>
                            <td> {{ $lead->nome }}                     </td>
                            <td> {{ $lead->email }}                    </td>
                            <td> {{ $lead->telefone }}                 </td>
                            <td> R$ {{ $lead->renda_tributavel }}      </td>
                            <td> R$ {{ $lead->renda_nao_tributavel }}  </td>
                            <td> {{ $lead->ano_nascimento }}           </td>
                            <td> {{ $lead->profissao }}                </td>
                            <td> {{ $lead->cidade }}                   </td>
                            <td> {{ $lead->estado }}                   </td>
                            <td>
                                <div>
                                        @livewire('buttons-crud', [ $lead->id, '/' . \App\Enums\RotinasAplicacaoEnum::Lead->value, ['visualizar']])
                                </div>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <th colspan="11" class="text-center">Não encontrado Registros...</th>    
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
