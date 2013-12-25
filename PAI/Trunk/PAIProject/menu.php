
<?php
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" src="js/jquery.validate.js"></script>
        <script type="text/javascript" src="js/jquery.validate.min.js"></script>
        <script type="text/javascript" scr="js/jquery.validate.valid.js"></script>
        <script type="text/javascript">

                var id = "<?php if(isset($_SESSION['name'])){echo $_SESSION['name'];} ?>"; 
                $(document).ready(function(){
                    if(id!=null && id.length!=0)
                    {
                    $('.logreg').bind('click',false);
                    $('.logreg').css("color","gray");
                    //$('.logreg').css("cursor","default");
                    
                    $('.logout').unbind('click',false);
                    $('.logout').css("color","white");
                    //$('.logout').css("cursor","default");
                    
                }
                else
                {
                    $('.logreg').unbind('click',false);
                    $('.logreg').css("color","white");
                    //$('.logreg').css("cursor","default");
                    
                    $('.logout').bind('click',false);
                    $('.logout').css("color","gray");
                    //$('.logout').css("cursor","default");
                }
//                    $('#log').click(function(e){
//                        e.preventDefault();
//                    });
                });
        </script>
    </head>
    <body>
        <header id="headerstyle">
            <div id="horizontalmenu">
                <ul>
                    <li><a href="login.php" title="Logowanie" class="logreg">Logowanie</a></li>
                    <li><a href="register.php" title="Rejestracja" class="logreg">Rejestracja</a></li> 
                    <li><a href="add.php" title="Dodaj" class="logregd">Dodaj</a></li>
                    <li><a href="index.php" title="Strong główna">Strona glowna</a></li>
                    <li><a href="poczekalnia.php" title="Poczekalnia">Poczekalnia</a></li>
                    <li><a href="rankingi.php?rank='rate'" title="Rankingi">Rankingi</a></li>
                    <li><a href="logout.php" title="Wyloguj" class="logout">Wyloguj</a></li>
                </ul></br>
                <label><?php if(isset($_SESSION['name'])){ echo "Witaj ", $_SESSION['name'];}else{echo"Niezalogowany";} ?></label></br>
             </div>
         </header>
        <?php
        //session_start();
        ?>
    </body>
</html>
