<?php include 'partiels/menu.php'; ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Food</h1>

        <br /><br /><br />

        <!---- BUTTON TO ADD ADMIN ---->
        <a href="<?php echo SITEURL ?>admin/add-food.php" class="btn-primary">Add Food</a>
        <!----END BUTTON TO ADD ADMIN ---->
        <br /><br /><br />

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }

        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }

        if (isset($_SESSION['unauthorized'])) {
            echo $_SESSION['unauthorized'];
            unset($_SESSION['unauthorized']);
        }
        if (isset($_SESSION['remove-failed'])) {
            echo $_SESSION['remove-failed'];
            unset($_SESSION['remove-failed']);
        }
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        ?>

        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
            <?php
            //Créer requete sql pour récupérer les foods
            $sql = "SELECT * FROM tbl_food";

            //Exécuter la requête
            $res = mysqli_query($connex, $sql);

            //compter les lignes pour vérifier si on a la nourriture ou pas
            $count = mysqli_num_rows($res);

            $sn = 1;

            if ($count > 0) {
                //On a trouvé la nourriture
                //Récupérer et afficher
                while ($row = mysqli_fetch_assoc($res)) {
                    //Récupérer les valeurs individuellements
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $image_name = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
            ?>
            <tr>
                <td><?php echo $sn++; ?></td>
                <td><?php echo $title; ?></td>
                <td><?php echo $price; ?></td>
                <td> <?php
                                //Vérifier si on a l'image ou pas
                                if ($image_name == "") {
                                    //Image indisponible afficher message d'erreur
                                    echo "<div class='error'>Image not Added.</div>";
                                } else {
                                    //
                                ?>
                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="100px">
                    <?php
                                }
                            ?>
                <td><?php echo $featured; ?></td>
                <td><?php echo $active; ?></td>
                <td>
                    <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>"
                        class="btn-secondary">Update Food</a>
                    <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>"
                        class="btn-danger">Delete Food</a>
                </td>
            </tr>

            <?php
                }
            } else {

                echo "<tr> <td colspan='7' class='error'>Food not added yet.</td></tr>";
            }

            ?>


        </table>
    </div>
</div>

<?php include 'partiels/footer.php'; ?>