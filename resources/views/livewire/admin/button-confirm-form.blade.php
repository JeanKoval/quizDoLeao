<div style="text-align: center;">

    @if( $action == \App\Enums\OptionCrudEnum::Excluir )
        <button type="submit" class="btn btn-outline btn-error">Confirmar Exclusão</button>
    @else
        <button type="submit" class="btn btn-outline btn-success">Salvar</button>
    @endif

</div>