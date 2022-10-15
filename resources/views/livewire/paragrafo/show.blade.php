<div>
<div class="card m-5 bg-base-100 shadow-xl">
        <div class="card-body">
            <div>
                <a href="/{{ \App\Enums\RotinasAplicacaoEnum::Paragrafo->value }}/incluir">
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
                            <th>Número</th>
                            <th>Artigo</th>
                            <th>Capitulo</th>
                            <th>Base Jurídica / Ano</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($paragrafos as $paragrafo)
                        <tr>
                            <td> 
                                @if($paragrafo->status==0)
                                <div class="badge badge-error">Inativo</div>
                                @else
                                <div class="badge badge-success">Ativo</div>
                                @endif
                            </td>
                            <td> {{ $paragrafo->numero }}° </td>
                            <td> {{ $paragrafo->artigo->numero }}° </td>
                            <td> {{ $paragrafo->capitulo->numeroRomano }} </td>
                            <td> {{ $paragrafo->capitulo->getBaseJuridicaAndAno() }} </td> 
                            <td>
                                <div>
                                    @if ($paragrafo->status==1)
                                        @livewire('buttons-crud', [ $paragrafo->id, '/' . \App\Enums\RotinasAplicacaoEnum::Paragrafo->value, ['visualizar', 'inativar']])
                                    @else    
                                        @livewire('buttons-crud', [ $paragrafo->id, '/' . \App\Enums\RotinasAplicacaoEnum::Paragrafo->value, ['visualizar']])
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
