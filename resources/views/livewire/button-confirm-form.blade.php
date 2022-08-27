<div style="text-align: center;">

    @if(in_array($action, ['incluir', 'alterar', 'revisao', 'inativar']))
        <button type="submit" class="btn btn-outline btn-success">Salvar</button>
    @elseif($action == 'excluir')
        <button type="submit" class="btn btn-outline btn-error">Confirmar Exclusão</button>
    @endif
    
</div>
