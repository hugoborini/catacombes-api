<?php
require "model/model.php";
// require "model/modelPost.php";


function createJson ($req){
    $i = 0;
    $y = 0;
    $tab_tmp =[];

    while ($data = $req->fetch()){
        $tab_tmp[$i]['id'] = $data['id_room'];
        $tab_tmp[$i]['room_name'] = $data["name"];
        $tab_tmp[$i]['room_describ'] = $data['description'];
        $tab_tmp[$i]['poster_principale'] = $data['path_img'];
        $picsFacts = getPicsAndFacts($data['id_room']);
        while($data_picsFacts = $picsFacts->fetch()){
            $y++;
                $tab_tmp[$i]['pics']["p" . $y] = $data_picsFacts["name"];
                if (!empty($data_picsFacts["fact"])){
                    $tab_tmp[$i]['facts']["p" . $y] = $data_picsFacts['fact'];
                }
        }
        $y = 0;

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
function postARoom($name, $path_img, $description){
    
    $req =  postRoom($name, $path_img, $description );
 
    return $req;
 }
 
