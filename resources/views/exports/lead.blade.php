<div>
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Renda Tributavel</th>
                <th>Renda Não Tributavel</th>
                <th>E-mail</th>
                <th>Telefone</th>
                <th>Ano Nascimento</th>
                <th>Profissão</th>
                <th>Cidade</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($leads as $lead)
            <tr>
                <td> {{ $lead->nome }} </td>
                <td> {{ $lead->renda_tributavel }} </td>
                <td> {{ $lead->renda_nao_tributavel }} </td>
                <td> {{ $lead->email }} </td>
                <td> {{ $lead->telefone }} </td>
                <td> {{ $lead->ano_nascimento }} </td>
                <td> {{ $lead->profissao }} </td>
                <td> {{ $lead->cidade }} </td>
                <td> {{ $lead->estado }} </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>