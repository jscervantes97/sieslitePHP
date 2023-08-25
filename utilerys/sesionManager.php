<?php
session_start();
if(isset($_SESSION['usuario']) && isset($_SESSION['logeado'])){
    if($_SESSION['logeado'] == "no"){
        header('Location: login.php');
    }
}else{
    header('Location: login.php');
}
