<div>
    <div class="card m-5 bg-base-100 shadow-xl">
        <div class="card-body">
            <div class="flex">
                <a href="{{ route('incisoForm', \App\Enums\OptionCrudEnum::Incluir->value) }}">
                    <button class="btn btn-outline btn-success">
                        <ion-icon name="add-outline"></ion-icon>
                        Incluir
                    </button>
                </a>

                <div class="form-control">
                    <label class="cursor-pointer label">
                        <span class="label-text pr-2">Mostrar inativos? </span>
                        <input type="checkbox" checked="checked" class="checkbox checkbox-accent" wire:click="mostraInativos" wire:model="mostraInativos" />
                    </label>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="table w-full">
                    <!-- head -->
                    <thead>
                        <tr>
                            <th>Status</th>
                            <th>Número Romano</th>
                            <th>Tipo Relacao</th>
                            <th>Base Jurídica / Ano</th>
                            <th>Capitulo</th>
                            <th>Artigo</th>
                            <th>Paragrafo</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($incisos as $inciso)
                        <tr>
                            <td>
                                @if($inciso->status==0)
                                <div class="badge badge-error">Inativo</div>
                                @else
                                <div class="badge badge-success">Ativo</div>
                                @endif
                            </td>
                            <td> {{ $inciso->numeroRomano }} </td>
                            <td> {{ $inciso->tipoRelacao->name }} </td>
                            <td> {{ $inciso->baseJuridica }} </td>
                            <td> {{ $inciso->capitulo->numeroRomano }} </td>
                            <td> {{ $inciso->artigo->numero }}° </td>
                            <td>
                                @if($inciso->tipoRelacao == \App\Enums\OptionIncisoEnum::Paragrafo)
                                {{ $inciso->paragrafo->numero }}°
                                @endif
                            </td>
                            <td>
                                <div>
                                    @if ($inciso->status==1)
                                    @livewire('admin.buttons-crud', [ $inciso->id, '/' . \App\Enums\RotinasAplicacaoEnum::Inciso->value, ['visualizar', 'inativar']])
                                    @else
                                    @livewire('admin.buttons-crud', [ $inciso->id, '/' . \App\Enums\RotinasAplicacaoEnum::Inciso->value, ['visualizar']])
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