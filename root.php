<?php
require("controller/controller.php");

if (isset($_GET['action'])){
    if ($_GET['action'] == "getRoom"){
        if (isset($_GET['room'])){
            header('Content-Type: application/json');
            $room = getRoomToJson($_GET["room"]);
            echo $room;
        }
    }
    if ($_GET['action'] == "getAllRoom"){
        header('Content-Type: application/json');
        $room = getAllRoomToJson();
        echo $room;
    }
    if ($_GET['action'] == "postRoom"){
        postARoom($_POST["room_name"], $_POST["room_describ"]);
    }
}
?>