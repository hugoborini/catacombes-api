<?php


function dbConnect() {
    try { $bdd = new PDO('mysql:host=localhost;dbname=catacombe;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
    catch (Exception  $e) {
        $retour["sucess"] = false;
        $retour["msg"] = "chakal c pas bon";
    die('Error : ' .  $e->getMessage());
    }
    return $bdd;
}


function getAllRoom(){
    $bdd = dbConnect();

    $req = $bdd->query("SELECT * from room");
    return $req;
}

function getRoom($name){
    $bdd = dbConnect();

    $req = $bdd->prepare("SELECT * from room WHERE room_name = :room_name");
    $req->execute([
        "room_name" => $name
    ]);

    return $req;
}

function getPics($room_id){
    $bdd =dbConnect();
    
    $req = $bdd->prepare("SELECT * FROM room_pics WHERE room_id = :room_id");
    $req->execute([
        "room_id" => $room_id
    ]);
    return $req;
}

function getFacts($room_id){
    $bdd= dbConnect();

    $req = $bdd->prepare("SELECT * FROM room_facts WHERE room_id = :room_id");
    $req->execute([
        "room_id" => $room_id
    ]);
    return $req;
}

function postRoom($room_name, $room_describ){
    $bdd = dbConnect();
    $req = $bdd->prepare("INSERT INTO room(room_name, room_describ) VALUES(:room_name, :room_describ)");

    $req->execute([
        "room_name" => $room_name,
        "room_describ" => $room_describ
    ]);

    return $req;

}



?>