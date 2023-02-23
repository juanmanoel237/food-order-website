<?php include('partiels/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>

        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Current Password: </td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current Password">
                    </td>
                </tr>

                <tr>
                    <td>New Password:</td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password">
                    </td>
                </tr>

                <tr>
                    <td>Confirm Password: </td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

    </div>
</div>

<?php

//Vérifier si on clique bien sur le button submit
if (isset($_POST['submit'])) {
    //echo "CLicked";

    //1. Récupérer les données de la BDD
    $id = $_POST['id'];
    $current_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);


    //2. Vérifier si l'utilisateur existe
    $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

    //Exécuter la Requête
    $res = mysqli_query($connex, $sql);

    if ($res == true) {
        //Vérifier si les données sont disponible ou pas
        $count = mysqli_num_rows($res);

        if ($count == 1) {
            //Utilisiteur exist et le MDP peut être modifié
            //echo "User FOund";

            // Vérifier si le nouveau et la confirmation du MDP correspondent
            if ($new_password == $confirm_password) {
                //Update le MDP
                $sql2 = "UPDATE tbl_admin SET 
                                password='$new_password' 
                                WHERE id=$id
                            ";

                //Executer la requête
                $res2 = mysqli_query($connex, $sql2);

                //Vérifier si la requête est éxécutée
                if ($res2 == true) {
                    //Afficher message de succes
                    //Redirection à la page admin
                    $_SESSION['change-pwd'] = "<div class='success'>Password Changed Successfully. </div>";
                    header('location:' . SITEURL . 'admin/manage-admin.php');
                } else {
                    //Afficher message d'erreur
                    //Redirection à la page admin avec message d'erreur
                    $_SESSION['change-pwd'] = "<div class='error'>Failed to Change Password. </div>";
                    header('location:' . SITEURL . 'admin/manage-admin.php');
                }
            } else {
                //Redirection à la page admin avec message d'erreur
                $_SESSION['pwd-not-match'] = "<div class='error'>Password Did not Match. </div>";

                header('location:' . SITEURL . 'admin/manage-admin.php');
            }
        } else {
            //Utilisateur inexistant
            $_SESSION['user-not-found'] = "<div class='error'>User Not Found. </div>";

            header('location:' . SITEURL . 'admin/manage-admin.php');
        }
    }
}

?>


<?php include('partiels/footer.php'); ?>