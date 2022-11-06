<div>
    @livewire('admin.button-back-form', [ route('incisoShow') ])
    <div class="card m-5 bg-base-100 shadow-xl">
        <div class="card-body">
            <form wire:submit.prevent="submit">
                <div class="grid grid-cols-3">

                    <div class="form-control py-2">
                        <label class="label">
                            <span class="label-text">
                                Número Romano
                                <span class="text-red-700" title="Campo obrigatório">*</span>
                            </span>
                        </label>
                        @if (in_array($action, ['visualizar','revisao', 'inativar']))
                        <input readonly wire:model="numeroRomano" class="input input-bordered w-full max-w-xs readonly" />
                        @else
                        <select class="input input-bordered w-full max-w-xs" wire:model="numeroRomano">
                            <option value="" selected>Selecione...</option>
                            @foreach($optionsNumeroRomano as $option)
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
                        <select class="input input-bordered w-full max-w-xs" wire:model="tipoRelacao">
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
                </div>

                <div class="grid grid-cols-3">
                    
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
                            wire:click="montaOptionsParagrafo"
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

                @if($tipoRelacao == \App\Enums\OptionIncisoEnum::Paragrafo->value)
                    <div class="form-control py-2">
                        <label class="label">
                            <span class="label-text">
                                Paragrafo
                                <span class="text-red-700" title="Campo obrigatório">*</span>
                            </span>
                        </label>
                        @if (in_array($action, ['visualizar','revisao', 'inativar']))
                        <input readonly wire:model="artigo" class="input input-bordered w-full max-w-xs readonly" />
                        @else
                        <select 
                            @if(empty($artigo)) disabled="disabled" @endif 
                            class="input input-bordered w-full max-w-xs" 
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
                </div>

                <div class="form-control py-2">
                    <label class="label">
                        <span class="label-text">Descrição</span>
                    </label>
                    <textarea @if (in_array($action, ['visualizar', 'inativar' ])) { readonly } @endif wire:model="descricao" class="textarea textarea-bordered" placeholder="Descrição...">
                    </textarea>
                </div>

                @livewire('admin.button-confirm-form', [$action])
            </form>
        </div>
    </div>
</div>