<?php
session_start();
require 'db.php';
require('get_routes.php');

if (isset($_COOKIE['user_id'])) {
    $records = $conn->prepare('SELECT id, name,role,email, password FROM users WHERE id = :id');
    $records->bindParam(':id', $_COOKIE['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
        $user = $results;
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Transporte publico</title>
</head>
<body>
    <div class="container">
        <?php require 'partials/header.php' ?>
        <?php if(!empty($user)): ?>
        <div class="row">
            <div class="col-12">
                <br> Bienvenido. <?= $user['name']; ?>
                <br>
                <a href="logout.php">
                    Cerrar sesion
                </a>
                <?php if ($user['role'] === 'admin' || $user['role'] === 'empleado' ){
                    header('Location: /transporte_publico/views/admin/admin.php');
                }
                ?>

            </div>
        </div>
        <?php else: ?>
            <div class="row">
                <div class="col-12 text-center">
                    <a href="login.php" class="btn btn-success">Login</a>
                    <a href="signup.php" class="btn btn-success">Registrarse</a>
                    <a href="about_us.php" class="btn btn-success">Autores</a>
                </div>
            </div>
        <?php endif; ?>
    </div>

<!--consultar rutas-->
    <div class="container">
        <h4 class="mt-5">Consulta de rutas </h4>
        <div class="row">

            <?php if(!empty($final_routes)): ?>
                <div class="alert alert-primary" role="alert">
                    <?php foreach ($final_routes as $route):?>
                        <p> La ruta: <span class="route-part"> <?= $route['init'] ?>  </span> - <span class="route-part"> <?= $route['middle']?> </span> - <span class="route-part"> <?= $route['finish']?> </span> . Es cubierta por la empresa: <span class="route-part"><?= $route['company']?></span> nombre de la ruta: <span class="route-part"><?= $route['name']?></span>  y tiene un costo de <span class="route-part"> <?= $route['price'] ?>  </span></p>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="alert alert-warning" role="alert">
                    <p>No hay ruta para los puntos dados</p>
                </div>
            <?php endif; ?>
            <form action="index.php" method="POST" class="mt-5">
                <p class="lead">
                    Punto inicio
                </p>
                <select name="init" class="form-select" aria-label="Default select example">
                    <option value> ---- </option>
                    <?php foreach ($places as $place): ?>
                        <option value="<?= $place['id']?>"> <?= $place['name'] ?> </option>
                    <?php endforeach;?>
                </select>
                <select name="middle" class="form-select mt-3" aria-label="Default select example">
                    <option value> ---- </option>
                    <?php foreach ($places as $place): ?>
                        <option value="<?= $place['id']?>"> <?= $place['name'] ?> </option>
                    <?php endforeach;?>
                </select>
                <select name="finish" class="form-select mt-3" aria-label="Default select example">
                    <option value> ---- </option>
                    <?php foreach ($places as $place): ?>
                        <option value="<?= $place['id']?>"> <?= $place['name'] ?> </option>
                    <?php endforeach;?>
                </select>
                <input type="submit" value="Submit" class="btn btn-primary mt-3">
            </form>
        </div>
        <a href="review.php" class="btn btn-primary mt-5">Buzon de criticas</a>
    </div>
</body>
</html>