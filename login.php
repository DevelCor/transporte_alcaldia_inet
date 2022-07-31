<?php
session_start();
if (isset($_SESSION['user_id'])) {
header('Location: /transporte_publico');
}
require 'db.php';

if (!empty($_POST['email']) && !empty($_POST['password'])) {
$records = $conn->prepare('SELECT id, name,email, password FROM users WHERE email = :email');
$records->bindParam(':email', $_POST['email']);
$records->execute();
$results = $records->fetch(PDO::FETCH_ASSOC);

$message = '';

if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {

setcookie("user_id", $results['id']);
setcookie("name", $results['name']);
header("Location: /transporte_publico");
} else {
$message = 'Sorry, those credentials do not match';
}
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</head>
<body>
    <?php require 'partials/header.php' ?>

    <?php if(!empty($message)): ?>
        <p> <?= $message ?></p>
    <?php endif; ?>

    <div class="container">
        <div class="row">
            <form action="login.php" method="POST">
                <h1>Iniciar sesion</h1>
                <span>o <a href="signup.php" class="btn btn-success">registrate</a></span>
                <input name="email" type="text" placeholder="email" class="form-control mb-3 mt-3">
                <input name="password" type="password" placeholder="password" class="form-control mb-3">
                <input type="submit" value="Submit" class="btn btn-primary">
                <a href="index.php" class="btn btn-primary"> Volver</a>
            </form>
        </div>

    </div>
</body>
</html>