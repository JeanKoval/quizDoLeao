<div>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Telefone</th>
                <th>Necessita Declarar</th>
                <th>Renda Tributável</th>
                <th>Renda Não Tributável</th>
                <th>Ganho de Capital</th>
                <th>Opera Bolsa de Valores</th>
                <th>Receita Bruta Atividade Rural</th>
                <th>Compensar Prejuízo Atividade Rural</th>
                <th>Bens e Direitos</th>
                <th>Residente no Brasil</th>
                <th>Isenção Imoveis</th>
            </tr>
        </thead>
        <tbody>
            @foreach($leads as $lead)
            <tr>
                <td> {{ $lead->id }}                                  </td>
                <td> {{ $lead->nome }}                                  </td>
                <td> {{ $lead->email }}                                 </td>
                <td> {{ $lead->telefone }}                              </td>
                <td> {{ $lead->necessita_declarar }}                    </td>
                <td> {{ $lead->renda_tributavel }}                      </td>
                <td> {{ $lead->renda_nao_tributavel }}                  </td>
                <td> {{ $lead->ganho_de_capital }}                      </td>
                <td> {{ $lead->opera_bolsa_de_valores }}                </td>
                <td> {{ $lead->receita_bruta_atividade_rural }}         </td>
                <td> {{ $lead->compensar_prejuizo_atividade_rural }}    </td>
                <td> {{ $lead->bens_e_direitos }}                       </td>
                <td> {{ $lead->residente_no_brasil }}                   </td>
                <td> {{ $lead->isencao_imoveis }}                       </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>