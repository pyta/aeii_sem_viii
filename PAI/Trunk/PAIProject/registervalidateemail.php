<?php
include "database.php";
include "loginuser.php";
$emailfree = false;
if(database::connectDatabase('127.0.0.1:3306','root',''))
{
          if(database::openDatabase('wymowkidatabase'));
          {
              $email = $_POST['email'];
              $query = "select * from userstable where userstable.emailuser = '$email'";
              $sql = database::executeQuery($query); 
              if($sql)
              {
                    $rowcount = mysql_num_rows($sql);  
                    if(mysql_num_rows($sql)==0)
                    {
                        $emailfree = true;
                    }
                    else
                    {
                        $emailfree = false;
                    }   
              }
              else
              {
                    echo "Blad zapytania";
              }
          }
    }
      //$valid = false;
      echo json_encode($emailfree);


