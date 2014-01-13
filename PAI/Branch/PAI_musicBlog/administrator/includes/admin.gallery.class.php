<?php

class adminGallery 
{
    public static function getCategory()
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
				$result = @$db->query("select id, title, description, addDate, patch, thumbnail from gallery_category");
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
						'
                        <table width="100%" id="rounded-corner">
                        <thead>
                            <tr>
                                <th width="5%" class="rounded-company" scope="col">ID</th>
                                <th width="15%" class="rounded" scope="col" align="center">Tytuł</th>
                                <th width="35%" class="rounded" scope="col" align="center">Opis (skrócony)</th>
                                <th width="15%" class="rounded" scope="col" align="center">Data Dodania</th>
                                <th width="15%" class="rounded" scope="col" align="center">Katalog</th>
                                <th width="5%" class="rounded" scope="col" align="center">Edytuj</th>
                                <th width="5%" class="rounded-q4" scope="col" align="center">Usuń</th>
                            </tr>
                        </thead>
                        <tfoot>
                        </tfoot>
                        <tbody>
						';
						
						while (($news = $result->fetch_assoc()) !== null)
						{    
							Show::showGalleryKat($all, $news['id'], $news['title'],  substr($news['description'],0,200), $news['addDate'], $news['patch']);
						}
						echo
						'
							   </tbody>
						</table>
						';
						$result -> close();
						$connect -> close();
					}
				}
			}
        }
        catch(Exception $Error)	
        {
            echo Show::ShowMessage('Wystąpił poważny błąd. Proszę spróbować później...', false);
        } 
    }
    
    public static function addCat($tit_id, $title, $description, $addDate, $patch, $thumb, $accept)
    {
		$host = 'laverte.nazwa.pl';
		$login = 'laverte_13';
		$password = 'DAwidtomczyks11';
		$database = 'laverte_13';
	
        if(isset($accept))
        {
            try
            {
                if(empty($tit_id) || empty($title) || empty($description) || empty($addDate) || empty($patch) || empty($thumb)) throw new Value();
                @$db = new mysqli($host, $login, $password, $database);
				if(mysqli_connect_errno()) {
					echo Show::ShowMessage ("Nie udało się połączyć z bazą...", false);
				}
                $query = "INSERT INTO gallery_category SET tit_id = '$tit_id', title = '$title', description = '$description', addDate = '$addDate', patch='$patch', thumbnail='$thumb'";
                $result = @$db->query($query);
                echo Show::ShowMessage('Pomyślnie dodano kategorie do bazy danych...', true);
                $db -> close();
            }
            catch(Value $Error)	
            {
                echo Show::ShowMessage($Error, false);
            }
            catch(Exception $Error)	
            {
                echo Show::ShowMessage('Wystąpił poważny błąd. Proszę spróbować później...', false);
            } 
        }
    }
    
    public static function deleteCat($id, $accept)
    {
		$host = 'laverte.nazwa.pl';
		$login = 'laverte_13';
		$password = 'DAwidtomczyks11';
		$database = 'laverte_13';
		
        if(isset($accept))
        {
            try
            {
                @$db = new mysqli($host, $login, $password, $database);
				if(mysqli_connect_errno()) {
					echo Show::ShowMessage ("Nie udało się połączyć z bazą...", false);
				}
                $query = "DELETE FROM gallery_category WHERE id='$id'";
                $result = @$db->query($query);
                echo Show::ShowMessage('Pomyślnie usunięto kategorie z bazy danych...', true);
                $db -> close();
            }
            catch(Exception $Error)	
            {
                echo Show::ShowMessage('Wystąpił poważny błąd. Proszę spróbować później...', false);
            }
        }
        else
        {
            echo 
            'Chcesz skasować kategorie?<br />
                <p align=center>
                [<a href=index.php?admin=promocje&action=delete&id=',$id,'&accept=yes>tak</a> / <a href=index.php?admin=promocje&action=showCat>nie</a>]
                </p>
            ';
        }
    }
    
    public static function deleteAllCat($accept)
    {
		$host = 'laverte.nazwa.pl';
		$login = 'laverte_13';
		$password = 'DAwidtomczyks11';
		$database = 'laverte_13';
		
        if(isset($accept))
        {
           try
            {
                @$db = new mysqli($host, $login, $password, $database);
				if(mysqli_connect_errno()) {
					echo Show::ShowMessage ("Nie udało się połączyć z bazą...", false);
				}
                $query = "DELETE FROM gallery_category";
                $result = @$db->query($query);
                Show::ShowMessage('Skasowano wsyzstkie kategorie które znajdowały się w bazie danych...', true);;
                $db -> close();
            }
            catch(Exception $Error)	
            {
                echo Show::ShowMessage('Wystąpił poważny błąd. Proszę spróbować później...', false);
            }
        }
        else
        {
            echo 
            'Chcesz skasować wszystkie kategorie?<br />
                <p align=center>
                [<a href=index.php?admin=promocje&action=delAll&accept=yes>tak</a> / <a href=index.php?admin=promocje&action=showCat>nie</a>]
                </p>
            ';
        }
    }
    
    public static function editCategory($id, $id_tekst, $title, $description, $addDate, $patch, $thumb, $acction)
    {
		$host = 'laverte.nazwa.pl';
		$login = 'laverte_13';
		$password = 'DAwidtomczyks11';
		$database = 'laverte_13';
		
        if(isset($acction))
        {
            try
            {
                @$db = new mysqli($host, $login, $password, $database);
				if(mysqli_connect_errno()) {
					echo Show::ShowMessage ("Nie udało się połączyć z bazą...", false);
				}
                $query = "UPDATE gallery_category SET tit_id='$id_tekst', title='$title', description='$description', addDate='$addDate', patch='$patch', thumbnail='$thumb' WHERE id='$id'";
                $result = @$db->query($query);
                Show::ShowMessage('Pomyślnie uaktualniono dane w bazie danych....', true);
                $db -> close();
            }
            catch(Exception $Error)	
            {
                echo Show::ShowMessage('Wystąpił poważny błąd. Proszę spróbować później...', false);
            }
        }
        else
        {
            try
            {
                @$db = new mysqli($host, $login, $password, $database);
				if(mysqli_connect_errno()) {
					echo Show::ShowMessage ("Nie udało się połączyć z bazą...", false);
				}
                $result = @$db->query("select tit_id, title, description, addDate, patch, thumbnail from gallery_category where id='$id'");
                $edit = $result->fetch_assoc();
                Show::showEditCat($id, $edit['tit_id'], $edit['title'], $edit['description'], $edit['addDate'], $edit['patch'], $edit['thumbnail']);
                $result -> close();
                $db -> close();
            }
            catch(Exception $Error)	
            {
                echo Show::ShowMessage('Wystąpił poważny błąd. Proszę spróbować później...', false);
            }
        }
    }
    
    public static function getPhoto()
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
            $result = @$db->query("select id, tit_cat_id, name, url, description, addDate, thumbnail from gallery_photo");
            $all = $result->num_rows;
            if($all <= 0)
                echo Show::ShowMessage ("Brak zdjęc do wyświetlenia...", false);
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
                        <table width="50%" id="rounded-corner">
                        <thead>
                            <tr>
                                <th width="5%" class="rounded-company" scope="col">ID</th>
                                <th width="15%" class="rounded" scope="col" align="center">Nazwa</th>
                                <th width="15%" class="rounded" scope="col" align="center">Adres</th>
                                <th width="15%" class="rounded" scope="col" align="center">Adres Miniatury</th>
                                <th width="5%" class="rounded" scope="col" align="center">Edytuj</th>
                                <th width="5%" class="rounded-q4" scope="col" align="center">Usuń</th>
                            </tr>
                        </thead>
                        <tfoot>
                        </tfoot>
                        <tbody>
                    ';
                    
                    while (($news = $result->fetch_assoc()) !== null)
                    {    
                        Show::showGalleryPhoto($al, $news['id'], $news['name'], $news['url'], $news['thumbnail'], $news['description'], $news['addDate']);
                    }
                    echo
                    '
                           </tbody>
                    </table>
                    ';
                    $result -> close();
                    $db -> close();
                }
            }
        }
        catch(Exception $Error)	
        {
            echo Show::ShowMessage('Wystąpił poważny błąd. Proszę spróbować później...', false);
        } 
    }
    
    public static function addPhoto($tit_id, $category, $name, $url, $description, $addDate, $thumb, $action)
    {
		$host = 'laverte.nazwa.pl';
		$login = 'laverte_13';
		$password = 'DAwidtomczyks11';
		$database = 'laverte_13';
	
        if(isset($action))
        {
            try
            {
                if(empty($tit_id) || empty($category) || empty($name) || empty($url) || empty($description) || empty($addDate) || empty($thumb)) throw new Value();
                @$db = new mysqli($host, $login, $password, $database);
				if(mysqli_connect_errno()) {
					echo Show::ShowMessage ("Nie udało się połączyć z bazą...", false);
				}
                $query = "INSERT INTO gallery_photo SET tit_cat_id = '$tit_id', category='$category', name='$name', url='$url', description='$description', addDate='$addDate', thumbnail='$thumb'";
                $result = @$db->query($query);
                echo Show::ShowMessage('Pomyślnie dodano zdjęcie do bazy danych...', true);
                $db -> close();
            }
            catch(Value $Error)	
            {
                echo Show::ShowMessage($Error, false);
            }
            catch(Exception $Error)	
            {
                echo Show::ShowMessage('Wystąpił poważny błąd. Proszę spróbować później...', false);
            }
        
        }
    }
    
    public static function deletePhoto($id, $accept)
    {
		$host = 'laverte.nazwa.pl';
		$login = 'laverte_13';
		$password = 'DAwidtomczyks11';
		$database = 'laverte_13';
		
        if(isset($accept))
        {
            try
            {
                @$db = new mysqli($host, $login, $password, $database);
				if(mysqli_connect_errno()) {
					echo Show::ShowMessage ("Nie udało się połączyć z bazą...", false);
				}
                $query = "DELETE FROM gallery_photo WHERE id='$id'";
                $result = @$db->query($query);
                echo Show::ShowMessage('Pomyślnie usunięto zdjęcie z bazy danych...', true);
                $db -> close();
            }
            catch(Exception $Error)	
            {
                echo Show::ShowMessage('Wystąpił poważny błąd. Proszę spróbować później...', false);
            }
        }
        else
        {
            echo 
            'Chcesz skasować zdjęcie?<br />
                <p align=center>
                [<a href=index.php?admin=promocje&action=deletePhoto&id=',$id,'&accept=yes>tak</a> / <a href=index.php?admin=promocje&action=showPhotos>nie</a>]
                </p>
            ';
        }
    }
    
    public static function deleteAllPhoto($accept)
    {
		$host = 'laverte.nazwa.pl';
		$login = 'laverte_13';
		$password = 'DAwidtomczyks11';
		$database = 'laverte_13';
		
        if(isset($accept))
        {
           try
            {
                @$db = new mysqli($host, $login, $password, $database);
				if(mysqli_connect_errno()) {
					echo Show::ShowMessage ("Nie udało się połączyć z bazą...", false);
				}
                $query = "DELETE FROM gallery_photo";
                $result = @$db->query($query);
                Show::ShowMessage('Skasowano wsyzstkie zdjęcia które znajdowały się w bazie danych...', true);;
                $db -> close();
            }
            catch(Exception $Error)	
            {
                echo Show::ShowMessage('Wystąpił poważny błąd. Proszę spróbować później...', false);
            }
        }
        else
        {
            echo 
            'Chcesz skasować wszystkie zdjęcia?<br />
                <p align=center>
                [<a href=index.php?admin=promocje&action=delAllPhoto&accept=yes>tak</a> / <a href=index.php?admin=promocje&action=showPhotos>nie</a>]
                </p>
            ';
        }
    }
    
    public static function editPhoto($id, $tit_cat_id, $category, $name, $url, $description, $addDate, $thumb, $acction)
    {
		$host = 'laverte.nazwa.pl';
		$login = 'laverte_13';
		$password = 'DAwidtomczyks11';
		$database = 'laverte_13';
		
        if(isset($acction))
        {
            try
            {
                @$db = new mysqli($host, $login, $password, $database);
				if(mysqli_connect_errno()) {
					echo Show::ShowMessage ("Nie udało się połączyć z bazą...", false);
				}
                $query = "UPDATE gallery_photo SET tit_cat_id='$tit_cat_id', category='$category', name='$name', url='$url', description='$description', addDate='$addDate', thumbnail='$thumb' WHERE id='$id'";
                $result = $db->query($query);
                Show::ShowMessage('Pomyślnie uaktualniono dane w bazie danych....', true);
                $db -> close();
            }
            catch(Exception $Error)	
            {
                echo Show::ShowMessage('Wystąpił poważny błąd. Proszę spróbować później...', false);
            }
        }
        else
        {
            try
            {
                @$db = new mysqli($host, $login, $password, $database);
				if(mysqli_connect_errno()) {
					echo Show::ShowMessage ("Nie udało się połączyć z bazą...", false);
				}
                $result = @$db->query("select id, tit_cat_id, category, name, url, description, addDate, thumbnail from gallery_photo where id='$id'");
                $edit = $result->fetch_assoc();
                Show::showEditPhoto($id, $edit['tit_cat_id'], $edit['tit_cat_id'], $edit['name'], $edit['url'], $edit['description'], $edit['addDate'], $edit['thumbnail']);
                $result -> close();
                $db -> close();
            }
            catch(Exception $Error)	
            {
                echo Show::ShowMessage('Wystąpił poważny błąd. Proszę spróbować później...', false);
            }
        }
    }
}

?>
