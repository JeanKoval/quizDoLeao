<div class="flex justify-between">
    <div class="ml-16 pl-8 mt-16 pt-8 pb-8 h-full border-4 rounded-3xl">
        <span style="color: #0B5CD5;" class="font-black text-4xl">
            De acordo com as suas respostas, você
            <span style="color: #0BD598;">
                @if($opcao == 'precisa')
                    {{ $MENSAGEM_SE_SIM }}
                @else
                    {{ $MENSAGEM_SE_NÃO }}
                @endif
            </span>
            fazer a sua Declaração do Imposto de Renda.
        </span>

        @if($opcao != 'precisa')
        <div class="font-semibold pt-4">
            <span>
                <span class="text-red-700" title="Campo obrigatório">*</span>
                A PESSOA FÍSICA AINDA QUE DESOBRIGADA, PODE APRESENTAR A DECLARAÇÃO DE AJUSTE ANUAL.
            </span>
        </div>
        @endif

        <div class="font-semibold pt-4">
            <span>
                PERGUNTAS REALIZADAS COM BASE NA:
                <br>
                INSTRUÇÃO NORMATIVA RFB Nº 2065, DE 24 DE FEVEREIRO DE 2022
            </span>
        </div>
    </div>


    <div class="w-full pt-8">
        <img class="w-96" src="{{ asset('images/lion.png') }}" alt="Lion">
    </div>

</div>