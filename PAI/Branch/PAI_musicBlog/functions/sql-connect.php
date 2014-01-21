<?php
	$host = '127.0.0.1';
	$login = 'root';
	$password = 'vertrigo';
	$database = 'laverte_13';
	
	$connect = @mysql_connect ($host, $login, $password);
	$error = mysql_error();
	mysql_query("SET NAMES utf8");
	
	if (!$connect)
	{
		echo "błąd połączenia: <b>$error</b>";
		exit;
	}
	
	$select_database = @mysql_select_db($database, $connect);
	$error = mysql_error();
	
	if (!$select_database)
	{
		echo "błąd wyboru bazy: <b>$error</b>";
		mysql_close($connect);
		exit;
	}
	else
	{
		mysql_query("SET NAMES utf8");
	}
?>