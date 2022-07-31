<?php
require ('../../partials/header.php');
require ('../../db.php');

$message = '';
if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['name'])) {

    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $email = $_POST['email'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = 'empleado';

    $sql = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$password', '$role')";

    if ( !$conn->prepare($sql)->execute() ) {
        $message = 'fallo el registro';
    }else {
        $message = 'registro exitoso';
    }
}

?>

<link rel="stylesheet" href="../../assets/css/style.css">
<div class="container">
    <div class="row">
        <h1>Registrar usuarios de la alcaldia</h1>
        <?php if(!empty($message)): ?>
            <div class="alert alert-primary" role="alert">
                <p> <?= $message ?></p>
            </div>
        <?php endif; ?>
        <form action="add_users.php" method="POST" class="mt-3">
            <input name="email" type="text" placeholder="email" class="form-control mb-3">
            <input name="name" type="text" placeholder="nombre" class="form-control mb-3">
            <input name="password" type="password" placeholder="password" class="form-control mb-3">
            <input type="submit" value="Submit" class="btn btn-primary">
            <a href="../../index.php" class="btn btn-primary"> Volver</a>
        </form>
    </div>
</div>
