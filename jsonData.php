<?php

init();

function init() {
    session_start();

    if(!file_exists("./data.txt")){
        file_put_contents("./data.txt", "[]");
        file_put_contents("./id.txt", 0);
    }
}

function edit(){
    foreach(getData() as $contact){
        if ($contact['id'] == $_GET['id']) {
            return $contact;
        }
    }
}

function store(){
    $data = getData();
    $contact['id'] = newID();
    $contact['name'] = $_POST['name'];
    $contact['surename'] = $_POST['surename'];
    $contact['phone'] = $_POST['phone'];
    $contact['address'] = $_POST['address'];
    
    $data[] = $contact;
    setData($data);
}

function getData(){
    $arr = json_decode(file_get_contents('./data.txt'), 1);
    foreach ($arr as &$entry) {
        $entry = (array) $entry;
    }
    return $arr;
}
function setData($arr){
    file_put_contents('./data.txt', json_encode($arr));
}

function newID(){
    $id = file_get_contents('./id.txt');
    $id++;
    file_put_contents('./id.txt',$id);
    return $id;
}

function delete(){
    $data = getData();
    foreach ($data as $key => &$contact) {
        if($contact['id'] == $_POST['id']){
        unset($data[$key]);
        setData($data);
        return;
        }
    }
}

function update(){
    $data = getData();
    foreach ($data as &$contact) {
    if($contact['id'] == $_POST['id']){
        $contact['name'] = $_POST['name'];
        $contact['surename'] = $_POST['surename'];
        $contact['phone'] = $_POST['phone'];
        $contact['address'] = $_POST['address'];
        setData($data);
            return;
        }  
    }
}

?>