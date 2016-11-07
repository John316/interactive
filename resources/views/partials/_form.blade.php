<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('desc', 'Description:') !!}
    {!! Form::textarea('desc', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::text('status', 1, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('active_from', 'Active from:') !!}
    {!! Form::input('date', 'active_from', date('Y-m-d'), ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('active_to', 'Active to:') !!}
    {!! Form::input('date', 'active_to', date('Y-m-d'), ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::submit($nameOfSubmitBtn, ['class' => 'btn btn-primary form-control']) !!}
</div>