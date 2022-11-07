<div>
    @if(in_array('visualizar', $actions))
        <a href="{{ \App\Providers\RouteServiceProvider::HOME_ADMIN }}{{ $route }}/visualizar/{{ $idData }}">
            <button class="btn btn-outline btn-info">visualizar</button>
        </a>
    @endif

    @if(in_array('alterar', $actions))
        <a href="{{ \App\Providers\RouteServiceProvider::HOME_ADMIN }}{{ $route }}/alterar/{{ $idData }}">
            <button class="btn btn-outline btn-warning">Alterar</button>
        </a>
    @endif

    @if(in_array('excluir', $actions))
    <a href="{{ \App\Providers\RouteServiceProvider::HOME_ADMIN }}{{ $route }}/excluir/{{ $idData }}">
        <button class="btn btn-outline btn-error">Excluir</button>
    </a>
    @endif

    @if(in_array('revisao', $actions))
        <a href="{{ \App\Providers\RouteServiceProvider::HOME_ADMIN }}{{ $route }}/incluir/{{ $idData }}?revisao=1">
            <button class="btn btn-outline btn-accent">Revisão</button>
        </a>
    @endif

    @if(in_array('inativar', $actions))
        <a href="{{ \App\Providers\RouteServiceProvider::HOME_ADMIN }}{{ $route }}/inativar/{{ $idData }}">
            <button class="btn btn-outline btn-error">Inativar</button>
        </a>
    @endif
</div>
