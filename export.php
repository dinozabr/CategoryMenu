<?php

require __DIR__ . '/config.php';

$mysqli = new mysqli($host, $username, $password, $dbname );
$db = new PDO('mysql:host=localhost;dbname=Vladlink;charset=utf8;','root','Root1234!',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

//$a = $db -> query('SELECT name FROM category WHERE name IN (SELECT children FROM category  WHERE children=name)');
$a = $db -> query('SELECT  * FROM category ');

//$rows1 = $a->fetchAll();
//
//print_r($rows1);
//$rows = $a->fetch();
//print_r($rows);
$arr = array();
while($rows = $a -> fetchObject()) {
    array_push($arr, $rows);


//    print_r($rows);
//    $ar = $rows -> children;
//    print_r($ar);
//    $arr1 = array();
//    print_r("$rows[name] \n");
//    if (sizeof($ar) > 0)
//        for ($i = 0; $i < sizeof($ar); $i++) {
//            array_push($arr1,$rows['name']);
//            if($rows['id'])
//            while (json_decode($rows['children']) == 0) {
//
//            }

    // Получение элемента вроде get_id(ребенок) не через циклы
}
//print_r($arr);
for ($i = 0; $i < sizeof($arr); $i++) {

    $temp = json_decode($arr[$i]->children);

    if (!empty($temp)) {
       print_r($arr[$i]->name . "\n");

//        print_r("not empty");

        for ($t = 0; $t < sizeof($temp); $t++) {
            for ($j = 0; $j < sizeof($arr); $j++)
                if ($temp[$t] == $arr[$j]->id) {
//                    print_r("     " . ($arr[$j]->name) . "\n");
                    recurse($arr, "   ", $j);
                 }

        }
    }
//    print_r($temp);
//    print_r(($arr[$i]->children) . "\n");



}

function recurse($all, $countTable, $idPredok){
    //if have childs
    if (strlen($all[$idPredok]->children) > 2) { //[] = 2symbol
        $countTable = $countTable * 3;
        recurse($all, $countTable, $all[$idPredok]->children);
    } else {
        print_r($countTable . $all[$idPredok]->children);
        return;
    }

}