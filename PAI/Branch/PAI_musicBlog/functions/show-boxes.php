<?php 
	function show_news_box($id, $author, $D, $M, $Y, $category, $title, $content)
	{
		$SID = session_id();
		if(empty($SID))
		{		
			session_start();
		}
		?>
		<div id="box">
			<div class="header">
				<h2><?php echo $title; ?></h2>
			</div>
			<div class="content">
				<div class="text">
					<?php echo $content; ?>
				</div>
				<p id="inf">
					Autor artykułu: <?php echo $author ?>, dodano: <?php echo "$D $M, $Y r."; ?> w kategorii: <?php echo $category; ?>
				</p>
				
				<?php
				if($category == 'news')
					echo
					"<p id = 'inf'>
						<p name = 'ShowCommentsButton' id = 'ShowCommentsButton$id' class = 'button' style = 'text-align:center; width:150px; float:left; margin-left:20px; margin-top:0px;' onclick = \"location.href = 'subpage.php?page=news&id=$id';\">Czytaj komentarze</p>
					</p>";
				?>
				
			</div>
			<div class="footer"></div>
		</div><!-- klasa box -->
	<?php
	}
	
	function show_right_box($id, $title, $content)
	{
		$SID = session_id();		
		if(empty($SID))
		{
			session_start();
		}
		?>
        	<div id="box">
        		<div class="header">
               		<h2><?php echo $title; ?></h2>
                </div>
                <div class="content">
					<div class="text">
						<?php
						
						/* Jesli box jest boxem do logowania to spradzamy czy istnieje zmienna sesji. Jeśli tak wyświetlamy coś ładnego.
						   Jeśli box nie służy do logowanie to normalnie zostanie wyśiwtlony jego tekst. */
						
						if($title == 'Logowanie') 
						{
							if(isset($_SESSION['userName'])) ShowUserPanel($_SESSION['userName']); // Jakiś panel
							else echo $content;
						} 
						else echo $content;
						
						?>
					</div>
                </div>
                <div class="footer"></div>
            </div><!-- klasa box -->
	<?php
	}
	
	function show_category_box($id, $title, $description, $D, $M, $Y, $patch, $thumbnail)
	{
		?>
		<div id="box">
			<div class="header">
				<h2><a href="subpage.php?page=galleries&id=<?=$id?>"><?php echo $title; ?></a></h2>
			</div>
			<div class="content">
				<div class="text">
					<img src=<?="$patch/$thumbnail"?> class="thumbnail" />
					<?php echo $description; ?>
				</div>
				
			</div>
			<p id="inf" style="background:url(images/content-bg.png) repeat-y;">
					dodano: <?php echo "$D $M, $Y r."; ?> w kategorii: <?php echo $patch; ?>, <a href="subpage.php?page=galleries&id=<?=$id?>">przeglądaj galerie</a>
			</p>
			<div class="footer"></div>
		</div><!-- klasa box -->
	<?php
	}
?>