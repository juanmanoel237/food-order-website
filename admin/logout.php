<?php
// Inclure constants.php pour SITEURL
include('../config/constants.php');
//1. Ecraser la session
session_destroy(); //Unset $_SESSION['user']

//2. Rediriger vers la page Login
header('location:' . SITEURL . 'admin/login.php');