<?php

class Admin
{        
    public static function IsLogin()
    {
        global $_SESSION;
        if (isset($_SESSION['login']) && $_SESSION['admin'] == 'ok')
            return true;
        else
            return false;
    }

    public static function checkSesion()
    {
        include 'checkSesion.php';
    }

    public static function ShowLoginFomrm()
    {
        Show::LoginForm();
    }

    public static function ShowAdminPanel()
    {
        Show::DiplayHeader($_SESSION['login']);
        if($_GET['admin'])
        {
            switch ($_GET['admin'])
            {
                case jednaidea:
                    Show::staticPage($_GET['action'], 'jednaidea');
                    break;
                
                case dlaFirm:
                    Show::staticPage($_GET['action'], 'dlaFirm');
                    break;
                
                case pop:
                    Show::staticPage($_GET['action'], 'pop');
                    break;
                
                case gallery:
                    Show::Galeria($_GET['action']);
                    break;
                
                case podstrony:
                    Show::Podstrony();
                    break;
					
				case films:
					Show::Films($_GET['action']);
					break;
					
				case events:
					Show::Events($_GET['action']);
					break;
					
				case news:
                    Show::News($_GET['action']);
                    break;
                
                default:
                    Show::ShowMessage("404 - Strona nie istnieje...", false);
                    break;
            }
        }
        else
        {
            Show::Dashboard();
        }
        Show::DiplayFooter();
    }
}

?>
