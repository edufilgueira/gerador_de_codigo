<div class="table-responsive">
    <table class="table" id="projetos-table">
        <thead>
            <tr>
                <th>Id</th>
        <th>Nome</th>
        <th>Tipo</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($projetos as $projeto)
            <tr>
                <td>{!! $projeto->id !!}</td>
            <td>{!! $projeto->nome !!}</td>
            <td>{!! $projeto->tipo !!}</td>
                <td>
                    {!! Form::open(['route' => ['projetos.destroy', $projeto->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('projetos.show', [$projeto->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('projetos.edit', [$projeto->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
