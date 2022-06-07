<div>

    <div class="card m-5 bg-base-100 shadow-xl">
        <div class="card-body">
            <form wire:submit.prevent="save">
                <div class="grid grid-cols-2">

                    <div class="form-control py-2">
                        <label class="label">
                            <span class="label-text">Código</span>
                        </label>
                        <input wire:model="codigo" type="text" placeholder="Código..." class="input input-bordered w-full max-w-xs" maxlength="6"/>
                    </div>

                    <div class="form-control py-2">
                        <label class="label">
                            <span class="label-text">Descrição</span>
                        </label>
                        <input wire:model="descricao" type="text" placeholder="Descrição..." class="input input-bordered w-full max-w-xs" />
                    </div>
                </div>

                <div class="grid grid-cols-4">
                    <div class="form-control">
                        <label class="label cursor-pointer">
                            <span class="label-text">Tem Mensagem Referencial?</span>
                            <input wire:model="tooltip" wire:click="limpaMsgTooltip" type="checkbox" class="toggle toggle-accent" />
                        </label>
                    </div>
                </div>

                @if($tooltip)
                <div class="form-control py-2">
                    <label class="label">
                        <span class="label-text">Mensagem Referencial</span>
                    </label>
                    <textarea wire:model="mensagemTooltip" class="textarea textarea-bordered" placeholder="Mensagem Referencial..."></textarea>
                    <!-- <input type="text" placeholder="Mensagem Referencial..." class="input input-bordered w-full max-w-xs" /> -->
                </div>
                @endif

                <div class="grid grid-cols-6">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <button wire:click="back" class="btn btn-outline btn-info">Voltar</button>
                    <button type="submit" class="btn btn-outline btn-success">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>