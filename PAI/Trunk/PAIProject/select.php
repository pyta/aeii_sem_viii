<?php

$rateUser = $_POST['newSelect'];
$name = rtrim($_POST['name'],'/');

$rate = 0;
$count = 0;
$database = new PDO('mysql:host=localhost;dbname=wymowkidatabase', 'root', '');
$query = "select rate, rateCount from imagestable where nameimage='$name'";
$data = $database->query($query);
$page = $_POST['page'];
foreach($data as $row)
{
    $rate = $row['rate'];
    $count = $row['rateCount'];
}
$data->closeCursor();
$rate = $rate*$count;
$count++;
$rate = ($rate+$rateUser)/$count;
$query = "update imagestable set rate=$rate, rateCount=$count where nameimage='$name'";
$data = $database->exec($query);
//$data->bindValue(':rate',$rate, PDO::PARAM_LOB);
//$data->bincValue(':rateCount',$count,PDO::PARAM_INT);
//$data->bincValue(':name',$name,PDO::PARAM_STR);
//$data->execute();
header("Location: index.php?page=$page");

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

