<?php

session_start();
require_once "./Classes/Users.php";
$user = new Users();

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $loggedInUser = $user->login($username,$password);

    if($loggedInUser){
        $_SESSION['username'] = $loggedInUser['username'];
        $_SESSION['password'] = $loggedInUser['password'];
        $_SESSION['role'] = strtolower($loggedInUser['role']);

        switch($_SESSION['role']){

            case "admin":
                header("Location: public/participants/index.php");
                break;
                
            case "teacher":
                header("Location: public/participants/index.php");
                break;
                
            case "student":
                default:
                header("Location: public/events/index.php");
                break;
        }exit();
    }else{
        header("Location: login.php?error=Invalid password or credentials");
        exit();
    }
}

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Login</title>
</head>

<body>
    <div class="form-container">
        <h3>Login</h3>
        <section>
            <form action="" method="post">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" required>

                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>

                <button type="submit">Login</button>
            </form>

            <a href="register.php">Don't have an account?</a>
        </section>
    </div>

    <!-- ERROR ALERT -->
    <?php if (isset($_GET['error'])): ?>
    <script>
        alert("<?= $_GET['error'] ?>");
    </script>
    <?php endif; ?>
</body>

</html>
