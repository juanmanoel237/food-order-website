<?php include('partiels/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>

        <br /><br />

        <?php
        //1 Récuperer l'ID de l'admin choisi
        $id = $_GET['id'];

        //2 Créer la requête SQL pour récupérer les détails de l'admin
        $sql = "SELECT * FROM tbl_admin WHERE id=$id";

        //3 Exécuter la requête SQL
        $res = mysqli_query($connex, $sql);

        //Vérifier si la requête est exécutée
        if ($res == TRUE) {
            //Vérifier si les données sont disponibles
            $count = mysqli_num_rows($res);
            ///Vérifier si on a les données de l'admin 
            if ($count == 1) {
                // Récupérer les détails
                // echo "Admin Disponible";
                $row = mysqli_fetch_assoc($res);

                $full_name = $row['full_name'];
                $username = $row['username'];
            } else {
                //Redirigé vers la page Manage Admin
                header('location:' . SITEURL . 'admin/manage-admin.php');
            }
        }
        ?>

        <form action="" method="post">

            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>
    </div>
</div>

<?php

//Vérifier si le button SUBMIT est cliqué
if (isset($_POST['submit'])) {
    //echo "Button Clicked";
    //Récupérer toutes les valeurs du formulaire pour UPDATE
    $id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];

    //Créer la requête SQL pour UPDATE
    $sql = "UPDATE tbl_admin SET
    full_name ='$full_name',
    username = '$username' 
    WHERE id='$id'
    ";

    //Executer la requête 
    $res = mysqli_query($connex, $sql);

    //Vérifier si la requête est exécutée
    if ($res == TRUE) {
        $_SESSION['update'] = "<div class='success'>Admin mis à jour</div>";
        //Redirection Vers Manage Admin
        header('location:' . SITEURL . 'admin/manage-admin.php');
    } else {
        $_SESSION['update'] = "<div class='error'>Echec de la mise à jour</div>";
        //Redirection Vers Manage Admin
        header('location:' . SITEURL . 'admin/manage-admin.php');
    }
}

?>


<?php include('partiels/footer.php'); ?>