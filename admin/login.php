<?php include('../config/constants.php'); ?>
<html>

<head>
    <title>Login - Food Order System</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>

    <div class="login">
        <h1 class="text-center">Login</h1>
        <br><br>
        <?php
        if (isset($_SESSION['login'])) {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        if (isset($_SESSION['no-login-message'])) {
            echo $_SESSION['no-login-message'];
            unset($_SESSION['no-login-message']);
        }
        if (isset($_SESSION['no-login-message'])) {
            echo $_SESSION['no-login-message'];
            unset($_SESSION['no-login-message']);
        }
        ?>
        <br><br>
        <!-- Login Form Commence ici -->
        <form action="" method="POST" class="text-center">
            Username: <br>
            <input type="text" name="username" placeholder="Enter Username"><br><br>
            Password: <br>
            <input type="password" name="password" placeholder="Enter Password"><br><br>
            <input type="submit" name="submit" value="Login" class="btn-primary">
            <br><br>
        </form>
        <!-- Fin Login Form -->

    </div>
</body>

</html>
<?php
//Vérifier si on clique sur submit

if (isset($_POST['submit'])) {
    //Processus de Login
    //1. Récupérer les données de Login

    $username = $_POST['username'];
    $password = md5($_POST['password']);

    //2. Requête SQL pour vérifier si le username et password existent

    $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
    //3. Executer la requête
    $res = mysqli_query($connex, $sql);

    //4. Compter les lignes
    $count = mysqli_num_rows($res);
    if ($count == 1) {
        //Utilisateur trouvé

        $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
        $_SESSION['user'] = $username; //POUR vérifier si l'utilisateur est connecté ou non et la déconnexion le désactivera
        //REdirect vers HOme Page/Dashboard
        header('location:' . SITEURL . 'admin/');
    } else {

        $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match.</div>";
        //REdirect to HOme Page/Dashboard
        header('location:' . SITEURL . 'admin/login.php');
    }
}
?>