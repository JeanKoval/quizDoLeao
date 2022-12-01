<div>
    <h1 class="my-4 ml-6 font-medium">Bem-vindo {{ Auth::user()->name }},</h1>

    <div class="flex justify-between">
        <div class="card ml-6 bg-base-100 shadow-xl">
            <div class="card-body">
                <p class="text-center font-black">Leads que Finalizaram x Não Finalizaram o Quiz</p>
                @livewire('am-charts.grafico-leads-finalizaram-x-nao-finalizaram')
            </div>
        </div>

        <div>
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body py-2">
                    <p class="text-center font-black">Total de Leads</p>
                    <span class="text-center text-6xl text-blue-600">
                        {{ $totalLeads }}
                    </span>
                </div>
            </div>

            <div class="card mt-4 bg-base-100 shadow-xl">
                <div class="card-body py-2">
                    <p class="text-center font-black">Leads que Necessitam Declarar</p>
                    <span class="text-center text-6xl text-green-600">
                        {{ $leadsQueDeclaram }}
                    </span>
                </div>
            </div>

            <div class="card mt-4 bg-base-100 shadow-xl">
                <div class="card-body py-2">
                    <p class="text-center font-black">Leads que Não Necessitam Declarar</p>
                    <span class="text-center text-6xl text-yellow-600">
                        {{ $leadsQueNaoDeclaram }}
                    </span>
                </div>
            </div>

            <div class="card mt-4 bg-base-100 shadow-xl">
                <div class="card-body py-2">
                    <p class="text-center font-black">Leads que Não Finalizaram o Quiz</p>
                    <span class="text-center text-6xl text-red-600">
                        {{ $leadsQueNaoFinalizaram }}
                    </span>
                </div>
            </div>
        </div>

        <div class="card mr-6 bg-base-100 shadow-xl">
            <div class="card-body">
                <p class="text-center font-black">Leads que Necessitam x Não Necessitam Declarar</p>
                @livewire('am-charts.grafico-leads-necessitam-x-nao-necessitam-declarar')
            </div>
        </div>
    </div>
</div>