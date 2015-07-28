@extends('layouts.admin')

@section('content')
    <?php if ($errors->first('name')) echo $errors->first('name'); ?><br>

    {!! Form::open(array('url' => $curLang->prefix.'/admin/saveEditLabel/'.$editLabel->id, 'method' => 'put', 'files' => true)) !!}
    {!! csrf_field() !!}

    <div class="col-md-12">
        {!! Form::label('Name', 'Name') !!}
        {!! Form::text('name', $editLabel->name) !!}
    </div>
    <h3>Set translations</h3>
    @foreach ($langs as $lang)
        <div class="col-md-12">
            {!! Form::label('Lang', $lang->prefix) !!}
            {!! Form::text($lang->prefix, $trlsArr[$lang->id]) !!}
        </div>
    @endforeach
    <div>
        {!! Form::submit('Save') !!}
    </div>
    {!! Form::close() !!}
@endsection