<?php

//Include Constants Page
include('../config/constants.php');

//echo "Delete Food Page";

if (isset($_GET['id']) && isset($_GET['image_name'])) //Utiliser '&&' ou 'AND'
{
    //Process pour supprimer

    //1.  Get ID ET Image NAme
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    //2. Retirer l'image si elle est disponible
    //Vérifier si l'image est disponoible ou pas ET supprimer seulement si disponible
    if ($image_name != "") {
        //Image disponible et doit être supprimée du dossier
        //Récupérer le path de l'image
        $path = "../images/food/" . $image_name;

        //Retirer l'image du fichier
        $remove = unlink($path);

        //Vérifier si l'image a été supprimée ou pas
        if ($remove == false) {
            //Echec dee la suppression
            $_SESSION['upload'] = "<div class='error'>Failed to Remove Image File.</div>";
            //REdirection vers Manage Food
            header('location:' . SITEURL . 'admin/manage-food.php');
            //Stop le processus
            die();
        }
    }

    //3. Supprimer Food de le BDD
    $sql = "DELETE FROM tbl_food WHERE id=$id";
    //Executer la requête
    $res = mysqli_query($connex, $sql);

    //Vérifier si la requête est éxécutée et afficher le message
    //4. Rediriger vers Manage food
    if ($res == true) {
        //Food supprimé
        $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully.</div>";
        header('location:' . SITEURL . 'admin/manage-food.php');
    } else {
        //ECHEC DE LA SUPPRESSION
        $_SESSION['delete'] = "<div class='error'>Failed to Delete Food.</div>";
        header('location:' . SITEURL . 'admin/manage-food.php');
    }
} else {
    //Redirection vers manage food
    $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
    header('location:' . SITEURL . 'admin/manage-food.php');
}