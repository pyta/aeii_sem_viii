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
            <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
            <script type="text/javascript" src="http://jquery.bassistance.de/validate/jquery.validate.js"></script>
            <script type="text/javascript" src="http://jquery.bassistance.de/validate/additional-methods.js"></script>

            <script type="text/javascript">
//                function setError(var messageError)
//                {
//                    errorMess = messageError;
//                }
               
            $(document).ready(function()
            {
                //var response;
                var id = "<?php if(isset($_SESSION['name'])){echo $_SESSION['name'];} ?>"; 
                //var a = $('#file').val();
                //var array =  $("#file").val().split("\\");
                //var nameFile = array[array.length-1];
                //var filename  = $('input[type=file]').val().split('\\').pop();
                 //   alert('A');
                //alert($('#file').val());
                var fileName; 
                $("form").submit(function() {
                        fileName = $("#file").val().split('\\').pop();
                });
                $.validator.addMethod("islogin",function(value,element,par)
                { 
                    if(id!=null && id.length>0)
                    { 
                        return true;
                    }
                    return false;
                });  
//                    var array =  value.split("\\");
//                    var nameFile = array[array.length-1];
//                   
//                    $.ajax({
//                    
//                        url: "aaa.php", 
//                        type: "post",
//                        
////                        data:{
////                            file: function(){
////                                return $("#file").val();
////                            }
////                        },
//                        //ansyc:false,
//                        data: {'file':nameFile},
//                        success: function(msg)
//                        {
//                            
//                            response = msg;
//                            alert('AAA');
//                        }
//                });
//                alert(response);
//                //return false;
//                });
                $("#add").validate({
                    
                    submitHandler: function(form){
                        //alert($('input[type=file]').val().split('\\').pop());
                        form.submit();
                    },
                    rules:{
                        file:{
                            required: true,
                            islogin: true,
                            remote:{
                                url:"existingValidate.php",
                                type: "post",
                                data: {name:function(){return $("#file").val().split('\\').pop();}},
                                ansyc: false
                            }
                            
                        }
                    },
                    messages:{
                        file:{
                            required: "Proszę wybrać plik",
                            islogin: "Tylko zalogowani użytkownicy mogą dodać plik",
                            remote: "Taki plik już istnieje"
                            
                        }
                    }          
                });
            });
            </script>
    </head>
    <body>
        <div>
        <div id="title">
            <h6>Dodawanie</h6>
        </div>
        <div class="menuDiv">
        <div id="horizontalmenu"><?php include('menu.php')?></div>
        </div>
        <div id="page">
            <form id="add" name="add" action="addimage.php" method="post" enctype="multipart/form-data">

                <label class ="labelinputdata" for="image">Wybierz plik</label></br>
                <input class="inputdata" type="file" id="file" name="file" accept="image/*"/></br>
                <input id="submitinput" type="submit" id="uploadimage" name="uploadimage" />       
            </form>
        </div>
            <footer>
            
        </footer>
        <?php
        // put your code here
        ?>
        </div>
    </body>
</html>
