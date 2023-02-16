<?php include('partiels/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>
        <?php

        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }

        ?>
        <br><br>
        <!-- Formulaire-->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>
                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
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
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <!-- fin  -->
        <?php

        //VÉRIFIEZ si le bouton Soumettre est cliqué ou non
        if (isset($_POST['submit'])) {
            //echo "Clicked";
            //1. Obtenir la valeur du formulaire de catégorie
            $title = $_POST['title'];
            //pour l'entrée Radio, nous devons vérifier si le bouton est sélectionné ou non
            if (isset($_POST['featured'])) {
                //Obtenir la valeur du formulaire
                $featured = $_POST['featured'];
            } else {
                //Définir la valeur par défaut
                $featured = "No";
            }
            if (isset($_POST['active'])) {
                $active = $_POST['active'];
            } else {
                $active = "No";
            }
            //Vérifiez si l'image est sélectionnée ou non et définissez la valeur du nom de l'image en conséquence

            if (isset($_FILES['image']['name'])) {
                //Télécharger l'image
                //Pour télécharger l'image, nous avons besoin du nom de l'image, du chemin source et du chemin de destination
                $image_name = $_FILES['image']['name'];

                //Upload image seulement si l'image est choisie
                if ($image_name != "") {


                    //Renommer automatiquement notre image
                    //Obtenir l'extension de notre image (jpg, png, gif,etc)
                    $ext = end(explode('.', $image_name));

                    //Rename image
                    $image_name = "Food_Category_" . rand(000, 999) . '.' . $ext; // e.g Food_Category_834.jpg

                    $source_path = $_FILES['image']['tmp_name'];

                    $destination_path = "../images/category/" . $image_name;


                    
                    $upload = move_uploaded_file($source_path, $destination_path);

                    //Vérifier si l'image est téléchargée ou non
                    // Et si l'image n'est pas téléchargée, nous arrêterons le processus et redirigerons avec un message d'erreur
                    if ($upload == false) {
                        
                        $_SESSION['upload'] = "<div class='error'>Failed to Upload Image. </div>";
                       
                        header('location:' . SITEURL . 'admin/add-category.php');
                       
                        die();
                    }
                }
            } else {
                // Ne pas télécharger l'image et définir la valeur image_name comme vide
                $image_name = "";
            }

            //2. Créer une requête SQL pour insérer une catégorie dans la base de données
            $sql = "INSERT INTO tbl_category SET 
                    title='$title',
                    image_name='$image_name',
                    featured='$featured',
                    active='$active'
                ";
            //3. Exécuter la requête et enregistrer dans la base de données
            $res = mysqli_query($connex, $sql);

            //4. Vérifier si la requête s'est exécutée ou non et si les données ont été ajoutées ou non
            if ($res == true) {
                
                $_SESSION['add'] = "<div class='success'>Category Added Successfully.</div>";
                
                header('location:' . SITEURL . 'admin/manage-category.php');
            } else {
                
                $_SESSION['add'] = "<div class='error'>Failed to Add Category.</div>";
                
                header('location:' . SITEURL . 'admin/add-category.php');
            }
        }

        ?>
    </div>
</div>
<?php include('partiels/footer.php'); ?>