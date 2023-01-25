<?php
//Autorisation

if (!isset($_SESSION['user'])) //Si la session utilisitaer n'est pas SET
{
    //User n'est pas logged in
    //Redirection vers la page avec message
    $_SESSION['no-login-message'] = "<div class = 'error'>Please login to access Admin Panel.</div>";
    //Redirection
    header('location:' . SITEURL . 'admin/login.php');
}