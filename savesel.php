<?php
require 'connectdb.php';
// $val = $_REQUEST['price'];
// $dy  = $_REQUEST['dy'];
$idr = $_REQUEST['idrm'];
$addpriceroom = $_REQUEST['saveprice'];

for($i=0;$i<count($addpriceroom);$i++){
    $val = $addpriceroom[$i]['price'];
    $dy = $addpriceroom[$i]['dy'];
    $sql = "INSERT INTO `priceroom`(`id_priceroom`, `date_start`, `ID_room`, `price_room`) VALUES(null,'$dy','$idr','$val')";
    $arr  = array();
    $query = mysqli_query($con, $sql);
    if ($query === TRUE) {
        $arr = [
            'status' => 200,
            'val' => 'Succes'
        ];
        echo json_encode($arr);
    } else {
        $arr = [
            'status' => 404,
            'val' => 'Fail'
        ];
        echo json_encode($arr);
    }

}





