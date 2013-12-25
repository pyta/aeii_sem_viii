<?php
session_start();
class loginuser {
    static function checklogin($sql,$name)
    {
        if(mysql_num_rows($sql)==0)
        {
            echo "Blad logowania";
            header("Location: login.php");
        }
        else
        {
             $_SESSION['loginok']=true;
             $_SESSION['name']=$name;
             header("Location: index.php");
             echo "Ok" ;
        }    
    }
    
    static function getIdUser($sql)
    {
        if(mysql_num_rows($sql)!=0)
        {
             $iduser=null;
             while($row = mysql_fetch_array($sql))
             {
                  $iduser=$row['iduser'];
                  return $iduser;
             }
        }
        return null;
    }
}
