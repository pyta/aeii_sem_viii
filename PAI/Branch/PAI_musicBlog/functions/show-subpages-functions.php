<?php

	/* 
	Lista funkcji:
		
		- ShowUserSessionPage
		- ShowEditPage
		- ShowRegisterPage
		- ShowUsersInfoPage
		- ShowMessagesPage
		- ShowFilmsPage
		- ShowNewPasswordPage
		- ShowNewsPage
	*/
	
	/* Logowanie użytkowników. Argument $akcja służy do rozpoznawania czy użytkownik chce sie zalogować czy wylogować */
	function ShowUserSessionPage($action)
	{ 
		echo
		"<div id = 'box'>",
			"<div class = 'header'>",
				"<h2>Logowanie</h2>",
			"</div>",
			"<div class = 'content'>",
				"<div class = 'text'>";
	
		try
		{
			if(isset($_POST['login']) && isset($_POST['pass']))
			{
				$login = $_POST['login'];
				$pass = $_POST['pass'];
				
				if(empty($login) || empty($pass)) throw new NiePodanoWartosci();
				
				$query = "Select id, login, pass From users Where login = '$login'";
				$zapytanie = mysql_query($query);
				if($zapytanie) {
					$wynik = mysql_fetch_array($zapytanie);
					if(empty($wynik)) throw new ZlyLogin();
					else if($wynik[2] == $pass) 
					{
						OknoInformacyjne('Udało się poprawnie zalogować!', true);
						session_set_cookie_params(time() + 3600);
						session_name('userLogin');
						
						$SID = session_id();
						if(empty($SID))
						{		
							session_start();
						}
							
						$_SESSION['userName'] = $wynik[1];
						$_SESSION['userId'] = $wynik[0];
						//return true;
					} 
					else 
					{
						throw new ZleHaslo();
					}
				}
			}
			else
			{
				if($action == 'out') {
					if(isset($_SESSION['userName'])) {
						unset($_SESSION['userName']);
						session_destroy();
						OknoInformacyjne('Uzytkownik wylogowany poprawnie!', true);
					}
				}
			}
		}
		catch(NiePodanoWartosci $Error) {
			echo OknoInformacyjne($Error, false);
		}
		catch(ZlyLogin $Error) {
			echo OknoInformacyjne($Error, false);
		}
		catch(ZleHaslo $Error) {
			echo OknoInformacyjne($Error, false);
		}
		catch(Exception $Error)	{
			echo OknoInformacyjne('Wystąpił poważny błąd. Proszę spróbować później...', false);
		}
		
		echo 
				"</div>",
			"</div>",
			"<div class = 'footer'></div>",
		"</div>";
	}

	/* Funckja wyświetla formularz z danymi wprowadzonymi wcześniej przez użytkownika */
	function ShowEditPage()	
	{
		function WypiszListeMiesiecy($Domyslny)
		{
			$Miesiace = array(1 => 'Styczeń', 'Luty', 'Marzec', 'Kwiecień', 'Maj', 'Czerwiec', 'Lipiec', 'Sierpnień', 'Wrzesień', 'Październik', 'Listopad', 'Grudzień');
			
			echo "<select name = 'miesiac' style = 'width: 120px;'>";
			for($i = 1; $i <= 12; ++$i) {
				if($i == $Domyslny) echo "<option selected = 'selected' value = \"$i\">";
				else echo "<option value = \"$i\">";
				echo $Miesiace[$i], "</option>\n";
			}
			echo "</select>";
		}
		
		if(isset($_SESSION['userId']))
		{
			echo
			"<div id = 'box'>",
			"<div class = 'header'>",
				"<h2>Edycja Twojego profilu</h2>",
			"</div>",
			"<div class = 'content'>",
				"<div class = 'text'>";
				if(isset($_POST['mail'])) EditUsersData();
				else
				{
					$userId = $_SESSION['userId'];
					
					$query = "Select * From users Where id = '$userId'";
					$zapytanie = @mysql_query($query);
					if($zapytanie)
					{
						$wynik = mysql_fetch_array($zapytanie);
						$EditsUser = new User($wynik[0], $wynik[1], $wynik[2], $wynik[3], $wynik[4], $wynik[5], $wynik[6], $wynik[7], $wynik[8], $wynik[9], $wynik[10], $wynik[11], $wynik[12]);

						echo 
						"<form enctype = 'multipart/form-data' name = 'EdycjaDanych' action = 'subpage.php?page=edit' method = 'POST' class = 'form'>",
						"<table class = 'regstyletable'>",
							"<tr>",
								"<td colspan = '3'><h5>Informacje podstawowe</h5></td>",
							"</tr>",
							"<tr>",
								"<td colspan = '3'>&nbsp;</td>",
							"</tr>",
							"<tr>",
								"<td><label for = 'email'>adres e-mail*</label></td>",
								"<td><input type = 'text' name = 'mail' value = '$EditsUser->_mail' onblur = 'SprawdzWymaganePolaPrzyEdycji();' style = 'width: 240px;'/></td>",
								"<td><img src = 'images/valid.png' id = 'ma'></td>",
							"</tr>",
							"<tr>",
								"<td colspan = '3'>&nbsp;</td>",
							"</tr>",
							"<tr>",
								"<td colspan = '3'><h5>Infromacje dodatkowe</h5></td>",
							"</tr>",
							"<tr>",
								"<td colspan = '3'>&nbsp;</td>",
							"</tr>",
							"<tr>",
								"<td><label for = 'imie'>imię</label></td>",
								"<td><input type = 'text' name = 'imie' value = '$EditsUser->_forname' style = 'width: 240px;'/></td>",
								"<td></td>",
							"</tr>",
							"<tr>",
								"<td><label for = 'nazwisko'>nazwisko</label></td>",
								"<td><input type = 'text' name = 'nazwisko' value = '$EditsUser->_surname' style = 'width: 240px;'/></td>",
								"<td></td>",
							"</tr>",
							"<tr>",
								"<td><label for = 'miejscowosc'>miejscowość</label></td>",
								"<td><input type = 'text' name = 'miejscowosc' value = '$EditsUser->_city' style = 'width: 240px;'/></td>",
								"<td></td>",
							"</tr>",
							"<tr>",
								"<td><label for= 'plec'>płeć</label></td>";
								
							if($EditsUser->_sex == 'M')
								echo "<td>Kobieta: &nbsp;<input type = 'radio' name = 'plec' value = 'K' />&nbsp;&nbsp;Mężczyzna: &nbsp;<input type = 'radio' name = 'plec' value = 'M' checked = 'checked'/></td>";
							else if($EditsUser->_sex == 'K')
								echo "<td>Kobieta: &nbsp;<input type = 'radio' name = 'plec' value = 'K' checked = 'checked'/>&nbsp;&nbsp;Mężczyzna: &nbsp;<input type = 'radio' name = 'plec' value = 'M'/></td>";
							else
								echo "<td>Kobieta: &nbsp;<input type = 'radio' name = 'plec' value = 'K' />&nbsp;&nbsp;Mężczyzna: &nbsp;<input type = 'radio' name = 'plec' value = 'M'/></td>";
											
						echo
								"<td></td>",
							"</tr>",
							"<tr>",
								"<td><label for = 'data-urodz'>data urodzenia</label></td>",
								"<td>";
								
								$TablicaDaty = explode('-', $EditsUser->_bornDate);
								$Dzien 		= intval($TablicaDaty[2]);
								$Miesiac 	= intval($TablicaDaty[1]);
								$Rok 		= $TablicaDaty[0];
								
									echo "<select name = 'dzien' style = 'width: 58px;'>";
									for($i = 1; $i <= 31; ++$i) {
										if($i == $Dzien) echo "<option selected = 'selected'>$i</option>";
										else echo "<option>$i</option>";
									}
									echo "</select>";
									
									WypiszListeMiesiecy($Miesiac);
									
									echo "<select name = 'rok' style = 'width: 72px;'>";
									for($i = date('Y'); $i >= 1921; --$i) {
										if($i == $Rok) echo "<option selected = 'selected'>$i</option>";
										else echo "<option>$i</option>";
									}
						echo        "</select>",
								"<td></td>",
							"</tr>",
							"<tr>",
								"<td colspan = '3'>&nbsp;</td>",
							"</tr>",
							"<tr>",
								"<td colspan = '3'><h5>Avatar</h5></td>",
							"</tr>",
							"<tr>",
								"<td colspan = '3'>&nbsp;</td>",
							"</tr>",
							"<tr>",
								"<td><label for = 'avatar'>Avatar</label></td>",
								"<td><input type = 'file' name = 'avatar' style = 'width: 240px;'/></td>",
								"<td></td>",
							"</tr>",
							"<tr>",
								"<td colspan = '3'>&nbsp;</td>",
							"</tr>",
							"<tr>",
								"<td colspan = '3'><h5>Hasło</h5></td>",
							"</tr>",
							"<tr>",
								"<td colspan = '3'>&nbsp;</td>",
							"</tr>",
							"<tr>",
								"<td colspan = '3' style = 'text-align:center;'><p class = 'button' onclick = \"ShowForm('PasswordsDiv', 'functions/show_password_form.php');\">Zmiana hasła</p></td>",
							"</tr>",
							"<tr>",
								"<td colspan = '3'><div id = 'PasswordsDiv'></div></td>",
							"</tr>",
							"<tr>",
								"<td colspan = '3'>&nbsp;</td>",
							"</tr>",
							"<tr>",
								"<td colspan = '3'><h5>O sobie</h5></td>",
							"</tr>",
							"<tr>",
								"<td colspan = '3'>&nbsp;</td>",
							"</tr>",
							"<tr>",
								"<td colspan = '3' style = 'text-align:center;'><textarea name = 'about'>$EditsUser->_about</textarea></td>",
							"</tr>",
							"<tr>",
								"<td colspan = '3'>&nbsp;</td>",
							"</tr>",
							"<tr>",
								"<td colspan = '3'>",
									"<p class = 'submit' style = 'text-align:center;'>",
										"<input type = 'submit' value = 'Aktualizuj' />",
									"</p>",
								"</td>",
							"</tr>",
						"</table>",
						"</form>";
					}
			}
			
			echo 
			"</div>",
			"</div>",
			"<div class = 'footer'></div>",
			"</div>";
		}
	}
	
	/* Funckja wyświetla formularz pozwalający na rejestracje użytkownika */
	function ShowRegisterPage()
	{
		echo
		"<div id = 'box'>",
		"<div class = 'header'>",
			"<h2>Rejestracja</h2>",
		"</div>",
		"<div class = 'content'>",
			"<div class = 'text'>";
				SignUpUser();
				echo
				"<form name = 'Rejestracja' action = 'subpage.php?page=sinup' method = 'POST' class = 'form'>",
				"<table class = 'regstyletable'>",
					"<tr>",
						"<td colspan = '3'><h5>Pola wymagane</h5></td>",
					"</tr>",
					"<tr>",
						"<td colspan = '3'>&nbsp;</td>",
					"</tr>",
					"<tr>",
						"<td><label for = 'login'>login*</label></td>",
						"<td><input type = 'text' name = 'login' onblur = 'SprawdzWymaganePola();' style = 'width: 240px;'/></td>",
						"<td><img src = 'images/error.png' id = 'lo'></td>",
					"</tr>",
					"<tr>",
						"<td><label for = 'password'>hasło*</label></td>",
						"<td><input type = 'password' name = 'pass' onblur = 'SprawdzWymaganePola();' style = 'width: 240px;'/></td>",
						"<td><img src = 'images/error.png' id = 'np'></td>",
					"</tr>",
					"<tr>",
						"<td><label for = 'repass'>powtórz hasło*</label></td>",
						"<td><input type = 'password' name = 'repass' onblur = 'SprawdzWymaganePola();' style = 'width: 240px;'/></td>",
						"<td><img src = 'images/error.png' id = 'rp'></td>",
					"</tr>",
					"<tr>",
						"<td><label for = 'email'>adres e-mail*</label></td>",
						"<td><input type = 'text' name = 'mail' onblur = 'SprawdzWymaganePola();' style = 'width: 240px;'/></td>",
						"<td><img src = 'images/error.png' id = 'ma'></td>",
					"</tr>",
					"<tr>",
						"<td colspan = '3'>&nbsp;</td>",
					"</tr>",
					"<tr>",
						"<td colspan = '3'><h5>Infromacje dodatkowe</h5></td>",
					"</tr>",
					"<tr>",
						"<td colspan = '3'>&nbsp;</td>",
					"</tr>",
					"<tr>",
						"<td><label for = 'imie'>imię</label></td>",
						"<td><input type = 'text' name = 'imie' style = 'width: 240px;'/></td>",
						"<td></td>",
					"</tr>",
					"<tr>",
						"<td><label for = 'nazwisko'>nazwisko</label></td>",
						"<td><input type = 'text' name = 'nazwisko' style = 'width: 240px;'/></td>",
						"<td></td>",
					"</tr>",
					"<tr>",
						"<td><label for = 'miejscowość'>miejscowość</label></td>",
						"<td><input type = 'text' name = 'miejscowosc' style = 'width: 240px;'/></td>",
						"<td></td>",
					"</tr>",
					"<tr>",
						"<td><label for = 'plec'>płeć</label></td>",
						"<td>Kobieta: &nbsp;<input type = 'radio' name = 'plec' value = 'K' />&nbsp;&nbsp;Mężczyzna: &nbsp;<input type = 'radio' name = 'plec' value = 'M'/></td>",
						"<td></td>",
					"</tr>",
					"<tr>",
						"<td><label for = 'data-urodz'>data urodzenia</label></td>",
						"<td>",
							"<select name = 'dzien' style = 'width: 58px;'>";
								for($i = 1; $i <= 31; ++$i) echo "<option>$i</option>";
							echo
							"</select>",
							"<select name = 'miesiac' style = 'width: 120px;'>",
								"<option>Styczeń</option>",
								"<option>Luty</option>",
								"<option>Marzec</option>",
								"<option>Kwiecień</option>",
								"<option>Maj</option>",
								"<option>Czerwiec</option>",
								"<option>Lipiec</option>",
								"<option>Sierpień</option>",
								"<option>Wrzesień</option>",
								"<option>Październik</option>",
								"<option>Listopad</option>",
								"<option>Grudzień</option>",
							"</select>",
							"<select name = 'rok' style = 'width: 72px;'>";
								for($i = 2011; $i >= 1921; --$i) echo "<option>$i</option>";
							echo
							"</select>",
						"<td></td>",
					"</tr>",
					"<tr>",
						"<td colspan = '3'>&nbsp;</td>",
					"</tr>",
					"<tr>",
						"<td colspan = '3'><h5>Avatar</h5></td>",
					"</tr>",
					"<tr>",
						"<td colspan = '3'>&nbsp;</td>",
					"</tr>",
					"<tr>",
						"<td><label for = 'avatar'>Avatar</label></td>",
						"<td><input type = 'file' name = 'avatar' style = 'width: 240px;'/></td>",
						"<td></td>",
					"</tr>",
					"<tr>",
					"<tr>",
						"<td colspan = '3'><h5>O sobie</h5></td>",
					"</tr>",
					"<tr>",
						"<td colspan = '3'>&nbsp;</td>",
					"</tr>",
					"<tr>",
						"<td colspan = '3' style = 'text-align:center;'><textarea name = 'about'></textarea></td>",
					"</tr>",
					"<tr>",
						"<td colspan = '3'>&nbsp;</td>",
					"</tr>",
					"<tr>",
						"<td colspan = '3'>",
							"<p class = 'submit' style = 'text-align:center;'>",
								"<input type = 'submit' value = 'Zarejestruj' />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",
								"<input type = 'reset' value = 'Reset' />",
							"</p>",
						"</td>",
					"</tr>",
				"</table>",
				"</form>",
			"</div>",
		"</div>",
		"<div class = 'footer'></div>",
		"</div>";
	}
	
	/* Funkcja wyświetlająca informacje o użytkowniku, którego login został podany jako argument */
	function ShowUsersInfoPage($login)
	{
		$query = "Select * From users Where login = '$login'";
		$zapytanie = @mysql_query($query);
		if($zapytanie) {
			$wynik = mysql_fetch_array($zapytanie);
			$User = new User($wynik[0], $wynik[1], $wynik[2], $wynik[3], $wynik[4], $wynik[5], $wynik[6], $wynik[7], $wynik[8], $wynik[9], $wynik[10], $wynik[11], $wynik[12]);
		}
		
		if($User->_sex == 'M') $image = 'm.png';
		else if($User->_sex == 'K')$image = 'k.png';
		else $image = '#';
		
		echo
		"<div id = 'box'>",
			"<div class = 'header'>",
				"<h2>Informacje o użytkowniku: $login</h2>",
			"</div>",
			"<div class = 'content'>",
				"<div class = 'text'>",
				
		'<table id = \'UsersInfoStyle\'>',
			'<tr>',
				"<td rowspan = '3'><img src = 'images/avatars/$User->_avatar' style = 'width: 100px; height: 100px;'></td>",
				"<td colspan = '2' class = 'nick'><b>$login</b></td>",
				"<td><img src = 'images/$image'></td>",
			'</tr>',
			'<tr>',
				"<td class = 'tags'>Imię: </td>",
				"<td>", $User->_forname, "</td>",
				"<td></td>",
			'</tr>',
			'<tr>',
				"<td class = 'tags'>Nazwisko: </td>",
				"<td>", $User->_surname, "</td>",
				"<td></td>",
			'</tr>',
			'<tr>',
				"<td colspan = '4'>&nbsp;</td>", // przerwa
			'</tr>',
			'<tr>',
				"<td class = 'tags'>Email:</td>",
				"<td colspan = \"3\">", $User->_mail, "</td>",
			'</tr>',
			'<tr>',
				"<td class = 'tags'>Miasto:</td>",
				"<td colspan = \"3\">", $User->_city, "</td>",
			'</tr>',
			'<tr>',
				"<td class = 'tags'>Data ur.:</td>",
				"<td colspan = \"3\">", ChangeDate($User->_bornDate), "</td>",
			'</tr>',
			'<tr>',
				"<td colspan = '4'>&nbsp;</td>", // przerwa
			'</tr>',
			'<tr>',
				"<td colspan = '4'><h5>O użytkowniku</h5></td>",
			'</tr>',
			'<tr>',
				"<td colspan = '4'>", $User->_about, "</td>",
			'</tr>',
			'<tr>',
				"<td colspan = '4'>&nbsp;</td>", // przerwa
			'</tr>',
			'<tr>',
				"<td colspan = '4'><h5>Znajomi</h5></td>",
			'</tr>',
			'<tr>',
				"<td colspan = '4'>";
				
				$FriendsList = new Friends($User->_id);
				
			echo
				"</td>",
			'</tr>',
			'<tr>',
				"<td colspan = '4'>&nbsp;</td>", // przerwa
			'</tr>';
			
			if(isset($_SESSION['userName'])) 
			{
				$senderId = $_SESSION['userId'];
			
				if($_SESSION['userName'] != $User->_login)
				{
					AddFriend();
					/*  
					Wyswietlenie guzikow specyficznych gdy ogladany uzytkownik nie jest uzytkownikiem zalogowanym - wysylanie widomosci
					i zapraszenie do znajomych 
					*/
					echo 
					"<tr>",
					"<td colspan = '2' style = 'text-align:left;'>",
						"<p class = 'button' style = 'text-align:center; width: 150px; float: left;' onclick = \"ShowMessageForm('messagediv');\">Wyślij wiadomość</p>",
					"</td>",
					"<td colspan = '2' style = 'text-align:right;'>";
					
					/*
					Wyswietlanie guzika dodajacego do znajomych tylko w sytuacji gdy znajomosc jescze nie istnieje
					*/
					$query = "Select recipientId From friends Where senderId = '$senderId'";
					$zapytanie = mysql_query($query);
					if($zapytanie) {
						$FriendJet = false;
						while($wynik = mysql_fetch_array($zapytanie)) {
							if($wynik[0] == $User->_id) {
								$FriendJet = true;
								break;
							}
						}
						if($FriendJet) echo "&nbsp;";
						else echo
						"<p class = 'button' style = 'text-align:center; width: 150px; float: right;' onclick = \"location.href = 'subpage.php?page=users&login=",$User->_login,"&recId=",$User->_id,"';\">Dodaj do znajomych</p>";
					}
					
					echo	
					"</td>",
					"</tr>";
				}
				echo 
				"<tr>",	
					"<td colspan = '4'>",
						"<form action = 'subpage.php?page=users&login=$login' method = 'POST' name = 'SendMessage'>",
							"<input type = 'hidden' value = \"$senderId\" name = 'senderId'>",
							"<input type = 'hidden' value = \"$User->_id\" name = 'recipientId'>",
						"<div id = 'messagediv'>";
						
						SendMessage();
						
				echo 
						"</div>",
						"</form>",
					"</td>",
				"</tr>";
			}
		echo '</table>';
		echo 
				"</div>",
			"</div>",
			"<div class = 'footer'></div>",
		"</div>";
	}
	
	/* Wyswietlenie wiadomości */
	function ShowMessagesPage($id, $type)
	{
		/*
			Funkcje przyjmuje dwa argumenty id oraz type.
				id 		- 	id użytkownika, który jest odbiorcą wiadomości (skrzynka odbiorcza) w przypadku gdy type == 1. Gdy type
							przyjmuje wartość 0 id staje się id konretnej wiadomości.
				type 	- 	rodzaj (0, 1) z zależności od którego wyświetlona zostanie cała lista wiadomości bądź jedna.
		*/
		$messages = new Messages($id, $type);
		$messages->Show();
	}
	
	/* Wyświetlanie strony z filmami */
	function ShowFilmsPage()
	{
		if(isset($_GET['cat']))
		{
			$categoryId = $_GET['cat'];
			
			/* Informacje o glowym obrazku i nazwie kategorii */
			$query = "Select name, image From films_category Where id = '$categoryId'";
			$zapytanie = mysql_query($query);
			if($zapytanie)
			{
				$wynik = mysql_fetch_array($zapytanie);
				
				$CategoryName 	= $wynik[0];
				$MainImg 		= '2'.$wynik[1];
			}
			else
			{
				$CategoryName 	= 'Error!';
				$MainImg 		= 'noimage.jpg';
			}
			
			echo
			"<div id = 'box'>",
				"<div class = 'header'>",
					"<h2>Filmy z kategorii: <b>$CategoryName</b></h2>",
				"</div>";

			/* Określanie liczby filmów na stronie */
			if(isset($_GET['site'])) {
				$LimitDown 	= ($_GET['site'] - 1) * 6;
				$LimitUp 	= $LimitDown + 6;
			} else
			{
				$LimitDown 	= 0;
				$LimitUp 	= 6;
			}
			
			$query = "Select f.id, f.name, f.link, f.categoryId, f.description, f.image, f.addDate, u.login From films f Inner Join users u On f.usersId = u.id Where f.categoryId = '$categoryId' Order By f.addDate DESC Limit $LimitDown, $LimitUp";
			$zapytanie = mysql_query($query);
			if($zapytanie)
			{
				echo
				"<div><img src = 'images/$MainImg' style = 'width: 577px; height: 223px;'></div>",
				"<div class = 'content'>",
					"<div class = 'text'>";	
					
				if(mysql_num_rows($zapytanie) == 0) echo OknoInformacyjne('Nie ma żadnych filmów w tej kategorii!', false);
				else
				{
					echo "<img src = 'images/musicbreak.png' style = 'width: 550px; height: 25px;'><br/><br/>";
					
					$DodaneElementy = 0;
					echo "<table style = 'width: 100%; border-spacing: 0px;'>";
					while($wynik = mysql_fetch_array($zapytanie))
					{
						if(($DodaneElementy % 2) == 0) echo "<tr>";
						echo "<td style = 'width: 50%; text-align: center; vertical-align: middle;'>";
						
						$NewFilm = new Film($wynik[0], $wynik[1], $wynik[2], $wynik[3], $wynik[4], $wynik[5], $wynik[6], $wynik[7]);
						$NewFilm->Show();
						
						$DodaneElementy += 1;
						
						echo "</td>";
						if(($DodaneElementy % 2) == 0) echo "</tr>";
					}
					if(($DodaneElementy % 2) != 0) echo "<td>&nbsp;</td></tr>";
					echo "</table>";
					
					echo "<br/><img src = 'images/musicbreak.png' style = 'width: 550px; height: 25px;'>";
				
					/* Wyświetlenie odnośników do przechodzenia między stronami */
					if(isset($_GET['site'])) $AktualnaStrona = $_GET['site'];
					else $AktualnaStrona = 1;
					
					$Nastepna = $AktualnaStrona + 1;
					$Poprzednia = $AktualnaStrona - 1;
					
					$query = "Select Count(*) From films Where categoryId = '$categoryId'";
					$zapytanie = @mysql_query($query);
					if($zapytanie)
					{
						$wynik = mysql_fetch_array($zapytanie);
						$FilmsCount = $wynik[0];
					}
					else $FilmsCount = 0;
					
					if(($FilmsCount - ($AktualnaStrona * 6)) > 0) {
						$Nas = "<a href = 'subpage.php?page=films&cat=$categoryId&site=$Nastepna'><img src = 'images/next.png' style = 'width: 50px; height: 50px;'></a>";
					} else $Nas = '&nbsp;';
					if(($AktualnaStrona * 6) > $FilmsCount && $AktualnaStrona != 1) {
						$Pop = "<a href = 'subpage.php?page=films&cat=$categoryId&site=$Poprzednia'><img src = 'images/prev.png' style = 'width: 50px; height: 50px;'></a>";
					} else $Pop = '&nbsp;';
					
					echo 
					"<table style = 'width: 100%; border-spacing: 0px;'>",
					"<tr>",
						"<td colspan = '3'>&nbsp;</td>",
					"</tr>",
					"<tr>",
						"<td style = 'width: 30%; text-align: lefr;'>$Pop</td>",
						"<td style = 'width: 40%; text-align: center;'><p class = 'button' onclick = \"location.href = 'subpage.php?page=films';\">Galeria filmów</p></td>",
						"<td style = 'width: 30%; text-align: right;'>$Nas</td>",
					"</tr>",
					"</table>";
				}
				
				echo
				"</div>",
				"</div>";
			}
			
			echo
				"<div class = 'footer'></div>",
			"</div>";
		}
		else
		{
			$query = "Select c.id, c.name, c.description, c.addDate, c.image, c.viewImage, u.login From films_category c Inner Join users u On c.usersId = u.id";
			$zapytanie = mysql_query($query);
			if($zapytanie)
			{
				$FilmsCount = mysql_num_rows($zapytanie);
				if($FilmsCount == 0) echo "Nie ma żadnych filmów!<br/>";
				else
				{
					while($wynik = mysql_fetch_array($zapytanie))
					{
						$NewCategory = new FilmsCategory($wynik[0], $wynik[1], $wynik[2], $wynik[3], $wynik[4], $wynik[5], $wynik[6]);
						$NewCategory->Show();
					}
				}
			} else echo "kon";
		}
	}
	
	/* Funckja pozwalająca na uzyskanie nowego hasła poprzez wypełnienie odpowiedniego formularza */
	function ShowNewPasswordPage()
	{
		echo
		"<div id = 'box'>",
			"<div class = 'header'>",
				"<h2>Odzyskaj hasło</h2>",
			"</div>",
			"<div class = 'content'>",
				"<div class = 'text'>";
				
		if(isset($_POST['login']))
		{
			$login = $_POST['login'];
			$mail = $_POST['mail'];
			
			try
			{
				if(empty($login) || empty($mail)) throw new NiePodanoWartosci();
				else
				{
					$query = "Select id, login, mail From users Where login = '$login'";
					$zapytanie = @mysql_query($query);
					if($zapytanie)
					{
						$wynik = mysql_fetch_array($zapytanie);
						if(($login != $wynik[1]) || ($mail != $wynik[2])) echo OknoInformacyjne('Zła para login - mail!', false);
						else
						{
							$NoweHaslo = uniqid('');
							$Email = "";
							
							$naglowki = "MIME-Version: 1.0"."\r\n";
							$naglowki .= "Content-type:text/html;charset=utf-8"."\r\n";
							$naglowki .= "From: <".$mail.">"."\r\n";
							$naglowki .= "Cc: <".$Email.">"."\r\n";
							
							$tytul = 'Odzyskiwanie hasła';
							$wiadomosc = <<< KONIEC
							<html>
								<p>Twoje nowe hasło to: <strong>$NoweHaslo</strong></p>
							</html>
KONIEC;
							$wysylanie = mail('<'.$mail.'>', $tytul, $wiadomosc, $naglowki);
							if($wysylanie)
							{
								$query = "Update users Set pass = '$NoweHaslo' Where id = '$wynik[0]'";
								$zapytanie = @mysql_query($query);
								if($zapytanie) {
									echo OknoInformacyjne('Na podany adres mail zostało wysłane nowe hasło!', true);
								}
							}
							else
							{
								echo OknoInformacyjne('Błąd!', false);
							}
						}
					} else echo "blad!";
				}
			}
			catch(NiePodanoWartosci $Error) {
				echo OknoInformacyjne($Error, false);
			}
			catch(Exception $Error)	{
				echo OknoInformacyjne('Wystąpił poważny błąd. Proszę spróbować później...', false);
			}
		}
		else
		{
			echo
			"<form name = 'NoweHaslo' action = 'subpage.php?page=newpassword' method = 'POST' class = 'form'>",
				"<table class = 'regstyletable'>",
					"<tr>",
						"<td colspan = '2'><h5>Podaj wszystkie dane</h5></td>",
					"</tr>",
					"<tr>",
						"<td colspan = '2'>&nbsp;</td>",
					"</tr>",
					"<tr>",
						"<td><label for = 'login'>login</label></td>",
						"<td><input type = 'text' name = 'login' style = 'width: 240px;'/></td>",
					"</tr>",
					"<tr>",
						"<td colspan = '2'>&nbsp;</td>",
					"</tr>",
					"<tr>",
						"<td><label for = 'mail'>mail</label></td>",
						"<td><input type = 'text' name = 'mail' style = 'width: 240px;'/></td>",
					"</tr>",
					"<tr>",
						"<td colspan = '2'>&nbsp;</td>",
					"</tr>",
					"<tr>",
						"<td colspan = '2'>",
							"<p class = 'submit' style = 'text-align:center;'>",
								"<input type = 'submit' value = 'Odzyskaj hasło!' />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",
								"<input type = 'reset' value = 'Reset' />",
							"</p>",
						"</td>",
					"</tr>",
				"</table>",
			"</form>";
		}
		
		echo
				"</div>",
			"</div>",
			"<div class = 'footer'></div>",
		"</div>";
	}
	
	function ShowSearchPage()
	{
		echo
		"<div id = 'box'>",
			"<div class = 'header'>",
				"<h2>Wyszukiwanie</h2>",
			"</div>",
			"<div class = 'content'>",
				"<div class = 'text'>";
				
		if(isset($_POST['aim']))
		{
			$aim = $_POST['aim'];
			
			$Search = new Search($aim);
		}
		
		echo
				"</div>",
			"</div>",
			"<div class = 'footer'></div>",
		"</div>";
	}
	
	/* Funckja służąca do obsługi aktualności na stronie. Wyświetlanie archiwum oraz komentarzy. */
	function ShowNewsPage($NewsId)
	{
		if(!empty($NewsId))
		{
			$query = "Select n.id, u.login, n.data, n.category, n.title, n.content from news n Inner Join users u On n.author = u.id Where n.id = '$NewsId' Order By n.data";
			$zapytanie = mysql_query($query);
			$allpages = mysql_num_rows($zapytanie);
		
			if($allpages < 1)
				echo OknoInformacyjne('Nie ma aktualności o podanym id!', false);
			else
			{
				$book = mysql_fetch_array($zapytanie);
				$News = new News($book['id'], $book['login'], $book['data'], $book['category'], $book['title'], $book['content']);
				$News->Show(1);
			}			
		}
		else
		{
			$query = "Select n.id, u.login, n.data, n.category, n.title, n.content from news n Inner Join users u On n.author = u.id Order By n.data DESC";
			$zapytanie = mysql_query($query);
			$allpages = mysql_num_rows($zapytanie);
			
			if($allpages < 1)
				echo OknoInformacyjne('Nie ma żadnych aktualności!', false);
			else 
			{
				$Licznik = 0;
				while($book = mysql_fetch_array($zapytanie)) 
				{
					$News = new News($book['id'], $book['login'], $book['data'], $book['category'], $book['title'], $book['content']);
					$News->Show(0);
					
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

					while($book = mysql_fetch_array($zapytanie)) 
					{			
						echo "<a href = 'subpage.php?page=news&id=", $book['id'], "'>", $book['title'], "</a><br/>";
					}		
							
					echo
							"</div>",
						"</div>",
						"<div class = 'footer'></div>",
					"</div>";
				}
			}
		}
	}
?>