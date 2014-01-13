<?php
	function show_events()
	{
		$order = "date";
		$perpage =15;
		$date = date("G:i:s, d.m.Y");  
		$current_date=date("Ym");
		$next_date=$current_date+1;
		$sql = "select e.id, e.category, e.title, e.content, e.date, u.login as log from events e Inner Join users u On e.usersId = u.id ORDER BY ".$order;
			
		$query= mysql_query($sql);		
		$allpages= mysql_num_rows(mysql_query("SELECT * FROM events"));
		
		if($allpages < 1)
		{
			echo
			"<div id = 'box'>",
				"<div class = 'header'>",
					"<h2>Wydarzenia</h2>",
				"</div>",
				"<div class = 'content'>",
					"<div class = 'text'>";
			echo OknoInformacyjne('Aktualnie brak wydarzeń do wyświetlenia ...', false);
					echo
					"</div>",
				"</div>",
				"<div class = 'footer'></div>",
			"</div>";
		}
		else 
		{		
			while($i = mysql_fetch_array($query)) 
			{
				//echo $i['date'];
			
				$DMY = explode('-', $i['date']);
				list ($D, $M, $Y)= $DMY;
				if ($M=="01") $M="stycznia";
				if ($M=="02") $M="lutego";
				if ($M=="03") $M="marca";
				if ($M=="04") $M="kwietnia";
				if ($M=="05") $M="maja";
				if ($M=="06") $M="czerwca";
				if ($M=="07") $M="lipca";
				if ($M=="08") $M="sierpnia";
				if ($M=="09") $M="września";
				if ($M=="10") $M="października";
				if ($M=="11") $M="listopada";
				if ($M=="12") $M="grudnia";
				
				show_news_box($i['id'], $i['log'], $D, $M, $Y, $i['category'], $i['title'], $i['content']);
			}
		}
	}
?>