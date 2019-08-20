<div class="table-responsive">
    <table class="table" id="campos-table">
        <thead>
            <tr>
                <th>Id</th>
        <th>Modelo Id</th>
        <th>Nome</th>
        <th>Validador</th>
        <th>Tipo Input</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($campos as $campo)
            <tr>
                <td>{!! $campo->id !!}</td>
            <td>{!! $campo->modelo_id !!}</td>
            <td>{!! $campo->nome !!}</td>
            <td>{!! $campo->validador !!}</td>
            <td>{!! $campo->tipo_input !!}</td>
                <td>
                    {!! Form::open(['route' => ['campos.destroy', $campo->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('campos.show', [$campo->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('campos.edit', [$campo->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
