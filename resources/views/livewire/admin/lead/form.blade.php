<div>
    @livewire('admin.button-back-form', [ route('leadShow') ])
    <div class="card m-5 bg-base-100 shadow-xl">
        <div class="card-body">
            <form>
                <div class="grid grid-cols-4">

                    <div class="form-control py-2">
                        <label class="label">
                            <span class="label-text">
                                Nome
                                <span class="text-red-700" title="Campo obrigatório">*</span>
                            </span>
                        </label>
                        <input readonly wire:model="nome" class="input input-bordered w-full max-w-xs readonly" />
                    </div>

                    <div class="form-control py-2">
                        <label class="label">
                            <span class="label-text">
                                E-mail
                                <span class="text-red-700" title="Campo obrigatório">*</span>
                            </span>
                        </label>
                        <input readonly wire:model="email" class="input input-bordered w-full max-w-xs readonly" />
                    </div>

                    <div class="form-control py-2">
                        <label class="label">
                            <span class="label-text">
                                Telefone
                                <span class="text-red-700" title="Campo obrigatório">*</span>
                            </span>
                        </label>
                        <input readonly wire:model="telefone" class="input input-bordered w-full max-w-xs readonly" />
                    </div>

                    <div class="form-control py-2">
                        <label class="label">
                            <span class="label-text">
                                Necessita Declarar
                                <span class="text-red-700" title="Campo obrigatório">*</span>
                            </span>
                        </label>
                        <input readonly wire:model="necessitaDeclarar" class="input input-bordered w-full max-w-xs readonly" />
                    </div>

                </div>

                <div class="grid grid-cols-3">

                    <div class="form-control py-2">
                        <label class="label">
                            <span class="label-text">
                                Renda Tributavel
                                <span class="text-red-700" title="Campo obrigatório">*</span>
                            </span>
                        </label>
                        <input readonly wire:model="rendaTributavel" class="input input-bordered w-full max-w-xs readonly" />
                    </div>

                    <div class="form-control py-2">
                        <label class="label">
                            <span class="label-text">
                                Renda Não Tributavel
                                <span class="text-red-700" title="Campo obrigatório">*</span>
                            </span>
                        </label>
                        <input readonly wire:model="rendaNaoTributavel" class="input input-bordered w-full max-w-xs readonly" />
                    </div>

                    <div class="form-control py-2">
                        <label class="label">
                            <span class="label-text">
                                Ganho de Capital
                                <span class="text-red-700" title="Campo obrigatório">*</span>
                            </span>
                        </label>
                        <input readonly wire:model="ganhoDeCapital" class="input input-bordered w-full max-w-xs readonly" />
                    </div>

                </div>

                <div class="grid grid-cols-3">

                    <div class="form-control py-2">
                        <label class="label">
                            <span class="label-text">
                                Opera Bolsa
                                <span class="text-red-700" title="Campo obrigatório">*</span>
                            </span>
                        </label>
                        <input readonly wire:model="operaBolsaDeValores" class="input input-bordered w-full max-w-xs readonly" />
                    </div>

                    <div class="form-control py-2">
                        <label class="label">
                            <span class="label-text">
                                Receita Bruta Atividade Rural
                                <span class="text-red-700" title="Campo obrigatório">*</span>
                            </span>
                        </label>
                        <input readonly wire:model="receitaBrutaAtividadeRural" class="input input-bordered w-full max-w-xs readonly" />
                    </div>

                    <div class="form-control py-2">
                        <label class="label">
                            <span class="label-text">
                                Compensar Prejuizo Atividade Rural
                                <span class="text-red-700" title="Campo obrigatório">*</span>
                            </span>
                        </label>
                        <input readonly wire:model="compensarPrejuizoAtividadeRural" class="input input-bordered w-full max-w-xs readonly" />
                    </div>
                </div>
                <div class="grid grid-cols-3">

                    <div class="form-control py-2">
                        <label class="label">
                            <span class="label-text">
                                Bens e Direitos
                                <span class="text-red-700" title="Campo obrigatório">*</span>
                            </span>
                        </label>
                        <input readonly wire:model="bensEDireitos" class="input input-bordered w-full max-w-xs readonly" />
                    </div>

                    <div class="form-control py-2">
                        <label class="label">
                            <span class="label-text">
                                Residente no Brasil
                                <span class="text-red-700" title="Campo obrigatório">*</span>
                            </span>
                        </label>
                        <input readonly wire:model="residenteNoBrasil" class="input input-bordered w-full max-w-xs readonly" />
                    </div>

                    <div class="form-control py-2">
                        <label class="label">
                            <span class="label-text">
                                Isencao Imoveis
                                <span class="text-red-700" title="Campo obrigatório">*</span>
                            </span>
                        </label>
                        <input readonly wire:model="isencaoImoveis" class="input input-bordered w-full max-w-xs readonly" />
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>