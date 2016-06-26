<div class="form-group">
    {!! Form::label('Category', 'Category: ') !!}
    {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('Name', 'Name: ') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('Description', 'Description: ') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('Price', 'Price: ') !!}
    {!! Form::text('price', null, ['class' => 'form-control']) !!}
</div>