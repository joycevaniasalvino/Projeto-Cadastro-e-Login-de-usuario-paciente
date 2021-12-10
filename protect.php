<?php
    if(!isset($_SESSION)){
        session_start();
    }

    if(!isset($_SESSION['id'])){
        $_SESSION['error'] = "Você não pode acessar esta página sem realizar login ou cadastro.";
        header("Location: login.php");
    }
?>