<?php

//Start session
session_start();



//Créer des constantes pour ne pas répéter des valeurs
define('SITEURL', 'http://localhost/food-order/');
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'food-order');

$connex = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($connex)); //Connexion  à la bdd
$db_select = mysqli_select_db($connex, DB_NAME) or die(mysqli_error($connex)); //Selection de la bdd