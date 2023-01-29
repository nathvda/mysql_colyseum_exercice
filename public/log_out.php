<?php
function log_out(){
session_start();

session_destroy();

header('Location: ../public/index.php');
exit;
}

log_out();


?>