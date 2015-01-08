<?php 
session_start();
session_unset();
    $_SESSION['FBID'] = NULL;
    $_SESSION['USERNAME'] = NULL;
    $_SESSION['FULLNAME'] = NULL;
    $_SESSION['EMAIL'] =  NULL;
    $_SESSION['BIRTHDAY'] =  NULL;
    $_SESSION['LOCATION'] =  NULL;
    $_SESSION['PICTURE'] = NULL;
    $_SESSION['LOGOUT'] = NULL;
session_destroy();
header("Location: .");        
?>
