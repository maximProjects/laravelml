@extends('layouts.admin')

@section('content')
    <?php if ($errors->first('name')) echo $errors->first('name'); ?><br>
    <?php if ($errors->first('prefix')) echo $errors->first('prefix'); ?><br>
    <?php if ($errors->first('image')) echo $errors->first('image'); ?><br>

    <?php
    $image_name = "no-photo.gif";
    if (!empty($editLang->ico)) {
        $image_name = $editLang->ico;
    }
    ?>
    <img width="20px" src="<?= url('admin/image', array('filename' => $image_name)) ?>" />
    <hr>
    {!! Form::open(array('url' => $curLang->prefix.'/admin/saveEditLang/'.$editLang->id, 'method' => 'put', 'files' => true)) !!}
    {!! csrf_field() !!}

    <div class="col-md-12">
        {!! Form::file('image') !!}
    </div>

    <div class="col-md-12">
        {!! Form::label('Name', 'Name') !!}
        {!! Form::text('name', $editLang->name) !!}
    </div>

    <div class="col-md-12">
        {!! Form::label('Prefix', 'Prefix') !!}
        {!! Form::text('prefix', $editLang->prefix) !!}
    </div>

    <div class="col-md-12">
        {!! Form::label('Visible', 'Visible') !!}
        {!! Form::checkbox('visible', 1, $editLang->visible) !!}
    </div>

    <div>
        {!! Form::submit('Save') !!}
    </div>
    {!! Form::close() !!}
@endsection