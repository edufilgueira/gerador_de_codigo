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
    {!! Form::label('validador', 'Validador:', ['style' => 'display: block;']) !!}
    <select class="form-control" style='float: left; width: 160px;' id="validadores" name="tipo_input">
        <option value="unico">Único</option>
        <option value="email">E-mail</option>
        <option value="cpf">CPF</option>
    </select>
    <a id='add_validator' style='width: 40px;float: left;' class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i></a>
    {!! Form::text('validador', null, ['class' => 'form-control', 'style' => 'float: left; width: calc(100% - 210px);margin-left: 10px;']) !!}
</div>

<!-- Tipo Input Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tipo_input', 'Tipo Input:') !!}
    {!! Form::select('tipo_input', ['Text' => 'Text','Select' => 'Select','Checked' => 'Checked'], null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('campos.index') !!}" class="btn btn-default">Cancel</a>
</div>


<script>
$(document).ready(function() {
    $("#add_validator").click(function() {
        $("#validadores option:selected").val();
        if( $("#validador").val() == "")
            $("#validador").val( $("#validadores option:selected").val() );
        else
            $("#validador").val( $("#validador").val() + "," + $("#validadores option:selected").val() );
    });
});
</script>