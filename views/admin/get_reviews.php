<?php
require ('../../partials/header.php');
require ('../../db.php');

$sql = "select * from review";
$records = $conn->prepare($sql);
$records->execute();
$reviews = $records->fetchAll(PDO::FETCH_ASSOC);

$final_reviews = [];
foreach ($reviews as $key => $review) {
    $id = $review['company_id'];
    $sql = "select * from company c where c.id = $id";
    $records = $conn->prepare($sql);
    $records->execute();
    $company = $records->fetch(PDO::FETCH_ASSOC);

    $final_reviews[$key]['first_name'] = $review['first_name'];
    $final_reviews[$key]['last_name'] = $review['last_name'];
    $final_reviews[$key]['email'] = $review['email'];
    $final_reviews[$key]['phone'] = $review['phone'];
    $final_reviews[$key]['company'] = $company['name'];
}

?>
<link rel="stylesheet" href="../../assets/css/style.css">

<div class="container">
    <div class="row">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Email</th>
                <th scope="col">telefono</th>
                <th scope="col">Compañia</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($final_reviews as $key => $review) :?>
                <tr>
                    <th scope="row"> <?= $key+1 ?></th>
                    <td> <?= $review['first_name'] ?> <?= $review['last_name']?> </td>
                    <td> <?= $review['email'] ?> </td>
                    <td> <?= $review['phone'] ?> </td>
                    <td> <?= $review['company'] ?> </td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
        <a href="../../index.php" class="btn btn-primary">Volver a registro de rutas</a>
    </div>
</div>

