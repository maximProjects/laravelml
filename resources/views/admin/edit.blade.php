<?php
/*
 * Render edit user form
 */
?>
@extends('layouts.admin')

@section('content')
    <?php echo $errors->first('name'); ?><br>
    <?php echo $errors->first('email'); ?><br>
    <?php echo $errors->first('image'); ?><br>
    {!! Form::open(array('url' => 'en/admin/save/'.$user->id, 'method' => 'put', 'files' => true)) !!}
        {!! csrf_field() !!}
        <?php
        $image_name = "no-photo.gif";
        if (!empty($user->picture_id)) {
            $image_name = $user->picture_id;
        }
        ?>
            <img width="100px" src="<?= url('admin/image', array('filename' => $image_name)) ?>" />
            <hr>
        <div class="col-md-12">
        {!! Form::file('image') !!}
        </div>
        <div class="col-md-12">
            {!! Form::label('country_id', 'Country') !!}
            <?= Form::select('country_id', $countries, $user->country_id) ?>
        </div>

        <div class="col-md-12">
            {!! Form::label('Name', 'Name') !!}
            {!! Form::text('name', $user->name) !!}
        </div>

        <div class="col-md-12">
            {!! Form::label('email', 'Email') !!}
            {!! Form::email('email', $user->email) !!}
        </div>


        <div>
            {!! Form::submit('Save') !!}
        </div>
    {!! Form::close() !!}
@endsection