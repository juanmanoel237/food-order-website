<?php
include('../config/constants.php');

//1. Récupérer l'Id de l'admin qu'on supprime
$id = $_GET['id'];

//2. Créer la requete SQL qui supprime l'ADMIN
$sql = "DELETE FROM tbl_admin WHERE id=$id";

//Executer la requete
$res = mysqli_query($connex, $sql);

//Verifier si la requete a ete executée correctement
if ($res == TRUE) {
    //Requete executee avec succes et ADMIN supprimé
    //echo "Admin supprimé";
    //Créer une SESSION pour afficher le message
    $_SESSION['delete'] = '<div class="success">Admin supprimé</div>';
    //Redirection vers Manage Admin
    header('location:' . SITEURL . 'admin/manage-admin.php');
} else {
    //Echec de la suppression
    //echo "Echec de la suppression";
    $_SESSION['delete'] = '<div class="error">Echec de la suppression</div>';
    header('location:' . SITEURL . 'admin/manage-admin.php');
}

//3. Redirection vers la page ADMIN avec Message (Succes ou Erreur)