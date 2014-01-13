<?php

class AdminEvents
{
	public static function ShowEvents()
    {
		if($_SESSION['id'])
		{
			$usersId = $_SESSION['id'];
		
			$host = 'laverte.nazwa.pl';
			$login = 'laverte_13';
			$password = 'DAwidtomczyks11';
			$database = 'laverte_13';
			
			try
			{
				@$db = new mysqli($host, $login, $password, $database);
				if(mysqli_connect_errno()) {
					echo Show::ShowMessage ("Nie udało się połączyć z bazą...", false);
				}
				else
				{
					$result = @$db->query("select * from events");
					$all = $result->num_rows;
					if($all <= 0)
					{
						echo Show::ShowMessage ("Brak wydarzeń do wyświetlenia...", false);
					}
					else
					{
						if ($result === false)
						{
							throw new sqlQueryError();
							$db -> close();
						}
						else 
						{
							echo 
							'<table width="100%" id="rounded-corner">
								<thead>
									<tr>
										<th width="5%" class="rounded-company" scope="col">ID</th>
										<th width="15%" class="rounded" scope="col" align="center">Kategoria</th>
										<th width="35%" class="rounded" scope="col" align="center">Tytuł</th>
										<th width="20%" class="rounded" scope="col" align="center">Treść</th>
										<th width="15%" class="rounded" scope="col" align="center">Data</th>
										<th width="5%" class="rounded" scope="col" align="center">Edytuj</th>
										<th width="5%" class="rounded-q4" scope="col" align="center">Usuń</th>
									</tr>
								</thead>
								<tfoot>
								</tfoot>
								<tbody>';
							
							while (($events = $result->fetch_assoc()) !== null)
							{    
								$id = $events['id'];
								$ShortText 	= substr($events['content'], 0, 15);
								$ShortText 	.= '...';
								
								echo
									'<tr>
										<td align="center">',$id,'</td>
										<td>',$events['category'],'</td>
										<td>',$events['title'],'</td>
										<td align="center">',$ShortText,'</td>
										<td align="center">',$events['date'],'</td>
										<td align="center"><a href="index.php?admin=events&action=editE&id=',$id,'"><img src="images/user_edit.png" alt="Edytuj wydarzenie..." title="Edytuj wydarzenie..." border="0" /></a></td>
										<td align="center"><a href="index.php?admin=events&action=deleteE&id=',$id,'" class="ask"><img src="images/trash.png" alt="Usuń wydarzenie..." title="Usuń wydarzenie..." border="0" /></a></td>
									</tr>';
							}
							
							echo
								'</tbody>
							</table>';
							
							$result->close();
							$db->close();
						}
					}
				}
			}
			catch(Exception $Error)	
			{
				echo Show::ShowMessage('Wystąpił poważny błąd. Proszę spróbować później...', false);
			}
		}
		else
		{
			echo Show::ShowMessage('Nie powinno Cie tu być...', false);
		}
    }
	
	public static function addEvents()
    {
		if(isset($_SESSION['id']))
		{
			$usersId = $_SESSION['id'];
			
			$host = 'laverte.nazwa.pl';
			$login = 'laverte_13';
			$password = 'DAwidtomczyks11';
			$database = 'laverte_13';
			
			try
			{
				if(isset($_POST['title']))
				{
					$category 	= $_POST['category'];
					$title 		= $_POST['title'];
					$content 	= $_POST['tresc'];
					$date 		= date('Y-m-d H:i:s');
					
					if(empty($category) || empty($title)) {
						echo Show::ShowMessage("Nie podano wszystkich wartości!", false);
					}
					else
					{
						@$db = new mysqli($host, $login, $password, $database);
						if(mysqli_connect_errno()) {
							echo Show::ShowMessage ("Nie udało się połączyć z bazą...", false);
						}
						else
						{
							$query = "Insert Into events Set category = '$category', title = '$title', content = '$content', date = '$date', usersId = '$usersId'";
							$result = @$db->query($query);
							
							if($result) {
								echo Show::ShowMessage ("Wydarzenie dodane poprawnie", true);
							} else {
								echo Show::ShowMessage ("Nie udało się dodać filmu do bazy...", false);
							}
							
							$result->close();
							$db->close();
						}
					}
				}
				else
				{
					@$db = new mysqli($host, $login, $password, $database);
					if(mysqli_connect_errno()) {
						echo Show::ShowMessage ("Nie udało się połączyć z bazą...", false);
					}
					else
					{		
						echo
						'
							<div class="round">
								<div class="round-head">
									<h2>Dodaj wydarzenie</h2>
								</div>

								<div class="round-content">
									<form action="index.php?admin=events&action=addEvents&accept=yes" class="uniForm" method="post"> 
									<fieldset class="inlineLabels"> 
										<div class="ctrlHolder"> 
											<label>Kategoria:</label> 
											<input type="text" id="category" name="category" class="textInput"/> 
										 </div>
										 <div class="ctrlHolder"> 
											<label>Tytuł:</label> 
											<input type="text" id="title" name="title" class="textInput"/> 
										 </div>
										<div class="ctrlHolder"> 
											<textarea id="content" name="tresc" class="textInput"/></textarea>
										</div>
										<br />
										<div class="buttonHolder"> 
											<a id="passwordForgot" href="index.php?admin=events">anuluj dodawanie wydarzenia</a>
											<button id="login" type="submit" class="primaryAction">Dodaj wydarzenie</button> 
											<button id="reset" type="reset" class="primaryAction">Zresetuj formularz</button>
										</div> 
									</fieldset> 
									</form>
								</div>
							</div>
						';
						
						$result->close();
						$db->close();
					}
				}
			}
			catch(Exception $Error)	
			{
				echo Show::ShowMessage('Wystąpił poważny błąd. Proszę spróbować później...', false);
			}
		}
		else 
		{
			echo Show::ShowMessage('Nie powinno Cie tu być...', false);
		}
	}
	
	public static function delEvent($EventsId)
	{
		if(empty($EventsId))
		{
			Show::ShowMessage("Nie ma takiego wydarzenia! Może już ktoś Ci go usunął?", false);
		}
		else
		{
			$host = 'laverte.nazwa.pl';
			$login = 'laverte_13';
			$password = 'DAwidtomczyks11';
			$database = 'laverte_13';
			
			@$db = new mysqli($host, $login, $password, $database);
			if(mysqli_connect_errno()) {
				echo Show::ShowMessage ("Nie udało się połączyć z bazą...", false);
			}
			else
			{
				$query = "Delete From events Where id = '$EventsId'";
				$result = @$db->query($query);
								
				if($result) {
					echo Show::ShowMessage ("Wydarzenie usunięte poprawnie", true);
				} else {
					echo Show::ShowMessage ("Nie udało się usunąć wydarzenia z bazy...", false);
				}
			}
		}
	}
	
	public static function editEvent($EventsId)
	{
		if(isset($_SESSION['id']))
		{
			$usersId = $_SESSION['id'];
			$host = 'laverte.nazwa.pl';
			$login = 'laverte_13';
			$password = 'DAwidtomczyks11';
			$database = 'laverte_13';
			
			try
			{
				if(isset($_POST['category']))
				{
					$category 	= $_POST['category'];
					$title 		= $_POST['title'];
					$content 	= $_POST['content'];
					
					if(empty($category) || empty($title)) {
						echo Show::ShowMessage("Nie podano wszystkich wartości!", false);
					}
					else
					{
						@$db = new mysqli($host, $login, $password, $database);
						if(mysqli_connect_errno()) {
							echo Show::ShowMessage ("Nie udało się połączyć z bazą...", false);
						}
						else
						{
							$query = "Update events Set category = '$category', title = '$title', content = '$content'";
							$result = @$db->query($query);
							
							if($result) {
								echo Show::ShowMessage ("Wydarzenie zmodyfikowane poprawnie", true);
							} else {
								echo Show::ShowMessage ("Nie udało się zmodyfikować wydarzenia...", false);
							}
							
							$result->close();
							$db->close();
						}
					}
				}
				else
				{
					@$db = new mysqli($host, $login, $password, $database);
					if(mysqli_connect_errno()) {
						echo Show::ShowMessage ("Nie udało się połączyć z bazą...", false);
					}
					else
					{
						$query = "Select * From events Where id = '$EventsId'";
						$result = @$db->query($query);
						$all = $result->num_rows;
						if($all <= 0)
						{
							echo Show::ShowMessage ("Nie ma takiego wydarzenia, więc nie da się go edytować... Smutne...", false);
						}
						else
						{
							if ($result === false)
							{
								throw new sqlQueryError();
								$db -> close();
							}	
							else 
							{
								$event 		= $result->fetch_assoc();
							
								$category 	= $event['category'];
								$title 		= $event['title'];
								$content 	= $event['content'];
							
								$result->close();

								echo
								'
									<div class="round">
										<div class="round-head">
											<h2>Dodaj wydarzenie</h2>
										</div>

										<div class="round-content">
											<form action="index.php?admin=events&action=editE&accept=yes" class="uniForm" method="post"> 
											<fieldset class="inlineLabels"> 
												<div class="ctrlHolder"> 
													<label>Kategoria:</label> 
													<input type="text" id="category" name="category" class="textInput" value="', $category, '"/> 
												 </div>
												 <div class="ctrlHolder"> 
													<label>Tytuł:</label> 
													<input type="text" id="title" name="title" class="textInput" value ="', $title, '"/> 
												 </div>
												<div class="ctrlHolder"> 
													<textarea id="content" name="content" class="textInput"/>', $content, '</textarea>
												</div>
												<br />
												<div class="buttonHolder"> 
													<a id="passwordForgot" href="index.php?admin=events">anuluj edycje wydarzenia</a>
													<button id="login" type="submit" class="primaryAction">Edytuj wydarzenie</button> 
													<button id="reset" type="reset" class="primaryAction">Zresetuj formularz</button>
												</div> 
											</fieldset> 
											</form>
										</div>
									</div>
								';
							}
						}
					}
				}
			}
			catch(Exception $Error)	
			{
				echo Show::ShowMessage('Wystąpił poważny błąd. Proszę spróbować później...', false);
			}
		}
		else 
		{
			echo Show::ShowMessage('Nie powinno Cie tu być...', false);
		}
	}
}

?>