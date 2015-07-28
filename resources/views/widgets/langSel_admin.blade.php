<?php
/**
 * render languages dropdown in menu
 */
?>
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $curLang->name; ?> <span class="caret"></span></a>
    <ul class="dropdown-menu">
        @foreach ($langs as $lang)
            <li><a href="/<?= $lang->prefix ?>/admin">{{ $lang->name }}</a></li>
        @endforeach
    </ul>
</li>