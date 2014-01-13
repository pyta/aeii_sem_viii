<?php

class AdminFilms
{
	public static function showFilmsCat()
    {
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
				$result = @$db->query("select id, name, description, addDate, image from films_category");
				$all = $result->num_rows;
				if($all <= 0)
				{
					echo Show::ShowMessage ("Brak kategorii do wyświetlenia...", false);
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
									<th width="15%" class="rounded" scope="col" align="center">Nazwa</th>
									<th width="35%" class="rounded" scope="col" align="center">Opis</th>
									<th width="20%" class="rounded" scope="col" align="center">Data Dodania</th>
									<th width="15%" class="rounded" scope="col" align="center">Obrazek</th>
									<th width="5%" class="rounded" scope="col" align="center">Edytuj</th>
									<th width="5%" class="rounded-q4" scope="col" align="center">Usuń</th>
								</tr>
							</thead>
							<tfoot>
							</tfoot>
							<tbody>';
						
						while (($news = $result->fetch_assoc()) !== null)
						{    
							$id = $news['id'];
							$ShortText 	= substr($news['description'], 0, 15);
							$ShortText 	.= '...';
							
							echo
								'<tr>
									<td align="center">',$id,'</td>
									<td>',$news['name'],'</td>
									<td>',$ShortText,'</td>
									<td align="center">',$news['addDate'],'</td>
									<td align="center">',$news['image'],'</td>
									<td align="center"><a href="index.php?admin=films&action=editC&id=',$id,'"><img src="images/user_edit.png" alt="Edytuj kategorie..." title="Edytuj kategorie..." border="0" /></a></td>
									<td align="center"><a href="index.php?admin=films&action=deleteC&id=',$id,'" class="ask"><img src="images/trash.png" alt="Usuń kategorie..." title="Usuń kategorie..." border="0" /></a></td>
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
	
	public static function showFilms()
    {
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
				$query = "select f.id, f.name, f.link, c.name As cat, f.description, f.image, f.addDate from films f Inner Join films_category c On f.categoryId = c.id";
				$result = @$db->query($query);
				$all = $result->num_rows;
				if($all <= 0)
				{
					echo Show::ShowMessage ("Brak filmów do wyświetlenia...", false);
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
									<th width="15%" class="rounded" scope="col" align="center">Nazwa</th>
									<th width="15%" class="rounded" scope="col" align="center">Link</th>
									<th width="15%" class="rounded" scope="col" align="center">Kategoria</th>
									<th width="15%" class="rounded" scope="col" align="center">Opis</th>
									<th width="10%" class="rounded" scope="col" align="center">Obrazek</th>
									<th width="15%" class="rounded" scope="col" align="center">Data dodania</th>
									<th width="5%" class="rounded" scope="col" align="center">Edytuj</th>
									<th width="5%" class="rounded-q4" scope="col" align="center">Usuń</th>
								</tr>
							</thead>
							<tfoot>
							</tfoot>
							<tbody>';
						
						while (($news = $result->fetch_assoc()) !== null)
						{    
							$id = $news['id'];
							$ShortText 	= substr($news['description'], 0, 15);
							$ShortText 	.= '...';
							echo
								'<tr>
									<td align="center">',$id,'</td>
									<td>',$news['name'],'</td>
									<td>',$news['link'],'</td>
									<td>',$news['cat'],'</td>
									<td align="center">',$ShortText,'</td>
									<td align="center">',$news['image'],'</td>
									<td align="center">',$news['addDate'],'</td>
									<td align="center"><a href="index.php?admin=films&action=editF&id=',$id,'"><img src="images/user_edit.png" alt="Edytuj kategorie..." title="Edytuj kategorie..." border="0" /></a></td>
									<td align="center"><a href="index.php?admin=films&action=deleteF&id=',$id,'" class="ask"><img src="images/trash.png" alt="Usuń kategorie..." title="Usuń kategorie..." border="0" /></a></td>
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
	
	public static function addFilm()
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
				if(isset($_POST['name']))
				{
					$name 			= $_POST['name'];
					$link 			= $_POST['link'];
					$categoryId 	= $_POST['category'];
					$description 	= $_POST['description'];
					$image			= $_FILES['image']['name'];
					$addDate 		= date('Y-m-d H:i:s');
					
					if(empty($name) || empty($link) || empty($categoryId)) {
						echo Show::ShowMessage("Nie podano wszystkich wartości!", false);
						//echo $name, $link, $categoryId, $description, $image, $addDate;
					}
					else
					{
						@$db = new mysqli($host, $login, $password, $database);
						if(mysqli_connect_errno()) {
							echo Show::ShowMessage ("Nie udało się połączyć z bazą...", false);
						}
						else
						{
							if(empty($image)) {
								$query = "Insert Into films Set name = '$name', link = '$link', categoryId = '$categoryId', description = '$description', addDate = '$addDate', usersId = '$usersId'";
							} else {
								$lokalizacja = "../images/".$_FILES['image']['name'];
								if(is_uploaded_file($_FILES['image']['tmp_name']))
								{
									if(!move_uploaded_file($_FILES['image']['tmp_name'], $lokalizacja)) {
										echo Show::ShowMessage("Plik nie może zostać skopiowany!", false);
									}
									else {
										$query = "Insert Into films Set name = '$name', link = '$link', categoryId = '$categoryId', description = '$description', image = '$image', addDate = '$addDate', usersId = '$usersId'";	
									}
								} 
								else {
									echo Show::ShowMessage("Blad w pracy z plikiem!", false);
									$query = "Insert Into films Set name = '$name', link = '$link', categoryId = '$categoryId', description = '$description', addDate = '$addDate', usersId = '$usersId'";
								}
							}
							$result = @$db->query($query);
							
							if($result) {
								echo Show::ShowMessage ("Film dodany poprawnie", true);
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
						$result = @$db->query("select id, name from films_category");
						$all = $result->num_rows;
						if($all <= 0)
						{
							echo Show::ShowMessage ("Nie ma jeszcze żadnej kategorii! Utwórz najpierw kategorię!", false);
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
								'
									<div class="round">
										<div class="round-head">
											<h2>Dodaj Film</h2>
										</div>

										<div class="round-content">
											<form action="index.php?admin=films&action=addFilm&accept=yes" class="uniForm" method="post"> 
											<fieldset class="inlineLabels"> 
												<div class="ctrlHolder"> 
													<label>Tytuł:</label> 
													<input type="text" id="title" name="name" class="textInput"/> 
												 </div>
												<div class="ctrlHolder"> 
													<label>Link z YT:</label> 
													<input type="text" id="title" name="link" class="textInput"/> 
												</div>
												<div class="ctrlHolder"> 
													<label>Kategoria:</label>
													<select name = "category" style = "width: 200px;">';
								
														while (($category = $result->fetch_assoc()) !== null) {
															echo "<option value = '", $category['id'], "'>", $category['name'], "</option>";
														}
														
														echo
													'</select>
													
												</div>
												<div class="ctrlHolder"> 
													<textarea id="content" name="description" class="textInput"/></textarea>
												</div>
												<div class="ctrlHolder"> 
													<label>Obrazek:</label> 
													<input type="file" id="title" name="image" class="textInput"/> 
												</div>
												<br />
												<div class="buttonHolder"> 
													<a id="passwordForgot" href="index.php?admin=films">anuluj dodawanie filmu</a>
													<button id="login" type="submit" class="primaryAction">Dodaj film</button> 
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
	
	public static function editFilm()
	{
		if(isset($_GET['id']))
		{
			$FilmsId = $_GET['id'];
		
			$host = 'laverte.nazwa.pl';
			$login = 'laverte_13';
			$password = 'DAwidtomczyks11';
			$database = 'laverte_13';
	
			if(isset($_POST['name']))
			{
				$name 			= $_POST['name'];
				$link 			= $_POST['link'];
				$categoryId 	= $_POST['category'];
				$description 	= $_POST['description'];
				$image			= $_FILES['image']['name'];
					
				echo $name, $link, $categoryId, $description, $image;
					
				if(empty($name) || empty($link) || empty($categoryId)) {
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
						if(empty($image)) {
							$query = "Update films Set name = '$name', link = '$link', categoryId = '$categoryId', description = '$description'";
						} else {
							$lokalizacja = "../images/".$_FILES['image']['name'];
							echo $_FILES['image']['tmp_name'], "kon";
							if(is_uploaded_file($_FILES['image']['tmp_name']))
							{
								if(!move_uploaded_file($_FILES['image']['tmp_name'], $lokalizacja)) {
									echo Show::ShowMessage("Plik nie może zostać skopiowany!", false);
								}
								else {
									$query = "Update films Set name = '$name', link = '$link', categoryId = '$categoryId', description = '$description', image = '$image' Where id = '$FilmsId'";	
								}
							}
							else {
								echo Show::ShowMessage("Blad w pracy z plikiem!", false);
								$query = "Update films Set name = '$name', link = '$link', categoryId = '$categoryId', description = '$description'";
							}
						}
						$result = @$db->query($query);
							
						if($result) {
							echo Show::ShowMessage ("Film dodany poprawnie", true);
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
					$query = "select f.id, f.name, f.link, c.name As cat, f.description, f.image, f.addDate from films f Inner Join films_category c On f.categoryId = c.id Where f.id = '$FilmsId'";
					$result = @$db->query($query);
					$all = $result->num_rows;
					if($all <= 0)
					{
						echo Show::ShowMessage ("Nie ma takiego filmu, więc nie da się go edytować... Smutne...", false);
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
							$film 			= $result->fetch_assoc();
							
							$name 			= $film['name'];
							$link 			= $film['link'];
							$categoryId 	= $film['categoryId'];
							$description 	= $film['description'];
							$image 			= $film['image'];
							
							if(empty($image)) $image = '[brak obrazka]';
							else $image = "<img style = 'width: 300px; height: 250px;' src = '../images/$image'>";
							
							$result->close();
							
							echo 
							'<table width="100%" id="rounded-corner">
								<thead>
									<tr>
										<th width="50%" class="rounded-company" scope="col">Dodaj film</th>
										<th width="50%" class="rounded-q4" scope="col" align="center">&nbsp;</th>					
									</tr>
								</thead>
								<tfoot>
								</tfoot>
								<tbody>';
												
							echo 
								"<tr>
									<td colspan = '2' style = 'text-align: center;'>Edycja</td>
								</tr>
								
								<form enctype = 'multipart/form-data' name = 'EdytujFilm' action = 'index.php?admin=films&action=editF&id=$FilmsId' method = 'POST'>
								
								<tr>
									<td>Nazwa filmu:</td>
									<td><input type = 'text' name = 'name' style = 'width: 200px;' value = '$name'></td>
								</tr>
								<tr>
									<td>Link z YT:</td>
									<td><input type = 'text' name = 'link' style = 'width: 200px;' value = '$link'></td>
								</tr>
								<tr>
									<td>Kategoria:</td>
									<td>
										<select name = 'category' style = 'width: 200px;'>";
										
							$query = "select id, name from films_category";
							$result = @$db->query($query);
							$all = $result->num_rows;
							if($all <= 0)
							{
								echo Show::ShowMessage ("Wystąpił błąd podczas łączenia się z bazą!", false);
							}
							else
							{	
								while (($category = $result->fetch_assoc()) !== null) {
									if($category['id'] == $categoryId)
										echo "<option value = '", $category['id'], "'> selected", $category['name'], "</option>";
									else
										echo "<option value = '", $category['id'], "'>", $category['name'], "</option>";
								}
							}
								
							echo
									"</select>
									</td>
								</tr>
								<tr>
									<td colspan = '2'>Opis:</td>
								</tr>
								<tr>
									<td colspan = '2'><textarea name = 'description'>$description</textarea></td>
								</tr>
								<tr>
									<td>Obrazek:</td>
									<td><input type = 'file' name = 'image' style = 'width: 200px;'></td>
								</tr>
								<tr>
									<td>Aktualny:</td>
									<td style = 'text-align: center;'>$image</td>
								</tr>
								<tr>
									<td colspan = '2' style = 'text-align: center;'><input type = 'submit' value = 'Dodaj film'></td>
								</tr>
								
								</form>";
												
							echo
									'</tbody>
								</table>';
								
							$result->close();
							$db->close();
						}
					}
				}
			}
		}
	}
	
	public static function editFilmsCategory($CategoryId)
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
				if(isset($_POST['name']))
				{
					$name 			= $_POST['name'];
					$description 	= $_POST['description'];
					$image1			= $_FILES['image1']['name'];
					$image2			= $_FILES['image2']['name'];
					
					if(empty($name)) {
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
							if(empty($image1) && empty($image2)) {
								$query = "Insert Into films_category Set name = '$name', description = '$description'";
							}
							else {
								$OperacjaPoprawna = false;
								if(!empty($image1))
								{
									$lokalizacja = "../images/".$_FILES['image1']['name'];
									if(is_uploaded_file($_FILES['image1']['tmp_name']))
									{
										if(!move_uploaded_file($_FILES['image1']['tmp_name'], $lokalizacja)) {
											echo Show::ShowMessage("Plik nie może zostać skopiowany!", false);
										}
										else {
											$OperacjaPoprawna = true;
											$query = "Insert Into films_category Set name = '$name', description = '$description', image = '$image1'";
										}
									} 
									else {
										echo Show::ShowMessage("Blad w pracy z plikiem!", false);
									}
								}
								
								if(!empty($image2))
								{
									$lokalizacja = "../images/".$_FILES['image2']['name'];
									if(is_uploaded_file($_FILES['image2']['tmp_name']))
									{
										if(!move_uploaded_file($_FILES['image2']['tmp_name'], $lokalizacja)) {
											echo Show::ShowMessage("Plik nie może zostać skopiowany!", false);
										}
										else {
											if($OperacjaPoprawna) {
												$query = "Insert Into films_category Set name = '$name', description = '$description', image = '$image1', viewImage = '$image2'";
											}
											else {
												$query = "Insert Into films_category Set name = '$name', description = '$description', viewImage = '$image2'";
											}
										}
									} 
									else {
										echo Show::ShowMessage("Blad w pracy z plikiem!", false);
									}
								}
								
							}
							$result = @$db->query($query);
							
							if($result) {
								echo Show::ShowMessage ("Kategoria zmodyfikowana poprawnie", true);
							} else {
								echo Show::ShowMessage ("Nie udało się dodać kategorii do bazy...", false);
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
						$query = "Select * From films_category Where id = '$CategoryId'";
						$result = @$db->query($query);
						$all = $result->num_rows;
						if($all <= 0)
						{
							echo Show::ShowMessage ("Nie ma takiej kategorii, więc nie da się jej edytować... Smutne...", false);
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
								$category 			= $result->fetch_assoc();
							
								$name 			= $category['name'];
								$description 	= $category['description'];
								$image1 		= $category['image'];
								$image2			= $category['viewImage'];
							
								if(empty($image1)) $image1 = '[brak obrazka]';
								else $image1 = "<img style = 'width: 300px; height: 250px;' src = '../images/$image1'>";
								
								if(empty($image2)) $image2 = '[brak obrazka]';
								else $image2 = "<img style = 'width: 300px; height: 250px;' src = '../images/$image2'>";
							
								$result->close();
								
								echo 
								'<table width="100%" id="rounded-corner">
									<thead>
										<tr>
											<th width="50%" class="rounded-company" scope="col">Edutuj kategorię</th>
											<th width="50%" class="rounded-q4" scope="col" align="center">&nbsp;</th>					
										</tr>
									</thead>
									<tfoot>
									</tfoot>
									<tbody>';
											
								echo 
										"<tr>
											<td colspan = '2' style = 'text-align: center;'>Zmodyfikuj pola!</td>
										</tr>
									
										<form enctype = 'multipart/form-data' name = 'DodajKategoei' action = 'index.php?admin=films&action=addFilmsCat' method = 'POST'>
									
											<tr>
												<td>Nazwa kategorii:</td>
												<td><input type = 'text' name = 'name' style = 'width: 200px;' value = '$name'></td>
											</tr>
											<tr>
												<td colspan = '2'>Opis:</td>
											</tr>
											<tr>
													<td colspan = '2'><textarea name = 'description'>$description</textarea></td>
											</tr>
											<tr>
												<td>Obrazek (300x250):</td>
												<td><input type = 'file' name = 'image1' style = 'width: 200px;'></td>
											</tr>
											<tr>
												<td>Aktualny:</td>
												<td style = 'text-align: center;'>$image1</td>
											</tr>
											<tr>
												<td>Obrazek (000x000):</td>
												<td><input type = 'file' name = 'image2' style = 'width: 200px;'></td>
											</tr>
											<tr>
												<td>Aktualny:</td>
												<td style = 'text-align: center;'>$image2</td>
											</tr>
											<tr>
												<td colspan = '2' style = 'text-align: center;'><input type = 'submit' value = 'Edytuj kategorie'></td>
											</tr>
									
										</form>";
											
								echo
									'</tbody>
								</table>';
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
	
	public static function delFilm($FilmsId)
	{
		if(empty($FilmsId))
		{
			Show::ShowMessage("Nie ma takiego filmu! Może już ktoś Ci go usunął?", false);
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
				$query = "Delete From films Where id = '$FilmsId'";
				$result = @$db->query($query);
								
				if($result) {
					echo Show::ShowMessage ("Film usunięty poprawnie", true);
				} else {
					echo Show::ShowMessage ("Nie udało się usunąć filmu z bazy...", false);
				}
			}
		}
	}
	
	public static function delFilmsCat($CategoryId)
	{
		if(empty($CategoryId))
		{
			Show::ShowMessage("Nie ma takiej kategorii! Może już ktoś Ci ją usunął?", false);
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
				$query = "Delete From films_category Where id = '$CategoryId'";
				$result = @$db->query($query);
								
				if($result) {
					echo Show::ShowMessage ("Kategoria usunięta poprawnie", true);
				} else {
					echo Show::ShowMessage ("Nie udało się usunąć kategorii z bazy...", false);
				}
			}
		}
	}
	
	public static function addFilmsCat()
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
				if(isset($_POST['name']))
				{
					$name 			= $_POST['name'];
					$description 	= $_POST['description'];
					$image1			= $_FILES['image1']['name'];
					$image2			= $_FILES['image2']['name'];
					$addDate 		= date('Y-m-d H:i:s');
					
					if(empty($name)) {
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
							if(empty($image1) && empty($image2)) {
								$query = "Insert Into films_category Set name = '$name', description = '$description', addDate = '$addDate', usersId = '$usersId'";
							}
							else {
								$OperacjaPoprawna = false;
								if(!empty($image1))
								{
									$lokalizacja = "../images/".$_FILES['image1']['name'];
									if(is_uploaded_file($_FILES['image1']['tmp_name']))
									{
										if(!move_uploaded_file($_FILES['image1']['tmp_name'], $lokalizacja)) {
											echo Show::ShowMessage("Plik nie może zostać skopiowany!", false);
										}
										else {
											$OperacjaPoprawna = true;
											$query = "Insert Into films_category Set name = '$name', description = '$description', addDate = '$addDate' image = '$image1', usersId = '$usersId'";
										}
									} 
									else {
										echo Show::ShowMessage("Blad w pracy z plikiem!", false);
									}
								}
								
								if(!empty($image2))
								{
									$lokalizacja = "../images/".$_FILES['image2']['name'];
									if(is_uploaded_file($_FILES['image2']['tmp_name']))
									{
										if(!move_uploaded_file($_FILES['image2']['tmp_name'], $lokalizacja)) {
											echo Show::ShowMessage("Plik nie może zostać skopiowany!", false);
										}
										else {
											if($OperacjaPoprawna) {
												$query = "Insert Into films_category Set name = '$name', description = '$description', addDate = '$addDate', image = '$image1', viewImage = '$image2', usersId = '$usersId'";
											}
											else {
												$query = "Insert Into films_category Set name = '$name', description = '$description', addDate = '$addDate', viewImage = '$image2', usersId = '$usersId'";
											}
										}
									} 
									else {
										echo Show::ShowMessage("Blad w pracy z plikiem!", false);
									}
								}
								
							}
							$result = @$db->query($query);
							
							if($result) {
								echo Show::ShowMessage ("Kategoria dodana poprawnie", true);
							} else {
								echo Show::ShowMessage ("Nie udało się dodać kategorii do bazy...", false);
							}
							
							$result->close();
							$db->close();
						}
					}
				}
				else
				{
					echo 
					'<table width="100%" id="rounded-corner">
						<thead>
							<tr>
								<th width="50%" class="rounded-company" scope="col">Dodaj kategorię</th>
								<th width="50%" class="rounded-q4" scope="col" align="center">&nbsp;</th>					
							</tr>
						</thead>
						<tfoot>
						</tfoot>
						<tbody>';
												
					echo 
							"<tr>
								<td colspan = '2' style = 'text-align: center;'>Podaj wszystkie niezbędne wartości!</td>
							</tr>
								
								<form enctype = 'multipart/form-data' name = 'DodajKategoei' action = 'index.php?admin=films&action=addFilmsCat' method = 'POST'>
								
									<tr>
										<td>Nazwa kategorii:</td>
										<td><input type = 'text' name = 'name' style = 'width: 200px;'></td>
									</tr>
									<tr>
										<td colspan = '2'>Opis:</td>
									</tr>
									<tr>
											<td colspan = '2'><textarea name = 'description'></textarea></td>
									</tr>
									<tr>
										<td>Obrazek (300x250):</td>
										<td><input type = 'file' name = 'image1' style = 'width: 200px;'></td>
									</tr>
									<tr>
										<td>Obrazek (000x000):</td>
										<td><input type = 'file' name = 'image2' style = 'width: 200px;'></td>
									</tr>
									<tr>
										<td colspan = '2' style = 'text-align: center;'><input type = 'submit' value = 'Dodaj kategorie'></td>
									</tr>
								
								</form>";
												
					echo
						'</tbody>
					</table>';
				}
			}
			catch(Exception $Error)	
			{
				echo Show::ShowMessage('Wystąpił poważny błąd. Proszę spróbować później...', false);
			}
		}
		else {
			echo Show::ShowMessage('Nie powinno Cie tu być...', false);
		}
	}
}
				
?>