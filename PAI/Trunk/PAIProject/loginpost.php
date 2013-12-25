<?php
include "database.php";
include "loginuser.php";
session_start(); 

header("Location: http://www.onet.pl");
//    $connection=  mysql_connect('127.0.0.1:3306','root','');
//if(!$connection)
//{
//    die('Nie można nawiązać połączenia: '.mysql_error());
//    header("Location: index.php");
//}
if(database::connectDatabase('127.0.0.1:3306','root',''))
{   
    if(database::openDatabase('wymowkidatabase'));
    {
        $name = $_POST['name'];
        $pass = $_POST['password'];
        $query="select nameuser from userstable where userstable.nameuser = '$name' AND userstable.passuser = '$pass'";
        $sql=database::executeQuery($query);
        if($sql)
        {
             loginuser::checklogin($sql,$name);           
        }
        else
        {
            echo "Blad" .mysql_error();
        }
    }
}


   
    


