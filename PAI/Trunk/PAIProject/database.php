<?php
class database {

    static public function connectDatabase($server, $user, $pass)
    {
        $connection=  mysql_connect($server,$user,$pass);
        if(!$connection)
        {
            die('Nie można nawiązać połączenia: '.mysql_error());
            //header("Location: index.php");
            return false;
        }
        return true;
    }
    static public function openDatabase($name)
    {
        $databaseconnection = mysql_select_db($name);
        if(!$databaseconnection)
        {
            die('Nie można nawiązać połączenia z bazą danych: '.mysql_error());
            return false;
        }
        return true;
    }
    static public function executeQuery($query)
    {
        $sql = mysql_query($query);
        if($sql)
        {
            return $sql;
        }
        else
        {
            die('Blad zapytania: '.mysql_error());
            return false;
        }
    }
}
