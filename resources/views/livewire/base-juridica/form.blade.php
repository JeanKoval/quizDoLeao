<div>
    @livewire('button-back-form', ['/base-juridica'])
    <div class="card m-5 bg-base-100 shadow-xl">
        <div class="card-body">
            <form wire:submit.prevent="submit">
                <div class="grid grid-cols-4">

                    <div class="form-control py-2">
                        <label class="label">
                            <span class="label-text">Revisão</span>
                        </label>
                        <input 
                            readonly
                            wire:model="revisao" type="text" placeholder="Revisão..." 
                            class="input input-bordered w-full max-w-xs readonly" />
                    </div>

                    <div class="form-control py-2">
                        <label class="label">
                            <span class="label-text">
                                Número
                                <span class="text-red-700" title="Campo obrigatório">*</span>
                            </span>
                        </label>
                        <input 
                            @if (in_array($action, ['visualizar','revisao', 'inativar'])) { readonly } @endif
                            wire:model="numero"
                            type="text"
                            placeholder="Número..." 
                            class="input input-bordered w-full max-w-xs
                                @if (in_array($action, ['visualizar','revisao', 'inativar'])) { readonly } @endif"/>
                        @error('numero')
                            <p class="text-red-500 text-xs italic">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="form-control py-2">
                        <label class="label">
                            <span class="label-text">
                                Ano
                                <span class="text-red-700" title="Campo obrigatório">*</span>
                            </span>
                        </label>
                        @if (in_array($action, ['visualizar','revisao', 'inativar']))
                            <input 
                            readonly
                            wire:model="ano"
                            class="input input-bordered w-full max-w-xs readonly"/>
                        @else
                            <select
                                class="input input-bordered w-full max-w-xs"
                                wire:model="ano">
                                <option value="" selected>Selecione...</option>
                                @foreach($optionsAno as $option)
                                    <option value="{{$option}}">{{$option}}</option>
                                @endforeach
                            </select>
                            @error('ano')
                                <p class="text-red-500 text-xs italic">{{$message}}</p>
                            @enderror
                        @endif
                    </div>
                    
                    <div class="form-control py-2">
                        <label class="label">
                            <span class="label-text">
                                Tipo
                                <span class="text-red-700" title="Campo obrigatório">*</span>
                            </span>
                        </label>
                        @if (in_array($action, ['visualizar','revisao', 'inativar']))
                            <input 
                            readonly
                            value="@if($tipo==1) Real @else Alteração @endif"
                            class="input input-bordered w-full max-w-xs readonly"/>
                        @else
                            <select
                                class="input input-bordered w-full max-w-xs"
                                wire:model="tipo">
                                <option value="" selected>Selecione...</option>
                                @foreach($optionsTipo as $key => $option)
                                    <option value="{{$key}}">{{$option}}</option>
                                @endforeach
                            </select>
                            @error('tipo')
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