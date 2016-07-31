<div class="form-group">
    {!! Form::label('Name', 'Name: ') !!}
    {!! Form::text('user[name]', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('Email', 'Email: ') !!}
    {!! Form::text('user[email]', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('Phone', 'Phone: ') !!}
    {!! Form::text('phone', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('Address', 'Address: ') !!}
    {!! Form::textarea('address', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('City', 'City: ') !!}
    {!! Form::text('city', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('State', 'State: ') !!}
    {!! Form::text('state', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('Zipcode', 'Zipcode: ') !!}
    {!! Form::text('zipcode', null, ['class' => 'form-control']) !!}
</div>