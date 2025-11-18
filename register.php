<?php
require_once "./Classes/Users.php";
$user = new Users();
$jsAlert = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $message = $user->create(
            $_POST['username'],
            $_POST['password'],
            $_POST['role']
        );
    $jsAlert = "<script>
    alert('" . addslashes($message) . "');
    window.location.href = 'login.php';
    </script>";
    echo $jsAlert;
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="styles.css">
    <title>Register</title>
</head>
<body>
    <div class="form-container">
    <h3>Registration</h3>
    <section>
        <form action="" method="post">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" placeholder="Enter username">
            <label for="username">Password</label>
            <input type="password" name="password" id="password" placeholder="Enter password">
            <label for="role">role</label>
            <select name="role" id="role">
                <option value="">Select role</option>
                <option value="student">student</option>
                <option value="teacher">teacher</option>

            </select>
            <button type="submit">Register</button>
        </form>
        <a href="login.php">Already have an account?</a>
    </section>
</div>
</body>

</html>