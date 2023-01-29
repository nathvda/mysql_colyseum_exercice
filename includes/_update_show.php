<?php

function editingShow(){
    include '../validators/ShowValidator.php';
    
    $sw = new ShowValidator($_POST);
    $sw = $sw->update_show();

    if (count($sw) === 0){
        header('Location: ../public/index.php');
        exit();
    } else {
        var_dump($sw);
    }

}

if(isset($_POST['submit'])){
    editingShow();


}
