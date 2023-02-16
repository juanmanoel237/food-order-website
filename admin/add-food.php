<?php include 'partiels/menu.php'; ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>

        <br><br>

        <?php
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">

                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the Food">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description of the Food."></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">

                            <?php

                            //1. Requête SQL pour récupérer les catégories actives
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                            //Execution de la requête
                            $res = mysqli_query($connex, $sql);

                            //Compter les lignes pour vérifier les catégories disponibles
                            $count = mysqli_num_rows($res);
                            if ($count > 0) {
                                //Catégories disponibles
                                while ($row = mysqli_fetch_assoc($res)) {
                                    //Récupérer les détails de la catégorie
                                    $id = $row['id'];
                                    $title = $row['title'];

                            ?>

                                    <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                                <?php
                                }
                            } else {
                                //Catégorie indisponible
                                ?>
                                <option value="0">No Category Found</option>
                            <?php
                            }


                            //2. Afficher sur le menu déroulant
                            ?>

                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>


        <?php

        //Vérifier si on clique sur le button ou pas
        if (isset($_POST['submit'])) {
            //Ajouter la nourriture à la BDD
            //echo "Clicked";

            //1. Récupérer les données du form
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];

            //Vérifier si les buttons radios ACTIVES ET FEATURE sont cochés
            if (isset($_POST['featured'])) {
                $featured = $_POST['featured'];
            } else {
                $featured = "No"; //Mettre la valeur par défaut
            }

            if (isset($_POST['active'])) {
                $active = $_POST['active'];
            } else {
                $active = "No"; //Mettre la valeur par défaut
            }

            //2. Upload image si selectionnée
            //Vérifiez si l'image sélectionnée est cliquée ou non et téléchargez l'image uniquement si l'image est sélectionnée
            if (isset($_FILES['image']['name'])) {
                //Obtenir les détails de l'image sélectionnée
                $image_name = $_FILES['image']['name'];

                //Vérifiez si l'image est sélectionnée ou non et téléchargez l'image uniquement si elle est sélectionnée
                if ($image_name != "") {
                    // Image selectionnées
                    //A. Renommer l'image
                    //Récupérer l'extension (jpg, png, gif, etc.) "vijay-thapa.jpg" vijay-thapa jpg
                    $ext = end(explode('.', $image_name));

                    // Créer nouveau nom pour l'Image
                    $image_name = "Food-Name-" . rand(0000, 9999) . "." . $ext; //New Image Name May Be "Food-Name-657.jpg"

                    //B. Upload l'image
                    //Récupérer la source et destination de l'image

                    // Le chemin source est l'emplacement actuel de l'image
                    $src = $_FILES['image']['tmp_name'];

                    //Chemin de destination pour l'image à télécharger
                    $dst = "../images/food/" . $image_name;


                    $upload = move_uploaded_file($src, $dst);

                    //Vérifier si l'image est upload ou pas
                    if ($upload == false) {
                        //Echec

                        $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                        header('location:' . SITEURL . 'admin/add-food.php');

                        die();
                    }
                }
            } else {
                $image_name = ""; //Valeur par défaut vide
            }

            //3. Inserer dans la base de données

            //Créer une requête SQL pour enregistrer ou ajouter des aliments

            $sql2 = "INSERT INTO tbl_food SET 
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = $category,
                    featured = '$featured',
                    active = '$active'
                ";

            //Executer la requête
            $res2 = mysqli_query($connex, $sql2);

            //Vérifier si les données sont insérées
            //4. Redirection
            if ($res2 == true) {
                //Données insérées avec success
                $_SESSION['add'] = "<div class='success'>Food Added Successfully.</div>";
                header('location:' . SITEURL . 'admin/manage-food.php');
            } else {
                //Echec insertion
                $_SESSION['add'] = "<div class='error'>Failed to Add Food.</div>";
                header('location:' . SITEURL . 'admin/manage-food.php');
            }
        }

        ?>


    </div>
</div>

<?php include('partiels/footer.php'); ?>