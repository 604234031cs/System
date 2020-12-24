<?php
require 'connectdb.php';
$page = $_GET['page'];
if ($page == "checkprice") {

    $id =  $_GET['id'];

    $sql = "SELECT * FROM tb_roomtype where id_resort = '$id'";
    $query = mysqli_query($con, $sql);
    $arr = array();
    while ($results11 = mysqli_fetch_array($query)) {
        array_push($arr, $results11);
    }
    echo json_encode($arr);

    // echo json_encode('ok');
} else if ($page == "edit") {
    $id = $_GET['name'];

    $sql = "SELECT * FROM tb_resort INNER JOIN tb_roomtype ON tb_resort.id=tb_roomtype.id_resort WHERE tb_resort.resort_name = '$id'";
    $query = mysqli_query($con, $sql);
    $arr = array();
    while ($results = mysqli_fetch_array($query)) {
        array_push($arr, $results);
    }
    echo json_encode($arr);
} else if ($page == "pricerooms") {
    $id = $_GET['id_resort'];
    $sql = "SELECT * FROM tb_roomtype where id_resort = '$id'";
    $query = mysqli_query($con, $sql);
    // $results11 = mysqli_fetch_assoc($query);
    $arr = array();
    while ($results = mysqli_fetch_assoc($query)) {
        array_push($arr, $results);
    }
    echo json_encode($arr);
} else if ($page == "showpriceroom") {
    $y = $_GET['year'];
    $m = $_GET['mont'];
    $id = $_GET['idresort'];
    $f = $y . '-' . $m;
    // $sql = "SELECT * FROM `priceroom` WHERE date_start LIKE '%$f%' ";
    // // // $sql =  "SELECT tb_roomtype.name_roomtype,tb_roomtype.price_roomtype,
    // // // priceroom.date_start,priceroom.price_room,priceroom.ID_room
    // // // FROM tb_roomtype
    // // // LEFT JOIN priceroom ON tb_roomtype.id = priceroom.ID_room
    // // // and priceroom.date_start like '%$f%'
    // // // Group by tb_roomtype.id";
    // $query = mysqli_query($con, $sql);
    // // $results11 = mysqli_fetch_array($query);
    // $arr = array();
    // while ($results = mysqli_fetch_assoc($query)) {
    //     array_push($arr, $results);
    // }
    // echo json_encode($arr);

    $sql = "SELECT tb_roomtype.id,tb_roomtype.name_roomtype,tb_roomtype.price_roomtype,tb_roomtype.id,
-- GROUP_CONCAT(CONCAT(priceroom.date_start,',', tb_roomtype.price_roomtype,',', priceroom.price_room)) as gpprice
GROUP_CONCAT(priceroom.date_start) as date,GROUP_CONCAT(priceroom.price_room) as gpprice
,SUBSTR(priceroom.date_start,1,7) as mday    
FROM tb_roomtype 
JOIN priceroom on priceroom.ID_room = tb_roomtype.id
WHERE priceroom.date_start like '%2020-12%'
GROUP BY tb_roomtype.id,tb_roomtype.name_roomtype,
SUBSTR(priceroom.date_start,1,7)";

    $query = mysqli_query($con, $sql);
    // $results11 = mysqli_fetch_array($query);
    $arr = array();
    $arr2  = array();
    while ($results = mysqli_fetch_assoc($query)) {
        $arr2 = [
            "id" => $results['id'],
            "name_roomtype" => $results['name_roomtype'],
            "price_roomtype" => $results['price_roomtype'],
            "date_start" => explode(',', $results['date']),
            // "price_room" => explode(',', $results['gpprice']),
            "priceDay" =>
            // 'date' => explode(',', $results['date']),
            explode(',', $results['gpprice'])

        ];
        // echo $results['name'] . "<br>";
        // echo $results['nomalprice'] . "<br>";
        // echo json_encode(explode(',', $results['date'])) . "<br>";
        array_push($arr, $arr2);
    }

    echo  json_encode($arr);

    // $sql = "SELECT tb_roomtype.name_roomtype,tb_roomtype.price_roomtype,
    // GROUP_CONCAT(priceroom.date_start) as date,GROUP_CONCAT(priceroom.price_room) as price,priceroom.ID_room
    // FROM tb_roomtype
    // LEFT JOIN priceroom ON tb_roomtype.id = priceroom.ID_room
    // and priceroom.date_start like '%$f%'
    // Group by tb_roomtype.id";

    // $query = mysqli_query($con, $sql);
    // // $results11 = mysqli_fetch_array($query);
    // $arr = array();
    // $arr2  = array();
    // while ($results = mysqli_fetch_assoc($query)) {
    //     $arr2 = [
    //         "name_roomtype" => $results['name_roomtype'],
    //         "price_roomtype" => $results['price_roomtype'],
    //         "date_start" => explode(',', $results['date']),
    //         "price_room" => explode(',', $results['price']),
    //         "ID_room" => $results['ID_room'],
    //     ];
    //     // echo $results['name'] . "<br>";
    //     // echo $results['nomalprice'] . "<br>";
    //     // echo json_encode(explode(',', $results['date'])) . "<br>";
    //     array_push($arr, $arr2);
    // }

    // echo  json_encode($arr);
}
