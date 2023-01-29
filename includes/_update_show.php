<?php

function editingShow(){
    include '../controller/showscontr.php';
    
    $sw = new Showscontr();
    $sw = $sw->editShow($_POST);
}

if(isset($_POST['submit'])){
    editingShow();

    header('Location: ../public/index.php');
    exit();
}
