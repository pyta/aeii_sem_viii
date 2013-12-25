<?php
  $nameimage = $_POST['nameimage'];
  $pathimage = $_POST['pathimage'];
  $page = $_POST['page'];
  $rate = rtrim($_POST['rate'],'/');
 
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
         <link rel="stylesheet" href="styles.css" type="text/css"/>
        <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" src="js/jquery.validate.js"></script>
        <script type="text/javascript" src="js/jquery.validate.min.js"></script>
        <script type="text/javascript" scr="js/jquery.validate.valid.js"></script>
    </head>
    <body>
        <div id="title">
           <h6>Wymowka<h6>
        </div>
        <div class="menuDiv">
            <div class="horizontalmenu"><?php include('menu.php'); ?></div>
        </div>
            <div id='page'>
            <div class = 'newDivClass' id='divImage'>  
            <?php
            $nameimage = trim($nameimage,'/');
            echo "<input class='labelImage' type='text' name='name' value='$nameimage' readonly='readonly'/></br>";
            //header("Content-type: application/json");
            $pathimage = rtrim($pathimage,'/');
            echo "<img src='$pathimage' alt='Obraz' witdh='300' height='400'/></br>";
            $database = new PDO('mysql:host=localhost;dbname=wymowkidatabase', 'root', '');
            $query = "select idimage from imagestable where nameimage='$nameimage'";
            $data = $database->query($query);
            $idimage=-1;
            foreach($data as $row)
            {
                $idimage = $row['idimage'];
            }
            $query = "select comment, iduser, datecomment from commentstable where idimage=$idimage ORDER BY idcomment DESC";
            $comm = $database->query($query);
            
            echo "<form class='formSelectClass' id='formSelect' name='formSelect' action='select.php' method='post'>"
                    . "<select class='check' name='newSelect' id='newSelect'>"
                    . "<option>1</option>"
                    . "<option>2</option>"
                    . "<option>3</option>"
                    . "<option>4</option>"
                    . "<option selected='selected'>5</option>"
                    . "<input name='page' type='hidden' value=$page/>"
                    . "<input name='name' type='hidden' value=$nameimage/>"
                    . "</select><input type=submit name='selectSubmit' id'selectSubmit/>"
                    . "<label class='labelinputdata'>Ocena:$rate</label></br>"
                    . "</form>"
                    . "<form class='formComment' id='formComment' name='formComment' action='addComment.php' method='post'>"
                    . "<input type='hidden' name='idimage' value=$idimage/>"
                    . "<input name='page' type='hidden' value=$page/>"
                    . "<input type='text' id='comment' name='comment' placeholder='Komentarz'/><input type='submit' value='Dodaj'/></form></br>";
                foreach($comm as $row)
                {
                    $comment = $row['comment'];
                    echo "<label>$comment</label></br>";
                }
              ?>
          </div>
        </div>
    </body>
</html>
