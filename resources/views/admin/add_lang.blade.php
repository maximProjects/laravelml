@extends('layouts.admin')

@section('content')
    <?php if ($errors->first('name')) echo $errors->first('name'); ?><br>
    <?php if ($errors->first('prefix')) echo $errors->first('prefix'); ?><br>
    <?php if ($errors->first('image')) echo $errors->first('image'); ?><br>

    {!! Form::open(array('url' => 'en/admin/saveNewLang/', 'method' => 'put', 'files' => true)) !!}
    {!! csrf_field() !!}

    <div class="col-md-12">
        {!! Form::file('image') !!}
    </div>

    <div class="col-md-12">
        {!! Form::label('Name', 'Name') !!}
        {!! Form::text('name') !!}
    </div>

    <div class="col-md-12">
        {!! Form::label('Prefix', 'Prefix') !!}
        {!! Form::text('prefix') !!}
    </div>

    <div class="col-md-12">
        {!! Form::label('Visible', 'Visible') !!}
        {!! Form::checkbox('visible') !!}
    </div>

    <div>
        {!! Form::submit('Save') !!}
    </div>
    {!! Form::close() !!}
@endsection