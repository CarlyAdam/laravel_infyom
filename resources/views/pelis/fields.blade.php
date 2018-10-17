<!-- Cines Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cines_id', 'Cine:') !!}
    {!! Form::select('cines_id', $cinesArray, null, ['class' => 'form-control']) !!}

</div>

<!-- Nombre Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
</div>

<!-- Descripcion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('descripcion', 'Descripcion:') !!}
    {!! Form::text('descripcion', null, ['class' => 'form-control']) !!}
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('pelis.index') !!}" class="btn btn-default">Cancel</a>
</div>
