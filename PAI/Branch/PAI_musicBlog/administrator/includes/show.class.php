<?php
class Show 
{
    public static function LoginForm()
    {
        echo 
        '
            <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
            <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
                <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
                <title>Logowanie do Panelu Administratora</title>
                <link rel="stylesheet" href="style.css" type="text/css" media="all" />
                <link rel="stylesheet" href="uni-form/default.uni-form.css" type="text/css" media="all" />
                <link rel="stylesheet" href="uni-form/uni-form.css" type="text/css" media="all" />
            </head>
            <body>	
            <div id="content" class="shell">
                <div class="log">
                    <div class="login">
                        <div class="login-head">
                                <h2>Logowanie do Panelu</h2>
                        </div>
                        <div class="login-content">
                            <form action="includes/checkSesion.php" class="uniForm" method="post"> 
                            <fieldset class="inlineLabels"> 
                                <div class="ctrlHolder"> 
                                    <label>login</label> 
                                    <input type="text" id="login" name="login" class="textInput"/> 
                                 </div>
                                <div class="ctrlHolder"> 
                                    <label>hasło</label> 
                                    <input type="password" id="pass" name="pass" class="textInput"/>  
                                </div> 
                                <br />
                                <div class="buttonHolder"> 
                                    <a id="passwordForgot" href="../">powrót na stronę główną</a>
                                    <button id="login" type="submit" class="primaryAction">Zaloguj</button> 
                                </div> 
                            </fieldset> 
                            </form>		
                        </div>
                    </div>
                </div>
            </div>
            <div id="footer">
                <p>Copyright &copy; 2011-2012 BlogMuzyczny - Projekt Serwisy Internetowe.</p>
            </div>
            </body>
            </html>
        ';
    }
    
    private static function showDate()
    {
        $dzien = date('d');
        $dzien_tyg = date('l');
        $miesiac = date('n');
        $rok = date('Y');
        $miesiac_pl = array(1 => 'stycznia', 'lutego', 'marca', 'kwietnia', 'maja', 'czerwca', 'lipca', 'sierpnia', 'września', 'października', 'listopada', 'grudnia');
        $dzien_tyg_pl = array('Monday' => 'poniedziałek', 'Tuesday' => 'wtorek', 'Wednesday' => 'środa', 'Thursday' => 'czwartek', 'Friday' => 'piątek', 'Saturday' => 'sobota', 'Sunday' => 'niedziela');
        echo $dzien_tyg_pl[$dzien_tyg].", ".$dzien." ".$miesiac_pl[$miesiac]." ".$rok."r.";
    }

    public static function DiplayHeader($user)
    {
        echo
        '
            <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
            <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
                <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
                <title>Panel Administratora</title>
                <link rel="stylesheet" href="style.css" type="text/css" media="all" />
                <link rel="stylesheet" href="uni-form/default.uni-form.css" type="text/css" media="all" />
                <link rel="stylesheet" href="uni-form/uni-form.css" type="text/css" media="all" />
                <script type="text/javascript" src="js/jquery-1.5.1.min.js"></script>
				<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
				<script type="text/javascript" src="ckeditor/adapters/jquery.js"></script>
				<script language="javascript">
						$(document).ready(function(){
							$(\'textarea\').ckeditor({ height : 300 });
						});
				</script>
            </head>
            <body>
                <!-- Header -->
                <div id="header">
                    <div class="shell">
                        <div id="head">
                            <h1><a href="index.php">Panel Administratora</a></h1>
                            <div class="right">
                                <p>
                                    Zalogowano jako: <strong>',$user,'</strong> | ';
                                    Show::showDate();
                                    echo ' | <a href="../index.php" target="_new" >Zobacz stronę główną</a> |
                                    
                                    <a href="logout.php">Wyloguj</a>
                                </p>
                            </div>
                        </div>
                        <!-- Navigation -->
                        <div id="navigation">
                            <ul>
                                <li><a href="index.php"><span>Strona głowna</span></a></li>
                                <li><a href="index.php?admin=news"><span>Aktualności</span></a></li>
                                <li><a href="index.php?admin=events"><span>Wydarzenia</span></a></li>
                                <li><a href="index.php?admin=films"><span>Galeria filmów</span></a></li>
                                <li><a href="index.php?admin=gallery"><span>Galeria zdjęć</span></a></li>
                            </ul>
                        </div>
                        <!-- End Navigation -->
                    </div>
                </div>
                <!-- End Header -->
                <!-- Content -->
                <div id="content" class="shell">';
    } 

    public static function DiplayFooter()
    {
        echo '
            <!-- End Content -->
            </div>
            <!-- Footer -->
            <div id="footer">
                <p>Copyright &copy; 2011 Created by <a href="mailto:dawidtomczyk@wp.eu">Dawid Tomczyk </a> i <a href="mailto:">Piotr Ciwiś</a></p>
            </div>
            <!-- End Footer -->
            </body>
            </html>';
    }
    
    public static function ShowMessage($text, $option)
    {
        if($option == false)
        {
            echo '
                <div class="message error-message">
                    <div class="erroricon">
                    <p><strong>',$text,'</strong></p>
                    </div>
		</div> ';
        }
        else
        {
            echo '
                <div class="message thank-message">
                    <div class="successicon">
                    <p><strong>',$text,'</strong></p>
                    </div>
		</div>';
        }
    }
    
    public static function Dashboard()
    {
        echo '
            <div class="round">
                <div class="round-head">
                        <h2>Tablica Administratora</h2>
                    </div>

                    <div class="round-content">
                        <div id="icondock">
                            <ul>
                            <center>
                                <li><a href="index.php?admin=news" title="Zarządzanie aktualnościami strony głównej"><img src="images/icons/pen.png" alt="Aktualności"><br>Aktualności</a></li> 
								<li><a href="index.php?admin=events" title="Zarządzanie wydarzeniami"><img src="images/icons/photos.png" alt="Wydarzenia"><br>Wydarzenia</a></li>
								<li><a href="index.php?admin=films" title="Zarządzanie galeriami filmów"><img src="images/icons/photos.png" alt="Galeria Filmów"><br>Gal. Filmów</a></li>
                                <li><a href="index.php?admin=gallery&action=showCat" title="Zarządzanie galeriami zdjęć"><img src="images/icons/photos.png" alt="Galeria Zdjęć"><br>Galeria Zdjęć</a></li>
                            </ul>
                            </center>
                            <div class=\"clear\"></div>
                        </div>
                    </div>
            </div> ';
			
			//<li><a href="index.php?admin=podstrony" title="Zarządzanie podstronami"><img src="images/icons/attachment.png" alt="Podstrony"><br>Podstrony</a></li> 
    }
    
    public static function Podstrony()
    {
        echo '
            <div class="round">
                <div class="round-head">
                        <h2>Podstrony</h2>
                    </div>

                    <div class="round-content">
                        <div id="icondock">
                            <ul>
                            <center>
                                <li><a href="index.php?admin=jednaidea&action=show" title="Jedna idea"><img src="images/icons/pen.png" alt="Jedna idea"><br>Jedna idea</a></li> 
                                <li><a href="index.php?admin=dlaFirm&action=show" title="Idea dla Firm"><img src="images/icons/pen.png" alt="Idea dla Firm"><br>Idea dla Firm</a></li> 
                                <li><a href="index.php?admin=pop&action=show" title="POP"><img src="images/icons/pen.png" alt="POP"><br>POP</a></li>
                                <li><a href="index.php?admin=gallery&action=showCat" title="Galeria Zdjęć"><img src="images/icons/photos.png" alt="Galeria Zdjęć"><br>Galeria Zdjęć</a></li>
                            </ul>
                            </center>
                            <div class=\"clear\"></div>
                        </div>
                    </div>
            </div> ';
    }
    
    public static function News($action)
    {
		if(!empty($action))
		{
			//echo '<div id="lewy">';
				switch($action)
				{
					case 'showNews':
						AdminNews::showNews();
						break;
					
					case 'add':
						Show::showAddForm();
						break;
					
					case 'addNews':
						AdminNews::addNews($_POST['title'], $_POST['content'], $_POST['addDate'], $_POST['author'], $_GET['accept']);
						break;
					
					case 'delAll':
						AdminNews::deleteAllNews($_GET['accept']);
						break;
					
					case 'delete':
						AdminNews::deleteNews($_GET['id'], $_GET['accept']);
						break;
					
					case 'edit':
						AdminNews::editNews($_GET['id'], $_POST['title'], $_POST['content'], $_POST['addDate'], $_POST['author'], $_GET['accept']);
						break;
					
					case 'editStatic':
						staticPage::edit($_GET['admin'], $_GET['id'], $_POST['title'], $_POST['content'], $_GET['accept']);
						break;
				  
					default:
						Show::ShowMessage("ERROR 404 - BRAK PODANEJ STRONY", false);
				}
		}
		else
		{
				
			echo '</div>
				<div id="prawy">
				<div class="sidebar_box">
						<div class="sidebar_box_top"></div>
						<div class="sidebar_box_content">
							<h3>Artykuły</h3>
							<img src="images/info.png" alt="" title="" class="sidebar_icon_right" />
								<ul>
									<li><a href="index.php?admin=news&action=add" title="Dodaj artykuł">Dodaj nowy artykuł</a></li>
									<li><a href="index.php?admin=news&action=showNews" title="Wyświetl wszystkie artykuły z bazy">Wyświetl artykuły</a></li>
									<li><a href="index.php?admin=news&action=delAll" title="!!USUWA WSZYSTKIE ARTYKUŁY Z BAZY DANYCH!!">Usuń wszystkie</a></li>
								</ul>
						</div>
						<div class="sidebar_box_bottom"></div>
					</div>
				</div>
				<div style="clear: both;"></div>';
		}
	}
    
    public static function showNewsFunct($i, $id, $title, $content, $addDate, $author)
    {
        if (!$i <= 0)
        {
            echo
            '
                <tr>
                    <td align="center">',$id,'</td>
                    <td>',$title,'</td>
                    <td>',$content,'</td>
                    <td align="center">',$addDate,'</td>
                    <td align="center">',$author,'</td>
                    <td align="center"><a href="index.php?admin=news&action=edit&id=',$id,'"><img src="images/user_edit.png" alt="Edytuj artykuł..." title="Edytuj artykuł..." border="0" /></a></td>
                    <td align="center"><a href="index.php?admin=news&action=delete&id=',$id,'" class="ask"><img src="images/trash.png" alt="Usuń artykuł..." title="Usuń artykuł..." border="0" /></a></td>
                </tr>  
            ';
        }
        else
        {
            echo Show::ShowMessage ("Brak artykułów do wyświetlenia...", false);
        }
    }
    
    public static function showAddForm()
    {
        echo
        '
            <div class="round">
                <div class="round-head">
                    <h2>Dodaj Artykuł</h2>
                </div>

                <div class="round-content">
                    <form action="index.php?admin=news&action=addNews&accept=yes" class="uniForm" method="post"> 
                    <fieldset class="inlineLabels"> 
                        <div class="ctrlHolder"> 
                            <label>tytuł:</label> 
                            <input type="text" id="title" name="title" class="textInput"/> 
                         </div>
                        <div class="ctrlHolder"> 
                            <textarea id="content" name="content" class="textInput"/></textarea>
                        </div>
                        <br />
                        <div class="buttonHolder"> 
                            <a id="passwordForgot" href="index.php?admin=news&action=show">anuluj dodawanie artykułu</a>
                            <button id="login" type="submit" class="primaryAction">Dodaj artykuł</button> 
                            <button id="reset" type="reset" class="primaryAction">Zresetuj formularz</button>
                        </div> 
                    </fieldset> 
                    </form>
                </div>
            </div>
        ';
    }
    
    public static function showEditForm($id, $title, $content, $addDate, $author)
    {
        echo
        '
            <div class="round">
                <div class="round-head">
                    <h2>Edytuj Artykuł</h2>
                </div>

                <div class="round-content">
                    <form action="index.php?admin=news&action=edit&id=',$id,'&accept=yes" class="uniForm" method="post"> 
                    <fieldset class="inlineLabels"> 
                        <div class="ctrlHolder"> 
                            <label>tytuł:</label> 
                            <input type="text" id="title" value="',$title,'" name="title" class="textInput"/> 
                         </div>
                        <div class="ctrlHolder"> 
                            <textarea id="content" name="content" class="textInput"/>',$content,'</textarea>
                        </div>
                        <br />
                        <div class="buttonHolder"> 
                            <a id="passwordForgot" href="index.php?admin=news&action=show">anuluj edycje artykułu</a>
                            <button id="login" type="submit" class="primaryAction">Edytuj artykuł</button> 
                            <button id="reset" type="reset" class="primaryAction">Zresetuj formularz</button>
                        </div> 
                    </fieldset> 
                    </form>
                </div>
            </div>
        ';
    }
    
    public static function staticPage($action, $tabble)
    {
        //echo '<div id="lewy">';
            switch($action)
            {
                case 'show':
                    staticPage::getArticle($tabble);
                    break;
                
                case 'edit':
                    staticPage::edit($_GET['admin'], $_GET['id'], $_POST['title'], $_POST['content'], $_GET['accept']);
                    break;
              
                default:
                    Show::ShowMessage("ERROR 404 - BRAK PODANEJ STRONY", false);
            }
            
        echo
            '</div>
                <div id="prawy">
        	<div class="sidebar_box">
                    <div class="sidebar_box_top"></div>
                    <div class="sidebar_box_content">
                        <h3>Artykuł</h3>
                        <img src="images/info.png" alt="" title="" class="sidebar_icon_right" />
                            <ul>
                                <li><a href="index.php?admin=',$tabble,'&action=edit&id=1" title="Edytuj artykuł">Edytuj artykuł</a></li>
                            </ul>
                    </div>
                    <div class="sidebar_box_bottom"></div>
                </div>
            </div>
            <div style="clear: both;"></div>
        ';
    }
    
    public static function article($i, $id, $title, $content, $tabble)
    {
        if (!$i <= 0)
        {
            echo 
            '
                <div id="lewy">
                    <div class="round">
                        <div class="round-head">
                            <h2>',$title,'</h2>
                        </div>
                        <div class="round-content">
                            ',$content,'
                        </div>
                    </div>
                </div>';
        }
        else
        {
            echo Show::ShowMessage ("Brak artykułów do wyświetlenia...", false);
        }
    }
    
    public static function showEdit($id, $title, $content, $tabble)
    {
        echo
        '
            <div class="round">
            <div class="round-head">
                <h2>Edytuj Artykuł</h2>
            </div>

            <div class="round-content">
                <form action="index.php?admin=',$tabble,'&action=edit&id=',$id,'&accept=yes" class="uniForm" method="post"> 
                <fieldset class="inlineLabels"> 
                    <div class="ctrlHolder"> 
                        <label>tytuł:</label> 
                        <input type="text" id="title" value="',$title,'" name="title" class="textInput"/> 
                     </div>
                    <div class="ctrlHolder"> 
                        <textarea id="content" name="content" class="textInput"/>',$content,'</textarea>
                    </div>
                    <br />
                    <div class="buttonHolder"> 
                        <a id="passwordForgot" href="index.php?admin=',$tabble,'&action=show">anuluj edycje artykułu</a>
                        <button id="login" type="submit" class="primaryAction">Edytuj artykuł</button> 
                        <button id="reset" type="reset" class="primaryAction">Zresetuj formularz</button>
                    </div> 
                </fieldset> 
                </form>
            </div>
        </div>
        ';
    }
    
    public static function Galeria($action)
    {
		if(!empty($action))
		{
			//echo '<div id="lewy">';
            switch($action)
            {
                case 'showCat':
                    adminGallery::getCategory();
                    break;
                
                case 'add':
                    Show::showAddCat();
                    break;
                
                case 'addCat':
                    adminGallery::addCat($_POST['idtekst'], $_POST['title'], $_POST['description'], $_POST['addDate'], $_POST['patch'], $_POST['thumb'], $_GET['accept']);
                    break;
                
                case 'delAll':
                    adminGallery::deleteAllCat($_GET['accept']);
                    break;
                
                case 'delete':
                    adminGallery::deleteCat($_GET['id'], $_GET['accept']);
                    break;
                
                case 'edit':
                    adminGallery::editCategory($_GET['id'], $_POST['idtekst'], $_POST['title'], $_POST['description'], $_POST['addDate'], $_POST['patch'], $_POST['thumb'], $_GET['accept']);
                    break;
                
                case 'addPhoto':
                    Show::showAddPhoto();
                    break;
                
                case 'addPhotos':
                    adminGallery::addPhoto($_POST['cat'], $_POST['cat'], $_POST['name'], $_POST['url'], $_POST['description'], $_POST['addDate'], $_POST['thumbnail'], $_GET['accept']);
                    break;
                
                case 'delAllPhoto':
                    adminGallery::deleteAllPhoto($_GET['accept']);
                    break;
                
                case 'deletePhoto':
                    adminGallery::deletePhoto($_GET['id'], $_GET['accept']);
                    break;
                
                case 'showPhotos':
                    adminGallery::getPhoto();
                    break;
                
                case 'editPhoto':
                    adminGallery::editPhoto($_GET['id'], $_POST['cat'], $_POST['cat'], $_POST['name'], $_POST['url'], $_POST['description'], $_POST['addDate'], $_POST['thumbnail'], $_GET['accept']);
                    break;
              
                default:
                    Show::ShowMessage("ERROR 404 - BRAK PODANEJ STRONY", false);
            }
			//echo '</div>';
		}
        else
		{
			echo
				'</div>
				<div id="prawy">
				<div class="sidebar_box">
						<div class="sidebar_box_top"></div>
						<div class="sidebar_box_content">
							<h3>Galeria Zdjęć</h3>
							<img src="images/info.png" alt="" title="" class="sidebar_icon_right" />
								<ul>
									Kategorie:
									<li><a href="index.php?admin=gallery&action=add" title="Dodaj kategorie">Dodaj nową kategorie</a></li>
									<li><a href="index.php?admin=gallery&action=showCat" title="Wyświetl wszystkie kategorie z bazy">Wyświetl kategorie</a></li>
									<li><a href="index.php?admin=gallery&action=delAll" title="!!USUWA WSZYSTKIE KATEGORIE Z BAZY DANYCH!!">Usuń wszystkie</a></li>
									<br />Zdjęcia:
									<li><a href="index.php?admin=gallery&action=addPhoto" title="Dodaj zdjęcie">Dodaj nową zdjęcie</a></li>
									<li><a href="index.php?admin=gallery&action=showPhotos" title="Wyświetl wszystkie zdjęcia z bazy">Wyświetl zdjęcia</a></li>
									<li><a href="index.php?admin=gallery&action=delAllPhoto" title="!!USUWA WSZYSTKIE ZDJECIA Z BAZY DANYCH!!">Usuń wszystkie</a></li>
								</ul>
						</div>
						<div class="sidebar_box_bottom"></div>
					</div>
				</div>
				<div style="clear: both;"></div>
			';
		}
    }
    
    public static function showGalleryKat($i, $id, $title, $desctiption, $addDate, $patch)
    {
        if (!$i <= 0)
        {
            echo
            '
                <tr>
                    <td align="center">',$id,'</td>
                    <td>',$title,'</td>
                    <td>',$desctiption,'</td>
                    <td align="center">',$addDate,'</td>
                    <td align="center">',$patch,'</td>
                    <td align="center"><a href="index.php?admin=gallery&action=edit&id=',$id,'"><img src="images/user_edit.png" alt="Edytuj kategorie..." title="Edytuj kategorie..." border="0" /></a></td>
                    <td align="center"><a href="index.php?admin=gallery&action=delete&id=',$id,'" class="ask"><img src="images/trash.png" alt="Usuń kategorie..." title="Usuń kategorie..." border="0" /></a></td>
                </tr>  
            ';
        }
        else
        {
            echo Show::ShowMessage ("Brak kategorii do wyświetlenia...", false);
        }
    }
    
    public static function showGalleryPhoto($i, $id, $name, $url, $thumb, $desctiption, $addDate)
    {
        if ($i <= 0)
        {
            echo
            '
                <tr>
                    <td align="center">',$id,'</td>
                    <td>',$name,'</td>
                    <td>',$url,'</td>
                    <td align="center">',$thumb,'</td>
                    <td align="center"><a href="index.php?admin=gallery&action=editPhoto&id=',$id,'"><img src="images/user_edit.png" alt="Edytuj kategorie..." title="Edytuj kategorie..." border="0" /></a></td>
                    <td align="center"><a href="index.php?admin=gallery&action=deletePhoto&id=',$id,'" class="ask"><img src="images/trash.png" alt="Usuń kategorie..." title="Usuń kategorie..." border="0" /></a></td>
                </tr>  
            ';
        }
        else
        {
            echo Show::ShowMessage ("Brak kategorii do wyświetlenia...", false);
        }
    }
    
    public static function showEditCat($id, $id_tekst, $title, $description, $addDate, $patch, $thumb)
    {
        echo
        '
            <div class="round">
                <div class="round-head">
                    <h2>Edytuj Kategorie</h2>
                </div>

                <div class="round-content">
                    <form action="index.php?admin=gallery&action=edit&id=',$id,'&accept=yes" class="uniForm" method="post"> 
                    <fieldset class="inlineLabels"> 
                        <div class="ctrlHolder"> 
                            <label>tytuł:</label> 
                            <input type="text" id="title" value="',$title,'" name="title" class="textInput"/> 
                         </div>
                        <div class="ctrlHolder"> 
                            <label>id tekstowe:</label> 
                            <input type="text" id="idtekst" name="idtekst" value="',$id_tekst,'" class="textInput"/>  
                        </div> 
                        <div class="ctrlHolder"> 
                            <label>data dodania:</label> 
                            <input type="text" id="addDate" name="addDate" value="',$addDate,'" class="textInput"/>  
                        </div> 
                        <div class="ctrlHolder"> 
                            <label>katalog na serwerze:</label> 
                            <input type="text" id="patch" name="patch" value="',$patch,'" class="textInput"/>  
                        </div> 
                        <div class="ctrlHolder"> 
                            <label>miniatura zdjęcia:</label> 
                            <input type="text" id="thumb" name="thumb" value="',$thumb,'" class="textInput"/>  
                        </div> 
                        <div class="ctrlHolder"> 
                            <textarea id="description" name="description" class="textInput"/>',$description,'</textarea>
                        </div>
                        <br />
                        <div class="buttonHolder"> 
                            <a id="passwordForgot" href="index.php?admin=gallery&action=showCat">anuluj edycje artykułu</a>
                            <button id="login" type="submit" class="primaryAction">Edytuj kategorie</button> 
                            <button id="reset" type="reset" class="primaryAction">Zresetuj formularz</button>
                        </div> 
                    </fieldset> 
                    </form>
                </div>
            </div>
        ';
    }
    
    public static function showAddCat()
    {
        echo
        '
            <div class="round">
                <div class="round-head">
                    <h2>Dodaj Kategorie</h2>
                </div>

                <div class="round-content">
                    <form action="index.php?admin=gallery&action=addCat&accept=yes" class="uniForm" method="post"> 
                    <fieldset class="inlineLabels"> 
                        <div class="ctrlHolder"> 
                            <label>tytuł:</label> 
                            <input type="text" id="title" name="title" class="textInput"/> 
                         </div>
                        <div class="ctrlHolder"> 
                            <label>id tekstowe:</label> 
                            <input type="text" id="idtekst" name="idtekst" class="textInput"/>  
                        </div> 
                        <div class="ctrlHolder"> 
                            <label>data dodania:</label> 
                            <input type="text" id="addDate" name="addDate"value="'; echo date('Y-n-d'); echo'" class="textInput"/>  
                        </div> 
                        <div class="ctrlHolder"> 
                            <label>katalog na serwerze:</label> 
                            <input type="text" id="patch" name="patch" class="textInput"/>  
                        </div> 
                        <div class="ctrlHolder"> 
                            <label>miniatura zdjęcia:</label> 
                            <input type="text" id="thumb" name="thumb" class="textInput"/>  
                        </div> 
                        <div class="ctrlHolder"> 
                            <textarea id="description" name="description" class="textInput"/></textarea>
                        </div>
                        <br />
                        <div class="buttonHolder"> 
                            <a id="passwordForgot" href="index.php?admin=gallery&action=showCat">anuluj edycje artykułu</a>
                            <button id="login" type="submit" class="primaryAction">Dodaj kategorie</button> 
                            <button id="reset" type="reset" class="primaryAction">Zresetuj formularz</button>
                        </div> 
                    </fieldset> 
                    </form>
                </div>
            </div>
        ';
    }
    
    public static function showAddPhoto()
    {
        echo
        '
            <div class="round">
                <div class="round-head">
                    <h2>Dodaj Zdjęcie</h2>
                </div>

                <div class="round-content">
                    <form action="index.php?admin=gallery&action=addPhotos&accept=yes" class="uniForm" method="post"> 
                    <fieldset class="inlineLabels"> 
                        <div class="ctrlHolder"> 
                            ',Show::getCats(),'
                         </div>
                        <div class="ctrlHolder"> 
                            <label>nazwa:</label> 
                            <input type="text" id="name" name="name" class="textInput"/> 
                         </div>
                        <div class="ctrlHolder"> 
                            <label>adres dużego zdjęcia:</label> 
                            <input type="text" id="url" name="url" class="textInput"/>  
                        </div> 
                        <div class="ctrlHolder"> 
                            <label>adres miniatury:</label> 
                            <input type="text" id="thumbnail" name="thumbnail" class="textInput"/>  
                        </div> 
                        <div class="ctrlHolder"> 
                            <label>data dodania zdjęcia:</label> 
                            <input type="text" id="addDate" name="addDate"value="'; echo date('Y-n-d'); echo'"class="textInput"/>  
                        </div>  
                        <div class="ctrlHolder"> 
                            <label>opis zdjęcia:</label> 
                                <textarea id="description" name="description" class="textInput"/></textarea>
                        </div>
                        <br />
                        <div class="buttonHolder"> 
                            <a id="passwordForgot" href="index.php?admin=gallery&action=showCat">anuluj edycje artykułu</a>
                            <button id="login" type="submit" class="primaryAction">Dodaj zdjęcie</button> 
                            <button id="reset" type="reset" class="primaryAction">Zresetuj formularz</button>
                        </div> 
                    </fieldset> 
                    </form>
                </div>
            </div>
        ';
    }
    
    public static function showEditPhoto($id, $tit_cat_id, $category, $name, $url, $description, $addDate, $thumb)
    {
        echo
        '
            <div class="round">
                <div class="round-head">
                    <h2>Edytuj Zdjęcie</h2>
                </div>

                <div class="round-content">
                    <form action="index.php?admin=gallery&action=editPhoto&id=',$id,'&accept=yes" class="uniForm" method="post"> 
                    <fieldset class="inlineLabels"> 
                        <div class="ctrlHolder"> 
                            ',Show::getCats(),'
                         </div>
                        <div class="ctrlHolder"> 
                            <label>nazwa:</label> 
                            <input type="text" value="',$name,'" id="name" name="name" class="textInput"/> 
                         </div>
                        <div class="ctrlHolder"> 
                            <label>adres dużego zdjęcia:</label> 
                            <input type="text" value="',$url,'" id="url" name="url" class="textInput"/>  
                        </div> 
                        <div class="ctrlHolder"> 
                            <label>adres miniatury:</label> 
                            <input type="text" id="thumbnail" name="thumbnail" value="',$thumb,'" class="textInput"/>  
                        </div> 
                        <div class="ctrlHolder"> 
                            <label>data dodania zdjęcia:</label> 
                            <input type="text" id="addDate" name="addDate" value="',$addDate,'" class="textInput"/>  
                        </div>  
                        <div class="ctrlHolder"> 
                            <label>opis zdjęcia:</label> 
                                <textarea id="description" name="description" class="textInput"/>',$description,'</textarea>
                        </div>
                        <br />
                        <div class="buttonHolder"> 
                            <a id="passwordForgot" href="index.php?admin=gallery&action=showPhotos">anuluj edycje zdjęcia</a>
                            <button id="login" type="submit" class="primaryAction">Edytuj zdjęcie</button> 
                            <button id="reset" type="reset" class="primaryAction">Zresetuj formularz</button>
                        </div> 
                    </fieldset> 
                    </form>
                </div>
            </div>
        ';
    }
    
    private static function getCats()
    {
        $connect = sqlConnect(); 
        $result = @$connect->query("select tit_id, title from gallery_category");
        $all = $result->num_rows;
        if($all <= 0)
        {
            echo Show::ShowMessage ("Brak artykułów kategorii do wyświetlenia...", false);
            exit;
        }
        else
        {
            echo '<label>wybierz kategorie:</label>';
            echo '<select name="cat" class="textInput" />';
            while (($cat = $result->fetch_assoc()) !== null)
            {    
                echo '<option value="',$cat[tit_id],'">',$cat[title],'</option>';
            }
            echo '</select>';
        }
    }
	
	public static function Films($action)
    {
		if(!empty($action))
		{
			if(isset($_GET['id'])) $id = $_GET['id'];
		
			//echo '<div id="lewy">';
            switch($action)
            {
                case 'showFilmsCat':
                    AdminFilms::showFilmsCat();
                    break;
					
				case 'showFilms':
					AdminFilms::showFilms();
					break;
					
				case 'addFilm':
					AdminFilms::addFilm();
					break;
					
				case 'addFilmsCat':
					AdminFilms::addFilmsCat();
					break;
					
				case 'editC':
					AdminFilms::editFilmsCategory($id);
					break;
					
				case 'editF':
					AdminFilms::editFilm();
					break;
					
				case 'deleteC':
					AdminFilms::delFilmsCat($id);
					break;	
					
				case 'deleteF':
					AdminFilms::delFilm($id);
					break;
              
                default:
                    Show::ShowMessage("ERROR 404 - BRAK PODANEJ STRONY", false);
            }   
			//echo '</div>';
		}
		else
		{
			echo
				'</div>
				<div id="prawy">
				<div class="sidebar_box">
						<div class="sidebar_box_top"></div>
						<div class="sidebar_box_content">
							<h3>Galeria Filmów</h3>
							<img src="images/info.png" alt="" title="" class="sidebar_icon_right" />
								<ul>
									Kategorie:
									<li><a href="index.php?admin=films&action=addFilmsCat" title="Dodaj kategorie">Dodaj nową kategorie</a></li>
									<li><a href="index.php?admin=films&action=showFilmsCat" title="Wyświetl wszystkie kategorie z bazy">Wyświetl kategorie</a></li>
									<br />Filmy:
									<li><a href="index.php?admin=films&action=addFilm" title="Dodaj film">Dodaj nowy film</a></li>
									<li><a href="index.php?admin=films&action=showFilms" title="Wyświetl wszystkie filmy z bazy">Wyświetl filmy</a></li>
								</ul>
						</div>
						<div class="sidebar_box_bottom"></div>
					</div>
				</div>
				<div style="clear: both;"></div>
			';
		}
	}
	
	public static function Events($action)
    {
		if(!empty($action))
		{
			if(isset($_GET['id'])) $id = $_GET['id'];
		
			//echo '<div id="lewy">';
            switch($action)
            {
                case 'showEvents':
                    AdminEvents::showEvents();
                    break;
				
				case 'addEvents':
                    AdminEvents::addEvents();
                    break;
					
				case 'deleteE':
					AdminEvents::delEvent($id);
					break;
					
				case 'editE':
					AdminEvents::editEvent($id);
					break;
					              
                default:
                    Show::ShowMessage("ERROR 404 - BRAK PODANEJ STRONY", false);
            }    
			//echo '</div>';
		}
		else
		{
			echo
				'</div>
				<div id="prawy">
					<div class="sidebar_box">
						<div class="sidebar_box_top"></div>
						<div class="sidebar_box_content">
							<h3>Wydarzenia</h3>
							<img src="images/info.png" alt="" title="" class="sidebar_icon_right" />
								<ul>
									<li><a href="index.php?admin=events&action=showEvents" title="Pokaż wydarzenia">Pokaż wydarzenia</a></li>
									<li><a href="index.php?admin=events&action=addEvents" title="Dodaj wydarzenie">Dodaj wydarzenie</a></li>
								</ul>
						</div>
						<div class="sidebar_box_bottom"></div>
					</div>
				</div>
				<div style="clear: both;"></div>
			';
		}
	}
}
?>
