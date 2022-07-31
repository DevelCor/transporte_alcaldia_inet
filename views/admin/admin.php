<?php
require ('../../partials/header.php');
require ('../../db.php');
$sql = "select * from places";
$records = $conn->prepare($sql);
$records->execute();
$places = $records->fetchAll(PDO::FETCH_ASSOC);


$sql = "select * from company";
$records = $conn->prepare($sql);
$records->execute();
$companies = $records->fetchAll(PDO::FETCH_ASSOC);


if (isset($_POST['init']) && isset($_POST['middle']) && isset($_POST['finish']) && ($_POST['price'] !== '')) {
    $message = '';
    $name = $_POST['name'];
    $init = $_POST['init'];
    $middle = $_POST['middle'];
    $finish = $_POST['finish'];
    $price = (float) $_POST['price'];
    $company = $_POST['company'];
    $sql = "INSERT INTO routes (name,price,company_id,start,middle,finish) VALUES ('$name', $price,$company,$init,$middle,$finish)";

    if ( !$conn->prepare($sql)->execute() ) {
        $message = 'fallo al registrar la ruta';
    }else {
        $message = 'ruta registrada correctamente';
    }
}
?>
<link rel="stylesheet" href="../../assets/css/style.css">

<div class="container">
    <br> Bienvenido. <?= $_COOKIE['name'] ?>
    <br>

    <?php if(!empty($message)): ?>
    <div class="alert alert-primary" role="alert">
        <p> <?= $message ?></p>
    </div>
    <?php endif; ?>
    <div class="d-flex flex-column">
        <a href="register_place.php">Agregar un sitio</a>
        <a href="add_company.php">Agregar una compañia</a>
        <a href="get_reviews.php">Ver reviews</a>
        <a href="add_users.php">Agregar usuarios</a>
        <a href="../../logout.php"> Cerrar sesion </a>
        <h1 class="mt-5"> Registrar rutas</h1>
    </div>

    <div class="row">
        <form action="admin.php" method="POST" class="mt-3">
            <p class="lead">
                Punto inicio
            </p>
            <select name="init" class="form-select" aria-label="Default select example">
                <?php foreach ($places as $place): ?>
                    <option value="<?= $place['id']?>"> <?= $place['name'] ?> </option>
                <?php endforeach;?>
            </select>

            <p class="lead mt-2">
                Punto medio
            </p>
            <select name="middle" class="form-select" aria-label="Default select example">
                <?php foreach ($places as $place): ?>
                    <option value="<?= $place['id']?>"> <?= $place['name'] ?> </option>
                <?php endforeach;?>
            </select>

            <p class="lead mt-2">
                Punto final
            </p>
            <select name="finish" class="form-select" aria-label="Default select example">
                <?php foreach ($places as $place): ?>
                    <option value="<?= $place['id']?>"> <?= $place['name'] ?> </option>
                <?php endforeach;?>
            </select>

            <p class="lead mt-2">
                Compañia
            </p>
            <select name="company" class="form-select" aria-label="Default select example">
                <?php foreach ($companies as $company): ?>
                    <option value="<?= $company['id']?>"> <?= $company['name'] ?> </option>
                <?php endforeach;?>
            </select>

            <input name="price" type="number" class="form-control mt-3" placeholder="costo" aria-label="costo" aria-describedby="basic-addon1">
            <input name="name" type="text" class="form-control mt-3" placeholder="nombre de la ruta" aria-label="nombre de la ruta" aria-describedby="basic-addon1">
            <input type="submit" value="Submit" class="btn btn-primary mt-5">

        </form>
    </div>
</div>