<?php
if(database::connectDatabase('127.0.0.1:3306','root',''))
{
          if(database::openDatabase('wymowkidatabase'));
          {
                $name = $_POST['name'];
                $pass = $_POST['password'];
                $email = $_POST['email'];
                $useradmin = false;
                $query = "insert into userstable(nameuser, passuser, emailuser, adminuser) values ('$name','$pass','$email',false)";
                $sql = database::executeQuery($query); 
                if($sql)
                {
                    header("Location: index.php");
                }
          }
}





