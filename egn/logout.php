<?php

session_start();

if(isset($_SESSION['eng_userid']))
{
    $_SESSION['eng_userid'] = NULL;
    unset($_SESSION['eng_userid']);
    unset($_SESSION['USER']);
    setcookie('eng_userid','',time()-(9000));
}

header("Location: login.php");
die;

?>