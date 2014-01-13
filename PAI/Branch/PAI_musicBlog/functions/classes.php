<?php

	/* Lista klas:
		
		- User
		- Comment
		- Comments
		- News
		- Message
		- Messages
		- Friend
		- Friends
		- FilmsCategory
		- Film
		- Search
	*/

class User
{
	private $_id;
	private $_login;
	private $_pass;
	private	$_mail;
	private	$_forname;
	private $_surname;
	private $_city;
	private $_sex;
	private $_bornDate;
	private $_addDate;
	private $_avatar;
	private $_about;
	private $_range;
	
	function __construct($id, $login, $pass, $mail, $forname, $surname, $city, $sex, $bornDate, $addDate, $avatar, $about, $range)
	{
		$this->_id 			= $id;
		$this->_login 		= $login;
		$this->_pass 		= $pass;
		$this->_mail 		= $mail;
		$this->_forname 	= $forname;
		$this->_surname 	= $surname;
		$this->_city 		= $city;
		$this->_sex 		= $sex;
		$this->_bornDate 	= $bornDate;
		$this->_addDate 	= $addDate;
		$this->_about		= $about;
		$this->_range		= $range;
		
		if(empty($avatar)) $this->_avatar = '_def.jpg';
		else $this->_avatar	= $avatar;
	}
	
	function __get($name) {
		if(empty($this->$name) && ($name != '_sex' || $name != 'avatar')) return '[Nie podano]';
		else return $this->$name;
	}
	function __set($name, $value) {$this->$name = $value;}
}

class Comment
{
	private $_id;
	private $_text;
	private $_login;
	private $_newsId;
	private $_addDate;
	private $_usersAvatar;
	private $_day;
	private $_hour;
	
	function __construct($id, $text, $login, $newsId, $addDate)
	{
		$this->_id 			= $id;
		$this->_text 		= nl2br($text);
		$this->_login 		= $login;
		$this->_newsId 		= $newsId;
		$this->_addDate 	= $addDate;
		
		$query = "Select avatar From users Where login = '$this->_login'";
		$zapytanie = @mysql_query($query);
		if($zapytanie) {
			$wynik = mysql_fetch_array($zapytanie);
			if(empty($wynik[0])) $this->_usersAvatar = "_def.jpg";
			else $this->_usersAvatar = $wynik[0];
		}
		
		$ardat = explode(' ', $this->_addDate);
		$this->_day = $ardat[0];
		$this->_hour = $ardat[1];
	}
	
	function __get($name) {return $this->$nazwa;}
	function __set($name, $value) {$this->$name = $value;}
	
	function Show()
	{
		echo 
		"<table style = 'width: 100%; border-spacing: 0px;'>",
			"<tr>",
				"<td rowspan = '2' style = 'text-align: center; vertical-align: middle; width: 150px;'><img src = 'images/avatars/$this->_usersAvatar' style = 'width: 50px; height: 50px;'><br/><a href = 'subpage.php?page=users&login=$this->_login'>$this->_login</a></td>",
				"<td style = 'text-align: left; vertical-align: top; padding-left: 5px; padding-right: 5px;'>$this->_text</td>",
			"</tr><tr>",
				"<td style = 'text-align: right; font-size: 10px; height: 15px;'>dodano: <b>", ChangeDate($this->_day), "</b> o godzinie: <b>$this->_hour</b></td>",
			"</tr><tr>",
		"</table>";
	}
}

class Comments
{
	private $_commentsCount;
	private $_newsId;

	function __construct($newsId)
	{
		$query = "Select Count(*) From comments Where newsId = '$newsId'";
		$zapytanie = @mysql_query($query);
		if($zapytanie) {
			$wynik = mysql_fetch_array($zapytanie);
			$this->_commentsCount = $wynik[0];
		}
		$this->_newsId = $newsId;
	}
	
	function Show()
	{	
		echo "<p id = 'inf' style = 'text-align: center;'><h5>Komentarze:</h5></p><br/>";
			
		if($this->_commentsCount == 0) 
		{
			echo OknoInformacyjne("Nie ma żadnych komentarzy!", false);
			$Pop = '&nbsp;';
			$Nas = '&nbsp;';
		}
		else 
		{
			/* Dodawanie nowych komentarzy do bazy */
			AddComment($this->_newsId);
		
			/* Określanie liczby komentarzy na stronie */
			if(isset($_GET['site'])) {
				$LimitDown 	= ($_GET['site'] - 1) * 4;
				$LimitUp 	= $LimitDown + 4;
			} else {
				$LimitDown 	= 0;
				$LimitUp 	= 4;
			}
		
			$query = "Select comments.id, comments.text, users.login, comments.newsId, comments.addDate From comments Inner Join users On comments.usersId = users.id Where newsId = '$this->_newsId' Order By addDate ASC Limit $LimitDown, $LimitUp";
			$zapytanie = @mysql_query($query);
			if($zapytanie)
			{
				$Licznik = 1;
				while($wynik = mysql_fetch_array($zapytanie))
				{
					echo "<br/>";
					$Comment = new Comment($wynik[0], $wynik[1], $wynik[2], $wynik[3], $wynik[4]);
					$Comment->Show();
					echo "<br/>";
					if($Licznik != mysql_num_rows($zapytanie)) echo "<hr>";
					$Licznik += 1;
				}
				
				/* Wyświetlenie odnośników do przechodzenia między stronami */
				if(isset($_GET['site'])) $AktualnaStrona = $_GET['site'];
				else $AktualnaStrona = 1;
					
				$Nastepna = $AktualnaStrona + 1;
				$Poprzednia = $AktualnaStrona - 1;
					
				$query = "Select Count(*) From comments Where newsId = '$this->_newsId'";
				$zapytanie = @mysql_query($query);
				if($zapytanie)
				{
					$wynik = mysql_fetch_array($zapytanie);
					$CommentsCount = $wynik[0];
				}
				else $CommentsCount = 0;
					
				if(($CommentsCount - ($AktualnaStrona * 4)) > 0) {
					$Nas = "<a href = 'subpage.php?page=news&id=$this->_newsId&site=$Nastepna'><img src = 'images/next.png' style = 'width: 50px; height: 50px;'></a>";
				} else $Nas = '&nbsp;';
				if(($AktualnaStrona * 4) > $CommentsCount && $AktualnaStrona != 1) {
					$Pop = "<a href = 'subpage.php?page=news&id=$this->_newsId&site=$Poprzednia'><img src = 'images/prev.png' style = 'width: 50px; height: 50px;'></a>";
				} else $Pop = '&nbsp;';
			}
		}
		
		// ***************************************** wyświetlanie guzika 'dodaj komantarz' dla zalogowanych użytkowników
		
		if(isset($_SESSION['userName'])) 
		{
			echo "<br><p name = 'ShowCommentFormButton' class = \"button\" style = \"text-align:center; width:100px; float:right; margin-right:20px; margin-top:0px;\" onclick = \"ShowCommentsForm($this->_newsId);\">Dodaj komentarz</p>";
			echo "<br><br>";
			
			// ***************************************** div na formularz
			echo "<form name = 'CommentsFormNo$this->_newsId' action = 'subpage.php?page=news&id=$this->_newsId' method = 'POST'>";
			echo "<br><div id = '$this->_newsId'>";
			echo "</div>"; 
			echo "</form>";
		}
		
		echo "<img src = 'images/musicbreak.png' style = 'width: 550px; height: 25px;'>";
		
		echo 
		"<table style = 'width: 100%; border-spacing: 0px;'>",
			"<tr>",
				"<td colspan = '3'>&nbsp;</td>",
			"</tr>",
			"<tr>",
				"<td style = 'width: 30%; text-align: lefr;'>$Pop</td>",
				"<td style = 'width: 40%; text-align: center;'><p class = 'button' onclick = \"location.href = 'index.php';\">Strona główna</p></td>",
				"<td style = 'width: 30%; text-align: right;'>$Nas</td>",
			"</tr>",
		"</table>";
	}
}

class News
{
	private $_id;
	private $_author;
	private $_addDate;
	private $_category;
	private $_title;
	private $_content;
	
	private $_day;
	private $_hour;
	
	public function __construct($id, $author, $addDate, $category, $title, $content)
	{
		$this->_id 			= $id;
		$this->_author 		= $author;
		$this->_addDate 	= $addDate;
		$this->_category 	= $category;
		$this->_title 		= $title;
		$this->_content 	= nl2br($content);
		
		$ardat = explode(' ', $this->_addDate);
		$this->_day = $ardat[0];
		$this->_hour = $ardat[1];
	}
	
	public function Show($type)
	{
		echo
		"
		<div id = 'box'>
			<div class = 'header'>
				<h2>$this->_title</h2>
			</div>
			<div class = 'content'>
				<div class = 'text'>
					$this->_content
				<p id = 'inf' style = 'text-align: right;'>
					dodano: <b>", ChangeDate($this->_day), "</b> o godzinie: <b>$this->_hour</b> przez <b>$this->_author</b>
				</p>
		";
				
		if($type == 1)
		{
			$Comments = new Comments($this->_id);
			$Comments->Show();
		}
		else
		{
			echo
			"<p id = 'inf'>
				<p name = 'ShowCommentsButton' id = 'ShowCommentsButton$this->_id' class = 'button' style = 'text-align:center; width:150px; float:left; margin-left:20px; margin-top:0px;' onclick = \"location.href = 'subpage.php?page=news&id=$this->_id';\">Czytaj komentarze</p>
			</p>";
		}
		
		echo
		"
				</div>
			</div>
			<div class = 'footer'></div>
		</div>
		";
	}
}

class Message
{
	private $_id;
	private $_senderId;
	private $_recipientId;
	private $_text;
	private $_sendDate;
	private $_state;
	
	function __construct($id, $senderId, $recipientId, $text, $sendDate, $state)
	{
		$this->_id 			= $id;
		$this->_senderId 	= $senderId;
		$this->_recipientId = $recipientId;
		$this->_text 		= $text;
		$this->_sendDate 	= $sendDate;
		$this->_state 		= $state;
	}
	
	function __get($name) {return $this->$nazwa;}
	function __set($name, $value) {$this->$name = $value;}
	
	function MessageRead()
	{
		$this->_state = 1;
		$query = "Update messages Set state = '$this->_state'";
		$zapytanie = @mysql_query($query);
	}
	
	function ShowShort()
	{
		$ShortText 	= substr($this->_text, 0, 10);
		$ShortText 	.= '...';
		$DateTime 	= explode(' ', $this->_sendDate);
		if($this->_state == 0) $class = 'messageListUnactiv';
		else $class = 'messageListActiv';
		
		echo
		"<tr class = '$class' onclick = \"location.href = 'subpage.php?page=messages&mid=$this->_id';\">",
			"<td style = 'width: 30%; height: 30px;'>", $this->_senderId, "</td>",
			"<td style = 'width: 40%; height: 30px;'>", $ShortText,"</td>",
			"<td style = 'width: 30%; height: 30px;'>", ChangeDate($DateTime[0]), "&nbsp;",  $DateTime[1], "</td>",
		"</tr>";
	}
	
	function ShowLong()
	{
		$senderId 		= $_SESSION['userId'];
		$recipientId 	= $this->_senderId;
		$query = "Select login, avatar From users Where id = '$this->_senderId'";
		$zapytanie = @mysql_query($query);
		if($zapytanie) 
		{
			$wynik = mysql_fetch_array($zapytanie);
			$senderName = $wynik[0];
			$senderAvatar = $wynik[1];
			$DateTime = explode(' ', $this->_sendDate);
			
			echo
			"<table style = 'width: 100%; border-spacing: 0px;'>",
				"<tr>",
					"<td style = 'text-align: left; width: 40%;'>",
						"<img src = \"images/avatars/$senderAvatar\" style = 'width: 50px; height: 50px;' />",
					"</td>",
					"<td style = 'text-align: center; width: 60%;'>",
						"<a href = \"subpage.php?page=users&login=$senderName\"><b>$senderName</b></a>",
					"</td>",
				"</tr>",
				"<tr>",
					"<td colspan = '2' style = 'text-align: center;'><h5>Treść wiadomości</h5></td>",
				"</tr>",
				"<tr>",
					"<td colspan = '2'>&nbsp;<br/>", nl2br($this->_text), "</td>",
				"</tr>",
				"<tr>",
					"<td colspan = '2' style = 'text-align: center;'><h5>&nbsp;</h5></td>",
				"</tr>",
				"<tr>",
					"<td colspan = '2' style = 'text-align: right;'><b>", ChangeDate($DateTime[0]), "&nbsp;",  $DateTime[1] ,"</b></td>",
				"</tr>",
				"<tr>",
					"<td colspan = '2' style = 'text-align: center;'>&nbsp;</td>",
				"</tr>",
				"<tr>",
					"<td style = 'text-align:center;' colspan = '2'><p class = 'button' style = 'text-align: center; width: 150px; margin:auto;' onclick = \"ShowMessageForm('messagediv');\">Odpowiedz</p></td>",
				"</tr>",
				"<tr>",
					"<td style = 'text-align: center;' colspan = '2'>",
						"<form action = 'subpage.php?page=messages&id=$this->_recipientId' method = 'POST' name = 'SendMessage'>",
							"<input type = 'hidden' value = \"$senderId\" name = 'senderId'>",
							"<input type = 'hidden' value = \"$recipientId\" name = 'recipientId'>",
						"<div id = 'messagediv'>";			
			
			echo "</div></form></td></tr></table>";
		}
	}
}

class Messages
{
	private $_recipientId;
	private	$_type;				// 1 - wyswietla calosc, 0 - liste
	
	function __construct($recipientId, $type)
	{
		$this->_recipientId = $recipientId;
		$this->_type 		= $type;
	}
	
	function Show()
	{
		echo 
		"<div id = 'box'>",
			"<div class = 'header'>",
				"<h2>Wiadomosci</h2>",
			"</div>",
			"<div class = 'content'>",
				"<div class = 'text'>";
	
		if($this->_type == 1)
		{
			$query = "Select id, senderId, recipientId, text, sendDate, state From messages Where messages.id = '$this->_recipientId'";
			$zapytanie = @mysql_query($query);
			if($zapytanie) {
				$wynik = mysql_fetch_array($zapytanie);
				$message = new Message($wynik[0], $wynik[1], $wynik[2], $wynik[3], $wynik[4], $wynik[5]);
				$message->ShowLong();
				$message->MessageRead();
			}
		}
		else
		{
			$query = "Select messages.id, users.login, messages.recipientId, messages.text, messages.sendDate, messages.state From messages Inner Join users On messages.senderId = users.id Where recipientId = '$this->_recipientId'";
			$zapytanie = @mysql_query($query);
			if($zapytanie) {
				echo "<table style = 'width: 100%; border-spacing: 0px;'><tr><td colspan = '3'>";
				SendMessage();
				echo "</td></tr>";
				while($wynik = mysql_fetch_array($zapytanie))
				{
					$message = new Message($wynik[0], $wynik[1], $wynik[2], $wynik[3], $wynik[4], $wynik[5]);
					$message->ShowShort();
				}
				echo "<tr><td colspan = '3'></td></tr></table>";
			}
		}
		
		echo 
				"</div>",
			"</div>",
			"<div class = 'footer'></div>",
		"</div>";
	}
}

class Friend
{
	private $_id;
	private $_senderId;
	private $_recipientId;
	private $_sendDate;
	private $_avatar;
	
	private $_HelpsId; // konsekwencja niekonsekwencji
	
	public function __construct($id, $senderId, $recipientId, $sendDate)
	{
		$this->_id 			= $id;
		$this->_senderId 	= $senderId;
		$this->_recipientId = $recipientId;
		$this->_sendDate 	= $sendDate;
		
		$query = "Select id, avatar From users Where login = '$this->_recipientId'";
		$zapytanie = @mysql_query($query);
		if($zapytanie)
		{
			$wynik = mysql_fetch_array($zapytanie);
			$this->_HelpsId = $wynik[0];
			
			if(empty($wynik[1])) $this->_avatar = '_def.jpg';
			else $this->_avatar = $wynik[1];
		}
	}

	function __get($name) {return $this->$nazwa;}
	function __set($name, $value) {$this->$name = $value;}
	
	public function Show()
	{
		if(isset($_SESSION['userId']) && ($this->_HelpsId != $_SESSION['userId'])) $Message = "<img src = 'administrator/images/icons/email.png' onclick = 'ShowQuickMessageDiv($this->_HelpsId);'>";
		else $Message = '&nbsp;';
		
		echo 
		"<tr>",
			"<td style = 'width: 20%; text-align: left;'><img src = \"images/avatars/", $this->_avatar, "\" style = 'width: 50px; height: 50px;'></td>",
			"<td style = 'width: 60%; text-align: center;'><a href = \"subpage.php?page=users&login=$this->_recipientId\">$this->_recipientId<a/></td>",
			"<td style = 'width: 20%; text-align: right;'>", $Message, "</td>",
		"</tr>";
	}
}

class Friends
{
	public function __construct($id)
	{
		$query = "Select f.id, u1.login, u2.login, f.sendDate From friends f Left Join users u1 On f.senderId = u1.id Left ";
		$query .= "Join users u2 On f.recipientId = u2.id Where f.senderId = '$id'";
		
		$zapytanie = @mysql_query($query);
		if($zapytanie)
		{
			if(mysql_num_rows($zapytanie) == 0) echo "Brak znajomych!";
			else
			{
				echo "<table style = 'width: 100%;'>";
				while($wynik = mysql_fetch_array($zapytanie))
				{
					$FriendPosition = new Friend($wynik[0], $wynik[1], $wynik[2], $wynik[3]);
					$FriendPosition->Show();
				}
				echo "</table>";
			}
			
			/* Latający div dający możliwość wysłania wiadomości */
			echo 
			"<div style = 'margin: auto; width: 1000px; height: 800px; visibility:hidden; position: fixed; top: 100px; left: 100px;' id = 'QuickMessage'>",
				"<div id = 'box'>",
					"<div class = 'header'>",
						"<h2>Wyślij wiadomość</h2>",
						"<img src = 'images/error.png' style = 'float: right; margin-top:-33px;' onclick = 'HideQuickMessageDiv();'>",
					"</div>",
					"<div class = 'content'>",
						"<div class = 'text' style = 'text-align:center;'>",
							// Fragment odpowiedzialny za wysylanie szybkiej wiadomosci
							"<form action = \"subpage.php?page=users&login=$_SESSION[userName]\" method = 'POST' name = 'SendQuickMessage'>",
								"<input type = 'hidden' value = \"$id\" name = 'senderId'>",
								"<input type = 'hidden' value = \"\" name = 'recipientId'>";

	echo 
	"<table style = 'width: 100%; border-spacing: 0px;'>",
        "<tr>",
            "<td style = 'vertical-align: middle; text-align: center;'><br/><h5>Treść wiadomości</h5></td>",
        "</tr><tr>",
            "<td>&nbsp;</td>",
        "</tr><tr>",
			"<td style = 'text-align: center;'><textarea name = 'messagetext'></textarea></td>",
		"</tr><tr>",
            "<td>&nbsp;</td>",
        "</tr><tr>",
            "<td>",
                "<p class = 'submit' style = 'text-align:center;'>",
                    "<input type = 'submit' value = 'Wyślij wiadomość' />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",
                    "<input type = 'reset' value = 'Reset' />",
                "</p>",
				"<br/>",
            "</td>",
        "</tr>",
    "</table>";
	
			echo
							"</form>",
						"</div>",
					"</div>",
					"<div class = 'footer'></div>",
				"</div>",
			"</div>";
		}
	}
}

class FilmsCategory
{
	private $_id;
	private $_name;
	private $_description;
	private $_addDate;
	private $_image;
	private $_viewImage;
	private $_filmsCount;
	private $_day;
	private $_hour;
	private $_usersId;
	
	public function __construct($id, $name, $description, $addDate, $image, $viewImage, $usersId)
	{
		if(empty($image)) $image = 'noimage.jpg';
		if(empty($viewImage)) $viewImage = 'noimage.jpg';
		
		$this->_id 			= $id;
		$this->_name 		= $name;
		$this->_description = $description;
		$this->_addDate 	= $addDate;
		$this->_image 		= $image;
		$this->_viewImage 	= $viewImage;
		$this->_usersId		= $usersId;
			
		$query = "Select categoryId, Count(*) From films Where categoryId = '$id' Group By categoryId";
		
		$zapytanie = @mysql_query($query);
		if($zapytanie)
		{
			if(mysql_num_rows($zapytanie) == 0) $this->_filmsCount = 0;
			else
			{
				$wynik = mysql_fetch_array($zapytanie);
				$this->_filmsCount = $wynik[1];
			}
		}
		
		$ardat = explode(' ', $this->_addDate);
		$this->_day = $ardat[0];
		$this->_hour = $ardat[1];
	}
	
	public function __get($name) {return $this->$nazwa;}
	public function __set($name, $value) {$this->$name = $value;}
	
	public function Show()
	{
		echo
		"<div id = 'box'>",
			"<div class = 'header'>",
				"<h2>$this->_name</h2>",
			"</div>",
			"<div class = 'content'>",
				"<div class = 'text'>",
							
					// Tabela wyświetlająca kategorie
					"<table style = 'width: 100%; border-spacing: 0px;'>",
						"<tr>",
							"<td>",
								"<a href = 'subpage.php?page=films&cat=$this->_id'><img src = 'images/$this->_image' style = 'width: 300px; height: 200px;'></a>",
							"</td><td style = 'text-align: left; vertical-align: top; padding-left: 10px; padding-right: 10px;'>",
								$this->_description,
							"</td>",
						"</tr>",
						"<tr>",
							"<td colspan = '2' style = 'text-align: right;'>",
								"<h4>Liczba filmów w galerii: ", $this->_filmsCount, "</h4>",
								"<br/>",
							"</td>",
						"</tr>",
						"<tr>",
							"<td colspan = '2' style = 'text-align: left;'>",
								"<p id = 'inf'>Dodano: <b>", ChangeDate($this->_day), "</b> o godzinie: <b>", $this->_hour, "</b> przez <b>", $this->_usersId, "</b></p>",
							"</td>",
						"</tr>",
					"</table>";
						
		echo 
				"</div>",
			"</div>",
			"<div class = 'footer'></div>",
		"</div>";
	}
}

class Film
{
	private $_id;
	private $_name;
	private $_link;
	private $_categoryId;
	private $_description;
	private $_image;
	private $_addDate;
	private	$_usersId;
	
	private $_day;
	private $_hour;
	
	public function __construct($id, $name, $link, $categoryId, $description, $image, $addDate, $usersId)
	{
		$fullLink = "http://www.youtube.com/".$link;
	
		$this->_id 			= $id;
		$this->_name 		= $name;
		$this->_link 		= $fullLink;
		$this->_categoryId 	= $categoryId;
		$this->_description = nl2br($description);
		$this->_addDate		= $addDate;
		$this->_usersId		= $usersId;
		
		if(empty($image)) $this->_image = 'images/noimage.jpg';
		else $this->_image = 'images/'.$image;
		
		$ardat = explode(' ', $this->_addDate);
		$this->_day = $ardat[0];
		$this->_hour = $ardat[1];
	}
	
	public function __get($name) {return $this->$nazwa;}
	public function __set($name, $value) {$this->$name = $value;}
	
	public function Show()
	{
		$id 		= $this->_id;
		$divId 		= 'Films'.$id;
		$iframeId 	= 'Frame'.$id;
	
		echo				
		// Głowna tabela wyświetlająca treść
		"<table style = 'width: 100%; height: 250px; vertical-align: middle; border-spacing: 0px;' class = 'FilmsFrame' onclick = \"ShowFilmsDiv($id, '$this->_link');\">",
			"<tr>",
				"<td style = 'text-align: center; vertical-align: bottom; height: 170px;'>",
					"<img src = '$this->_image' style = 'width: 200; height: 150px;'>",
				"</td>",
			"</tr><tr>",
				"<td style = 'text-align: center; vertical-align: middle; padding-left: 10px; padding-right: 10px;'>",
					$this->_name,
				"</td>",
			"</tr>",
		"</table>";
		
		$SpecialLink = $this->_link.'END';
		
		echo 
		"<div style = 'margin: auto; width: 1000px; height: 800px; visibility:hidden; position: fixed; top: 100px; left: 100px;' id = '$divId'>",
			"<div id = 'box'>",
				"<div class = 'header'>",
					"<h2>$this->_name</h2>",
					"<img src = 'images/error.png' style = 'float: right; margin-top:-33px;' onclick = 'HideFilmsDiv($id);'>",
				"</div>",
				"<div class = 'content'>",
					"<div class = 'text' style = 'text-align:center;'>",
						"<iframe width = '500' height = '300' src = '/END' frameborder = '0' allowfullscreen style = 'margin:auto;' id = '$iframeId'></iframe><br/>",
						"<p>",
						$this->_description,
						"</p>",
						"<p id = 'inf' style = 'text-align: right;'>dodano: <b>", ChangeDate($this->_day), "</b> o godzinie: <b>$this->_hour</b> przez <b>$this->_usersId</b></p>",
					"</div>",
				"</div>",
				"<div class = 'footer'></div>",
			"</div>",
		"</div>";
	}
}

class SearchObject
{
	private $_id;
	private $_what;
	private $_result;
	
	public function __construct($id, $what, $result)
	{
		$this->_id 		= $id;
		$this->_what 	= $what;
		$this->_result 	= $result;
	}
	
	public function Show()
	{
		switch($this->_what)
		{
			case 'news':
				$title = 'Aktualności';
				$link = "subpage.php?page=news&id=$this->_id";
			break;
			case 'events':
				$title = 'Wydarzenia';
				$link = "subpage.php?page=events&id=$this->_id";
			break;
		}
	
		echo
		"
		<tr>
			<td>$title</td><td>$this->_result</td><td><a href = '$link'>GO</a></td>
		</tr>
		";
	}
}

class Search
{
	public function __construct($aim)
	{
		if(!empty($aim))
		{
			$LiczbaWynikow = 0;
		
			echo "<table style = 'width: 100%; border-spacing: 0px;'><tr><td colspan = '3'></td></tr>";
		
			$query = "Select Distinct n.id, u.login, n.category, n.title, n.content From news n Inner Join users u On n.author = u.id Where u.login LIKE '%$aim%' OR n.category LIKE '%$aim%' OR n.title LIKE '%$aim%' OR n.content LIKE '%$aim%'";
			$zapytanie = @mysql_query($query);
			if($zapytanie)
			{
				$LiczbaWynikow += mysql_num_rows($zapytanie);
				if($LiczbaWynikow > 0)
				{
					while($wynik = mysql_fetch_array($zapytanie))
					{
						$Row = new SearchObject($wynik[0], 'news', $wynik[3]);
						$Row->Show();
					}
				}
			}
			
			$query = "Select Distinct e.id, e.category, e.title, e.content, u.login From events e Inner Join users u On e.usersId = u.id Where e.category LIKE '%$aim%' OR e.title LIKE '%$aim%' OR e.content LIKE '%$aim%' OR u.login LIKE '%$aim%'";
			$zapytanie = @mysql_query($query);
			if($zapytanie)
			{
				$LiczbaWynikow += mysql_num_rows($zapytanie);
				if($LiczbaWynikow > 0)
				{
					while($wynik = mysql_fetch_array($zapytanie))
					{
						$Row = new SearchObject($wynik[0], 'events', $wynik[2]);
						$Row->Show();
					}
				}
			}
			
			echo "<tr><td colspan = '3'></td></tr></table>";
			
			if($LiczbaWynikow == 0)  OknoInformacyjne("Nie ma takiej frazy w bazie!", false);
		}
		else
		{
			OknoInformacyjne("Nie podano frazy!", false);
		}
	}
}

?>