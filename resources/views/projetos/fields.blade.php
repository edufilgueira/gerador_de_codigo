<!-- Nome Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nome', 'Nome:') !!}
    {!! Form::text('nome', null, ['class' => 'form-control']) !!}
</div>

<!-- Linguagem Field -->
<div class="form-group col-sm-6">
    {!! Form::label('linguagem', 'Linguagem:') !!}
    {!! Form::select('linguagem', ['Angular' => 'Angular'], null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('projetos.index') !!}" class="btn btn-default">Cancel</a>
</div>
