<?php
	function show_news()
	{
		$sql = "Select n.id, u.login, n.data, n.category, n.title, n.content from news n Inner Join users u On n.author = u.id Order By n.data DESC";
		$query= mysql_query($sql);
		$allpages= mysql_num_rows(mysql_query("select * from news"));
		
		
		if($allpages < 1)
			echo OknoInformacyjne('Nie ma żadnych aktualności!', false);
		else 
		{
			$Licznik = 0;
			while($book = mysql_fetch_array($query)) 
			{
				$DMY = explode('.', $book[data]);
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
				
				show_news_box($book[id], $book[login], $D, $M, $Y, $book[category], $book[title], nl2br($book[content]));
				
				$Licznik += 1;
				if($Licznik == 1) break;
			}
			
			if($allpages > 1)
			{
				echo
				"<div id = 'box'>",
					"<div class = 'header'>",
						"<h2>Archiwum</h2>",
					"</div>",
					"<div class = 'content'>",
						"<div class = 'text'>";

				while($book = mysql_fetch_array($query)) 
				{
					$DMY = explode('.', $book[data]);
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
					
					echo "<a href = 'subpage.php?page=news&id=", $book[id], "'>", $book[title], "</a><br/>";
				}		
						
						echo
						"</div>",
					"</div>",
					"<div class = 'footer'></div>",
				"</div>";
			}
		}
	}
	
	function show_new_and_comments($newsId)
	{
		$sql = "Select n.id, u.login, n.data, n.category, n.title, n.content from news n Inner Join users u On n.author = u.id Where n.id = '$newsId'";
		$query= mysql_query($sql);
		if($query)
		{
			while($book = mysql_fetch_array($query))
			{
				$DMY = explode('.', $book[data]);
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
				show_news_box($book[id], $book[login], $D, $M, $Y, $book[category], $book[title], nl2br($book[content]));
			}
			
			echo 
			"<script type = 'text/javascript'>
				HideCommentButton($newsId);
			</script>";
			
			$Comments = new Comments($newsId);
			$Comments->Show();
		}
	}
?>