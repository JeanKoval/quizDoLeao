<div>
<div class="card m-5 bg-base-100 shadow-xl">
        <div class="card-body">
            <div class="flex">
                <a href="{{ route('alineaForm', \App\Enums\OptionCrudEnum::Incluir->value) }}">
                    <button class="btn btn-outline btn-success">
                        <ion-icon name="add-outline"></ion-icon>
                        Incluir
                    </button>
                </a>

                <div class="form-control">
                    <label class="cursor-pointer label">
                        <span class="label-text pr-2">Mostrar inativos? </span>
                        <input type="checkbox" checked="checked" class="checkbox checkbox-accent" wire:click="getAlineas" wire:model="mostraInativos"/>
                  </label>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="table w-full">
                    <!-- head -->
                    <thead>
                        <tr>
                            <th>Status</th>
                            <th>Letra</th>
                            <th>Tipo Relacao</th>
                            <th>Base Jurídica / Ano</th>
                            <th>Capitulo</th>
                            <th>Artigo</th>
                            <th>Paragrafo</th>
                            <th>Inciso</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($alineas as $alinea)
                        <tr>
                            <td> 
                                @if($alinea->status==0)
                                <div class="badge badge-error">Inativo</div>
                                @else
                                <div class="badge badge-success">Ativo</div>
                                @endif
                            </td>
                            <td> {{ $alinea->letra }}               </td>
                            <td> {{ $alinea->tipoRelacao->name }}   </td>
                            <td> {{ $alinea->baseJuridica ?? '' }}  </td>
                            <td> {{ $alinea->capitulo ?? '' }}      </td>
                            <td> {{ $alinea->artigo ?? '' }}        </td>
                            <td> {{ $alinea->paragrafo ?? '' }}     </td>
                            <td> {{ $alinea->inciso ?? '' }}        </td>
                            <td>
                                <div>
                                    @if ($alinea->status==1)
                                        @livewire('admin.buttons-crud', [ $alinea->id, '/' . \App\Enums\RotinasAplicacaoEnum::Alinea->value, ['visualizar', 'inativar']])
                                    @else    
                                        @livewire('admin.buttons-crud', [ $alinea->id, '/' . \App\Enums\RotinasAplicacaoEnum::Alinea->value, ['visualizar']])
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
