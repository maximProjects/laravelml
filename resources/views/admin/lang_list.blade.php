@extends('layouts.admin')

@section('content')
    <h1>Language admininstration</h1>
    <a href="<?= url($curLang->prefix.'/admin/addLang') ?>">Add Language</a>
    <table border="1">
        <tr>
            <th>Id</th>
            <th>ico</th>
            <th>Prefix</th>
            <th>Name</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        @foreach ($langs as $lang)

        <tr>
            <td>{{ $lang->id }}</td>
            <td>

                <?php

                $img_name = 'no-photo.gif';
                if (!empty($lang->ico)) {
                    $img_name = $lang->ico;
                }
                ?>
                <img width="20px" src="<?= url('admin/image', array('filename' => $img_name)) ?>" />

            </td>
            <td>{{ $lang->prefix }}</td>
            <td>{{ $lang->name }}</td>
            <td>{{ $lang->visible }}</td>
            <td>
                <?php
                //if ($user->id != $one_user->id) {
                ?>
                <a href="<?= url($curLang->prefix.'/admin/deleteLang/'.$lang->id); ?>">Delete</a> |
                <?php
                //}
                ?>
                <a href="<?= url($curLang->prefix.'/admin/editLang/'.$lang->id); ?>">Edit</a>
            </td>
        </tr>
        @endforeach
    </table>
@endsection