<?php 

include 'recaptchalib.php'; 
$privatekey = '6LfotckSAAAAAO-raSY9oNocu7bQ891nnDrJSUtx'; // prywatny klucz reCAPTCHA
$publickey = '6LfotckSAAAAAEgWxKAXnF3FeyZ_Vju1OVai_x50'; // publiczny klucz reCAPTCHA

if (isset($_POST['wyslane']) && $_POST['wyslane']) 
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

?>
<div class="header">
    <h2>Kontakt z Nami</h2>
</div>
<div class="content">
	<div class="text">	
  		<form name="Kontakt" action="subpage.php?page=contact" method="POST" class="form">
		<input type="hidden" name="wyslane" value="TRUE" />
			<table width="auto" align="center">
					<tr>
						<td colspan="2"><h5>Wybierz odbiorcę wiadomości:</h5></td>
					</tr>
					<tr>
						<td colspan="2">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="2">
						<select name="odbiorca" style = "width: 539px;">
							<option value="dawid.tomczyk@laverte.pl">Dawid Tomczyk [dawid.tomczyk@laverte.pl]</option>
							<option value="piociw@gmail.com">Piotr Ciwiś [piociw@gmail.com]</option>
						</select>
						</td>
					</tr>
					<tr>
						<td colspan="2">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="2"><h5>Wypelnij informacje o nadawcy:</h5></td>
					</tr>
					<tr>
						<td colspan="2">&nbsp;</td>
					</tr>
					<tr>
						<td><label for="imie">imię</label></td>
						<td><input type = "text" name = "imie" style = "width: 350px;"/></td>
					</tr>
					<tr>
						<td colspan="2"></td>
					</tr>
					<tr>
						<td><label for="nazwisko">nazwisko</label></td>
						<td><input type = "text" name = "nazwisko" style = "width: 350px;"/></td>
					</tr>
					<tr>
						<td colspan="2"></td>
					</tr>
					<tr>
						<td><label for="email">adres e-mail</label></td>
						<td><input type = "text" name = "email" style = "width: 350px;"/></td>
					</tr>
					<tr>
						<td colspan="2"></td>
					</tr>
					<tr>
						<td><label for="temat">temat</label></td>
						<td><input type = "text" name = "temat" style = "width: 350px;"/></td>
					</tr>
					<tr>
						<td colspan="2">&nbsp;</td>
					</tr>
					<tr>
						<td><label for="tresc">wiadomość</label></td>
						<td><textarea id="tresc" name="tresc" style = "width: 350px;"></textarea></td>
					</tr>
					<tr>
						<td colspan="2"></td>
					</tr>
					<tr>
						<td><label for="kopia">wyślij kopię wiadomości</label></td>
						<td><input type="checkbox" name="kopia" value="1" /></td>
					</tr>
					<tr>
						<td colspan="2">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="2" style="text-align:center;"><center><?php echo recaptcha_get_html($publickey); ?></center></td>
					</tr>
					<tr>
						<td colspan="2">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="2">
							<p class="submit" style="text-align:center;">
								<input type="submit" value="Wyślij" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<input type="reset" value="Reset" />
							</p>
						</td>
					</tr>
					
				</table>
			</form>
	</div>
</div>
<div class="footer"></div>