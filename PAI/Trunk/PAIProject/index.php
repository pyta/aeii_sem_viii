<?php
session_start();
include "image.php";
$_GET['rank']='idimage';
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
            $(document).ready(function()
            {
                var id = "<?php if(isset($_SESSION['name'])){echo $_SESSION['name'];} ?>"; 
//                $("#imagelink").click(function(){
//                    alert("A");
//                    $.post("imagepage.php",name:"imie");
//                });
                $.validator.addMethod("islogin",function(value,element,par)
                {
                    if(id!=null && id.length>0)
                    {
                        return true;
                    }
                    return false;
                });
                   $(".formComment").validate({
                     submitHandler: function (form){
                          return form.submit();
                      },
                     rules:{
                      comment:{
                          required:true,
                          islogin: true
                      }
                     
                    },
                    messages:{
                      comment:{
                          required: "Nie można dodać pustego komentarza",
                          islogin: "Aby dodać komentarz trzeba się zalogować"
                      }
                  }
                 
             });
            });
//                
//                //var a = $(".formSelectClass").length;
//                  $(".formComment").validate({
//                      submitHandler: function (form){
//                          return form.submit();
//                      }
//                  },
//                  rules:{
//                      comment:{
//                          required:true
//                      }
//                  },
//                  messages:{
//                      comment:{
//                          required: "Nie można dodać pustego komentarza"
//                      }
//                  }
//             });
                    
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
  //          });
        </script>
    </head>
    <body>
        <div id="title">
           <h6>Wymowka<h6>
        </div>
        <div class="menuDiv">
            <div class="horizontalmenu"><?php include('menu.php'); ?></div>
            
        </div>
            <?php
                
                //image::setSort("idimage");
                image::indexPage('index.php', $_GET['rank'],1);
            ?>
        <footer>
            
        </footer>
        <?php
        // put your code here
        ?>
    </body>
</html>
