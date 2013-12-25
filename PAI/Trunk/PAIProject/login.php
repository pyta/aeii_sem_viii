<?php
    session_start();
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
        <script type="text/javascript">
            var loginorregister = false;
            $(document).ready(function()
            {
                $("#login").validate({
                    submitHandler: function(form){
                        form.submit();
                    },
                    rules:{
                        name:{
                            required: true,
                            remote:{
                                url:"registervalidateuser.php",
                                type: "post",
                                data: {'loginorregister':true},
                                ansyc: false      
                            }
                        },
                        password:{
                            required: true,
                            remote:{
                                url:"passwordvalidateuser.php",
                                type: "post",
                                data: {
                                    name: function(){
                                        return $("#name").val();
                                    }
                                },
                                ansyc: false
                            }
                        }
                    },
                    messages:{
                        name:{
                            required: "Proszę podać nazwę użytkownika",
                            remote: "Użytkownik o takiej nazwie nie istnieje"
                        },
                        password:{
                            required: "Proszę podać hasło",
                            remote: "Podano nieprawidłowe hasło"
                        }
                    }          
                });
            });
        </script>
    </head>
    <body>
        <div>
            <div id = title>
                <h6>Strona logowania<h6>
            </div>
         <div class="menuDiv">
            <div id="horizontalmenu"><?php include('menu.php'); ?></div>
         </div>
        <div id="page">
            <form id="login" name="login" action="loginpost.php" method="post">
                <lable class ="labelinputdata" for="username">Nazwa użytkownika</label></br>
                <input class="inputdata" type="text" name="name" id="name"/></br>
                <label class ="labelinputdata" for="userpass">Hasło użytkownika</label></br>
                <input class= "inputdata" type="password" name="password" id="password"/></br>
                <input id="submitinput" type="submit" name="submit" value="Ok"/>
            </form>
        </div>
        </div>
        <footer>
            
        </footer>
        <?php
        ?>
    </body>
</html>

