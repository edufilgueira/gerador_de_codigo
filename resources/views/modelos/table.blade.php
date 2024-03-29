<div class="table-responsive">
    <table class="table" id="modelos-table">
        <thead>
            <tr>
                <th>Id</th>
        <th>Projeto Id</th>
        <th>Singular</th>
        <th>Plural</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($modelos as $modelo)
            <tr>
                <td>{!! $modelo->id !!}</td>
            <td>{!! $modelo->projeto->nome !!}</td>
            <td>{!! $modelo->singular !!}</td>
            <td>{!! $modelo->plural !!}</td>
                <td>
                {!! Form::open(['route' => ['modelos.destroy', $modelo->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('modelos.show', [$modelo->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('modelos.edit', [$modelo->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
