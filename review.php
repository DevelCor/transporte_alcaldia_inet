<?php
require ('partials/header.php');
require ('db.php');
$sql = "select * from company";
$records = $conn->prepare($sql);
$records->execute();
$companies = $records->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['phone']) && ( isset($_POST['company']) && $_POST['company'] !== '') && isset($_POST['message'])) {

    $fist_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $company = $_POST['company'];
    $message = $_POST['message'];

    $sql = "INSERT INTO review (first_name, last_name, email, phone, company_id, comment) VALUES ('$fist_name', '$last_name', '$email', '$phone', $company, '$message')";

    if ( !$conn->prepare($sql)->execute() ) {
        $message = 'fallo el envio de la critica';
    }else {
        $message = 'critica enviada con exito, gracias por su opinion! ';
    }

}
?>


<div class="container">
    <div class="row text-center">
        <h1>Buzon de críticas</h1>
    </div>
    <div class="row ">
        <?php if(!empty($message)): ?>
            <p> <?= $message ?></p>
        <?php endif; ?>

        <form action="review.php" method="POST" class="mt-3">
            <input name="first_name" type="text" placeholder="nombre" class="form-control mb-3">
            <input name="last_name" type="text" placeholder="apellido" class="form-control mb-3">
            <input name="email" type="text" placeholder="email" class="form-control mb-3">
            <input name="phone" type="text" placeholder="numero de telefono" class="form-control mb-3">
            <select name="company" class="form-select mb-3" aria-label="Default select example">
                <option value> Selecciona una compañia </option>
                <?php foreach ($companies as $company): ?>
                    <option value="<?= $company['id']?>"> <?= $company['name'] ?> </option>
                <?php endforeach;?>
            </select>

            <div class="form-floating mb-3">
                <textarea name="message" class="form-control" placeholder="Comentario" id="floatingTextarea"></textarea>
                <label for="floatingTextarea">Comentario</label>
            </div>

            <input type="submit" value="Submit" class="btn btn-primary">
            <a href="index.php" class="btn btn-primary"> Volver</a>
        </form>
    </div>
</div>
