<div>
@livewire('admin.button-back-form', [ route('artigoShow') ])
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
                            wire:model="numero"
                            class="input input-bordered w-full max-w-xs readonly"/>
                        @else
                            <select
                                class="input input-bordered w-full max-w-xs"
                                wire:model="numero">
                                <option value="" selected>Selecione...</option>
                                @foreach($optionsNumero as $key=>$option)
                                    <option value="{{$key}}">{{$option}}</option>
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
                                Capitulo / Base Jurídica / Ano
                                <span class="text-red-700" title="Campo obrigatório">*</span>
                            </span>
                        </label>
                        @if (in_array($action, ['visualizar','revisao', 'inativar']))
                            <input 
                            readonly
                            wire:model="capitulo"
                            class="input input-bordered w-full max-w-xs readonly"/>
                        @else
                            <select
                                class="input input-bordered w-full max-w-xs"
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

                @livewire('admin.button-confirm-form', [$action])
            </form>
        </div>
    </div>
</div>
