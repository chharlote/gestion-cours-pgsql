<?php

if (isset($_POST['create'])) {
    header('Location: index.php?element=epreuves&action=add');
    exit();
}

if (isset($_POST['list'])) {

    header('Location: index.php?element=epreuves&action=list');
    exit();
}



