<?php include('partiels/menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br/><br/>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter your name">
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" placeholder="Your username">
                    </td>
                </tr>

                <tr>
                    <td>Password: </td>
                    <td>
                        <input type="password" name="password" placeholder="Your password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin "class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php include('partiels/footer.php');?>

<?php
     //Traiter les valeurs dans le formulaire et enregistrer dans la base de données

     //Vérifier si on clique sur "SUBMIT" ou non

     if(isset($_POST['submit'])){
        // Si on a cliqué
       // echo "Button cliqué";

       //1. Récuperer les donées du formulaire
       $full_name = $_POST['full_name'];
       $username = $_POST['username'];
       $password = md5($_POST['password']); //Password crypté avec MD5

       //2. Requete SQL pour sauvegarder les données dans la bdd
       $sql = "INSERT INTO tbl_admin SET 
            full_name='$full_name',
            username='$username',
            password='$password'
       ";
       //3. Executer la requete et sauvegarder les données
       $connex = mysqli_connect('localhost', 'root', '') or die(mysqli_error()); //Connexion  à la bdd
       $db_select = mysqli_select_db($connex,'food-order') or die(mysqli_error()); //Selection de la bdd

       //Exécution de la requête et Sauvegarde dans la BDD
       $res = mysqli_query($connex, $sql) or die('Error:' . mysqli_error($connex));

       //4. Vérifier si (la requête est exécuté) les données sont insérées dans la bdd ou pas et afficher le message correct
       if($res==TRUE){
        //Données insérées
        echo "Données insérées";
       }else{
        //Echec
        echo "Echec d'insertion";
       }
     }
?>