<div class="flex justify-between">
    <div class="text-center ml-32 mt-8 border-2 rounded">
        <div class="p-6">
            <form wire:submit.prevent="save">
                <div class="grid pt-4">
                    <label class="font-black">Nome</label>
                    <input class="rounded border-2 border-solid" type="text" wire:model="nome" style="border-color: #136CF2;">
                </div>

                <div class="grid pt-4">
                    <label class="font-black">E-mail</label>
                    <input class="rounded border-2 border-solid" type="text" wire:model="email" style="border-color: #136CF2;">
                </div>

                <div class="grid pt-4">
                    <label class="font-black">Celular</label>
                    <input class="rounded border-2 border-solid" type="text" wire:model="telefone" style="border-color: #136CF2;">
                </div>

                <button style="background-color: #136CF2;" class="text-white rounded-md mt-4 px-6 py-1.5 font-black flex text-center" type="submit">Continuar</button>
            </form>
        </div>
    </div>

    <div class="pr-32 pt-8">
        <img class="w-96" src="{{ asset('images/lion.png') }}" alt="Lion">
    </div>

</div>