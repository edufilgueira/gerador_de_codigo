
<li class="{{ Request::is('projetos*') ? 'active' : '' }}">
    <a href="{!! route('projetos.index') !!}"><i class="fa fa-edit"></i><span>Projetos</span></a>
</li>


<li class="{{ Request::is('modelos*') ? 'active' : '' }}">
    <a href="{!! route('modelos.index') !!}"><i class="fa fa-edit"></i><span>Modelos</span></a>
</li>

