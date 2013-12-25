<?php
include "database.php";
include "image.php";
$connection=  mysql_connect('127.0.0.1:3306','root','');
if(database::connectDatabase('127.0.0.1:3306','root',''))
{   
    if(database::openDatabase('wymowkidatabase'));
    {
    
        $query = "select * from imagestable";
        $sql=database::executeQuery($query);
        //$sql = mysql_query("select * from userstable where userstable.emailuser = '$email'");
        if($sql)
        {
            image::addImageToPage($sql);
        }
        else
        {
            header("Location: register.php");
        }
    }
}
//        if(database::connectDatabase('127.0.0.1:3306','root',''))
//        {
//            if(database::openDatabase('wymowkidatabase'))
//            {
//                $query = "select count(*) as allimages from imagestable";
//                $sql = database::executeQuery($query) or die("Blad pobrania danych z bazy");
//                $row = mysql_fetch_array($sql);
//                extract($row);
//        
//                $pagenumber=1;//Numer strony
//                $page=2;//Ilosc na stronie
//                $pages=2;//Wyswietlana ilosc
//                $allpages = ceil($allimages/$page);
//                //echo($allimages);
//                
//                if(!isset($_GET['page']) || !is_numeric($_GET['page']) || $_GET['page']>$allpages || $_GET['page'] <= 0)
//                {
//                    $pagenumber=1;
//                }
//                else
//                {
//                    $pagenumber=$_GET['page'];
//                }
//
//                $limitpage = ($pagenumber-1)*$page;
//        
//                $query = "select * from imagestable ORDER BY idimage DESC LIMIT $limitpage, $page";
//                $sql = database::executeQuery($query) or die("Blad pobrania danych z bazy");
//        if($sql)
//        {
//            image::addImageToPage($sql);
//        }
//        if($pages > $allpages)
//        {
//            $pages = $allpages;
//        }
//        
//
//        $start = $pagenumber - floor($pages/2);
//        $end = $start + $pages;
//        
//        if($start<=0)
//        {
//            $start=1;
//        }
//        
//        $over = $allpages-$end;
//        if($over<0)
//        {
//            $start = $start + $over + 1;
//        }
//        
//        $end = $start + $pages;
//        $prev = $pagenumber-1;
//        $next = $pagenumber+1;
//        
//        $script_name = $_SERVER['SCRIPT_NAME'];
//        
//        echo "<div id='pageimages'><ul>";
//        if($pagenumber > 1) echo "<li><a href=\"".$script_name."?page=".$prev."\">Poprzednia</a></li>";
//        if ($start > 1) echo "<li><a href=\"".$script_name."?page=1\">[1]</a></li>";
//        if ($start > 2) echo "<li>...</li>";
//        for($start; $start < $end; $start++){
//                if($start == $pagenumber){
//                        echo "<li class='current'>";
//                }else{
//                        echo "<li>";
//                }
//                echo "<a href=\"".$script_name."?page=".$start."\">[".$start."]</a></li>";
//        }
//        if($start < $allpages) echo "<li>...</li>";
//        if($start - 1 < $allpages) echo "<li><a href=\"".$script_name."?page=".$allpages."\">[".$allpages."]</a></li>";
//        if($pagenumber < $allpages) echo "<li><a href=\"".$script_name."?page=".$next."\">Następna</a></li>";
//        echo "</ul></div><div class='clear'>";
//        
//        
//                
//    }
//
//}


