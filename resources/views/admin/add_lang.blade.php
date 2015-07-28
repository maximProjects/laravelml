@extends('layouts.admin')

@section('content')
    {!! Form::open(array('url' => $curLang->prefix.'/admin/saveNewLang/', 'method' => 'put', 'files' => true)) !!}
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
        {!! Form::email('prefix') !!}
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