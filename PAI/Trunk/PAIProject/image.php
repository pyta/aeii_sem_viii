<?php

class image {
    
    private $arrayExt;
    private $commArray;
    var $sort;
    
    static function setSort($sortValue)
    {
        $this->sort=$sortValue;
    }
    
    static function getSort()
    {
        return $this->sort;
    }
    static function addImageToPage($getData, $page)
    {
        $commArray=array("","");
        $index=0;
        $database = new PDO('mysql:host=localhost;dbname=wymowkidatabase', 'root', '');
       
        foreach($getData as $data)
        {   
            $commArray=array("","");
            $query = "select comment from commentstable where idimage=$data[0] ORDER BY idcomment DESC LIMIT 0,2";
            $comm = $database->query($query);
            if($comm==false)
            {
                echo "Blad";
            }
            $index=0;
            foreach($comm as $row)
            {
                $commArray[$index]=$row[0];
                $index++;
            }
            $comm->closeCursor();
            echo "<div class = 'newDivClass' id='newDiv$index'>";      
            echo 
                    
                    "<input class='labelImage' type='text' name='name' value='$data[2]' readonly='readonly'/></br>"
                    . "<form id='linkimage$index' name='linkimage$index' action='imagepage.php' method='post'>"
                    . "<input name='nameimage' type='hidden' value=$data[2]/>"
                    . "<input name='pathimage' type='hidden' value=$data[1]/>"
                    . "<input name='page' type='hidden' value=$page/>"
                    . "<input name='rate' type='hidden' value=$data[5]/>"
                    . "<a href='javascript:document.linkimage$index.submit()' id='imagelink'><img src='$data[1]' alt='Obraz' witdh='300' height='400'/></a></br>"
                    . "</form>"
                    . "<form class='formSelectClass' id='formSelect$index' name='formSelect$index' action='select.php' method='post'>"
                    . "<select class='check' name='newSelect' id='newSelect$index'>"
                    . "<option>1</option>"
                    . "<option>2</option>"
                    . "<option>3</option>"
                    . "<option>4</option>"
                    . "<option selected='selected'>5</option>"
                    . "<input name='page' type='hidden' value=$page/>"
                    . "<input name='name' type='hidden' value=$data[2]/>"
                    . "</select><input type=submit name='selectSubmit' id'selectSubmit$index'/>"
                    . "<label class='labelinputdata'>Ocena: $data[5]</label></br>"
                    . "</form>"
                    . "<form class='formComment' id='formComment$index' name='formComment$index' action='addComment.php' method='post'>"
                    . "<input type='hidden' name='idimage' value=$data[0]/>"
                    . "<input name='page' type='hidden' value=$page/>"
                    . "<input type='text' id='comment' name='comment' placeholder='Komentarz'/><input type='submit' value='Dodaj'/></form></br>"
                    . "<label> $commArray[0]</label></br>"
                    . "<label> $commArray[1]</label>";
            echo "</div>";
            $index++;
        }
    }
    
    static function checkExtensionImage()
    {
        $arrayExt = array("gif","jpg","jpeg","png");
        $nameext = explode(".", $_FILES["file"]["name"]);
        $ext = end($nameext);
        if ((($_FILES["file"]["type"] == "image/gif")
        || ($_FILES["file"]["type"] == "image/jpeg")
        || ($_FILES["file"]["type"] == "image/jpg")
        || ($_FILES["file"]["type"] == "image/pjpeg")
        || ($_FILES["file"]["type"] == "image/x-png")
        || ($_FILES["file"]["type"] == "image/png"))
        && in_array($ext, $arrayExt))
        {
            return true;
        }
        return false;
    }
    
    static function isErrorImage()
    {
        if($_FILES["file"]["error"]>0)
        {
             return true;
        }
        return false;
    }
    
    static function fileExists()
    {
        if(file_exists("images/" . $_FILES["file"]["name"]))
        {
            return true;
        }
        return false;
    }

    
    static function uploadImage()
    {
        move_uploaded_file($_FILES["file"]["tmp_name"], "images/" . $_FILES["file"]["name"]);
    }
    
    static function indexPage($script, $queryVal, $accept)
    {

            echo "<div id='page' name ='page'>";
            //<?php
            
            include "database.php";
            //include "image.php";
            $database = new PDO('mysql:host=localhost;dbname=wymowkidatabase', 'root', '');
            $query = "select count(*) as allimages from imagestable where accept=$accept";
            $countData = $database->query($query)->fetchColumn();
            $results = 2;
            $pages = ceil($countData/$results);
            $page=0;
            if(!isset($_GET['page']))
            {
                $page=1;
            }
            else
            {
                $page=$_GET['page'];
            }
            //$page = isset($_GET['page']) ? $_GET['page'] : 1;
            $next = $page + 1;
            $back = $page - 1;
            $start = $page * $results - $results;            
            $queryVal = trim($queryVal,"'");
            $query = "select * from imagestable where accept=$accept ORDER BY $queryVal DESC LIMIT $start, $results";
            $getData = $database->query($query)->fetchAll();
            image::addImageToPage($getData,$page);
            $index=0;
            $script_name = $_SERVER['SCRIPT_NAME'];
            echo "<div id='pageimages'><ul>";
            if($page > 1) {
                echo '<li><a class="pagenumbre" href="'.$script.'?page=' . $back . '&amp;rank='.$queryVal.'">Poprzednia</a></li>';
            }
            for($pg=1; $pg<=$pages; $pg++) {
                echo('<li><a href="'.$script.'?page=' . $pg . '&amp;rank='.$queryVal.'">' . $pg . '</a></li>');
            }
            if($page < $pages) {
                echo '<li><a class="pagenumbre" href='.$script.'?page=' . $next . '&amp;rank='.$queryVal.'">Nastepna</a></li>';
            }
            echo"</ul></div><div class='clear'>";
            
            echo "</div>";
    }
}
