<div class="flex justify-between">
    <div class="text-center pl-24 w-full pt-24">
        <div>
            <span style="color: #0B5CD5;" class="font-black text-4xl">
                Você recebeu rendimentos tributáveis, sujeitos ao ajuste na declaração, cuja soma foi superior a R$ 28.559,70 ?
            </span>
        </div>

        <div class="pt-4 font-medium text-xs">
            <span>
                PERGUNTA REALIZADA COM BASE NA:
                <br>
                INSTRUÇÃO NORMATIVA RFB Nº 2065, DE 24 DE FEVEREIRO DE 2022
            </span>
        </div>

        <div class="flex justify-center pt-6">
            <a href="{{ route('resultadoWebSite', base64_encode('precisa')) }}">
                <button style="background-color: #136CF2;" class="mr-4 text-white rounded-md px-6 py-1.5 font-black flex">
                    SIM
                </button>
            </a>
            <a href="{{ route('resultadoWebSite', base64_encode('nao_precisa')) }}">
                <button style="background-color: #136CF2;" class="ml-4 text-white rounded-md px-6 py-1.5 font-black flex">
                    NÃO
                </button>
            </a>
        </div>
    </div>

    <div class="w-full pt-8">
        <img class="w-96" src="{{ asset('images/lion.png') }}" alt="Lion">
    </div>

</div>