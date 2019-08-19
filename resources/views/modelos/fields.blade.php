<!-- Projeto Field -->
<div class="form-group col-sm-6">
    {!! Form::label('projeto', 'Projeto:') !!}
    {!! Form::select('projeto', $projetos, null, ['class' => 'form-control']) !!}
</div>

<!-- Nome Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nome', 'Nome:') !!}
    {!! Form::text('nome', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('modelos.index') !!}" class="btn btn-default">Cancel</a>
</div>
