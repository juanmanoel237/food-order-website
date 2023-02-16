<?php include('partiels/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>

        <br><br>


        <?php

        //Vérifier si l'ID est défini ou pas
        if (isset($_GET['id'])) {
            //Récupérer l'ID et les détails

            $id = $_GET['id'];
            //Requête SQL
            $sql = "SELECT * FROM tbl_category WHERE id=$id";

            //Exécuter la requête
            $res = mysqli_query($connex, $sql);

            //Compter les lignes pour vérifier que l'id est valid ou pas
            $count = mysqli_num_rows($res);

            if ($count == 1) {
                //Récupérer les Données
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $current_image = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];
            } else {
                //Redirection vers manage catégories
                $_SESSION['no-category-found'] = "<div class='error'>Category not Found.</div>";
                header('location:' . SITEURL . 'admin/manage-category.php');
            }
        } else {

            header('location:' . SITEURL . 'admin/manage-category.php');
        }

        ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                        if ($current_image != "") {
                            //Afficher l'image
                        ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150px">
                        <?php
                        } else {
                            //AFFICHER LE MESSAGE
                            echo "<div class='error'>Image Not Added.</div>";
                        }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>New Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if ($featured == "Yes") {
                                    echo "checked";
                                } ?> type="radio" name="featured" value="Yes"> Yes

                        <input <?php if ($featured == "No") {
                                    echo "checked";
                                } ?> type="radio" name="featured" value="No"> No
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
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

        <?php

        if (isset($_POST['submit'])) {
            //1. Récupérer les valeurs du formulaire
            $id = $_POST['id'];
            $title = $_POST['title'];
            $current_image = $_POST['current_image'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            //2. Mettre à jour nouvel image si elle est selectionnée
            //Vérifier si nouvelle image est selectionnée
            if (isset($_FILES['image']['name'])) {
                //Récupérer les détails de l'image
                $image_name = $_FILES['image']['name'];

                //Vérifier si l'image est disponible ou pas
                if ($image_name != "") {
                    //Image dispo

                    //A. UPload nouvelle image
                    //Auto renommer l'image
                    //Récupére l'extension de notre image (jpg, png, gif, etc) e.g. "specialfood1.jpg"
                    $ext = end(explode('.', $image_name));

                    //Renommer l'image
                    $image_name = "Food_Category_" . rand(000, 999) . '.' . $ext; // e.g. Food_Category_834.jpg


                    $source_path = $_FILES['image']['tmp_name'];

                    $destination_path = "../images/category/" . $image_name;

                    //Upload l'image
                    $upload = move_uploaded_file($source_path, $destination_path);

                    //Vérifier si l'image est upload

                    if ($upload == false) {

                        $_SESSION['upload'] = "<div class='error'>Failed to Upload Image. </div>";

                        header('location:' . SITEURL . 'admin/manage-category.php');

                        die();
                    }

                    //B. Retirer l'image actuelle si disponible
                    if ($current_image != "") {
                        $remove_path = "../images/category/" . $current_image;

                        $remove = unlink($remove_path);

                        //Vérifier si l'image est retirée
                        //Si echec
                        if ($remove == false) {
                            //Failed to remove image
                            $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current Image.</div>";
                            header('location:' . SITEURL . 'admin/manage-category.php');
                            die(); //Stop the Process
                        }
                    }
                } else {
                    $image_name = $current_image;
                }
            } else {
                $image_name = $current_image;
            }

            //3. Update la base de données
            $sql2 = "UPDATE tbl_category SET 
                    title = '$title',
                    image_name = '$image_name',
                    featured = '$featured',
                    active = '$active' 
                    WHERE id=$id
                ";

            //Executer la requête
            $res2 = mysqli_query($connex, $sql2);

            //4. Redirection vers manage catégories avec message
            //Vérifier si requête exécutée
            if ($res2 == true) {
                //Categorie mise à jour
                $_SESSION['update'] = "<div class='success'>Category Updated Successfully.</div>";
                header('location:' . SITEURL . 'admin/manage-category.php');
            } else {

                $_SESSION['update'] = "<div class='error'>Failed to Update Category.</div>";
                header('location:' . SITEURL . 'admin/manage-category.php');
            }
        }

        ?>

    </div>
</div>

<?php include('partiels/footer.php'); ?>