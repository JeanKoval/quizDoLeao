<div>
    @if(in_array('visualizar', $actions))
        <a href="{{ $route }}/visualizar/{{ $idData }}">
            <button class="btn btn-outline btn-info">visualizar</button>
        </a>
    @endif

    @if(in_array('alterar', $actions))
        <a href="{{ $route }}/alterar/{{ $idData }}">
            <button class="btn btn-outline btn-warning">Alterar</button>
        </a>
    @endif

    @if(in_array('excluir', $actions))
    <a href="{{ $route }}/excluir/{{ $idData }}">
        <button class="btn btn-outline btn-error">Excluir</button>
    </a>
    @endif

    @if(in_array('revisao', $actions))
        <a href="{{ $route }}/incluir/{{ $idData }}?revisao=1">
            <button class="btn btn-outline btn-accent">Revisão</button>
        </a>
    @endif

    @if(in_array('inativar', $actions))
        <a href="{{ $route }}/inativar/{{ $idData }}">
            <button class="btn btn-outline btn-error">Inativar</button>
        </a>
    @endif
</div>
