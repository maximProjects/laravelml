@extends('layouts.admin')

@section('content')
    <h1>Translations admininstration</h1>
    <a href="<?= url($curLang->prefix.'/admin/addLabel') ?>">Add Label</a>
    <table border="1">
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Actions</th>
        </tr>
        @foreach ($labels as $label)

            <tr>
                <td>{{ $label->id }}</td>
                <td>{{ $label->name }}</td>
                <td>
                    <?php
                    //if ($user->id != $one_user->id) {
                    ?>
                    <a href="<?= url($curLang->prefix.'/admin/deleteLabel/'.$label->id); ?>">Delete</a> |
                    <?php
                    //}
                    ?>
                    <a href="<?= url($curLang->prefix.'/admin/editLabel/'.$label->id); ?>">Edit</a>
                </td>
            </tr>
        @endforeach
    </table>
@endsection