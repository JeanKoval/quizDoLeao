<div class="flex justify-between">
    <div class="text-center pl-24 w-full pt-24">
        <div>
            <span style="color: #0B5CD5;" class="font-black text-4xl">
                {{ $perguntaAtual->descricao }}
            </span>
        </div>

        <div class="pt-4 font-medium text-xs justify-between flex">
            <div>
                <span>
                    PERGUNTA REALIZADA COM BASE NA:
                    <br>
                    INSTRUÇÃO NORMATIVA RFB Nº 2065, DE 24 DE FEVEREIRO DE 2022
                </span>
            </div>

            <div class="tooltips font-black underline mt-2">
                Ajuda para Responder?
                <span>
                    {{ $perguntaAtual->mensagem_auxiliar }}
                </span>
            </div>
        </div>


        <div class="flex justify-center pt-6">
            <button wire:click="enviaResposta(1)" style="background-color: #136CF2;" class="mr-4 text-white rounded-md px-6 py-1.5 font-black flex">
                SIM
            </button>
            <button wire:click="enviaResposta(0)" style="background-color: #136CF2;" class="ml-4 text-white rounded-md px-6 py-1.5 font-black flex">
                NÃO
            </button>
        </div>
    </div>

    <div class="w-full pt-8">
        <img class="w-96" src="{{ asset('images/lion.png') }}" alt="Lion">
    </div>

</div>