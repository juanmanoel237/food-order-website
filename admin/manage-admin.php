<?php
include 'partiels/menu.php';
?>

<!-- Main-->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Admin</h1>
        <br /><br /><br />

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add']; // Afficher le message de session
            unset($_SESSION['add']); // Retirer le message de session
        }
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        if (isset($_SESSION['user-not-found'])) {
            echo $_SESSION['user-not-found'];
            unset($_SESSION['user-not-found']);
        }
        if (isset($_SESSION['pwd-not-match'])) {
            echo $_SESSION['pwd-not-match'];
            unset($_SESSION['pwd-not-match']);
        }
        if (isset($_SESSION['change-pwd'])) {
            echo $_SESSION['change-pwd'];
            unset($_SESSION['change-pwd']);
        }
        ?>
        <br /><br />

        <!---- BUTTON TO ADD ADMIN ---->
        <a href="add-admin.php" class="btn-primary">Add Admin</a>
        <!----END BUTTON TO ADD ADMIN ---->
        <br /><br /><br />

        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>

            <?php
            // Requête SQL pour récupérer les admins
            $sql = "SELECT * FROM tbl_admin";
            //Execution de la REQUÊTE 
            $res = mysqli_query($connex, $sql);

            //VERIFIER SI LA REQUETE EST EXECUTE
            if ($res == TRUE) {
                //Compte les lignes pour savoir si il y a des données dans la BDD ou pas
                $count = mysqli_num_rows($res); // Function pour obtenir toutes les lignes

                $sn = 1; //CREER une variable ET lui ASSIGNER la VALEUR

                //Verrifier le nombre de lignes
                if ($count > 0) {
                    //Il y a des données dans la BDD
                    while ($rows = mysqli_fetch_assoc($res)) {
                        //On utilise la boucle "tant que" pour récupérer les données de la BDD
                        //ET la Boucle sera executer aussi longtemps qu'il y aura des données

                        //Récupérer les données individuellement
                        $id = $rows['id'];
                        $full_name = $rows['full_name'];
                        $username = $rows['username'];

                        //Afficher les Valeurs dans notre table
            ?>

            <tr>
                <td><?php echo $sn++; ?></td>
                <td><?php echo $full_name; ?></td>
                <td><?php echo $username; ?></td>
                <td>
                    <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>"
                        class="btn-primary">Changer Mot de
                        Passe</a>
                    <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>"
                        class="btn-secondary">Update Admin</a>
                    <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>"
                        class="btn-danger">Delete Admin</a>
                </td>
            </tr>

            <?php

                    }
                } else {
                    //Il n y a pas de données dans la BDD
                }
            }
            ?>

        </table>

        <div class="clearfixe"></div>
    </div>
</div>
<!--fin Main-->

<?php
include 'partiels/footer.php';
?>