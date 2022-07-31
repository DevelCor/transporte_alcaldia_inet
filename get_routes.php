<?php
require ('db.php');

$sql = "select * from places";
$records = $conn->prepare($sql);
$records->execute();
$places = $records->fetchAll(PDO::FETCH_ASSOC);

if ((isset($_POST['init']) && $_POST['init'] !== '') && (isset($_POST['middle']) && $_POST['middle'] !== '') && (isset($_POST['finish']) && $_POST['finish'] !== '')) {
    $init = $_POST['init'];
    $middle = $_POST['middle'];
    $finish = $_POST['finish'];
    $sql = "select * from routes r where r.start = $init and r.finish = $finish and r.middle = $middle";
    $records = $conn->prepare($sql);
    $records->execute();
    $routes = $records->fetchAll(PDO::FETCH_ASSOC);
}else if ((isset($_POST['finish']) && $_POST['finish'] !== '') && (isset($_POST['init']) && $_POST['init'] !== '')) {
    $finish = $_POST['finish'];
    $init = $_POST['init'];
    $sql =  "select * from routes r where r.finish = $finish and r.start = $init";
    $records = $conn->prepare($sql);
    $records->execute();
    $routes = $records->fetchAll(PDO::FETCH_ASSOC);
} else if ((isset($_POST['middle']) && $_POST['middle'] !== '') && (isset($_POST['init']) && $_POST['init'] !== '')) {
    $middle = $_POST['middle'];
    $init = $_POST['init'];
    $sql =  "select * from routes r where r.middle = $middle and r.start = $init";
    $records = $conn->prepare($sql);
    $records->execute();
    $routes = $records->fetchAll(PDO::FETCH_ASSOC);
} else if ((isset($_POST['middle']) && $_POST['middle'] !== '') && (isset($_POST['finish']) && $_POST['finish'] !== '')) {
    $middle = $_POST['middle'];
    $finish = $_POST['finish'];
    $sql =  "select * from routes r where r.middle = $middle and r.finish = $finish";
    $records = $conn->prepare($sql);
    $records->execute();
    $routes = $records->fetchAll(PDO::FETCH_ASSOC);
} else if (isset($_POST['init']) && $_POST['init'] !== '') {
    $init = $_POST['init'];
    $sql = "select * from routes r where r.start = $init";
    $records = $conn->prepare($sql);
    $records->execute();
    $routes = $records->fetchAll(PDO::FETCH_ASSOC);
} else if (isset($_POST['middle']) && $_POST['middle'] !== '') {
    $middle = $_POST['middle'];
    $sql =  "select * from routes r where r.middle = $middle";
    $records = $conn->prepare($sql);
    $records->execute();
    $routes = $records->fetchAll(PDO::FETCH_ASSOC);
} else if (isset($_POST['finish']) && $_POST['finish'] !== '') {
    $finish = $_POST['finish'];
    $sql =  "select * from routes r where r.finish = $finish";
    $records = $conn->prepare($sql);
    $records->execute();
    $routes = $records->fetchAll(PDO::FETCH_ASSOC);
}

if (isset($routes)) {
    $final_routes = [];
    foreach ($routes as $key => $route) {
        $start = $route['start'];
        $middle = $route['middle'];
        $finish = $route['finish'];
        $company = $route['company_id'];

        $sql = "select * from places p where p.id = $start";
        $records = $conn->prepare($sql);
        $records->execute();
        $start = $records->fetch(PDO::FETCH_ASSOC);

        $sql = "select * from places p where p.id = $middle";
        $records = $conn->prepare($sql);
        $records->execute();
        $middle = $records->fetch(PDO::FETCH_ASSOC);

        $sql = "select * from places p where p.id = $finish";
        $records = $conn->prepare($sql);
        $records->execute();
        $finish = $records->fetch(PDO::FETCH_ASSOC);

        $sql = "select * from company c where c.id = $company";
        $records = $conn->prepare($sql);
        $records->execute();
        $company = $records->fetch(PDO::FETCH_ASSOC);

        $final_routes[$key]['init'] = $start['name'];
        $final_routes[$key]['middle'] = $middle['name'];
        $final_routes[$key]['finish'] = $finish['name'];
        $final_routes[$key]['company'] = $company['name'];
        $final_routes[$key]['price'] = $route['price'];
        $final_routes[$key]['name'] = $route['name'];
    }
}
