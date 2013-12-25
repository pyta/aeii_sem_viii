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
                
              $(document).ready(function()
              {
                  $.validator.addMethod("minl",function(value,element,par)
                  { 
                      return value.length >= par;
                      //return ($("#name").val().length >= par);
                  },"Błąd");
                  $("#register").validate({
                      submitHandler: function(form) {
                        form.submit();
                      },
                      rules:{
                          name:{
                              required: true,
                              minl: 6,
                              remote: {
                                  url: "registervalidateuser.php",
                                  type:"post",
                                  data: {'loginorregister':false},
                                  ansyc: false
                              }
                          },
                          password:{
                              required: true,
                              minl: 6
                          },
                          passwordagain:{
                              required: true,
                              minl: 6,
                              equalTo: "#password"
                          },
                          email:{
                              required: true,
                              email: true,
                              remote: {
                                     url: "registervalidateemail.php",
                                     type: "post"
                                  }
                          }
                                  
                      },
                      messages: {
                          name: {
                              required: "Proszę podać nazwę użytkownika",
                              minl: "Nazwa użytkownika musi mieć przynajmniej 6 znaków",
                              remote: "Użytkownik o takiej nazwie już istnieje"
                          },
                          password:{
                              required: "Proszę podać hasło użytkownika",
                              minl: "Hasło użytkownika musi mieć przynajmniej 6 znaków"
                          },
                          passwordagain:{
                              required: "Proszę powtórzyć hasło użytkownika",
                              minl: "Hasło użytkownika musi mieć przynajmniej 6 znaków",
                              equalTo: "Podane hasła nie są identyczne"
                          },
                          email:{
                              required: "Proszę podać email użytkownika",
                              email: "Podano niepoprawny email",
                              remote: "Użytkownik z takim adresem email już istnieje"
                          }
                      }
                  });
              });
              
//              function checkEmail()
//              {
//                  
////                $("#email").(function(){
//                     var useremail = $("#email").val();
//                    $.ajax({
//                       url: 'registervalidateemail.php',
//                          data: {useremail : useremail},
//                          dataType : 'JSON',
//                            type : 'POST',
//                            cache : false,
//                         succes: function(result){
//                             alert(result);
//                             
//                         }
////                          
//                 });
//                 alert("AAA");
////                  });
//              }
//            $(document).ready(function()
//            {
//                
//                 jQuery.validator.addMethod("myCustomRule", function(value, element)
//                 {   
//                     alert("A");
//                     return $("#name").val().length > 0;
//                 },"Proszę podać nazwę użytkownika");
//                 $('#register').validate({
//                     rules:{
//                         'name':{
//                             required: true
//                         },
//                     },
//                     massages:{
//                         'name':{
//                             required: "Nazwa użytkownika jest wymagana"
//                         },
//                     }
//                 });
//                 
//            });
            
//            function checkusername(input) 
//            {
//                input.setCustomValidity('');
//               
//                if($("#name").val() == null || $("#name").val().length < 6)
//                {
//                    input.setCustomValidity('Proszę wprowadzić nazwę użytkownika');
//                }
//                
//                else
//                {
//                    input.setCustomValidity('');
//                    
//                }
//                return false;
//               
//            }
//            function validate()
//            {
//                    //onsubmit="return validate()"
//                    if(document.register.name.value == "")
//                    {
//                        alert("Prosze wprowadzić nazwę użytkownika");
//                        return false;
//                    }
//                    else if(document.register.password.value == "")
//                    {
//                        alert("Prosze wprowadzic hasło użytkownika");
//                        return false;
//                    }  
//            }
//            onsubmit="return validate(this)"
//            oninvalid="return checkusername(this)"
        </script>
    </head>
    <body>
        <div>
            <div id="title">
                <h6>Rejestracja</h6>
            </div>
            <div class="menuDiv">
                <div id="horizontalmenu"><?php include('menu.php') ?></div>
            </div>
            <div id="page">
            <form id="register" name="register" action="registerpost.php" method="post" onsubmit="return checkEmail()">               
                <label class="labelinputdata" for="username">Nazwa użytkownika</label></br>
                    <input class="inputdata" type="text" id="name" name="name"/></br>
                    <label class="labelinputdata" for="userpass">Hasło użytkownika</label></br>
                    <input class="inputdata" type="password" id="password" name="password"/></br>
                    <label class="labelinputdata" for="userpasswordagain">Powtórz hasło</label></br>
                    <input class="inputdata" type="password" id="passwordagain" name="passwordagain"/><br>
                    <label class="labelinputdata" for="useremail">Email użytkownika</label></br>
                    <input class="inputdata" type="text"name="email" id="email" /></br>
                    <input id="submitinput" type="submit" name="submit" value="Ok"/>
            </form>
            </div>  
        </div>
        <footer>
            
        </footer>
        <?php
        // put your code here
        ?>
    </body>
</html>
