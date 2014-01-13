<?php
	
	function get_gallery_category()
	{
		$sql = "select id, title, description, addDate, patch, thumbnail from gallery_category";
		$query = mysql_query($sql);
		$allcats = mysql_num_rows(mysql_query("select * from gallery_category"));
		
		if ($allcats < 1 )
			echo OknoInformacyjne('Brak kategorii do wyświetlenia ...', false);
		else
		{
			while($i = mysql_fetch_array($query))
			{
				$DMY = explode('-', $i['addDate']);
				list ($Y, $M, $D)= $DMY;
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
				show_category_box($i['id'], $i['title'], $i['description'], $D, $M, $Y, $i['patch'], $i['thumbnail']);
			}
		}
	}
	
	function show_gallery($id)
	{
		$sql_cat = "select tit_id, title, description, patch  from gallery_category where id = '$id'";
		$query = mysql_query($sql_cat);
		$i = mysql_fetch_array($query);
		$tit_id	= $i[0];
		$title = $i[1];
		$description = $i[2];
		$patch = $i[3];
		
		$sql_photo = "select id, category, name, url, description, addDate, thumbnail from gallery_photo where tit_cat_id = '$tit_id'";
		$query_photo = mysql_query($sql_photo);
		$allphoto = mysql_num_rows(mysql_query("select * from gallery_photo where tit_cat_id = '$tit_id'"));
		
		if($allphoto < 1)
			echo OknoInformacyjne('Brak zdjęć do wyświetlenia...', false);
		else
		{
			echo "<div id='box'>",
					"<div class='header'>",
						"<h2>$title</h2>",
					"</div>",
					"<div class='content'>",
						"<div class='text'>",
							"<div id='gallery'>",
								"<ul style='text-align:center;'>";
									while($i = mysql_fetch_array($query_photo))
									{
										$DMY = explode('-', $i['addDate']);
										list ($Y, $M, $D)= $DMY;
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
									
										echo "<li>",
												"<a href='$patch/$i[url]' alt='$i[name]' title='<p><u><i>Opis zdjęcia:</i></u><br />$i[description]</p><p><u><i>Data dodania:</u></i></p> $D $M $Y r.'>",
													"<img src='$patch/$i[thumbnail]' alt='$i[name]' class='thumbnail' />",
												"</a>",
											"</li>";
									}
					echo 		"</ul>",
							"</div>",
						"</div>",
						"<p id='inf'>",
						"$description",
					"</p>",
					"</div>",
				"<div class='footer'></div>",
			"</div><!-- klasa box -->";
		}
	}

?>