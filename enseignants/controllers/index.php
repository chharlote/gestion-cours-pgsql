<?php

if (isset($_POST['create'])) {
    header('Location: index.php?element=enseignants&action=add');
    exit();
}

if (isset($_POST['list'])) {

    header('Location: index.php?element=enseignants&action=list');
    exit();
}



