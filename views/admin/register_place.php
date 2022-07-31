<?php
require '../../db.php';
$message = '';
if (!empty($_POST['name'])) {
    $name = $_POST['name'];
    $sql = "INSERT INTO places (name) VALUES ('$name')";

    if ( !$conn->prepare($sql)->execute() ) {
        $message = 'fallo el registro del sitio';
    }else {
        $message = 'sitio registrado exitosamente';
    }
}
?>
<?php require ('../../partials/header.php') ?>
<link rel="stylesheet" href="../../assets/css/style.css">

<div class="container">
    <div class="row">
        <?php if(!empty($message)): ?>
            <div class="alert alert-primary" role="alert">
                <p> <?= $message ?></p>
            </div>
        <?php endif; ?>

        <h5> Registrar lugares</h5>
        <form action="register_place.php" method="POST">
            <input name="name" type="text" placeholder="nombre del lugar" class="form-control mb-3">
            <input type="submit" value="Submit" class="btn btn-primary">
            <a href="../../index.php" class="btn btn-primary">Volver a registro de rutas</a>
        </form>
    </div>
</div>
