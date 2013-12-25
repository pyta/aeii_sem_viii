<?php
$fileName = $_POST['name'];
$value=false;
$db = new PDO('mysql:host=localhost;dbname=wymowkidatabase','root','');
$query = "select count(*) as allimages from imagestable where imagestable.nameimage='$fileName'";
$countData = $db->query($query)->fetchColumn();
if($countData==0)
{
     $value=true;
}

echo json_encode($value);

