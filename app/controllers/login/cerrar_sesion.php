<?php


include ('../../config.php');
global $URL;

session_start();
if(isset($_SESSION['sesion_email'])){
    session_destroy();
    header('Location: '.$URL.'/');
}
