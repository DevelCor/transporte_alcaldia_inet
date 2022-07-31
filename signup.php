<?php
require 'db.php';
$message = '';
if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['name'])) {

    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $email = $_POST['email'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = 'user';

    $sql = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$password', '$role')";

    if ( !$conn->prepare($sql)->execute() ) {
        $message = 'fallo el registro';
    }else {
        $message = 'registro exitoso';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>SignUp</title>
</head>
<body>
    <?php require 'partials/header.php' ?>
    <div class="container">
        <?php if(!empty($message)): ?>
            <p> <?= $message ?></p>
        <?php endif; ?>

        <h1>Registrate</h1>
        <span class="">o <a href="login.php" class="btn btn-success">Login</a></span>

        <form action="signup.php" method="POST" class="mt-3">
            <input name="email" type="text" placeholder="email" class="form-control mb-3">
            <input name="name" type="text" placeholder="nombre" class="form-control mb-3">
            <input name="password" type="password" placeholder="password" class="form-control mb-3">
            <input type="submit" value="Submit" class="btn btn-primary">
            <a href="index.php" class="btn btn-primary"> Volver</a>
        </form>
    </div>
</body>
</html>