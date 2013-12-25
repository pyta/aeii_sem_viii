<?php
session_start();
include "image.php";
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
            var count = 0;
            $(document).ready(function(){
//                if(count==0)
//                {
//                 $('#formRank').submit();
//                 count++;
//                }
                //var a = $(".formSelectClass").length;
 
//                $(".formSelectClass").submit(function(e){
//                    e.preventDefault();
//                    //var val = $("input[type=submit][clicked=true]").val()
//                    //$(this).children().fi
//                    //alert(val);
//                    var cv = $(this).find('select').val();//attr('name');
//                    alert(cv);
//                    //alert($(this).attr('id'));
////                    for(var i=0;i<a;i++)
////                    {
////                        
////                    }
//                    //alert("ASD");
//                });
//                for(var i=0;i<a;i++)
//                {
//                    var ab = "#formSelect"+i;
//                    var bc = "#newSelect"+i;
//                    var b = $(ab).find(bc).val();
//                    alert(b);
//                    //
//                }
                
//                $.ajax({
//                    type: "GET",
//                    url: "getImages.php",
//                    dataType: "html",
//                    success:function(response){
//                        $("#page").html(response);
//                    }
//                    
//                });
//                
//                
//                var newDiv = document.createElement('div');
//                newDiv.setAttribute('id',"newDiv");
//                $("#newDiv").css("background-color","black")
//                var mainDiv = document.getElementById('page');
//                mainDiv.appendChild(newDiv);
            });
        </script>
    </head>
    <body>
        <div id="title">
           <h6>Rankingi<h6>
        </div>
        <div class="menuDiv">
            <div class="horizontalmenu"><?php include('menu.php'); ?></div>
        </div>
        <div id="rankDiv" name="rankDiv">
            <form id="formRank" name="formRank" action="rank.php" method="post">
                <label class='labelinputdata'>Sortuj według: </label>
                <select class='rankSelect' name='rankSelect' id='rankSelect'>"
                    <option selected="selected">Ocena</option>
                    <option>Data dodania</option>
                </select>
                <input type='submit' name='submitRank'/>
            </form>
        </div>
            <?php 
            //echo $_GET['rank'];
                image::indexPage('rankingi.php',$_GET['rank'],1);
            ?>
        <footer>
            
        </footer>
        <?php
        // put your code here
        ?>
    </body>
</html>
