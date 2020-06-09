<?php
require "model/model.php";

function createJson ($req){
    $i = 0;
    $y = 0;
    $tab_tmp =[];
    $x = 0;

    while ($data = $req->fetch()){
        $tab_tmp[$i]['id'] = $data['id_room'];
        $tab_tmp[$i]['room_name'] = $data["name"];
        $tab_tmp[$i]['room_describ'] = $data['description'];
        $picsFacts = getPicsAndFacts($data['id_room']);
        while($data_picsFacts = $picsFacts->fetch()){
            $y++;
            if($data['id_room'] == $data_picsFacts['id_room']){
                $tab_tmp[$i]['pics']["p" .$y] = $data_picsFacts["name"];
                if (!empty($data_picsFacts["fact"])){
                    $x++;
                    $tab_tmp[$i]['facts']["f" . $x] = $data_picsFacts['fact'];
                }
                
            }
        }
        $y = 0;
        $x = 0;
        $i++;
    }

    return $tab_tmp;
}

function getAllRoomToJson(){
    $req = getAllRoom();

    $tab_tmp = createJson($req);

    $result['result'] = $tab_tmp;

    $json_tab = json_encode($result);
    return $json_tab;

}

function getRoomToJson($room){
    $req = getRoom($room);

    $tab_tmp = createJson($req);

    $result['result'] = $tab_tmp;

    $json_tab = json_encode($result);

    return $json_tab;

}
