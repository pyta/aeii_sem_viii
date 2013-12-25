<?php
include "database.php";
include "loginuser.php";
$lor= $_POST['loginorregister'];
$namefree = false;
if(database::connectDatabase('127.0.0.1:3306','root',''))
{
          if(database::openDatabase('wymowkidatabase'))
          {
              $name = $_POST['name'];
              $query = "select * from userstable where userstable.nameuser = '$name'";
              $sql = database::executeQuery($query); 
              if($sql)
              {
                    $rowcount = mysql_num_rows($sql);         
                    if(mysql_num_rows($sql)==0)
                    {
                        if($lor== true)
                        {
                            $namefree = false;//logowanie
                        }
                        else
                        {
                            $namefree = true;
                        }              
                    }
                    else
                    {
                        if($lor== true)
                        {
                            $namefree = true;//logowanie
                        }
                        else
                        {
                            $namefree = false;
                        }
                    }           
              }
              else
              {
                    die("Blad zapytania");
              }
           
          } 
          else
          {
              die("Blad otwarcia bazy");
          }
}
else
{
    die("Blad polaczenie z serwerem");
}
echo json_encode($namefree);


