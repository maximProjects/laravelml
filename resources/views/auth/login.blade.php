<?php
/*
 * login page view
 */
?>

{!! Form::open(array('url' => 'en/auth/login', 'method' => 'post')) !!}
    {!! csrf_field() !!}
    <div>
        Email
        {!! Form::email('email', '') !!}
        <?php if ($errors->first('email')) echo "<div>".$errors->first('email')."</div>"; ?>
    </div>

    <div>
        Password
        {!! Form::password('password', '', array('id' => 'password')) !!}
        <?php if ($errors->first('password')) echo "<div>".$errors->first('password')."</div>"; ?>
    </div>

    <div>
        {!! Form::checkbox('remember', 'remember me', false) !!} Remember me
    </div>

    <div>
        {!! Form::submit('Login') !!}
    </div>
{!! Form::close() !!}