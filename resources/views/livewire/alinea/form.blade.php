<div>
    @livewire('button-back-form', ['/' . \App\Enums\RotinasAplicacaoEnum::Alinea->value])
    <div class="card m-5 bg-base-100 shadow-xl">
        <div class="card-body">
            <form wire:submit.prevent="submit">
                <div class="grid grid-cols-{{ $qtdeColunasForm }}">

                    <div class="form-control py-2">
                        <label class="label">
                            <span class="label-text">
                                Letra
                                <span class="text-red-700" title="Campo obrigatório">*</span>
                            </span>
                        </label>
                        @if (in_array($action, ['visualizar','revisao', 'inativar']))
                        <input readonly wire:model="letra" class="input input-bordered w-full max-w-xs readonly" />
                        @else
                        <select class="input input-bordered w-full max-w-xs" wire:model="letra">
                            <option value="" selected>Selecione...</option>
                            @foreach($optionsLetra as $option)
                                <option value="{{$option}}">{{$option}}</option>
                            @endforeach
                        </select>
                        @error('numero')
                            <p class="text-red-500 text-xs italic">{{$message}}</p>
                        @enderror
                        @endif
                    </div>

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
                        <select class="input input-bordered w-full max-w-xs" wire:model="tipoRelacao" wire:click="isInciso">
                            <option value="" selected>Selecione...</option>
                            @foreach(\App\Enums\OptionAlineaEnum::cases() as $option)
                                <option value="{{$option->value}}">{{$option->name}}</option>
                            @endforeach
                        </select>
                        @error('numero')
                            <p class="text-red-500 text-xs italic">{{$message}}</p>
                        @enderror
                        @endif
                    </div>

                    @if($tipoRelacao == \App\Enums\OptionAlineaEnum::Inciso->value)
                    <div class="form-control py-2">
                        <label class="label">
                            <span class="label-text">
                                Tipo Inciso
                                <span class="text-red-700" title="Campo obrigatório">*</span>
                            </span>
                        </label>
                        @if (in_array($action, ['visualizar','revisao', 'inativar']))
                            <input readonly wire:model="tipoInciso" class="input input-bordered w-full max-w-xs readonly" />
                        @else
                        <select class="input input-bordered w-full max-w-xs" wire:model="tipoInciso">
                            <option value="" selected>Selecione...</option>
                            @foreach(\App\Enums\OptionIncisoEnum::cases() as $option)
                                <option value="{{$option->value}}">{{$option->name}}</option>
                            @endforeach
                        </select>
                        @error('numero')
                            <p class="text-red-500 text-xs italic">{{$message}}</p>
                        @enderror
                        @endif
                    </div>
                    @endif

                    <div class="form-control py-2">
                        <label class="label">
                            <span class="label-text">
                                Base Jurídica / Ano
                                <span class="text-red-700" title="Campo obrigatório">*</span>
                            </span>
                        </label>
                        @if (in_array($action, ['visualizar','revisao', 'inativar']))
                        <input readonly wire:model="baseJuridica" class="input input-bordered w-full max-w-xs readonly" />
                        @else
                        <select 
                            class="input input-bordered w-full max-w-xs" 
                            wire:click="montaOptionsCapitulo" 
                            wire:model="baseJuridica">
                            <option value="" selected>Selecione...</option>
                            @foreach($optionsBaseJuridica as $key => $option)
                                <option value="{{$key}}">{{$option}}</option>
                            @endforeach
                        </select>
                        @error('baseJuridica')
                            <p class="text-red-500 text-xs italic">{{$message}}</p>
                        @enderror
                        @endif
                    </div>

                    <div class="form-control py-2">
                        <label class="label">
                            <span class="label-text">
                                Capitulo
                                <span class="text-red-700" title="Campo obrigatório">*</span>
                            </span>
                        </label>
                        @if (in_array($action, ['visualizar','revisao', 'inativar']))
                        <input readonly wire:model="capitulo" class="input input-bordered w-full max-w-xs readonly" />
                        @else
                        <select 
                            @if(empty($baseJuridica)) disabled="disabled" @endif 
                            class="input input-bordered w-full max-w-xs" 
                            wire:click="montaOptionsArtigo" 
                            wire:model="capitulo">
                            <option value="" selected>Selecione...</option>
                            @foreach($optionsCapitulo as $key => $option)
                                <option value="{{$key}}">{{$option}}</option>
                            @endforeach
                        </select>
                        @error('capitulo')
                            <p class="text-red-500 text-xs italic">{{$message}}</p>
                        @enderror
                        @endif
                    </div>
                </div>

                <div class="grid grid-cols-3">

                    <div class="form-control py-2">
                        <label class="label">
                            <span class="label-text">
                                Artigo
                                <span class="text-red-700" title="Campo obrigatório">*</span>
                            </span>
                        </label>
                        @if (in_array($action, ['visualizar','revisao', 'inativar']))
                            <input readonly wire:model="artigo" class="input input-bordered w-full max-w-xs readonly" />
                        @else
                        <select 
                            @if(empty($capitulo)) disabled="disabled" @endif 
                            class="input input-bordered w-full max-w-xs" 
                            wire:click="montaOptionsParagrafoOuInciso"
                            wire:model="artigo">
                            <option value="" selected>Selecione...</option>
                            @foreach($optionsArtigo as $key => $option)
                                <option value="{{$key}}">{{$option}}</option>
                            @endforeach
                        </select>
                        @error('artigo')
                            <p class="text-red-500 text-xs italic">{{$message}}</p>
                        @enderror
                        @endif
                    </div>

                    @if($this->mostraParagrafo())
                    <div class="form-control py-2">
                        <label class="label">
                            <span class="label-text">
                                Paragrafo
                                <span class="text-red-700" title="Campo obrigatório">*</span>
                            </span>
                        </label>
                        @if (in_array($action, ['visualizar','revisao', 'inativar']))
                        <input readonly wire:model="paragrafo" class="input input-bordered w-full max-w-xs readonly" />
                        @else
                        <select 
                            @if(empty($artigo)) disabled="disabled" @endif 
                            class="input input-bordered w-full max-w-xs" 
                            @if($tipoRelacao == \App\Enums\OptionAlineaEnum::Inciso->value)
                                wire:click="montaOptionsInciso"
                            @endif
                            wire:model="paragrafo">
                            <option value="" selected>Selecione...</option>
                            @foreach($optionsParagrafo as $key => $option)
                                <option value="{{$key}}">{{$option}}</option>
                            @endforeach
                        </select>
                        @error('artigo')
                            <p class="text-red-500 text-xs italic">{{$message}}</p>
                        @enderror
                        @endif
                    </div>
                    @endif

                    @if(!empty($tipoInciso))
                    <div class="form-control py-2">
                        <label class="label">
                            <span class="label-text">
                                Inciso
                                <span class="text-red-700" title="Campo obrigatório">*</span>
                            </span>
                        </label>
                        @if (in_array($action, ['visualizar','revisao', 'inativar']))
                        <input readonly wire:model="inciso" class="input input-bordered w-full max-w-xs readonly" />
                        @else
                        <select 
                            @if($this->incisoBloqueado()) disabled="disabled" @endif 
                            class="input input-bordered w-full max-w-xs" 
                            wire:model="inciso">
                            <option value="" selected>Selecione...</option>
                            @foreach($optionsInciso as $key => $option)
                                <option value="{{$key}}">{{$option}}</option>
                            @endforeach
                        </select>
                        @error('inciso')
                            <p class="text-red-500 text-xs italic">{{$message}}</p>
                        @enderror
                        @endif
                    </div>
                    @endif
                </div>

                <div class="form-control py-2">
                    <label class="label">
                        <span class="label-text">Descrição</span>
                    </label>
                    <textarea @if (in_array($action, ['visualizar', 'inativar' ])) { readonly } @endif wire:model="descricao" class="textarea textarea-bordered" placeholder="Descrição...">
                    </textarea>
                </div>

                @livewire('button-confirm-form', [$action])
            </form>
        </div>
    </div>
</div>