<?php
include "database.php";
include "loginuser.php";
$userok = false;
$user = $_POST['name'];
$pass = $_POST['password'];
if(database::connectDatabase('127.0.0.1:3306','root',''))
{
          if(database::openDatabase('wymowkidatabase'));
          {
              $query = "select userstable.nameuser from userstable where userstable.nameuser = '$user' AND userstable.passuser = '$pass'";
              $sql = database::executeQuery($query); 
              if($sql)
              {
                  if(mysql_num_rows($sql)!=0)
                  {
                        $userok=true;
                  }
              }
          }
    }
      //$valid = false;
      echo json_encode($userok);
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

