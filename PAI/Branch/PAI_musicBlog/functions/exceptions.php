<?php

	/* Lista wyjatkow:
		
		- IstniejacyUzytkownik
		- NiePodanoWartosci
		- ZlyLogin
		- ZleHaslo
		- NieZapisanoAvatara
	*/

	class IstniejacyUzytkownik extends Exception
	{
		function __toString()
		{
			return 'Podana nazwa użytkownika istnieje już w bazie. Proszę wybrać inną';
		}
	}

	class NiePodanoWartosci extends Exception
	{
		function __toString()
		{
			return 'Nie podano wszystkich niezbędnych wartości!';
		}
	}

	class ZlyLogin extends Exception
	{
		function __toString()
		{
			return 'Nie ma takiego użytkownika w bazie!';
		}
	}

	class ZleHaslo extends Exception
	{
		function __toString()
		{
			return 'Złe hasło!';
		}
	}

	class NieZapisanoAvatara extends Exception
	{
		function __toString()
		{
			return 'Wystąpił błąd podczas zapisywania avatara!';
		}
	}

?>