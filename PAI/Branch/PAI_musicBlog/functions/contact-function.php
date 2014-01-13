<?php 
function contact_funct()
{

if ($_POST['wyslane']) 
{
	$twojemail = htmlspecialchars(stripslashes(strip_tags(trim($_POST["odbiorca"]))), ENT_QUOTES);
	$imie = htmlspecialchars(stripslashes(strip_tags(trim($_POST["imie"]))), ENT_QUOTES);
	$nazwisko = htmlspecialchars(stripslashes(strip_tags(trim($_POST["nazwisko"]))), ENT_QUOTES);
	$email = htmlspecialchars(stripslashes(strip_tags(trim($_POST["email"]))), ENT_QUOTES);
	$temat = htmlspecialchars(stripslashes(strip_tags(trim($_POST["temat"]))), ENT_QUOTES);
	$tresc = htmlspecialchars(stripslashes(strip_tags(trim($_POST["tresc"]))), ENT_QUOTES);
	$kopia = $_POST["kopia"];
	$resp = recaptcha_check_answer ($privatekey, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);

	try
	{
		if(empty($imie) || empty($nazwisko) || !eregi("^[0-9a-z_.-]+@([0-9a-z-]+\.)+[a-z]{2,4}$", $email) || empty($temat) || empty ($tresc) || !$resp->is_valid) throw new NiePodanoWartosci();
		else
		{
			$naglowki = "MIME-Version: 1.0" . "\r\n";
			$naglowki .= "Content-type:text/html;charset=utf-8" . "\r\n";
			$naglowki .= 'From: <'.$email.'>' . "\r\n";
			$naglowki .= 'Cc: <'.$twojemail.'>' . "\r\n";
			$tytul = 'Formularz kontaktowy';
			$tresc = nl2br($tresc);
			$wiadomosc = <<< KONIEC
			<html>
				<p><strong>Imię:</strong> $imie</p>
				<p><strong>Nazwisko:</strong> $nazwisko</p>
				<p><strong>Temat:</strong> $temat</p>
				<p><strong>Treść wiadomości:</strong> <br />$tresc</p>
			</html>
KONIEC;
			$wynik = mail('<'.$email.'>', $tytul, $wiadomosc, $naglowki);
			if ($kopia) 
			{
				$naglowki2 = "MIME-Version: 1.0" . "\r\n";
				$naglowki2 .= "Content-type:text/html;charset=utf-8" . "\r\n";
				$naglowki2 .= 'From: <'.$twojemail.'>' . "\r\n";
				$tytul2 = 'Kopia - Formularz kontaktowy';

				$wynik = mail($email, $tytul2, $wiadomosc, $naglowki2);
			}
			if ($wynik) 
			{
				echo '<p>Wiadomość została wysłana</p>';
			} 
			else 
			{
				echo '<p>Wiadomość nie została wysłana</p>';
			}
		}
	}
	catch(NiePodanoWartosci $Error) 
	{
		echo OknoInformacyjne($Error, false);
	}
	catch(Exception $Error)	
	{
		echo OknoInformacyjne('Wystąpił poważny błąd. Proszę spróbować później...', false);
	}	
}
}

?>