<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $modelo->id !!}</p>
</div>

<!-- Projeto Id Field -->
<div class="form-group">
    {!! Form::label('projeto_id', 'Projeto Id:') !!}
    <p>{!! $modelo->projeto_id !!}</p>
</div>

<!-- Singular Field -->
<div class="form-group">
    {!! Form::label('singular', 'Singular:') !!}
    <p>{!! $modelo->singular !!}</p>
</div>

<!-- Plural Field -->
<div class="form-group">
    {!! Form::label('plural', 'Plural:') !!}
    <p>{!! $modelo->plural !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $modelo->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $modelo->updated_at !!}</p>
</div>

