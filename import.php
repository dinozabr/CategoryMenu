<?php

require __DIR__ . '/config.php';

$mysqli = new mysqli($host, $username, $password, $dbname );
$db = new PDO('mysql:host=localhost;dbname=Vladlink;charset=utf8;','root','Root1234!');

//if ($mysqli->connect_errno) {
//    echo "Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
//}


$url = "categories.json";
$json = file_get_contents($url);
$data = json_decode($json, true);
$datum = $data['categories'];
//print_r($datum);
//
foreach ($datum as $d) {
    $id = $d['id'];
    $name = $d['name'];
    $alias = $d['alias'];
    $children = array();

        foreach ($d['children'] as $child) {
            array_push($children, $child);
        }
        $stmt = $db -> prepare('INSERT INTO category (id, name, alias, children) VALUES(?,?,?,?)');
        $stmt -> execute(array($id, $name, $alias, json_encode($children)));

}

//
//
//
//
//}


