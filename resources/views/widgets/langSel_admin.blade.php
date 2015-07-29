<?php
/**
 * render languages dropdown in menu
 */
?>
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{TrlHelper::t()->curLang()->name}} <span class="caret"></span></a>
    <ul class="dropdown-menu">
        @foreach (TrlHelper::t()->getLangArr() as $lang)
            <li><a href="/<?= $lang->prefix ?>/admin">{{ $lang->name }}</a></li>
        @endforeach
    </ul>
</li>