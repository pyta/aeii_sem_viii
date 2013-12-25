<?php
session_start();
$page = $_POST['page'];
$comment = $_POST['comment'];
$nameuser = $_SESSION['name'];
$idimage = $_POST['idimage'];
$iduser;
$database = new PDO('mysql:host=localhost;dbname=wymowkidatabase', 'root', '');
$query = "select iduser as iduser from userstable where nameuser='$nameuser'";
$data = $database->query($query);

foreach($data as $row)
{
    $iduser = $row['iduser'];
}
$data->closeCursor();

$idimage = trim($idimage,'/');
$date = date('Y-m-d H:i:s');
$query = "insert into commentstable(comment,idimage,iduser,datecomment) values ('$comment',$idimage,$iduser,'$date')";

$data = $database->exec($query);
if($data==false)
{
    echo "Blad" .  mysql_error();
}
else
{
    header("Location: index.php?page=$page");
}
//header("Location: http://www.wp.pl");
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

