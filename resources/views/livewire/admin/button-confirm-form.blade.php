<div style="text-align: center;">

    @if( $action == \App\Enums\OptionCrudEnum::Excluir->value )
        <button type="submit" class="btn btn-outline btn-error">Confirmar Exclusão</button>
    @elseif ($action != \App\Enums\OptionCrudEnum::Visualizar->value )
        <button type="submit" class="btn btn-outline btn-success">Salvar</button>
    @endif

</div>