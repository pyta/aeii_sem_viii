<?php
session_start();
require_once '../../functions/sql-connect.php';
require_once 'exception.class.php';
if($_POST)
{
    if(isset($_POST['login']) && isset($_POST['pass']))
    {
        try
        {
            if($_POST['login'] && $_POST['pass'])
            {
                $login = $_POST['login'];
                $pass = $_POST['pass'];
                $sql = "SELECT * FROM users WHERE login='$login' and pass='$pass' LIMIT 1";
				$query= mysql_query($sql);
                $result = mysql_fetch_array($query);
                if($result)
                {
					if($result[range] == 5)
					{
						session_regenerate_id();
						$_SESSION['id']		= $result['id'];
						$_SESSION['login'] 	= $result['login'];
						$_SESSION['admin'] 	= 'ok';
						
						header('Location:' . $_SERVER['HTTP_REFERER']);
					}
					else
					{
						echo 'nie masz prawa do panelu...';
					}
                }
                else throw new noUser();
            }
            elseif($_POST['send']) throw new noValue();
        }
        catch(noUser $error) 
        {
            echo $error;
        }
        catch(noValue $error) 
        {
            echo $error;
        }
        catch(Exception $Error)	
        {
            echo 'Wystąpił poważny błąd. Proszę spróbować później...';
        }
    }
}
else
{
    header('Location:' . $_SERVER['HTTP_REFERER']);
}
?>
