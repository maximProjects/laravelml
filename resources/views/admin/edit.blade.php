<?php
/*
 * Render edit user form
 */
?>
<?php echo $errors->first('name'); ?><br>
<?php echo $errors->first('email'); ?><br>
<?php echo $errors->first('image'); ?><br>
{!! Form::open(array('url' => '/admin/save/'.$user->id, 'method' => 'put', 'files' => true)) !!}
    {!! csrf_field() !!}
    <?php
    $image_name = "no-photo.gif";
    if (!empty($user->picture_id)) {
        $image_name = $user->picture_id;
    }
    ?>
        <img width="100px" src="<?= url('admin/image', array('filename' => $image_name)) ?>" />
        <hr>
    {!! Form::file('image') !!}
    <div class="col-md-6">
        {!! Form::label('country_id', 'Country') !!}
        <?= Form::select('country_id', $countries, $user->country_id) ?>
    </div>

    <div class="col-md-6">
        {!! Form::label('Name', 'Name') !!}
        {!! Form::text('name', $user->name) !!}
    </div>

    <div>
        {!! Form::label('email', 'Email') !!}
        {!! Form::email('email', $user->email) !!}
    </div>


    <div>
        {!! Form::submit('Save') !!}
    </div>
{!! Form::close() !!}