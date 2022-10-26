<div>
    @livewire('button-back-form', ['/' . \App\Enums\RotinasAplicacaoEnum::Lead->value])
    <div class="card m-5 bg-base-100 shadow-xl">
        <div class="card-body">
            <form>
                <div class="grid grid-cols-3">

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
                                Ano Nascimento
                                <span class="text-red-700" title="Campo obrigatório">*</span>
                            </span>
                        </label>
                        <input readonly wire:model="anoNascimento" class="input input-bordered w-full max-w-xs readonly" />
                    </div>

                </div>

                <div class="grid grid-cols-3">

                    <div class="form-control py-2">
                        <label class="label">
                            <span class="label-text">
                                Profissão
                                <span class="text-red-700" title="Campo obrigatório">*</span>
                            </span>
                        </label>
                        <input readonly wire:model="profissao" class="input input-bordered w-full max-w-xs readonly" />
                    </div>

                    <div class="form-control py-2">
                        <label class="label">
                            <span class="label-text">
                                Cidade
                                <span class="text-red-700" title="Campo obrigatório">*</span>
                            </span>
                        </label>
                        <input readonly wire:model="cidade" class="input input-bordered w-full max-w-xs readonly" />
                    </div>

                    <div class="form-control py-2">
                        <label class="label">
                            <span class="label-text">
                                Estado
                                <span class="text-red-700" title="Campo obrigatório">*</span>
                            </span>
                        </label>
                        <input readonly wire:model="estado" class="input input-bordered w-full max-w-xs readonly" />
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>