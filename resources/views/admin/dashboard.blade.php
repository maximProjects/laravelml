@extends('layouts.admin')

@section('content')
<h1>Users admininstration</h1>
<table border="1">
    <tr>
        <th>Id</th>
        <th>Image</th>
        <th>Name</th>
        <th>Email</th>
        <th>Actions</th>
    </tr>
    <?php
    foreach ($users as $one_user) {
    ?>
        <tr>
            <td><?= $one_user->id ?></td>
            <td>
                <?php
                    $img_name = 'no-photo.gif';
                    if (!empty($one_user->picture_id)) {
                        $img_name = $one_user->picture_id;
                    }
                ?>
                <img width="100px" src="<?= url('admin/image', array('filename' => $img_name)) ?>" />

            </td>
            <td><?= $one_user->name ?></td>
            <td><?= $one_user->email ?></td>
            <td>
                <?php
                if (Auth::user()->id != $one_user->id) {
                ?>
                <a href="<?= url('en/admin/delete/'.$one_user->id); ?>">Delete</a> |
                <?php
                }
                ?>
                <a href="<?= url('en/admin/edit/'.$one_user->id); ?>">Edit</a>
            </td>
        </tr>
    <?php
    }
    ?>
    <?= $users->render() ?>
</table>
@endsection