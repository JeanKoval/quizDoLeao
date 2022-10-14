<div>
<div class="card m-5 bg-base-100 shadow-xl">
        <div class="card-body">
            <div>
                <a href="/capitulo/incluir">
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
                            <th>Base Jurídica / Ano</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($capitulos as $capitulo)
                        <tr>
                            <td> 
                                @if($capitulo->status==0)
                                <div class="badge badge-error">Inativo</div>
                                @else
                                <div class="badge badge-success">Ativo</div>
                                @endif
                            </td>
                            <td> {{ $capitulo->numeroRomano   }} </td>
                            <td> {{ $capitulo->baseJuridica->numero }} / {{ $capitulo->baseJuridica->ano }} </td>
                            <td>
                                <div>
                                    @if ($capitulo->status==1)
                                        @livewire('buttons-crud', [ $capitulo->id, '/' . \App\Enums\RotinasAplicacaoEnum::Capitulo->value, ['visualizar', 'inativar']])
                                    @else    
                                        @livewire('buttons-crud', [ $capitulo->id, '/' . \App\Enums\RotinasAplicacaoEnum::Capitulo->value, ['visualizar']])
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
