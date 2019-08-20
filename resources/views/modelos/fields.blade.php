<!-- Projeto Id Field -->
<div class="form-group col-sm-12">
    {!! Form::label('projeto_id', 'Projeto:') !!}
    {!! Form::select('projeto_id', $projetos, null, ['class' => 'form-control']) !!}
</div>

<!-- Singular Field -->
<div class="form-group col-sm-6">
    {!! Form::label('singular', 'Singular:') !!}
    {!! Form::text('singular', null, ['class' => 'form-control']) !!}
</div>

<!-- Plural Field -->
<div class="form-group col-sm-6">
    {!! Form::label('plural', 'Plural:') !!}
    {!! Form::text('plural', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('modelos.index') !!}" class="btn btn-default">Cancel</a>
</div>
