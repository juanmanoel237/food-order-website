<?php
include('../config/constants.php');

//Vérifier si l'id et image_name sont définis 
if (isset($_GET['id']) and isset($_GET['image_name'])) {
    //Récupérer la valeur et supprimer
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    //Retirer l'image physique
    if ($image_name != "") {
        //Image est disponible. Donc on retire
        $path = "../images/category/" . $image_name;
        //Retirer l'image
        $remove = unlink($path);

        if ($remove == false) {
            //Message de session
            $_SESSION['remove'] = "<div class='error>Failed to remove category image.</div>";
            //Redirection
            header('location:' . SITEURL . 'admin/manage-category.php');
        }
    }

    //Supprimer les données de la base de données
    $sql = "DELETE FROM tbl_category WHERE id=$id";

    //Executer la requête
    $res = mysqli_query($connex, $sql);

    //Vérifier si les données sont supprimées de la BDD
    if ($res == true) {
        $_SESSION['delete'] = "<div class='success'>Category deleted successfully.</div>";
        //Redirection
        header('location:' . SITEURL . 'admin/manage-category.php');
    }

    //Redirection 
} else {
    $_SESSION['delete'] = "<div class='error'>Failed to delete category.</div>";
    //rediriger vers la page manage category
    header('location :' . SITEURL . 'admin/manage-category.php');
}