<?php
include "database.php";
include "image.php";
include "loginuser.php";
if(isset($_SESSION['name']))
{
if(image::checkExtensionImage())
{
    if(!image::isErrorImage())
    {
        if(!image::fileExists())
        {
             if(database::connectDatabase('127.0.0.1:3306','root',''))
             {   
                    if(database::openDatabase('wymowkidatabase'));
                    {
                          $name = $_SESSION['name'];
                          $query = "select nameuser, iduser from userstable where userstable.nameuser = '$name'";
                          $sql=database::executeQuery($query);
                          if($sql)
                          {
                               $iduser = loginuser::getIdUser($sql);
                               if($iduser!=null)
                               {
                                   $path="images/" . $_FILES["file"]["name"];
                                   $name=$_FILES["file"]["name"];
                                   $date = date('Y-m-d H:i:s'); 
                                   echo $date;
                                   $query = "insert into imagestable(pathimage, nameimage, iduser, addDate, accept) values ('$path','$name',$iduser,'$date',0)";
                                   $score = (database::executeQuery($query));
                                   if(!$score)
                                   {
                                       die("Blad zapisu " .mysql_error());
                                   }
                                   else
                                   {
                                       image::uploadImage();
                                       header("Location: index.php");
                                   }
                                }
                            }           
                    }
             }
        }
    }
}
}


