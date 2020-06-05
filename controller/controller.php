<?php
require "model/model.php";


function spicySauce($req){
    $i =0;
    $y = 0;
    $x = 0;
    $tab_tmp = [];

    while($data = $req->fetch()){
        
        $tab_tmp[$i]['id'] = $data['id'];
        $tab_tmp[$i]['room_name'] = $data["room_name"];
        $tab_tmp[$i]['room_dercrip'] = $data["room_describ"];
        $pics = getPics($data['id']);
        $facts = getFacts($data['id']);
        while($data_pics = $pics->fetch()){
            $y++;
            if($data['id'] == $data_pics["room_id"]){
                $tab_tmp[$i]['poster']["p".$y] = $data_pics["poster"];
            }
            ;
        }
        $y = 0;
        while($data_facts = $facts->fetch()){
            $y++;
            if($data['id'] == $data_facts["room_id"]){
                $tab_tmp[$i]['facts']["f".$y] = $data_facts["room_facts"];
            }
        }
        $y=0;
        $i++;
    }

    return $tab_tmp;

}


function getAllRoomToJson(){
    

    $req = getAllRoom();
    
    $tab_concat = spicySauce($req);

    $retour['success'] = true;
    $retour['msg'] = "tt est en ordre chakal";
    $retour["result"]['room'] = $tab_concat;


    $json_tab = json_encode($retour);

    return $json_tab;
}

function getRoomToJson($name){
    $req = getRoom($name);

    $tab_concat = spicySauce($req);

    $retour['success'] = true;
    $retour['msg'] = "tt est en ordre chakal";
    $retour["result"]['room'] = $tab_concat;

    $json_tab = json_encode($retour);

    return $json_tab;
}


function postARoom($room_name, $room_describ){
    postRoom($room_name, $room_describ);
}

?>