<div>
@livewire('button-back-form', ['/' . \App\Enums\RotinasAplicacaoEnum::Capitulo->value])
    <div class="card m-5 bg-base-100 shadow-xl">
        <div class="card-body">
            <form wire:submit.prevent="submit">
                <div class="grid grid-cols-2">
                    <div class="form-control py-2">
                        <label class="label">
                            <span class="label-text">
                                Número
                                <span class="text-red-700" title="Campo obrigatório">*</span>
                            </span>
                        </label>
                        @if (in_array($action, ['visualizar','revisao', 'inativar']))
                            <input 
                            readonly
                            wire:model="numeroRomano"
                            class="input input-bordered w-full max-w-xs readonly"/>
                        @else
                            <select
                                class="input input-bordered w-full max-w-xs"
                                wire:model="numeroRomano">
                                <option value="" selected>Selecione...</option>
                                @foreach($optionsNumeroRomano as $option)
                                    <option value="{{$option}}">{{$option}}</option>
                                @endforeach
                            </select>
                            @error('numeroRomano')
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
                            <input 
                            readonly
                            wire:model="baseJuridica"
                            class="input input-bordered w-full max-w-xs readonly"/>
                        @else
                            <select
                                class="input input-bordered w-full max-w-xs"
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

                <div class="form-control py-2">
                    <label class="label">
                        <span class="label-text">Descrição</span>
                    </label>
                    <textarea
                        @if (in_array($action, ['visualizar', 'inativar'])) { readonly } @endif
                        wire:model="descricao" class="textarea textarea-bordered" 
                        placeholder="Descrição...">
                    </textarea>
                </div>

                @livewire('button-confirm-form', [$action])
            </form>
        </div>
    </div>
</div>
