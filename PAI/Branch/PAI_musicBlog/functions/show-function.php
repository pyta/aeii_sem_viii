<?php	

	function show_start_html()
	{
		include('get-settings.php');
		?>
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="Description" content<?php echo "=\"$description\"";?> />
		<meta name="keywords" content<?php echo "=\"$keywords\"" ?> />
		<meta name="Author" content<?php echo "=\"$author\"" ?> />
		<meta name="Robots" content="ALL" />
		<title><?php echo "$web_title"; ?></title>
		<link href="style.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
		<script type="text/javascript" src="js/coin-slider.min.js"></script>
		<script type="text/javascript" src="js/jquery.lightbox-0.5.js"></script>
		<script type="text/javascript" src="js/registerjs.js"></script>
		<script type="text/javascript" src="js/commentjs.js"></script>
		<script type="text/javascript" src="js/messagejs.js"></script>
		<script type="text/javascript">
			$(document).ready(function() { $('#coin-slider').coinslider({ width: 565, navigation: true, delay: 5000 }); });
			$(function() { $('#gallery a').lightBox(); });
		</script>
		</head>

		<body id="bg">
			<div id="main">
		<?php
	}
	
	function show_header()
	{
		?>
		<div id="header">
        	<div class="logo"><a href="index.php" title="Blog Muzyczny - Projekt z Serwisów Internetowych"><img src="images/logo.jpg" border="0" /></a></div>
            <?php show_top_menu(); ?>
            <div class="slider">
                <div class="text">
                        <div class="title">
                            Aussiefloyd znów w Polsce!!
                        </div>
                        <div class="msg">
                        <?php
						
						$sentenceId = 1;
						$query = "Select * From sentences Where id = '$sentenceId'";
						$zapytanie = mysql_query($query);
						if($zapytanie)
						{
							$wynik = mysql_fetch_array($zapytanie);
							echo nl2br($wynik[1]);
							echo "<br>";
							echo "<b>", $wynik[2], "</b>";
						}
						
						?>
                        </div>
                </div>
            	
            	<div id="coin-slider">
                    <a href="http://www.aussiefloyd.com/">
                        <img src="images/slider1.png" />
                    </a>
                    <a href="subpage.php?page=events">
                        <img src="images/slider2.png" />
                    </a>
                </div>
                
            </div>
        </div>
		<?php
	}
	
	function show_top_menu()
	{
		$sql = "select id, title, link from menu";
		$query = mysql_query($sql);
		?>
		<div class="top-menu">
			<ul>
		<?php
		while($i = mysql_fetch_array($query)) 
		{
			echo "<li><a href=$i[link]>$i[title]</a></li>";
		}
		?>
			</ul>
		</div>
		<?php
	}
	
	function show_index()
	{
		?>
		<div id="content">
        	<?php ShowNewsPage(""); ?>
        </div><!-- klasa content -->
		<?php
	}
	
	function show_subpage()
	{
		?>
		<div id="content">
        	<?php 
				switch ($_GET['page'])
				{
					case 'start':
						ShowNewsPage();
						break;
						
					case 'sinup':
						ShowRegisterPage();
						break;
						
					case 'contact':
						include_once('show-contact-form.php');
						break;
						
					case 'events':
						show_events();
						break;
						
					case 'news':
						ShowNewsPage($_GET['id']);
						break;
						
					case 'user_session':
					
						$showUSPaction = 'in';
					
						if(isset($_GET['action']))
							$showUSPaction = $_GET['action'];
							
						ShowUserSessionPage(showUSPaction);
						break;
						
					case 'users':
						ShowUsersInfoPage($_GET['login']);
						break;
						
					case 'messages':
						if(isset($_GET['mid'])){
							$type = 1;
							$aim = $_GET['mid'];
						}	
						else {
							$type = 0;
							$aim = $_GET['id'];
						}
						ShowMessagesPage($aim, $type);
						break;
						
					case 'gallery':
						get_gallery_category();
						break;
						
					case 'galleries':
						show_gallery($_GET['id']);
						break;
						
					case 'edit':
						ShowEditPage();
						break;
						
					case 'films':
						ShowFilmsPage();
						break;
						
					case 'newpassword':
						ShowNewPasswordPage();
						break;
						
					case 'search':
						ShowSearchPage();
						break;
						
					default:
						echo"404 error";
						break;
				}
			?>
        </div><!-- klasa content -->
		<?php
	}
	
	function show_cool()
	{
		?>
		<div id="cool">
		<?php
		
		$sql= "SELECT id, title, content FROM panels";
		$query = mysql_query($sql);
		while($i = mysql_fetch_array($query)) 
		{
			show_right_box($i['id'], $i['title'], $i['content']);
		}
		?>
		</div><!-- klasa cool -->
		<?php
	}
	
	function show_footer()
	{
		?>
		</div><!-- klasa main -->
    
		<div id="footer">
			<div class="boxes"></div>
			<div class="copyright">
				<p>© 2011-2012 BlogMuzyczny - Projektowanie Aplikacji Internetowych. Projekt wyokonali: <a href="mailto:arom8989@gmail.com">Łukasz Adamik</a> oraz <a href="mailto:piociw@gmail.com">Piotr Ciwiś</a> oraz <a href="mailto:lukasz.wiewiora1@gmail.com">Łukasz Wiewióra</a>. Wszelkie prawa zastrzeżone.</p>
			</div>
		</div>
		<?php
	}
	
	function show_end_html()
	{
		?>
		</body>
		</html>
		<?php
	}
?>