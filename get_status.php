<?php

    header("Content-type: text/javascript");
    include('connection.php');

    $row = 10;
    $col = 10;
    $res = array();

    $sql = "SELECT * FROM status";

    $result = $connect->query($sql);


    if(!empty($result)){
        foreach($result as $cell){
            $res[$cell['cell_id']] = $cell['val'];
        }
    }

    echo json_encode($res);
?>