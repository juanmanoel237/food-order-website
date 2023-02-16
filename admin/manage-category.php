<?php include 'partiels/menu.php'; ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1>

        <br /><br /><br />

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if (isset($_SESSION['remove'])) {
            echo $_SERVER['remove'];
            unset($_SESSION['remove']);
        }
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }

        if (isset($_SESSION['no-category-found'])) {
            echo $_SESSION['no-category-found'];
            unset($_SESSION['no-category-found']);
        }

        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }

        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        if (isset($_SESSION['failed-remove'])) {
            echo $_SESSION['failed-remove'];
            unset($_SESSION['failed-remove']);
        }


        ?>

        <br><br>
        <!---- BUTTON TO ADD ADMIN ---->
        <a href="add-category.php" class="btn-primary">Add Category</a>
        <!----END BUTTON TO ADD ADMIN ---->
        <br /><br /><br />

        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Action</th>
            </tr>

            <?php
            $sql = "SELECT * FROM tbl_category";

            $res = mysqli_query($connex, $sql);

            //Compter les lignes
            $count = mysqli_num_rows($res);

            $sn = 1;

            //Vérifier si on a des données dans la base de données
            if ($count > 0) {
                //Données disponibles
                //Récupérer et afficher les données
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];

            ?>

            <tr>
                <td><?php echo $sn++; ?></td>
                <td><?php echo $title; ?></td>

                <td>
                    <?php
                            //Vérifier si le nom de l'image est dispo
                            if ($image_name != "") {
                                //Afficher l'image
                            ?>
                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="100px" alt="">
                    <?php
                            } else {
                                //Afficher message
                                echo "<div class='error'>Image not Added.</div>";
                            }
                            ?>
                </td>

                <td><?php echo $featured; ?></td>
                <td><?php echo $active; ?></td>
                <td>
                    <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>"
                        class="btn-secondary">Update Category</a>
                    <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>"
                        class="btn-danger">Delete Category</a>
                </td>
            </tr>

            <?php


                }
            } else {
                //On n'a pas de données
                //On va afficher le méssage dans la table
                ?>
            <tr>
                <td colspan="6">
                    <div class="error">No Category Added.
                </td>

            </tr>
            <?php

            }

            ?>




        </table>
    </div>
</div>

<?php include 'partiels/footer.php'; ?>