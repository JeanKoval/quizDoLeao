<div class="flex justify-between">
    <div>
        <h1 class="text-5xl pl-14 pt-12 font-black">
            <span>
                Descubra
            </span><br>
            <span style="color: #15f0bc;">
                se você precisa
            </span><br>
            <span style="color: #0B5CD5;">
                fazer sua declaração
            </span><br>
            <span style="color: #0B5CD5;">
                de Imposto de Renda!
            </span>
        </h1>

        <h1 class="pl-14 pt-8 font-black">
            <span>
                FAÇA O QUIZ DO LEÃO!
            </span><br>
            <span style="color: #136CF2;">
                O QUIZ LEVA EM MÉDIA {{ $tempoMedioRealizacaoQuiz }} MINUTOS.
            </span>
        </h1>

        <div class="pl-14 pt-8">
            <a href="{{ route('perguntaWebSite', '01') }}">
                <button style="background-color: #136CF2;" class="text-white rounded-md px-6 py-1.5 font-black flex" title="Clique Aqui para Responder o Quiz">
                    CLIQUE AQUI
                    <img class="pt-1 pl-2 w-6" src="{{ asset('images/seta_diagonal_direita.png') }}" alt="">
                </button>
            </a>
        </div>

        <div class="pl-14 pt-8 flex">
            <img class="w-48" src="{{ asset('images/people.png') }}" alt="">
            <div class="pl-2">
                <h1 style="color: #136CF2;" class="font-black pt-2">
                    +{{ $qtdePessoasReponderam }} PESSOAS JÁ REALIZARAM O QUIZ!
                </h1>
                <h1 class="font-black">
                    Feedback
                </h1>
            </div>
        </div>

    </div>

    <div class="pr-32 pt-8">
        <img class="w-96" src="{{ asset('images/lion.png') }}" alt="Lion">
    </div>
</div>