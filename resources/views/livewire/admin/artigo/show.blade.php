<div>
    <div class="card m-5 bg-base-100 shadow-xl">
        <div class="card-body">
            <div>
                <a href="{{ route('artigoForm', \App\Enums\OptionCrudEnum::Incluir->value) }}">
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
                            <th>Capitulo</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($artigos as $artigo)
                        <tr>
                            <td>
                                @if($artigo->status==0)
                                <div class="badge badge-error">Inativo</div>
                                @else
                                <div class="badge badge-success">Ativo</div>
                                @endif
                            </td>
                            <td> {{ $artigo->numero }}° </td>
                            <td> {{ $artigo->capitulo->getBaseJuridicaAndAno() }}</td>
                            <td> {{ $artigo->capitulo->numeroRomano }} </td>
                            <td>
                                <div>
                                    @if ($artigo->status==1)
                                    @livewire('admin.buttons-crud', [ $artigo->id, '/' . \App\Enums\RotinasAplicacaoEnum::Artigo->value, ['visualizar', 'inativar']])
                                    @else
                                    @livewire('admin.buttons-crud', [ $artigo->id, '/' . \App\Enums\RotinasAplicacaoEnum::Artigo->value, ['visualizar']])
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