<div>
    @livewire('button-back-form', ['/' . \App\Enums\RotinasAplicacaoEnum::Pergunta->value])
    <div class="card m-5 bg-base-100 shadow-xl">
        <div class="card-body">
            <form wire:submit.prevent="save">
                <div class="grid grid-cols-2">

                    <div class="form-control py-2">
                        <label class="label">
                            <span class="label-text">Ordem</span>
                        </label>
                        <input disabled="disabled" wire:model="ordem" type="text" placeholder="Código..." class="input input-bordered w-full max-w-xs" maxlength="6" />
                    </div>

                    <div class="form-control py-2">
                        <label class="label">
                            <span class="label-text">
                                Revisão
                            </span>
                        </label>
                        <input disabled="disabled" wire:model="revisao" type="text" placeholder="Revisão..." class="input input-bordered w-full max-w-xs" />
                        @error('ordem')
                        <p class="text-red-500 text-xs italic">{{$message}}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-2">
                    <div class="form-control py-2">
                        <label class="label">
                            <span class="label-text">
                                Tipo Relação
                                <span class="text-red-700" title="Campo obrigatório">*</span>
                            </span>
                        </label>
                        @if (in_array($action, ['visualizar','revisao', 'inativar']))
                        <input readonly wire:model="tipoRelacao" class="input input-bordered w-full max-w-xs readonly" />
                        @else
                        <select class="input input-bordered w-full max-w-xs" wire:click="tipoRelacaoUpdated" wire:model="tipoRelacao">
                            <option value="" selected>Selecione...</option>
                            @foreach(\App\Enums\OptionPerguntaEnum::cases() as $option)
                            <option value="{{$option->value}}">{{$option->name}}</option>
                            @endforeach
                        </select>
                        @error('tipoRelacao')
                        <p class="text-red-500 text-xs italic">{{$message}}</p>
                        @enderror
                        @endif
                    </div>

                    @if(!empty($tipoRelacao))
                    <div class="form-control py-2">
                        <label class="label">
                            <span class="label-text">
                                {{ ucfirst($tipoRelacao) }}
                                <span class="text-red-700" title="Campo obrigatório">*</span>
                            </span>
                        </label>
                        <div class="input-group">
                            <input wire:model="idRelacao" type="text" placeholder="{{ ucfirst($tipoRelacao) }}..." class="input input-bordered" disabled="disabled" />
                            <label for="modal-select" class="btn btn btn-square">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </label>
                        </div>
                        @error('idRelacao')
                        <p class="text-red-500 text-xs italic">{{$message}}</p>
                        @enderror
                    </div>
                    @endif
                </div>

                <div class="form-control py-2">
                    <label class="label">
                        <span class="label-text">
                            Descrição
                            <span class="text-red-700" title="Campo obrigatório">*</span>
                        </span>
                    </label>
                    <textarea wire:model="descricao" class="textarea textarea-bordered" placeholder="Descrição..."></textarea>
                    @error('descricao')
                    <p class="text-red-500 text-xs italic">{{$message}}</p>
                    @enderror
                </div>

                @livewire('button-confirm-form', [$action])
            </form>
        </div>
    </div>

    {{--! Montagem do modal de escolha do item que relacionara com a pergunta --}}
    @if(!empty($tipoRelacao))
    <!-- Put this part before </body> tag -->
    <input type="checkbox" id="modal-select" class="modal-toggle" />
    <div class="modal">
        <div class="modal-box w-11/12 max-w-5xl">
            <h3 class="font-bold text-lg">
                Selecione o registro, clicando em
                <div class="badge badge-success">OK</div>
            </h3>
            <div class="overflow-x-auto">
                <table class="table w-full">
                    <!-- head -->
                    <thead>
                        <tr>
                            <th></th>
                            @foreach($header as $head)
                            <th>{{ $head }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($optionPergunta as $key => $options)
                        <tr>
                            <td>
                                <div>
                                    <label for="modal-select" class="cursor-pointer" wire:click="selectedItem({{$key}})">
                                        <div class="badge badge-success">OK</div>
                                    </label>
                                </div>
                            </td>
                            @foreach($options as $value)
                            <td>{{ $value }}</td>
                            @endforeach
                        </tr>
                        @empty
                        <tr>
                            <th colspan="4" class="text-center">Não encontrado Registros...</th>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="modal-action">
                <label for="modal-select" class="btn btn-outline btn-error">Cancelar</label>
            </div>
        </div>
    </div>
    @endif
</div>