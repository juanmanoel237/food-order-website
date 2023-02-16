<?php include('partiels/menu.php'); ?>

<?php
//Vérifier si l'ID est défini  
if (isset($_GET['id'])) {
    //Récupérer tous les détails
    $id = $_GET['id'];

    //Requête SQL pour récupérer la nourriture choisie
    $sql2 = "SELECT * FROM tbl_food WHERE id=$id";
    //executer la requête
    $res2 = mysqli_query($connex, $sql2);

    //Récupérer la valeur selon la requête exécutée
    $row2 = mysqli_fetch_assoc($res2);

    //Récupérer les valeurs individuelles de la nourriture sélectionnée
    $title = $row2['title'];
    $description = $row2['description'];
    $price = $row2['price'];
    $current_image = $row2['image_name'];
    $current_category = $row2['category_id'];
    $featured = $row2['featured'];
    $active = $row2['active'];
} else {
    //Redirection vers "Manage food"
    header('location:' . SITEURL . 'admin/manage-food.php');
}
?>


<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">

                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                        if ($current_image == "") {
                            //Image indisponible
                            echo "<div class='error'>Image not Available.</div>";
                        } else {
                            //Image disponible
                        ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="150px">
                        <?php
                        }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>Select New Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">

                            <?php
                            //Requête pour récupérer les Catégories Actives
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                            //Executer la requête
                            $res = mysqli_query($conn, $sql);
                            //Compter les lignes
                            $count = mysqli_num_rows($res);

                            //Vérifier si la catégorie est dispo
                            if ($count > 0) {
                                //Catégorie disponible
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $category_title = $row['title'];
                                    $category_id = $row['id'];

                                    //echo "<option value='$category_id'>$category_title</option>";
                            ?>
                                    <option <?php if ($current_category == $category_id) {
                                                echo "selected";
                                            } ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?>
                                    </option>
                            <?php
                                }
                            } else {
                                //Catégorie indisponible
                                echo "<option value='0'>Category Not Available.</option>";
                            }

                            ?>

                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if ($featured == "Yes") {
                                    echo "checked";
                                } ?> type="radio" name="featured" value="Yes">
                        Yes
                        <input <?php if ($featured == "No") {
                                    echo "checked";
                                } ?> type="radio" name="featured" value="No">
                        No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if ($active == "Yes") {
                                    echo "checked";
                                } ?> type="radio" name="active" value="Yes"> Yes
                        <input <?php if ($active == "No") {
                                    echo "checked";
                                } ?> type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">

                        <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

        <?php

        if (isset($_POST['submit'])) {
            //echo "Button Clicked";

            //1. Get tous les détails du formulaire
            $id = $_POST['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $current_image = $_POST['current_image'];
            $category = $_POST['category'];

            $featured = $_POST['featured'];
            $active = $_POST['active'];

            //2. Upload l'image si sélectionnée

            //vérifier qu'on clique sur le button Upload
            if (isset($_FILES['image']['name'])) {
                //Button cliqué
                $image_name = $_FILES['image']['name']; //Nouveau nom d'image

                //Vérifier si le fichier est disponible ou pas
                if ($image_name != "") {
                    //IMage disponible
                    //A. Uploa nouvelle image
                    $tmp = explode('.', $image_name);
                    //enommer l'image
                    $ext = end($tmp); //Récupérer l'extension de l'image

                    $image_name = "Food-Name-" . rand(0000, 9999) . '.' . $ext; //Ceci sera renommé

                    //Récupérer la source et la destination
                    $src_path = $_FILES['image']['tmp_name']; //Source Path
                    $dest_path = "../images/food/" . $image_name; //DEstination Path

                    //Upload l'image
                    $upload = move_uploaded_file($src_path, $dest_path);

                    /// Vérifier si l'image est upload
                    if ($upload == false) {
                        //Echec
                        $_SESSION['upload'] = "<div class='error'>Failed to Upload new Image.</div>";
                        //REdirection vers Manage-food
                        header('location:' . SITEURL . 'admin/manage-food.php');
                        //Stop le process
                        die();
                    }
                    //3. Retirer l'image si nouvelle image est upload et image actuelle existent
                    //B. Retirer image actuelle si elle existe
                    if ($current_image != "") {
                        //Image actuelle existe
                        //Retirer l'image
                        $remove_path = "../images/food/" . $current_image;

                        $remove = unlink($remove_path);

                        //Vérifier si l'image est retirée 
                        if ($remove == false) {
                            //Echec
                            $_SESSION['remove-failed'] = "<div class='error'>Faile to remove current image.</div>";
                            //redirection vers manage-food
                            header('location:' . SITEURL . 'admin/manage-food.php');
                            //stop
                            die();
                        }
                    }
                } else {
                    $image_name = $current_image; //Image par défaut si l'image n'est pas selectionnée
                }
            } else {
                $image_name = $current_image; //Image par défaut si le button n'est pas cliqué
            }



            //4. Mettre à jour la nourriture dans la base de données
            $sql3 = "UPDATE tbl_food SET 
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = '$category',
                    featured = '$featured',
                    active = '$active'
                    WHERE id=$id
                ";

            //Exécuter la requête
            $res3 = mysqli_query($connex, $sql3);

            //Vérifier si la requête est exécutée
            if ($res3 == true) {
                //Requête exécutée
                $_SESSION['update'] = "<div class='success'>Food Updated Successfully.</div>";
                header('location:' . SITEURL . 'admin/manage-food.php');
            } else {
                //Echec
                $_SESSION['update'] = "<div class='error'>Failed to Update Food.</div>";
                header('location:' . SITEURL . 'admin/manage-food.php');
            }
        }

        ?>

    </div>
</div>

<?php include('partiels/footer.php'); ?>