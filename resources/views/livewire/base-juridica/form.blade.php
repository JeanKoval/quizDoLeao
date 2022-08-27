<div>
    @livewire('button-back-form', ['/base-juridica'])
    <!-- Flash Data -->
    @if(Session::has('messageFlashData'))
        @livewire('flash-data',[
                session('typeFlashData'), 
                session('messageFlashData')
            ]
        )
    @endif
    <div class="card m-5 bg-base-100 shadow-xl">
        <div class="card-body">
            <form wire:submit.prevent="save">
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
                            @if (in_array($action, ['visualizar','revisao'])) { readonly } @endif
                            required
                            wire:model="numero"
                            type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" 
                            placeholder="Número..." 
                            class="input input-bordered w-full max-w-xs
                                @if (in_array($action, ['visualizar','revisao'])) { readonly } @endif" 
                            maxlength="6"/>
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
                                required
                                class="input input-bordered w-full max-w-xs"
                                wire:model="ano">
                                <option value="" selected>Selecione</option>
                                @for($x = date('Y'); $x >= (intval(date('Y'))-1); $x--)
                                <option value="{{$x}}">{{$x}}</option>
                                @endfor
                            </select>
                        @endif
                    </div>
                    
                    <div class="form-control py-2">
                        <label class="label">
                            <span class="label-text">
                                Tipo
                                <span class="text-red-700" title="Campo obrigatório">*</span>
                            </span>
                        </label>
                        @if (in_array($action, ['visualizar','revisao']))
                            <input 
                            readonly
                            value="@if($tipo==1) Real @else Alteração @endif"
                            class="input input-bordered w-full max-w-xs readonly"/>
                        @else
                            <select
                                required
                                class="input input-bordered w-full max-w-xs"
                                wire:model="tipo">
                                <option value="" selected>Selecione</option>
                                <option value="1">Real</option>
                                <option value="2">Alteração</option>
                            </select>
                        @endif
                    </div>
                </div>

                <div class="form-control py-2">
                    <label class="label">
                        <span class="label-text">Descrição</span>
                    </label>
                    <textarea 
                        wire:model="descricao" class="textarea textarea-bordered" 
                        placeholder="Descrição...">
                    </textarea>
                </div>

                @livewire('button-confirm-form', [$action])
            </form>
        </div>
    </div>
</div>