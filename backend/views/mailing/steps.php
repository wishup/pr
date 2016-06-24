<ul class="nav nav-tabs">
    <li <?= $step == 1 ? 'class="active"' : '' ?>>
        <a href="<?= $model_id ? '/backend/mailing/update/'.$model_id.'/1' : '#' ?>"> Template </a>
    </li>
    <li <?= $step == 2 ? 'class="active"' : '' ?>>
        <a href="<?= $model_id ? '/backend/mailing/update/'.$model_id.'/2' : '#' ?>"> Users </a>
    </li>
    <li <?= $step == 3 ? 'class="active"' : '' ?>>
        <a href="<?= $model_id ? '/backend/mailing/update/'.$model_id.'/3' : '#' ?>"> Preview </a>
    </li>
    <li <?= $step == 4 ? 'class="active"' : '' ?>>
        <a href="<?= $model_id ? '/backend/mailing/update/'.$model_id.'/4' : '#' ?>"> Send </a>
    </li>
</ul>