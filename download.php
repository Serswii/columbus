<?php
require_once("db_connection.php");

if ($_FILES && $_FILES['inputfile'] && $_FILES['inputfile']['error'] == 0 && $_FILES['inputfile']['type'] === 'application/vnd.ms-excel') { // Проверяем на наличие ошибок
    $error = false;
    $tmpname = $_FILES['inputfile']['tmp_name'];
    $new_path = "uploads/";
    $new_name = $_FILES['inputfile']['name'] . ".csv";
    if (move_uploaded_file($tmpname, $new_path . $new_name)) { // Перемещаем файл в желаемую директорию
       if(($file = fopen($new_path . $new_name, 'rb')) !== false){
           while (($mass = fgetcsv($file, 0, ';')) !== false) {
               list($id, $name) = $mass;

               $data[] = [
                   'id' => $id,
                   'name' => $name
               ];

           }
           $out = "";
           foreach ($data as $row) {
               if (preg_match("/^[а-яА-ЯёЁa-zA-Z0-9\-.]+$/iu", $row['name'])) {
                   if($row['name'] === 'Название'){
                       $out .= $row['id'].";".$row['name'].";Error\n";
                   }
                   $out .= $row['id'].";".$row['name'].";\n";
                   $search = $mysqli->query("SELECT * FROM `product` WHERE `Код` = '{$row['id']}'");
                   $count = $search->num_rows;
                   if(empty($count)){
                       $mysqli->query("INSERT INTO `product`(`Код`, `Название`) VALUES ('{$row['id']}','{$row['name']}')");
                   }
                   else {
                       $mysqli->query("UPDATE `product` SET `Название`='{$row['name']}' WHERE `Код`='{$row['id']}'");
                   }

               } else {
                   $out .= $row['id'].";".$row['name'].";Недопустимый символ \"%s\" в поле Название\n";
               }
           }
           echo $out;
           fclose($file);
       } else {
           echo 'Profile Pic not uploaded';
       }
        include_once("report.php");
       }

}
