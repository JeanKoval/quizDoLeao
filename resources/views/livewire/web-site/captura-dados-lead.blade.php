<div class="flex justify-between">
    <div class="text-center ml-32 mt-8 border-2 rounded">
        <div class="p-6">
            <form wire:submit.prevent="save">
                <div class="grid pt-4">
                    <label class="font-black">Nome</label>
                    <input class="rounded border-2 border-solid" type="text" wire:model="nome" style="border-color: #136CF2;">
                    @error('nome')
                    <p class="text-red-500 text-xs italic">{{$message}}</p>
                    @enderror
                </div>

                <div class="grid pt-4">
                    <label class="font-black">E-mail</label>
                    <input class="rounded border-2 border-solid" type="text" wire:model="email" style="border-color: #136CF2;">
                    @error('email')
                    <p class="text-red-500 text-xs italic">{{$message}}</p>
                    @enderror
                </div>

                <div class="grid pt-4">
                    <label class="font-black">Telefone</label>
                    <input class="rounded border-2 border-solid" type="text" wire:model="telefone" style="border-color: #136CF2;">
                    @error('telefone')
                    <p class="text-red-500 text-xs italic">{{$message}}</p>
                    @enderror
                </div>

                <div class="pt-4 block">
                    <input type="checkbox" wire:model="aceiteDoTermo">
                    <label class="text-xs">
                        Declaro estar ciente com o envio das informações contidas neste formulário,
                        <br>
                        assim como estar de acordo com o 
                        <a href="{{ route('termoDePrivacidade') }}" target="_blank" class="font-black">
                            Termo de Privacidade.
                        </a>
                    </label>
                    @error('aceiteDoTermo')
                    <p class="text-red-500 text-xs italic">{{$message}}</p>
                    @enderror
                </div>
                
                <div class="grid">
                    <button style="background-color: #136CF2;" class="text-white rounded-md mt-4 px-6 py-1.5 font-black text-center" type="submit">Continuar</button>
                </div>
            </form>
        </div>
    </div>

    <div class="pr-32 pt-8">
        <img class="w-96" src="{{ asset('images/lion.png') }}" alt="Lion">
    </div>

</div>