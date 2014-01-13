<?php

	/* Lista funkcji:
		
		* drobne funkcje pomocnicze:
		
			- ChangeDate
			- OknoInformacyjne
			- ZamianaMiesiacaNaLiczbe
			
		* funkcje wykonujace większe zadania:
		
			- SignUpUser
			- AddComment
			- ShowUserPanel
			- SendMessage
			- EditUsersData
			- AddFriend
	*/
	
	
	// ********************************************************************************** Jakieś drobne funkcje pomocnicze

	/* Funkcja zmienia date przekazana w argumencie na date z notacji rzymskiej i zwraca ją jako wynik. */
	
	function ChangeDate($someDate)
	{
		$Elements = explode('-', $someDate);
		$RomMonths = array('I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII');
		$Elements[1] = intval($Elements[1]);
		$NewDate = $Elements[2].' '.$RomMonths[$Elements[1] - 1].' '.$Elements[0];
		return $NewDate;
	}
	
	/* Funkcja wyświetla okno z informacja przekazana przez argument */

	function OknoInformacyjne($Tekst, $Temperament)
	{
		/*
		Argumenty:
		
			- Tekst			- tekst do wyświetlenia
			- Temperament	- wartosc boolowska. Jeśli przyjmuje wartość false to okienko jest oknem błędu.
							  W przeciwnym wypadku okno sygnalizuje poprawność wykonania jakiejś operacji.	
		*/
		if($Temperament) echo "<div class = \"valid_box\"><br>", $Tekst, "<br>&nbsp;</div>"; 
		else echo "<div class=error_box>", $Tekst, "</div>"; 
	}
	
	/* Prosta funkcja zmieniająca nazwe miesiąca na odpowiadającą mu liczbę. */

	function ZamianaMiesiacaNaLiczbe($Miesiac)
	{
		$Miesiace = array(1 => 'Styczeń', 'Luty', 'Marzec', 'Kwiecień', 'Maj', 'Czerwiec', 'Lipiec', 'Sierpnień', 'Wrzesień', 'Październik', 'Listopad', 'Grudzień');
		for($i = 1; $i <= 12; ++$i) if($Miesiac == $Miesiace[$i]) {if($i < 10) return '0'.$i; else return $i;}
	}

	
	// ********************************************************************************** Funkcje wykonujące większe zadania
	
	/* Funkcja służąca do rejestracji użytkowników. */

	function SignUpUser()
	{
		if(isset($_POST['login']))
		{
			$login 	= strip_tags($_POST['login']);
			$pass 	= strip_tags($_POST['pass']);
			$mail 	= strip_tags($_POST['mail']);
			
			try
			{
				if(empty($login) || empty($pass) || empty($mail)) throw new NiePodanoWartosci();
				else
				{
					$Dzien			= $_POST['dzien'];
					$Miesiac		= ZamianaMiesiacaNaLiczbe($_POST['miesiac']);
					$Rok			= $_POST['rok'];
					$Miesiac == '' ?  $dataUrodzenia = '' : $dataUrodzenia 	= $Rok.'-'.$Miesiac.'-'.$Dzien;
				
					$imie 			= strip_tags($_POST['imie']);
					$nazwisko 		= strip_tags($_POST['nazwisko']);
					$miejscowosc 	= strip_tags($_POST['miejscowosc']);
					$plec 			= $_POST['plec'];
					$dataDodania 	= date('Y-m-d');
					$avatar			= '';
					$about			= strip_tags($_POST['about']);
					
					//echo "$login<br/>$pass<br/>$mail</br>$imie<br/>$nazwisko</br>$miejscowosc<br/>$plec</br>$dataUrodzenia<br/>$dataDodania<br/>";
				
					$target_path = "images/avatars/";
					$target_path .= $login; 
					$target_path .= ".jpg";
					
					if(!empty($_FILES['avatar']['tmp_name']) && !move_uploaded_file($_FILES['avatar']['tmp_name'], $target_path)) throw new NieZapisanoAvatara();
					else if(!empty($_FILES['avatar']['tmp_name']))
					{
						$avatar = '_def.jpg';
						//if(copy("images\def.jpg", "images\avatars\def.jpg.k"))
						//rename("images\avatars\def.jpg.k", "images\avatars\$avatar");
					}
				
					$query = "Select login From users";
					$zapytanie = mysql_query($query);
					if($zapytanie)
					{
						while($wynik = mysql_fetch_array($zapytanie))
							if($wynik[0] == $login) throw new IstniejacyUzytkownik();
					
						$query = "Insert Into users Set login = '$login', pass = '$pass', mail = '$mail', forname = '$imie', surname = '$nazwisko', city = '$miejscowosc', sex = '$plec', bornDate = '$dataUrodzenia', addDate = '$dataDodania', avatar = '$avatar', about = '$about'";
						$zapytanie = @mysql_query($query);
						if(!$zapytanie)
							echo OknoInformacyjne('Nie udało się dodać użytkownika :(', false);
						else
							echo OknoInformacyjne('Użytkownik dodany poprawnie! Możesz się treaz zalogować - zapraszamy na stronę główną!', true);
					}
				}
			}
			catch(NiePodanoWartosci $Error) {
				echo OknoInformacyjne($Error, false);
			}
			catch(IstniejacyUzytkownik $Error) {
				echo OknoInformacyjne($Error, false);
			}
			catch(Exception $Error)	{
				echo OknoInformacyjne('Wystąpił poważny błąd. Proszę spróbować później...', false);
			}
		}
	}
	
	/* Dodawanie komentarzy */
	
	function AddComment($id)
	{
		if(isset($_POST['commentstext']))
		{
			try
			{
				$text = strip_tags($_POST['commentstext']);
				if(empty($text)) throw new NiePodanoWartosci();
				else
				{
					$newsId 	= $id;
					$addDate 	= date('Y-m-d H:i:s');
					$login 		= $_SESSION['userName'];
					$usersId 	= $_SESSION['userId'];
					
					//echo "$newsId<br/>$author</br>$addDate</br>$text";
						
					$query = "Insert Into comments Set text = '$text', usersId = '$usersId', newsId = '$newsId', addDate = '$addDate'";
					$zapytanie = @mysql_query($query);
					if(!$zapytanie)
						echo OknoInformacyjne('Nie udało się dodać komentarza...', false);
					else{
						echo OknoInformacyjne("Komentarz dodany poprawnie! <a href = \"subpage.php?page=news&id=$newsId\">Odśwież</a>", true);
					}
				}
			}
			catch(NiePodanoWartosci $Error) {
				echo OknoInformacyjne($Error, false);
			}
			catch(Exception $Error)	{
				echo OknoInformacyjne('Wystąpił poważny błąd. Proszę spróbować później...', false);
			}
		}
	}
	
	/* Funkcja wyświetlająca danemu użytkownikowi (argument $login) panel z którego może podejrzeć swoje dane lub się wylogować */
	
	function ShowUserPanel($login)
	{
		$query = "Select id, avatar From users Where login = '$login'";
		$zapytanie = @mysql_query($query);
		if($zapytanie) {
			$wynik = mysql_fetch_array($zapytanie);
			$id		= $wynik[0];
			$avatar = $wynik[1];
		}
		
		$query = "Select count(*) From messages Where recipientId = '$id' And state = '0'";
		$zapytanie = @mysql_query($query);
		if($zapytanie) {
			$wynik = mysql_fetch_array($zapytanie);
			$MessagesCount = $wynik[0];
			if($MessagesCount > 0) $image = 'administrator/images/icons/new_email.png'; // Fajny
			else $image = 'administrator/images/icons/email.png'; // Zwykly
		}
	
		echo 
		"<table style = 'width:250px;'>",
			'<tr>',
				"<td style = 'width:120px; text-align:center;'><img src = 'images/avatars/$avatar' style = 'width: 100px; height: 100px;'></td>",
				"<td style = 'text-align: center;'><b><a href = 'subpage.php?page=users&login=$login'>", $login, "</a></b></td>",
			'</tr>',
			'<tr>',
				"<td style = 'text-align: left; border-top:1px dotted #e4e4e4;' colspan = '2' width: 40px;>",
					"<a href = \"subpage.php?page=messages&id=$id\"><img src = \"$image\" title='Skrzynka odbiorcza wiadomości'></a>&nbsp;",
					"<a href = \"subpage.php?page=edit\"><img src = \"administrator/images/icons/preferences.png\" title='Edycja profilu użytkownika'></a>",
				"</td>",
			'</tr>',
			'<tr>',
				"<td style = 'text-align: right; border-top:1px dotted #e4e4e4;' colspan = '2'><a href = 'subpage.php?page=user_session&action=out' class = 'submit'>Wyloguj</a></td>",
			'</tr>',
		'</table>';
	}
	
	/* Wysyłanie wiadomości do użytkownika określonego za pomocą formularza - dodawanie rekordu wiadomości do tabeli messages */
	
	function SendMessage()
	{
		if(isset($_POST['messagetext']) && isset($_POST['recipientId']) && isset($_POST['senderId']))
		{
			try
			{
				$text 			= strip_tags($_POST['messagetext']);
				$senderId 		= $_POST['senderId'];
				$recipientId 	= $_POST['recipientId'];
				$sendDate		= date('Y-m-d H:i:s');
				
				if(empty($text)) throw new NiePodanoWartosci();
				else
				{
					$query = "Insert Into messages Set senderId = '$senderId', recipientId = '$recipientId', text = '$text', sendDate = '$sendDate', state = '0'";
					$zapytanie = @mysql_query($query);
					if(!$zapytanie)
						echo OknoInformacyjne('Nie udało się wysłać wiadomości...', false);
					else{
						echo OknoInformacyjne("Wiadomość wysłana poprawnie!", true);
					}
				}
			}
			catch(NiePodanoWartosci $Error) {
				echo OknoInformacyjne($Error, false);
			}
			catch(Exception $Error)	{
				echo OknoInformacyjne('Wystąpił poważny błąd. Proszę spróbować później...', false);
			}
		}
	}
	
	/* Funkcja wprowadzająca zmiany w odpowiednim rekordzie użytkownika w tabeli users */
	
	function EditUsersData()
	{
		if(isset($_POST['mail']) && isset($_SESSION['userId']))
		{
			try
			{
				$mail = strip_tags($_POST['mail']);
				
				if(empty($mail)) throw new NiePodanoWartosci();
				else
				{
					$id			= $_SESSION['userId'];
					$login		= $_SESSION['userName'];
					$forname 	= strip_tags($_POST['imie']);
					$surname 	= strip_tags($_POST['nazwisko']);
					$city 		= strip_tags($_POST['miejscowosc']);
					$sex		= $_POST['plec'];
					$Dzien		= $_POST['dzien'];
					$Miesiac	= ZamianaMiesiacaNaLiczbe($_POST['miesiac']);
					$Rok		= $_POST['rok'];
					$Miesiac == '' ?  $dataUrodzenia = '' : $dataUrodzenia 	= $Rok.'-'.$Miesiac.'-'.$Dzien;
					
					$target_path = "images/avatars/";
					$target_path .= $login; 
					$target_path .= ".jpg";
					
					$avatar = $login.'.jpg';
					$about	= strip_tags($_POST['about']);
					
					if(!empty($_FILES['avatar']['tmp_name']) && !move_uploaded_file($_FILES['avatar']['tmp_name'], $target_path)) throw new NieZapisanoAvatara();
					
					if(isset($_POST['oldPass']))
					{
						$oldpass 	= strip_tags($_POST['oldPass']);
						$pass 		= strip_tags($_POST['pass']);
						$repass 	= strip_tags($_POST['repass']);
						
						$query = "Select pass From users Where id = '$id'";
						$zapytanie = @mysql_query($query);
						if($zapytanie) {
							$wynik = mysql_fetch_array($zapytanie);
							if($wynik[0] != $oldpass) throw new ZleHaslo();
							else {
								$query = "Update users Set pass = '$pass', mail = '$mail', forname = '$forname', surname = '$surname', city = '$city', sex = '$sex', bornDate = '$dataUrodzenia', avatar = '$avatar', about = '$about' Where id = '$id'";
							}
						} else throw new Exception();
					}
					else {
						$query = "Update users Set mail = '$mail', forname = '$forname', surname = '$surname', city = '$city', sex = '$sex', bornDate = '$dataUrodzenia', avatar = '$avatar', about = '$about' Where id = '$id'";
					}
					
					$zapytanie = @mysql_query($query);
					if($zapytanie) {
						echo OknoInformacyjne("Wartości zmodyfikowane! <a href = 'subpage.php?page=users&login=$login'>Odśwież</a>", true);
					} else {
						echo OknoInformacyjne('Nie udało się zmodyfikować danych... Proszę spróbować później.', false);
					}
				}
			}
			catch(ZleHaslo $Error) {
				echo OknoInformacyjne($Error, false);
			}
			catch(NieZapisanoAvatara $Error) {
				echo OknoInformacyjne($Error, false);
			}
			catch(NiePodanoWartosci $Error) {
				echo OknoInformacyjne($Error, false);
			}
			catch(Exception $Error)	{
				echo OknoInformacyjne('Wystąpił poważny błąd. Proszę spróbować później...', false);
			}
		}
	}
	
	/* Funkcja dodaje kontakt powiązany z kontem wysyłającym zaporoszenie */
	
	function AddFriend()
	{
		if(isset($_SESSION['userId']) && isset($_GET['recId']))
		{
			$senderId 		= $_SESSION['userId'];
			$recipientId 	= $_GET['recId'];
			$sendDate 		= date('Y-m-d H:i:s');
			
			$query = "Insert Into friends Set senderId = '$senderId', recipientId = '$recipientId', sendDate = '$sendDate'";
			$zapytanie = @mysql_query($query);
			if($zapytanie) {
				echo OknoInformacyjne("Użytkownik dodany do grona znajomych!", true);
			} else {
				echo OknoInformacyjne("Nie udało się dodać znajomego...", true);
			}
		}
	}
?>