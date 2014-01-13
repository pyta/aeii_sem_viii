<?php
	$sql = "select name, value from settings";
	$query = mysql_query($sql);
	
	while($i = mysql_fetch_array($query)) 
	{
		if($i['name'] == 'web-title')
			$web_title = $i['value'];
		if($i['name'] == 'description')
			$description = $i['value'];
		if($i['name'] == 'keywords')
			$keywords = $i['value'];
		if($i['name'] == 'author')
			$author = $i['value'];
	}
?>