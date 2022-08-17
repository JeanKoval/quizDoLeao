<div>
    @livewire('button-back-form', ['/pergunta'])
    <div class="card m-5 bg-base-100 shadow-xl">
        <div class="card-body">
            <form wire:submit.prevent="save">
                <div class="grid grid-cols-2">

                    <div class="form-control py-2">
                        <label class="label">
                            <span class="label-text">Código</span>
                        </label>
                        <input 
                            @if (in_array($action, ['visualizar','excluir'])) { readonly } @endif
                            wire:model="codigo" type="text" placeholder="Código..." 
                            class="input input-bordered w-full max-w-xs" maxlength="6"/>
                    </div>

                    <div class="form-control py-2">
                        <label class="label">
                            <span class="label-text">Descrição</span>
                        </label>
                        <input 
                            @if (in_array($action, ['visualizar','excluir'])) { readonly } @endif
                            wire:model="descricao" type="text" placeholder="Descrição..." 
                            class="input input-bordered w-full max-w-xs" />
                    </div>
                </div>

                <div class="grid grid-cols-4">
                    <div class="form-control">
                        <label class="label cursor-pointer">
                            <span class="label-text">Tem Mensagem Referencial?</span>
                            <input 
                                @if (in_array($action, ['visualizar','excluir'])) { disabled } @endif
                                wire:model="tooltip" wire:click="limpaMsgTooltip" type="checkbox" 
                                class="toggle toggle-accent" />
                        </label>
                    </div>
                </div>

                @if($tooltip)
                <div class="form-control py-2">
                    <label class="label">
                        <span class="label-text">Mensagem Referencial</span>
                    </label>
                    <textarea 
                        wire:model="mensagemTooltip" class="textarea textarea-bordered" 
                        placeholder="Mensagem Referencial...">
                    </textarea>
                </div>
                @endif

                @livewire('button-confirm-form', [$action])
            </form>
        </div>
    </div>
</div>