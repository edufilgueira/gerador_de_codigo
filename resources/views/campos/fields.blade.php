<!-- Modelo Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('modelo_id', 'Modelo Id:') !!}
    {!! Form::select('modelo_id', $modelos, null, ['class' => 'form-control']) !!}
</div>

<!-- Nome Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nome', 'Nome:') !!}
    {!! Form::text('nome', null, ['class' => 'form-control']) !!}
</div>

<!-- Validador Field -->
<div class="form-group col-sm-6">
    {!! Form::label('validador', 'Validador:') !!}
    {!! Form::text('validador', null, ['class' => 'form-control']) !!}
</div>

<!-- Tipo Input Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tipo_input', 'Tipo Input:') !!}
    {!! Form::select('tipo_input', ['Text' => 'Text'], null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('campos.index') !!}" class="btn btn-default">Cancel</a>
</div>
